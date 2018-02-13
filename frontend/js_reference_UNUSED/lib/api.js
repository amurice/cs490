{
  window.lib = window.lib || {};
  window.lib.api = {};


  const ifSuccessfulResponse = response => {
    if (response.ok) return Promise.resolve(response);
    return Promise.reject('Response code was not within 200-299 range');
  };

  const snagJSON = response => response.json();

  const objectToParams = object =>
    '&' + Object
      .keys(object)
      .filter(key => object[key] !== '' && object[key] !== undefined)
      .map(key => `${key}=${encodeURIComponent(object[key])}`)
      .join('&');

  const exports = window.lib.api;

  exports.getBuildings = () => {
    const requestOptions = {
      method: 'GET',
    };

    return fetch('php/middle.php?endpoint=locations.php', requestOptions)
      .then(ifSuccessfulResponse)
      .then(snagJSON);
  };

  exports.deleteEvent = id => {
    const requestOptions = { credentials: 'same-origin', method: 'DELETE' };

    return fetch(`php/middle.php?endpoint=delete.php&id=${id}`, requestOptions)
      .then(ifSuccessfulResponse);
  };

  exports.postFavorite = id => {
    const requestOptions = {
      credentials: 'same-origin',
      method: 'POST',
      body: JSON.stringify({ id }),
    };

    return fetch('php/middle.php?endpoint=favorite.php', requestOptions)
      .then(ifSuccessfulResponse);
  };

  exports.postUnfavorite = id => {
    const requestOptions = {
      credentials: 'same-origin',
      method: 'POST',
      body: JSON.stringify({ id }),
    };

    return fetch('php/middle.php?endpoint=unfavorite.php', requestOptions)
      .then(ifSuccessfulResponse);
  };

  exports.getSelf = () =>
    fetch('php/middle.php?endpoint=self.php', { credentials: 'same-origin' })
    .then(ifSuccessfulResponse)
    .then(snagJSON);

  exports.getSearch = options => {
    options = options || {};
    options.offset = 0;
    options.count = 100;

    const requestOptions = { credentials: 'same-origin', method: 'GET' };
    const paramString = objectToParams(options);
    return fetch(`php/middle.php?endpoint=search.php${paramString}`, requestOptions)
      .then(ifSuccessfulResponse)
      .then(snagJSON);
  };

  exports.postEvent = body => {
    const requestOptions = {
      method: 'POST',
      body: JSON.stringify(body || {}),
      credentials: 'same-origin',
    };

    return fetch('php/middle.php?endpoint=create.php', requestOptions)
      .then(ifSuccessfulResponse)
      .then(snagJSON)
      .then(json => {
        if (json.message === 'Event successfully created') return json;
        return Promise.reject(json.message);
      });
  };

  exports.postLogin = body => {
    const requestOptions = {
      method: 'POST',
      credentials: 'same-origin',
      body: JSON.stringify(body || {}),
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
    };

    return fetch('php/middle.php?endpoint=login.php', requestOptions)
      .then(ifSuccessfulResponse)
      .then(snagJSON)
      .then(json => {
        if (json.message === 'Valid login') return json;
        return Promise.reject(json.message);
      });
  };

  exports.putModify = body => {
    const requestOptions = {
      method: 'POST',
      body: JSON.stringify(body || {}),
      credentials: 'same-origin',
    };

    return fetch('php/middle.php?endpoint=modify.php', requestOptions)
      .then(ifSuccessfulResponse);
  };
}
