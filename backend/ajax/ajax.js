export function ajax(method, url, data, callback) {
  const request = new XMLHttpRequest();
  request.open(method.toUpperCase(), url, true);
  request.onload = () => {
    callback(request);
  };
  if (arguments.length < 4) {
    callback = arguments[2];
  }
  if (typeof data == 'string') {
    request.setRequestHeader(
      'Content-type',
      'application/x-www-form-urlencoded'
    );
  }
  request.send(data);
}
