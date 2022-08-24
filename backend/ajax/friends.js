import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  searchNewFriend();
  preventSubmits();
  renderFriends();
  toggleFriendListClass();
  searchFriend();
  // -------------------------- variables -------------------------
  // ------------------- refresh friend list every 5 milliseconds ----------------------
  setInterval(() => {
    renderFriends();
  }, 500);
  // ------------------ toggle classes on friend list -----------------
  function toggleFriendListClass() {
    const friend_list = document.querySelector('.friend_list');
    friend_list.onmouseenter = () => {
      friend_list.classList.add('active');
    };
    friend_list.onmouseleave = () => {
      friend_list.classList.remove('active');
    };
  }
  // ------------ prevent submits ---------------
  function preventSubmits() {
    const search_friend = document.querySelector('#search_friend'),
      search_new_friend = document.querySelector('#search_new_friend');
    search_friend.onsubmit = (e) => {
      e.preventDefault();
    };
    search_new_friend.onsubmit = (e) => {
      e.preventDefault();
    };
  }
  // search existing friend
  function searchFriend() {
    let searchFriendUrl = '../../backend/php/searchFriend.php';
    const searchBar = document.querySelector('#search_friend input'),
      friend_list = document.querySelector('.friend_list');
    searchBar.onkeyup = () => {
      let searchStr = searchBar.value,
        html = '';
      if (searchStr != '') {
        friend_list.classList.add('active');
      } else {
        friend_list.classList.remove('active');
      }
      ajax('POST', searchFriendUrl, 'searchStr=' + searchStr, function (res) {
        let parsed = JSON.parse(res.response);
        parsed.length === 0 ? (html += 'No results found.') : '';
        parsed.forEach((friend) => {
          const { unique_id, fname, lname, profile_pic } = friend;
          html += `<div class="friend">
                           <div class="flex pic_name_wrapper">
                             <img src="../profile_pics/${profile_pic}" alt="">
                             <a href="../visits?unique_id=${unique_id}">${
            fname + ' ' + lname
          }</a>
                           </div>
                         </div>`;
        });
        return (friend_list.innerHTML = html);
      });
    };
  }
  // --------- search new friend -------------
  function searchNewFriend() {
    let searchNewFriendUrl = '../../backend/php/searchNewFriend.php';
    let searchBar = document.querySelector('#search_new_friend input'),
      new_friend_list = document.querySelector('.new_friend_list');
    searchBar.onkeyup = () => {
      let searchStr = searchBar.value,
        html = '';
      ajax(
        'POST',
        searchNewFriendUrl,
        'searchStr=' + searchStr,
        function (res) {
          let parsed = JSON.parse(res.response);
          if (parsed.length === 0) {
            html += 'No results found.';
          } else {
            parsed.forEach((friend) => {
              const { unique_id, fname, lname, profile_pic } = friend;
              html += `<div class="friend">
                           <div class="flex pic_name_wrapper">
                             <img src="../profile_pics/${profile_pic}" alt="">
                             <a href="../visits?unique_id=${unique_id}">${
                fname + ' ' + lname
              }</a>
                           </div>
                         </div>`;
            });
          }
          return (new_friend_list.innerHTML = html);
        }
      );
    };
    new_friend_list.innerHTML = 'Start searching...';
  }
  // ------------------- get friend function ----------------------
  async function getFriends() {
    const data = await fetch('../../backend/php/getFriends.php');
    return data.json();
  }
  // ----------------------- render friends --------------------
  async function renderFriends() {
    const friend_list = document.querySelector('.friend_list');
    const friends = await getFriends();
    let html = '';
    friends.length === 0 ? (html += 'No friends yet.') : '';
    friends.forEach((friend) => {
      const { unique_id, fname, lname, profile_pic } = friend;
      html += `<div class="friend">
                  <div class="flex pic_name_wrapper">
                    <img src="../profile_pics/${profile_pic}" alt="">
                    <a href="../visits?unique_id=${unique_id}">${
        fname + ' ' + lname
      }</a>
                  </div>
               </div>`;
    });
    if (!friend_list.classList.contains('active')) {
      return (friend_list.innerHTML = html);
    }
  }
});
