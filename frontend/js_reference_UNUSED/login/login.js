{
  const Stream = window.lib.Stream;
  const api = window.lib.api;

  const allFieldsFilled = inputElements => {
    const reducer = (previous, current) => previous.and(current);

    return inputElements
    .map(inputElement => Stream.fromEvent(inputElement, 'input'))
    .map(inputStream => inputStream.map(event => event.target.value))
    .map(textStream => textStream.map(text => text.length > 0))
    .reduce(reducer);
  };

  const loginForm = document.getElementById('login');
  const usernameInput = loginForm.querySelector('[type="text"]');
  const passwordInput = loginForm.querySelector('[type="password"]');
  const loginButton = document.getElementById('login-button');
  const guestButton = document.getElementById('guest-button');

  const usernameProperty = Stream.fromInput(usernameInput);
  const passwordProperty = Stream.fromInput(passwordInput);


  allFieldsFilled([usernameInput, passwordInput])
  .subscribe(allFilled => {
    loginButton.disabled = !allFilled;
  });

  Stream
  .fromEvent(loginButton, 'click')
  .subscribe(() => {
    const body = {
      username: usernameProperty.get(),
      password: passwordProperty.get(),
    };

    api.postLogin(body)
    .then(() => {
      window.location = 'dashboard.html';
    })
    .catch(error => alert(error));
  });

  Stream
  .fromEvent(guestButton, 'click')
  .subscribe(() => {
    window.location = 'dashboard.html';
  });
}
