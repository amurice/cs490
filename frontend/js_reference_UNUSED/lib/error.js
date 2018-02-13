{
  window.lib = window.lib || {};
  window.lib.error = {};
  const exports = window.lib.error;

  exports.FormValidationError = (message) => {
    this.name = 'FormValidationError';
    this.message = message;
    this.stack = (new Error()).stack;
  };
  exports.FormValidationError.prototype = Object.create(Error.prototype);
  exports.FormValidationError.prototype.constructor = exports.FormValidationError;
}
