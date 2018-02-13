{
  const Stream = window.lib.Stream;

  const profileName = document.getElementById('profile-name');
  Stream
    .fromEvent(document, 'DOMContentLoaded')
    .subscribe(() =>
      fetch('php/middle.php?endpoint=self.php', { credentials: 'same-origin' })
        .then(response => response.json())
        .then(json => {
          profileName.innerHTML = json.username || '';
        })
        .catch(err => console.error(err))
    );
}
