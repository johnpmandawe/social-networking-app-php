import { timeAgo } from './timeAgo.js';
import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  // --------------- function calls -----------------
  getNotifs();
  setInterval(() => {
    getNotifs();
  }, 500);
  dynamicEvents();
  // ----------------- get notifs -------------------
  function getNotifs() {
    const load_notifs = document.querySelector('#load_notifs');
    let html = '';
    load_notifs.onmouseenter = () => {
      load_notifs.classList.add('active');
    };
    load_notifs.onmouseleave = () => {
      load_notifs.classList.remove('active');
    };
    ajax('GET', '../../backend/php/getNotifs.php', function (res) {
      let notifs = JSON.parse(res.response);

      if (notifs.length === 0) {
        html += 'No notifs to show.';
      }
      notifs.forEach((notif) => {
        const { notif_id, notif_from, notif_content, notif_date, notif_type } =
          notif;
        html += `<div class='notif flex' data-type='${notif_type}' data-id='${notif_id}' data-from='${notif_from}'>
                        <span class='delete'>&times</span>
                        <p>${notif_content}</p>
                        <span>${timeAgo(new Date(notif_date))}</span>
                      </div>`;
      });
      if (!load_notifs.classList.contains('active')) {
        return (load_notifs.innerHTML = html);
      }
    });
  }
  // ------------------ dynamic events -----------------
  function dynamicEvents() {
    const load_notifs = document.querySelector('#load_notifs');
    load_notifs.addEventListener('click', function (e) {
      const target = e.target;
      if (target.classList.contains('notif')) {
        let notif_id = target.dataset.id,
          notif_from = target.dataset.from,
          notif_type = target.dataset.type;
        if (notif_type == 'request') {
          openRequest(notif_id, notif_from);
        } else if (notif_type == 'comment') {
          openComment(notif_id);
        }
      } else if (target.classList.contains('delete')) {
        let notif_id = target.closest('.notif').dataset.id,
          notif = target.closest('.notif');
        deleteNotif(notif_id, notif);
      }
    });
    // ----------------- delete notif --------------------
    function deleteNotif(notif_id, notif) {
      let deleteNotifUrl = '../../backend/php/deleteNotif.php';
      ajax('POST', deleteNotifUrl, 'notif_id=' + notif_id, function (res) {
        if (res.response == 'deleted') {
          document.querySelector('#load_notifs').classList.remove('active');
          notif.style.display = 'none';
        }
      });
    }
    // ------------------- open notif ---------------------
    function openRequest(notif_id, notif_from) {
      let openNotifUrl = '../../backend/php/openNotif.php';
      ajax('POST', openNotifUrl, 'notif_id=' + notif_id, function (res) {
        if (res.response == 'opened') {
          window.location = `../visits/?unique_id=${notif_from}`;
        }
      });
    }
    // ------------------- open comment notif ---------------------
    function openComment(notif_id) {
      let openNotifUrl = '../../backend/php/openNotif.php';
      ajax('POST', openNotifUrl, 'notif_id=' + notif_id, function (res) {
        if (res.response == 'opened') {
          window.location = '../';
        }
      });
    }
  }
});
