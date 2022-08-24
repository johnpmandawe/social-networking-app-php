import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  const url = window.location.href,
    btn_wrapper = document.querySelector('.btn_wrapper');
  getVisitedUserProfilePic();
  manageRequests();
  navigateBack();
  toggleActiveClassesOnBtnWrapper();
  validateButtons();
  setInterval(() => {
    validateButtons();
  }, 500);
  // --------------------- toggle active class on btn wrapper ------------------
  function toggleActiveClassesOnBtnWrapper() {
    btn_wrapper.onmouseenter = () => {
      btn_wrapper.classList.add('active');
    };
    btn_wrapper.onmouseleave = () => {
      btn_wrapper.classList.remove('active');
    };
  }
  //  ---------------------- back navigation -------------
  function navigateBack() {
    const back = document.querySelector('.fa-arrow-left-long');
    back.onclick = () => {
      history.back();
    };
  }
  // ----------------- manage requests -------------
  function manageRequests() {
    btn_wrapper.addEventListener('click', function (e) {
      const target = e.target,
        add = target.closest('.btn_wrapper').children[0],
        accept = target.closest('.btn_wrapper').children[1],
        cancel = target.closest('.btn_wrapper').children[2];
      if (target.classList.contains('add_btn')) {
        addFriend();
      } else if (target.classList.contains('accept_btn')) {
        acceptRequest();
      } else if (target.classList.contains('cancel_btn')) {
        cancelRequest();
      }
      function addFriend() {
        let addFriendUrl = '../../backend/php/addFriend.php';
        ajax('POST', addFriendUrl, 'url=' + url, function (res) {
          if (res.response == 'success') {
            add.innerText = 'Request Sent';
            add.setAttribute('disabled', 'disabled');
            cancel.classList.add('show');
          }
        });
      }
      function cancelRequest() {
        let cancelRequestUrl = '../../backend/php/cancelRequest.php';
        ajax('POST', cancelRequestUrl, 'url=' + url, function (res) {
          if (res.response == 'success') {
            add.removeAttribute('disabled'),
              (add.innerText = 'Add Friend'),
              add.classList.add('show'),
              cancel.classList.remove('show'),
              accept.classList.remove('show');
          }
        });
      }
      function acceptRequest() {
        let acceptRequestUrl = '../../backend/php/acceptRequest.php';
        ajax('POST', acceptRequestUrl, 'url=' + url, function (res) {
          if (res.response == 'success') {
            add.setAttribute('disabled', 'disabled'),
              (add.innerText = 'Friends'),
              add.classList.add('show'),
              (cancel.innerText = 'Unfriend'),
              cancel.classList.add('show'),
              accept.classList.remove('show');
          }
        });
      }
    });
  }
  // --------------------- fetch visited user profile pic ---------------------
  function getVisitedUserProfilePic() {
    const v_profile_pic = document.querySelector('#v_profile_pic');
    let loadVisitUrl = '../../backend/php/loadVisit.php';
    let get_pic = '';
    ajax('POST', loadVisitUrl, 'url=' + url, function (res) {
      let json_parsed = JSON.parse(res.response);
      json_parsed[2].forEach((data) => {
        const { profile } = data;
        get_pic = profile;
      });
      return (v_profile_pic.style.backgroundImage = `url(../profile_pics/${get_pic})`);
    });
  }
  function validateButtons() {
    let html = '';
    let loadVisitUrl = '../../backend/php/loadVisit.php';
    ajax('POST', loadVisitUrl, 'url=' + url, function (res) {
      let parsed = JSON.parse(res.response),
        accepted = parsed[0].accepted;
      if (accepted == 'pending') {
        html += `<button class="add_btn show" disabled='disabled'>Request Sent</button>
                    <button class="accept_btn">Accept</button>
                    <button class="cancel_btn show">Cancel</button>`;
      } else if (accepted == 'friends') {
        html += `<button class="add_btn show" disabled='disabled'>Friends</button>
                    <button class="accept_btn">Accept</button>
                    <button class="cancel_btn show">Unfriend</button>`;
      } else if (accepted == 'requested') {
        html += `<button class="add_btn" disabled='disabled'>Friends</button>
                    <button class="accept_btn show">Accept</button>
                    <button class="cancel_btn show">Cancel</button>`;
      } else if (accepted == 'self') {
        html += `<button class="add_btn">Friends</button>
                    <button class="accept_btn">Accept</button>
                    <button class="cancel_btn">Cancel</button>`;
      } else {
        html += `<button class="add_btn show">Add friend</button>
                    <button class="accept_btn">Accept</button>
                    <button class="cancel_btn">Cancel</button>`;
      }
      if (!btn_wrapper.classList.contains('active')) {
        return (btn_wrapper.innerHTML = html);
      }
    });
  }
});
