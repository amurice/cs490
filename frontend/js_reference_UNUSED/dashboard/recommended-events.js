{
  const Stream = window.lib.Stream;
  const api = window.lib.api;
  const validate = window.lib.validate;
  const f = window.lib.f;
  const views = window.lib.views

  const inputPollStream = element =>
    Stream
      .fromInput(element)
      .merge(Stream.poll(() => element.value, 2000));

  const elements = {
    date: document.getElementById('create-date'),
    startTime: document.getElementById('create-start'),
    endTime: document.getElementById('create-end'),
    eventSection: document.getElementsByClassName('recommended-list')[0],
  };

  inputPollStream(elements.date)
    .filter(validate.date)
    .skipDuplicates()
    .map(date => ({ startDate: date, endDate: date }))
    .merge(inputPollStream(elements.startTime)
           .filter(validate.time)
           .skipDuplicates()
           .map(startTime => ({ startTime })))
    .merge(inputPollStream(elements.endTime)
           .filter(validate.time)
           .skipDuplicates()
           .map(endTime => ({ endTime })))
    .reduce({}, f.assign)
    .subscribe(filterObject => {
      api.getSearch(filterObject)
         .then(json => json.events)
         .then(events => events.map(views.recommendedEvent))
         .then(eventViews => eventViews.join('\n'))
         .then(newInnerHTML => {
           elements.eventSection.innerHTML = newInnerHTML;
         })
         .catch(error => console.error(error));
    });
}
