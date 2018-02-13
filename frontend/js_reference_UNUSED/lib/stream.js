{
  const f = window.lib.f;

  function Stream(defaultValue) {
    this.subscribers = [];
    this.value = defaultValue || undefined;
  }

  Stream.fromEvent = (EventTarget, eventName, defaultValue) => {
    const stream = new Stream(defaultValue);
    EventTarget.addEventListener(eventName, event => stream.pulse(event));
    return stream;
  };

  Stream.fromInput = (eventTarget, defaultValue) => Stream
  .fromEvent(eventTarget, 'input', defaultValue)
  .map(event => event.target.value);

  Stream.fromSelect = (eventTarget, defaultValue) => Stream
  .fromEvent(eventTarget, 'change', defaultValue)
  .map(event => event.target.value);

  Stream.fromCheckbox = (eventTarget, defaultValue) =>
    Stream
      .fromEvent(eventTarget, 'click', defaultValue)
      .map(event => event.target.checked);

  Stream.poll = (func, rate) => {
    const stream = new Stream();
    window.setInterval(() => stream.pulse(func()), rate);
    return stream;
  };


  Stream.prototype.pulse = function pulse(value) {
    this.value = value;
    this.subscribers.forEach(cb => cb(this.value));
    return this;
  };

  Stream.prototype.subscribe = function subscribe(func) {
    this.subscribers.push(func);
    return this;
  };

  Stream.prototype.skipDuplicates = function skipDuplicates() {
    const stream = new Stream(this.value);
    this.subscribe(value => {
      if (value !== stream.get()) stream.pulse(value);
    });
    return stream;
  };

  Stream.prototype.map = function map(transform) {
    const stream = new Stream();
    this.subscribe(value => stream.pulse(transform(value)));
    return stream;
  };

  Stream.prototype.log = function log(tag) {
    return this.subscribe(value => console.log({ tag, value }));
  };

  Stream.prototype.merge = function merge(otherStream) {
    const newStream = new Stream();
    this.subscribe(value => newStream.pulse(value));
    otherStream.subscribe(value => newStream.pulse(value));
    return newStream;
  };

  Stream.prototype.filter = function filter(predicate) {
    const stream = new Stream();
    this.subscribe(value => {
      if (predicate(value)) stream.pulse(value);
    });
    return stream;
  };

  Stream.prototype.debounce = function debounce(wait) {
    const stream = new Stream();
    this.subscribe(f.debounce(value => {
      stream.pulse(value);
    }, wait));
    return stream;
  };

  Stream.prototype.reduce = function reduce(initial, reducer) {
    const stream = new Stream();
    let accumulated = initial;
    this.subscribe(value => {
      accumulated = reducer(accumulated, value);
      stream.pulse(accumulated);
    });
    return stream;
  };

  Stream.prototype.get = function get() {
    return this.value;
  };

  Stream.prototype.combine = function combine(otherStream, combiner) {
    const newStream = new Stream();

    this.subscribe(value => {
      const otherValue = otherStream.get();
      newStream.pulse(combiner(value, otherValue));
    });

    otherStream.subscribe(value => {
      const otherValue = this.get();
      newStream.pulse(combiner(value, otherValue));
    });

    return newStream;
  };

  Stream.prototype.and = function and(otherStream) {
    const andFunc = (a, b) => a && b;
    return this.combine(otherStream, andFunc);
  };


  window.lib = window.lib || {};
  window.lib.Stream = Stream;
}
