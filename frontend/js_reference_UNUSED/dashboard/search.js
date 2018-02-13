{
  const Stream = window.lib.Stream;
  const f = window.lib.f;
  const api = window.lib.api;
  const validate = window.lib.validate;
  const eventView = window.lib.views.event;

  const fromSearch = searchBar =>
    Stream
    .fromEvent(searchBar, 'input')
    .map(event => event.target.value)
    .debounce(500);

  const deleteHandler = event =>
    api.deleteEvent(event.target.dataset.id)
       .then(() => alert('Event successfully deleted'))
       .then(() => {
         const parent = f.parentQuery(event.target, element => element.classList.contains('event'));
         parent.parentNode.removeChild(parent);
       })
       .catch(() => alert('Could not delete event'));

  const favoriteHandler = event =>
    api.postFavorite(event.target.dataset.id)
       .then(() => {
         event.target.removeEventListener('click', favoriteHandler);
         event.target.addEventListener('click', unfavoriteHandler);
         event.target.classList.remove('favorite-color', 'secondary-bg-color');
         event.target.classList.add('secondary-color', 'favorite-bg-color');
         const oldValue = event.target.value.split(' ');
         event.target.value = `${oldValue[0]} ${parseInt(oldValue[1]) + 1}`
       })
       .catch(() => alert('Could not favorite event'));

  const unfavoriteHandler = event =>
    api.postUnfavorite(event.target.dataset.id)
       .then(() => {
         event.target.removeEventListener('click', unfavoriteHandler);
         event.target.addEventListener('click', favoriteHandler);
         event.target.classList.remove('secondary-color', 'favorite-bg-color');
         event.target.classList.add('favorite-color', 'secondary-bg-color');
         const oldValue = event.target.value.split(' ');
         event.target.value = `${oldValue[0]} ${parseInt(oldValue[1]) - 1}`
       })
       .catch(() => alert('Could not unfavorite event'));

  const editHandler = e => {
    const id = e.target.dataset.id;
    const modal = document.getElementById('modal-edit');
    const elements = {
      title: document.getElementById('edit-title'),
      description: document.getElementById('edit-description'),
      date: document.getElementById('edit-date'),
      startTime: document.getElementById('edit-start'),
      endTime: document.getElementById('edit-end'),
      room: document.getElementById('edit-room'),
      building: document.getElementById('edit-building'),
      id: document.getElementById('edit-id'),
    };

    api.getSearch({ id })
       .then(json => json.events[0])
       .then(event => {
         elements.title.value = event.name;
         elements.description.value = event.description;
         elements.date.value = event.date;
         elements.startTime.value = event.startTime;
         elements.endTime.value = event.endTime;
         elements.room.value = event.room;
         elements.building.value = event.building;
         elements.id.value = id;
         modal.classList.remove('hidden');
       })
       .catch(err => console.error(err));
  };


  const elements = {
    order: document.getElementById('order'),
    sorting: document.getElementById('sorting'),
    search: document.getElementById('search'),
    startDate: document.getElementById('startDate'),
    endDate: document.getElementById('endDate'),
    startTime: document.getElementById('startTime'),
    endTime: document.getElementById('endTime'),
    room: document.getElementById('room'),
    building: document.getElementById('building'),
    favorited: document.getElementById('favorited'),
    onlyNJIT: document.getElementById('onlyNJIT'),
    onlyUser: document.getElementById('onlyUser'),
    mine: document.getElementById('mine'),
  };


  const filterStream = fromSearch(elements.search)
    .map(search => ({ search }))
    .merge(Stream
           .fromSelect(elements.order)
           .map(order => ({ order })))
    .merge(Stream
           .fromSelect(elements.sorting)
           .map(sorting => ({ sorting })))
    .merge(Stream
           .fromInput(elements.startDate)
           .filter(date => date === '' || validate.date(date))
           .map(startDate => ({ startDate })))
    .merge(Stream
           .fromInput(elements.endDate)
           .filter(date => date === '' || validate.date(date))
           .map(endDate => ({ endDate })))
    .merge(Stream
           .fromInput(elements.startTime)
           .filter(date => date === '' || validate.time(date))
           .map(startTime => ({ startTime })))
    .merge(Stream
           .fromInput(elements.endTime)
           .filter(date => date === '' || validate.time(date))
           .map(endTime => ({ endTime })))
    .merge(Stream
           .fromInput(elements.room)
           .debounce(250)
           .map(room => ({ room })))
    .merge(Stream
           .fromSelect(elements.building)
           .map(building => ({ building })))
    .merge(Stream
           .fromCheckbox(elements.favorited)
           .map(favorited => ({ favorited })))
    .merge(Stream
           .fromCheckbox(elements.onlyNJIT)
           .map(onlyNJIT => ({ onlyNJIT })))
    .merge(Stream
           .fromCheckbox(elements.onlyUser)
           .map(onlyUser => ({ onlyUser })))
    .merge(Stream
           .fromCheckbox(elements.mine)
           .map(mine => ({ mine })))
    .reduce({}, f.assign)
    .log('filter object');


  filterStream
    .subscribe(filterObject => {
      api.getSearch(filterObject)
        .then(json => {
          const events = json.events;
          return api.getSelf()
            .then(self => events.map(event => eventView(event, self.id, self.admin)))
            .catch(console.error);
        })
        .then(newInnerHTML => {
          const main = document.getElementsByClassName('main')[0];
          main.innerHTML = newInnerHTML.join('\n');
          return main;
        })
        .then(main => {
          const deleteButtons = Array.from(main.getElementsByClassName('delete-button'));
          deleteButtons.forEach(button => button.addEventListener('click', deleteHandler));

          const favoriteButtons = Array.from(main.getElementsByClassName('favorited-button'));
          favoriteButtons.forEach(button => button.addEventListener('click', unfavoriteHandler));

          const notFavoriteButtons = Array.from(main.getElementsByClassName('not-favorited-button'));
          notFavoriteButtons.forEach(button => button.addEventListener('click', favoriteHandler));

          const editButtons = Array.from(main.getElementsByClassName('edit-button'));
          editButtons.forEach(button => button.addEventListener('click', editHandler));
        })
        .catch(error => console.error(error));
    });
}
