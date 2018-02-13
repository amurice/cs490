{
  window.lib = window.lib || {};
  window.lib.time = {};
  const exports = window.lib.time;

  exports.delay = (milliseconds) => (argument) => new Promise(fulfill => {
    setInterval(fulfill.bind(undefined, argument), milliseconds);
  });

  exports.timeout = (milliseconds, errMessage) => new Promise((_, reject) => {
    errMessage = errMessage || `Timed out in ${milliseconds} milliseconds`;
    setTimeout(() => {
      reject(new Error(errMessage));
    }, milliseconds);
  });
}
