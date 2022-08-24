import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  // Sign up code driver in ajax.
  document.querySelector('.signup_btn').addEventListener('click', function () {
    let error_msg = document.querySelector('.signup_form .error_msg');
    let success_msg = document.querySelector('.signup_form .success_msg');
    let signup_form = document.querySelector('.signup_form');
    let formData = new FormData(signup_form);
    ajax('POST', 'backend/php/signup.php', formData, function (res) {
      if (res.response == 'success') {
        error_msg.style.display = 'none';
        success_msg.innerHTML = 'Account created!';
        success_msg.style.display = 'block';
        function reLoad() {
          window.location.reload();
        }
        setTimeout(reLoad, 800);
      } else {
        success_msg.style.display = 'none';
        error_msg.innerHTML = res.response;
        error_msg.style.display = 'block';
      }
    });
  });

  // Login code driver in ajax
  $('.login_btn').click(function () {
    let error_msg = $('.login_form .error_msg');
    let login_form = $('.login_form').serialize();

    $.ajax({
      method: 'POST',
      url: 'backend/php/login.php',
      data: { loginForm: login_form },
      success: function (response) {
        if (response == 'success') {
          error_msg.text('');
          error_msg.css('display', 'none');
          window.location = 'users/';
          login_form.trigger('reset');
        } else {
          error_msg.text(response);
          error_msg.css('display', 'block');
        }
      },
    });
  });
  // password reset code
  const forgot_password = document.querySelector('.forgot_password'),
    pass_reset = document.querySelector('#pass_reset'),
    pass_reset_form = document.querySelector('#pass_reset_form'),
    cancel = document.querySelector('button[type=reset]'),
    pwr_msg = document.querySelector('.pwr_msg');
  forgot_password.onclick = () => {
    pass_reset.classList.add('show');
  };
  cancel.onclick = () => {
    pass_reset.classList.remove('show');
  };
  pass_reset_form.onsubmit = (e) => {
    let formData = new FormData(pass_reset_form);
    e.preventDefault();
    ajax('POST', 'backend/php/resetPass.php', formData, function (res) {
      if (res.response == 'success') {
        pwr_msg.innerText = 'Password has been reset.';
        if (!pwr_msg.classList.contains('show')) {
          pwr_msg.classList.add('show');
        }
        setTimeout(() => {
          pass_reset.classList.remove('show');
        }, 1000);
      } else {
        pwr_msg.innerText = res.response;
        if (!pwr_msg.classList.contains('show')) {
          pwr_msg.classList.add('show');
        }
      }
    });
  };
});
