import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  // --------------- Create post code -------------------
  const post_form = document.querySelector('#post_form'),
    post_modal = document.querySelector('#post_modal'),
    title = document.querySelector('#post_modal .modal_content .content_title'),
    content = document.querySelector(
      '#post_modal .modal_content .content_content'
    );
  post_form.addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(post_form);
    let createPostUrl = '../../backend/php/createPost.php';
    ajax('POST', createPostUrl, formData, function (res) {
      if (res.response == 'inserted') {
        post_form.reset();
        title.innerHTML = 'Success!';
        content.innerHTML = 'Post created!';
        post_modal.classList.add('show');
        setTimeout(() => {
          post_modal.classList.remove('show');
          window.location = '../';
        }, 1500);
      } else {
        title.innerHTML = 'Oops!';
        content.innerHTML = res.response;
        post_modal.classList.add('show');
        setTimeout(() => {
          post_modal.classList.remove('show');
        }, 1500);
      }
    });
  });
});
