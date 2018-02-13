{
  const Stream = window.lib.Stream;
  const validate = window.lib.validate;
  const api = window.lib.api;


  const hideModalForm = (container, form, submitButton) => {
    container.classList.add('hidden');
    form.reset();
    submitButton.disabled = true;
  };

  const fieldsFilled = inputElements =>
    inputElements
    .map(element =>
      Stream
      .fromInput(element, 'input')
      .merge(Stream.poll(() => element.value, 2000))
      .map(string => string.length > 0))
    .reduce((previousStream, currentStream) => previousStream.and(currentStream));

  const pollField = inputElement => {
    return Stream
      .fromInput(inputElement)
      .merge(Stream.poll(() => inputElement.value, 1000));
  };

  const pollSelect = selectElement => {
    return Stream
      .fromSelect(selectElement)
      .merge(Stream.poll(() => selectElement.value, 1000));
  }


  const buttons = {
    cancel: document.getElementById('edit-cancel'),
    submit: document.getElementById('edit-submit'),
  };
  const formContainer = document.getElementById('modal-edit');
  const editEventForm = formContainer.getElementsByTagName('form')[0];

  const requiredFields = Array
    .from(editEventForm.getElementsByTagName('input'))
    .filter(element => element.required);

  const properties = {
    date: pollField(document.getElementById('edit-date')),
    startTime: pollField(document.getElementById('edit-start')),
    endTime: pollField(document.getElementById('edit-end')),
    room: pollField(document.getElementById('edit-room')),
    building: pollSelect(document.getElementById('edit-building')),
  };

  Stream
    .fromEvent(buttons.cancel, 'click')
    .subscribe(() => {
      hideModalForm(formContainer, editEventForm, buttons.submit);
    });

  fieldsFilled(requiredFields)
    .and(properties.building.map(value => value !== ''))
    .and(properties.date.map(validate.date))
    .and(properties.startTime.map(validate.time))
    .and(properties.endTime.map(validate.time))
    .merge(Stream.fromEvent(editEventForm, 'reset').map(() => false))
    .subscribe(allowSubmit => {
      buttons.submit.disabled = !allowSubmit;
    });

  Stream
    .fromEvent(buttons.submit, 'click')
    .subscribe(() => {
      const body = {
        date: properties.date.get() || '',
        startTime: properties.startTime.get() || '',
        endTime: properties.endTime.get() || '',
        room: properties.room.get() || '',
        building: properties.building.get() || '',
        id: document.getElementById('edit-id').value,
      };

      api.putModify(body)
        .then(() => hideModalForm(formContainer, editEventForm, buttons.submit))
        .catch(error => alert(error));
    });
}
