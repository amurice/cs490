{
  const Stream = window.lib.Stream;
  const time = window.lib.time;

  const logoutButton = document.querySelector('[value="Logout"]');
  Stream
    .fromEvent(logoutButton, 'click')
    .subscribe(() => {
      const requestOptions = {
        method: 'PUT',
        credentials: 'same-origin',
      };
      const parallels = [
        fetch('php/middle.php?endpoint=logout.php', requestOptions),
        time.timeout(5000, 'Logout timed out. (?)'),
      ];

      Promise.race(parallels)
        .then(response => (response.statusText === 'OK')
          ? Promise.resolve()
          : Promise.reject(response.statusText))
        .then(() => {
          document.cookie = 'PHPSESSID=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        })
        .then(() => {
          window.location = 'index.html';
        })
        .catch(error => console.error(error));
    });
}
