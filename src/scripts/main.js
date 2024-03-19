console.log("main");

function throttle(func, limit) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    if (!timeout) {
      func.apply(context, args);
      timeout = setTimeout(function () {
        timeout = null;
      }, limit);
    }
  };
}
