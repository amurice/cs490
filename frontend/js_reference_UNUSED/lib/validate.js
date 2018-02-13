{
  window.lib = window.lib || {};
  window.lib.validate = {};
  const exports = window.lib.validate;

  exports.date = input => {
    const regex = /^\d{4}-\d{1,2}-\d{1,2}$/;
    if (!regex.test(input)) return false;

    const tokens = input.split('-');
    const year = tokens[0];
    if (year < 2016) return false;

    const month = tokens[1];
    if (month < 1 || month > 12) return false;

    const day = tokens[2];
    if (day < 1 || day > 31) return false;

    return true;
  };

  exports.time = input => {
    const regex = /\d{1,2}:\d{2}/;
    if (!regex.test(input)) return false;

    const tokens = input.split(':');
    const hours = tokens[0];
    if (hours < 0 || hours > 23) return false;

    const minutes = tokens[1];
    if (minutes < 0 || minutes > 59) return false;

    return true;
  };
}
