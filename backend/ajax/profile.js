import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  const profile_content = document.querySelector('.profile_content');
  const upp = document.querySelector('#update_pp');
  // ----------- calling all functions --------------
  renderProfile();
  editUserProfile();
  editProfilePic();
  // ----------------- other functions -----------------
  function changeType(child, splitter) {
    if (splitter == '@') {
      return child.value.split(splitter).length == 2
        ? child.setAttribute('type', 'email')
        : '';
    } else {
      return child.value.split(splitter).length == 2
        ? child.setAttribute('type', 'number')
        : '';
    }
  }
  function returnType(child, splitter) {
    return child.value.split(splitter).length == 2
      ? child.setAttribute('type', 'text')
      : '';
  }
  // ------------------ edit fields --------------------
  function editFields(target) {
    const child = target.closest('.row').children[1],
      value = target.closest('.row').children[1].defaultValue,
      length = target.closest('.row').children[1].value.length;
    if (child.hasAttribute('readonly')) {
      child.removeAttribute('readonly');
      returnType(child, '@');
      returnType(child, '09');
      child.setSelectionRange(length, length);
      child.focus();
    } else {
      child.setAttribute('readonly', 'readonly');
      changeType(child, '@');
      changeType(child, '09');
      child.value = value;
    }
    child.classList.toggle('white');
  }
  // ----------------- send form data -------------------------
  function sendFormData() {
    profile_content.onsubmit = (e) => {
      if (e.target.id == 'edit_profile') {
        return false;
      }
    };
    const edit_form = document.querySelector('#edit_profile'),
      update_msg = document.querySelector('#update_msg'),
      title = document.querySelector(
        '#update_msg .modal_content .content_title'
      ),
      content = document.querySelector(
        '#update_msg .modal_content .content_content'
      );
    let editUserDetailsUrl = '../../backend/php/editUserDetails.php';
    let formData = new FormData(edit_form);
    ajax('POST', editUserDetailsUrl, formData, function (res) {
      if (res.response == 'Profile updated!') {
        title.innerHTML = 'Success!';
        content.innerHTML = res.response;
        update_msg.classList.add('show');
        setTimeout(() => {
          update_msg.classList.remove('show');
          window.location.reload();
        }, 1500);
      } else {
        title.innerHTML = 'Oops!';
        content.innerHTML = res.response;
        update_msg.classList.add('show');
        setTimeout(() => {
          update_msg.classList.remove('show');
        }, 1500);
      }
    });
  }
  // ------------------ edit profile code driver ------------------------
  function editUserProfile() {
    profile_content.addEventListener('click', function (e) {
      const target = e.target;
      if (target.id === 'edit_btn') {
        sendFormData();
      } else if (target.classList.contains('fa-pen-clip')) {
        editFields(target);
        target.classList.toggle('active');
      } else if (target.id === 'edit_pp_btn') {
        upp.classList.add('show');
      }
    });
  }
  // --------------- edit profile picture -------------------
  function editProfilePic() {
    const update_pp_form = document.querySelector('#update_pp_form'),
      err_msg = document.querySelector('#err_msg'),
      cancel = document.querySelector('#update_pp_form .flex .cancel');
    cancel.onclick = () => {
      upp.classList.remove('show');
      err_msg.classList.remove('show');
    };
    update_pp_form.addEventListener('submit', function (e) {
      e.preventDefault();
      let formData = new FormData(update_pp_form);
      let editProfilePicUrl = '../../backend/php/editProfilePic.php';
      ajax('POST', editProfilePicUrl, formData, function (res) {
        if (res.response != 'success') {
          err_msg.innerHTML = res.response;
          err_msg.classList.add('show', 'err');
        } else {
          err_msg.innerHTML = 'Profile picture changed!';
          err_msg.classList.add('show', 'suc');
          err_msg.classList.replace('err', 'suc');
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      });
    });
  }
  // -------------------- load user profile -----------------------
  async function loadUserProfile() {
    const profile = await fetch('../../backend/php/getUserData.php');
    return profile.json();
  }
  async function renderProfile() {
    const profile = await loadUserProfile();
    let html = '';
    profile.forEach((prof) => {
      const { fname, lname, address, contact, email, uname, profile_pic } =
        prof;
      html += `<article class="pic_name_wrapper1">
                  <div id="profile_pic" style="background-image: url(../profile_pics/${profile_pic})"></div>
                  <section>
                    <button id='edit_pp_btn'>Edit profile picture</button>
                  </section>
                  <p>${fname + ' ' + lname}</p>
                </article>
                <form action="#" id="edit_profile" autocomplete="off">
                  <div class="row flex">
                    <span>Firstname:</span><input type="text" name="firstname" value="${fname}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <div class="row flex">
                    <span>Lastname:</span><input type="text" name="lastname" value="${lname}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <div class="row flex">
                    <span>Address:</span><input type="text" name="address" value="${address}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <div class="row flex">
                    <span>Contact:</span><input type="number" name="contact" value="${contact}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <div class="row flex">
                    <span>Email:</span><input type="email" name="email" value="${email}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <div class="row flex">
                    <span>Username:</span><input type="text" name="username" value="${uname}" readonly/>
                    <i class="fa-solid fa-pen-clip"></i>
                  </div>
                  <button id="edit_btn">Save</button>
                </form>`;
    });
    return (profile_content.innerHTML = html);
  }
});
