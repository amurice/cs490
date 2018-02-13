{
  const Stream = window.lib.Stream;
  const api = window.lib.api;
  const time = window.lib.time;
  const validate = window.lib.validate;


  const hideModalForm = (container, form, submitButton) => {
    container.classList.add('hidden');
    form.reset();
    submitButton.disabled = true;
  };

  const showModalForm = (container, form, submitButton) => {
    container.classList.remove('hidden');
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


  const buttons = {
    showNew: document.querySelector('[value="Create Event"]'),
    cancel: document.getElementById('create-cancel'),
    submit: document.getElementById('create-submit'),
  };
  const formContainer = document.getElementById('modal-create');
  const newEventForm = formContainer.getElementsByTagName('form')[0];

  Stream
    .fromEvent(buttons.showNew, 'click')
    .subscribe(() => showModalForm(formContainer, newEventForm, buttons.submit));

  Stream
    .fromEvent(buttons.cancel, 'click')
    .subscribe(() => hideModalForm(formContainer, newEventForm, buttons.submit));


  const requiredFields = Array
    .from(newEventForm.getElementsByTagName('input'))
    .filter(element => element.required);

  const properties = {
    title: Stream.fromInput(document.getElementById('create-title')),
    date: Stream.fromInput(document.getElementById('create-date')),
    startTime: Stream.fromInput(document.getElementById('create-start')),
    endTime: Stream.fromInput(document.getElementById('create-end')),
    room: Stream.fromInput(document.getElementById('create-room')),
    building: Stream.fromSelect(document.getElementById('create-building')),
    description: Stream.fromInput(document.getElementById('create-description')),
  };

  fieldsFilled(requiredFields)
    .and(properties.building.map(value => value !== ''))
    .and(properties.date.map(validate.date))
    .and(properties.startTime.map(validate.time))
    .and(properties.endTime.map(validate.time))
    .merge(Stream.fromEvent(newEventForm, 'reset').map(() => false))
    .subscribe(allowSubmit => {
      buttons.submit.disabled = !allowSubmit;
    });

  Stream
    .fromEvent(buttons.submit, 'click')
    .subscribe(() => {
      const body = {
        title: properties.title.get() || '',
        date: properties.date.get() || '',
        startTime: properties.startTime.get() || '',
        endTime: properties.endTime.get() || '',
        room: properties.room.get() || '',
        building: properties.building.get() || '',
        description: properties.description.get() || '',
      };

      api.postEvent(body)
        .then(json => alert(json.message))
        .then(() => hideModalForm(formContainer, newEventForm, buttons.submit))
        .catch(error => alert(error));
    });
}
