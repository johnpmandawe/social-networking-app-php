import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  countNotifs();
  setInterval(() => {
    countNotifs();
  }, 500);
  function countNotifs() {
    const count_notifs = document.querySelector('.count_notifs');
    const pathname = window.location.pathname.split('/');
    let url = '';
    if (
      pathname.includes('users') &&
      !pathname.includes('post') &&
      !pathname.includes('friends') &&
      !pathname.includes('profile') &&
      !pathname.includes('notifs')
    ) {
      url = '../backend/php/countNotifs.php';
    } else if (
      pathname.includes('users') &&
      ((pathname.includes('post') && pathname.includes('users')) ||
        (pathname.includes('friends') && pathname.includes('users')) ||
        (pathname.includes('profile') && pathname.includes('users')) ||
        (pathname.includes('notifs') && pathname.includes('users')))
    ) {
      url = '../../backend/php/countNotifs.php';
    }
    ajax('GET', url, function (res) {
      count_notifs.innerText = res.response;
    });
  }
});
