$(document).ready(function () {
  // Prevent form from submitting if login button is clicked
  $('.login_form').submit(function (e) {
    e.preventDefault();
  });
  $('.signup_form').submit(function (e) {
    e.preventDefault();
  });
  // Show/Hide password
  document
    .querySelector('.fa-eye-slash')
    .addEventListener('click', function () {
      if (this.classList.contains('fa-eye-slash')) {
        this.classList.replace('fa-eye-slash', 'fa-eye');
      } else {
        this.classList.replace('fa-eye', 'fa-eye-slash');
      }
      let password_field = document.querySelector('.pword');
      password_field.type == 'password'
        ? (password_field.type = 'text')
        : (password_field.type = 'password');
    });

  //Show/Hide forms
  let login_form = $('.login_form');
  let signup_form = $('.signup_form');

  $('.login').click(function () {
    signup_form.css('display', 'none');
    login_form.css('display', 'block');
  });
  $('.signup').click(function () {
    login_form.css('display', 'none');
    signup_form.css('display', 'block');
  });
});
