import { ajax } from './ajax.js';
window.addEventListener('pageshow', () => {
  // ------------- Calling all functions ------------
  staticEventHandlers();
  // ---------------- Static Event Handlers ----------------
  function staticEventHandlers() {
    logoutModal();
    // ------------------ Toggle logout modal -------------------
    function logoutModal() {
      const logout = document.querySelector('#logout');
      const logout_modal = document.querySelector('#logout_modal');
      const yes = document.querySelector('#yes');
      const cancel = document.querySelector('#cancel');
      logout.onclick = () => {
        logout_modal.classList.add('show');
        yes.onclick = () => {
          logoutUser();
        };
        cancel.onclick = () => {
          logout_modal.classList.remove('show');
        };
      };
    }
    // -------------- Logout code --------------------
    function logoutUser() {
      let logoutUrl = '../../backend/php/logout.php';
      ajax('POST', logoutUrl, function (res) {
        if (res.response == 'loggedout') {
          window.location = '../../';
        }
      });
    }
  }
});
