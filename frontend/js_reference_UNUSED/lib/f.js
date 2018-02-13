{
  window.lib = window.lib || {};
  window.lib.f = {};
  const exports = window.lib.f;

  exports.partial = (func, ...args) => func.bind(this, ...args);

  exports.debounce = (func, wait) => {
    let timeout;
    return (...args) => {
      const later = exports.partial(func, ...args);
      window.clearTimeout(timeout);
      timeout = window.setTimeout(later, wait);
    };
  };

  exports.assign = (base, extension) => {
    const newObject = {};
    Object.keys(base)
    .forEach(key => {
      newObject[key] = base[key];
    });

    Object.keys(extension)
    .forEach(key => {
      newObject[key] = extension[key];
    });
    return newObject;
  };

  exports.toKeys = (array, value) => {
    const obj = {};
    array.forEach(element => {
      obj[element] = value;
    });
    return obj;
  };

  exports.range = (end) => {
    const array = [];
    for (let index = 0; index < end; index++) {
      array.push(index);
    }
    return array;
  };

  exports.parentQuery = (element, predicate) => {
    let current = element;
    while (current !== document) {
      if (predicate(current)) return current;
      current = current.parentNode;
    }
    return undefined;
  };
}
