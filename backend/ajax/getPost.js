import { timeAgo } from './timeAgo.js';
import { ajax } from './ajax.js';
window.addEventListener('pageshow', function () {
  // --------- Calling all functions --------------
  let getUserPostsUrl = '',
    profilePicUrl = '',
    visitsUrl = '',
    editCommentUrl = '',
    deleteCommentUrl = '',
    submitCommentUrl = '',
    likePostUrl = '',
    unlikePostUrl = '',
    deletePostUrl = '',
    editPostUrl = '';
  let pathname = window.location.pathname.split('/');
  if (
    pathname.includes('users') &&
    !pathname.includes('visits') &&
    !pathname.includes('profile')
  ) {
    getUserPostsUrl = '../backend/php/getUserPosts.php';
    profilePicUrl = 'profile_pics/';
    visitsUrl = 'visits/?visited_id=';
    editCommentUrl = '../backend/php/editComment.php';
    deleteCommentUrl = '../backend/php/deleteComment.php';
    submitCommentUrl = '../backend/php/submitComment.php';
    likePostUrl = '../backend/php/likePost.php';
    unlikePostUrl = '../backend/php/unlikePost.php';
    deletePostUrl = '../backend/php/deletePost.php';
    editPostUrl = '../backend/php/editPost.php';
  } else if (pathname.includes('users') && pathname.includes('visits')) {
    getUserPostsUrl = '../../backend/php/getPostById.php';
    profilePicUrl = '../profile_pics/';
    visitsUrl = '../visits/?visited_id=';
    editCommentUrl = '../../backend/php/editComment.php';
    deleteCommentUrl = '../../backend/php/deleteComment.php';
    submitCommentUrl = '../../backend/php/submitComment.php';
    likePostUrl = '../../backend/php/likePost.php';
    unlikePostUrl = '../../backend/php/unlikePost.php';
    deletePostUrl = '../../backend/php/deletePost.php';
    editPostUrl = '../../backend/php/editPost.php';
  } else if (pathname.includes('users') && pathname.includes('profile')) {
    getUserPostsUrl = '../../backend/php/getOwnPost.php';
    profilePicUrl = '../profile_pics/';
    visitsUrl = '../visits/?visited_id=';
    editCommentUrl = '../../backend/php/editComment.php';
    deleteCommentUrl = '../../backend/php/deleteComment.php';
    submitCommentUrl = '../../backend/php/submitComment.php';
    likePostUrl = '../../backend/php/likePost.php';
    unlikePostUrl = '../../backend/php/unlikePost.php';
    deletePostUrl = '../../backend/php/deletePost.php';
    editPostUrl = '../../backend/php/editPost.php';
  }
  renderPosts();
  setInterval(() => {
    renderPosts();
  }, 500);
  dynamicEvents();
  editComment();
  editPost();
  // --------------- Getting posts from server -------------
  async function getPosts() {
    let posts = await fetch(getUserPostsUrl);
    return posts.json();
  }
  // ----------- Rendering Posts --------------
  async function renderPosts() {
    let posts = await getPosts();
    const post_wrapper = document.querySelector('.posts');
    let html = '';
    post_wrapper.onmouseenter = () => {
      post_wrapper.classList.add('active');
    };
    post_wrapper.onmouseleave = () => {
      post_wrapper.classList.remove('active');
    };
    if (posts.length === 0) {
      html +=
        "<p style='color: var(--color); font-size: 1.3rem; font-weight: 300;'>No posts to show for now.</p>";
    }
    posts.forEach((post) => {
      const {
        post_id,
        post_title,
        post_content,
        date_posted,
        fname,
        lname,
        unique_id,
        profile_pic,
        likes,
        // liked,
        comments,
        comments_arr,
        post_type,
      } = post;
      let totalLikes = likes + (likes > 1 ? ' likes' : ' like');
      let totalComments = comments + (comments > 1 ? ' comments' : ' comment');
      // let validateLiker = liked == 'yes' ? 'fa-solid' : 'fa-regular';
      let post_ops =
        post_type == 'self'
          ? `<div class='flex post_ops' data-post_id=${post_id}>
               <i class='fa-solid fa-pen-to-square'></i>
               <i class='fa-solid fa-trash-can'></i>
               </div>`
          : '';
      html += ` <div class='post flex'>
                  <div class='flex'>
                    <div class='profile_pic' style='background-image: url(${
                      profilePicUrl + profile_pic
                    })'></div>
                    <div class='flex' style='flex-direction: column; align-items: flex-start; margin-left: 0.3rem;'>
                      <a href='${visitsUrl + unique_id}' class='name'>${
        fname + ' ' + lname
      }</a>
                      <p class='date_posted'>${timeAgo(
                        new Date(date_posted)
                      )}</p>
                    </div>`;
      html += post_ops;
      html += `</div>
                  <h2>${post_title}</h2>
                  <p class='post_content'>${post_content}</p>
                  <div class='counters flex'>
                    <span class='likes'>${totalLikes}</span>
                    <span class='comments'>${totalComments}</span>
                  </div>
                  <div class='acts flex' data-post_id='${post_id}'>
                    <i class='fa-regular fa-thumbs-up'></i>
                    <i class='fa-solid fa-pencil'></i>
                    <i class='fa-solid fa-comment-dots'></i>
                  </div>
                  <form action='#' class='flex' id='comment_form' autocomplete='off'>
                    <input type='text' name='content' placeholder='Write a comment...'/>
                    <input type='hidden' name='post_id' value='${post_id}'/>
                    <input type='hidden' name='user_id' value='${unique_id}'/>
                    <button type='submit' id='com_submit'><i class='fa-solid fa-paper-plane'></i></button>
                  </form>
                  <div class='comment_section flex'>`;
      if (comments > 0) {
        comments_arr
          .map((comment) => {
            const { com_id, com_content, com_date, fname, lname, com_type } =
              comment;
            let com_ops =
              com_type == 'self'
                ? `<i class="fa-solid fa-ellipsis"></i>
                  <ul class='operations' data-com_id='${com_id}'>
                    <li class='edit_comment'>Edit</li>
                    <li class='delete_comment'>Delete</li>
                  </ul>`
                : '';
            html += `<div class='comment flex'>
                       <p>-- ${fname + ' ' + lname} --</p>
                       <p>${com_content}</p>
                       <p class='time'>${timeAgo(new Date(com_date))}</p>`;
            html += com_ops;
            html += `</div>`;
          })
          .join('');
      } else {
        html += 'No comments';
      }
      html += `</div>
                </div>`;
    });
    if (!post_wrapper.classList.contains('active')) {
      return (post_wrapper.innerHTML = html);
    }
  }
  // ---------------- dynamic events -----------------
  function dynamicEvents() {
    const post_wrapper = document.querySelector('.posts');
    post_wrapper.addEventListener('click', function (e) {
      let target = e.target;
      if (target.classList.contains('fa-thumbs-up')) {
        likePost(target);
      } else if (target.classList.contains('fa-comment-dots')) {
        toggleCommentSection(target);
      } else if (target.classList.contains('fa-pencil')) {
        toggleCommentForm(target);
      } else if (target.classList.contains('fa-ellipsis')) {
        replaceEllipsis(target);
      } else if (target.classList.contains('fa-xmark')) {
        replaceXmark(target);
      } else if (target.classList.contains('delete_comment')) {
        deleteComment(target);
      } else if (target.classList.contains('edit_comment')) {
        getCommentDetails(target);
      } else if (target.classList.contains('fa-trash-can')) {
        deletePostModal(target);
      } else if (target.classList.contains('fa-pen-to-square')) {
        getPostDetails(target);
      }
    });
    post_wrapper.onsubmit = (e) => {
      let target = e.target;
      if (target.id === 'comment_form') {
        submitComment(target);
        return false;
      }
    };
  }
  // -------------------- delete post ---------------------------
  function deletePostModal(target) {
    const delete_post_modal = document.querySelector('#delete_post_modal'),
      no = document.querySelector('.no'),
      yes = document.querySelector('.yes');
    let post_id = target.closest('.post_ops').dataset.post_id,
      storage = document.querySelector(
        '#delete_post_modal .modal_content .storage'
      );
    storage.dataset.post_id = post_id;
    delete_post_modal.classList.add('show');
    no.onclick = () => {
      document.querySelector('#delete_post_modal').classList.remove('show');
    };
    yes.onclick = () => {
      let data_post_id = yes.closest('.storage').dataset.post_id;
      ajax('POST', deletePostUrl, 'post_id=' + data_post_id, function (res) {
        if (res.response == 'deleted') {
          document.querySelector('#delete_post_modal').classList.remove('show');
        }
      });
    };
  }
  // --------------------- get post details -----------------------
  function getPostDetails(target) {
    let id = parseInt(target.closest('.post_ops').dataset.post_id),
      post_title = target.closest('.post_ops').closest('.flex').closest('.post')
        .children[1].innerText,
      post_content = target
        .closest('.post_ops')
        .closest('.flex')
        .closest('.post').children[2].innerText;
    let edit_post = document.querySelector('#edit_post'),
      modal_post_id = document.querySelector('input[name=id]'),
      modal_post_title = document.querySelector('input[name=post_title]'),
      modal_post_content = document.querySelector('input[name=post_content]');
    (modal_post_id.value = id),
      (modal_post_title.value = post_title),
      (modal_post_content.value = post_content);
    edit_post.classList.add('show');
  }
  // -------------------- edit post ---------------------
  function editPost() {
    const edit_post = document.querySelector('#edit_post'),
      edit_post_form = document.querySelector('#edit_post_form'),
      cancels = document.querySelectorAll('button[type=reset]');
    edit_post_form.onsubmit = (e) => {
      e.preventDefault();
      let formData = new FormData(edit_post_form);
      ajax('POST', editPostUrl, formData, function (res) {
        if (res.response == 'edited') {
          removeActiveClass();
          edit_post.classList.remove('show');
        }
      });
    };
    cancels.forEach((cancel) => {
      cancel.addEventListener('click', function () {
        edit_post.classList.remove('show');
      });
    });
  }

  // -------------------- edit comment ---------------------
  function editComment() {
    const edit_comment = document.querySelector('#edit_comment'),
      edit_com_form = document.querySelector('#edit_com_form'),
      cancels = document.querySelectorAll('button[type=reset]');
    edit_com_form.onsubmit = (e) => {
      e.preventDefault();
      let formData = new FormData(edit_com_form);
      ajax('POST', editCommentUrl, formData, function (res) {
        if (res.response == 'updated') {
          removeActiveClass();
          edit_comment.classList.remove('show');
        }
      });
    };
    cancels.forEach((cancel) => {
      cancel.addEventListener('click', function () {
        edit_comment.classList.remove('show');
      });
    });
  }
  // ------------------- remove active class ------------------
  function removeActiveClass() {
    document.querySelector('.posts').classList.remove('active');
  }
  // ----------------- get comment details and show modal --------------------
  function getCommentDetails(target) {
    let com_id = parseInt(target.closest('.operations').dataset.com_id),
      com_content = target.closest('.operations').closest('.comment')
        .children[1].innerText,
      edit_comment = document.querySelector('#edit_comment'),
      modal_com_id = document.querySelector('input[name=com_id]'),
      modal_com_content = document.querySelector('input[name=com_content]');
    modal_com_id.value = com_id;
    modal_com_content.value = com_content;
    edit_comment.classList.add('show');
  }
  // -------------------- delete comment -------------------
  function deleteComment(target) {
    let com_id = target.closest('.operations').dataset.com_id,
      comment = target.closest('.operations').closest('.comment');
    ajax('POST', deleteCommentUrl, 'com_id=' + com_id, function (res) {
      if (res.response == 'deleted') {
        comment.style.display = 'none';
        removeActiveClass();
      }
    });
  }
  // ---------------- replace ellipsis ------------------
  function replaceEllipsis(target) {
    target.classList.replace('fa-ellipsis', 'fa-xmark');
    let ops = target.closest('.comment').children[4];
    ops.classList.add('show');
  }
  // ------------------ replace xmark ----------------------
  function replaceXmark(target) {
    target.classList.replace('fa-xmark', 'fa-ellipsis');
    let ops = target.closest('.comment').children[4];
    ops.classList.remove('show');
  }
  // ----------------------- submit comment ---------------------
  function submitComment(target) {
    let comment_content = target.children[0];
    let formData = new FormData(target);
    if (comment_content.value !== '') {
      ajax('POST', submitCommentUrl, formData, function (res) {
        if (res.response == 'success') {
          let comment_modal = document.querySelector('#comment_modal'),
            modal_title = document.querySelector(
              '#comment_modal .modal_content .content_title'
            ),
            modal_content = document.querySelector(
              '#comment_modal .modal_content .content_content'
            );
          modal_title.innerText = 'Success!';
          modal_content.innerText = 'Comment Submitted';
          comment_modal.classList.add('show');
          setTimeout(() => {
            comment_modal.classList.remove('show');
          }, 1500);
          comment_content.value = '';
          removeActiveClass();
        }
      });
    }
  }
  // -------------- toggle comment form ------------------
  function toggleCommentForm(target) {
    let comment_form = target.closest('.acts').closest('.post').children[5];
    if (comment_form.classList.contains('show')) {
      comment_form.classList.remove('show');
    } else {
      comment_form.classList.add('show');
    }
  }
  // ---------------------- toggle comment section ----------------------
  function toggleCommentSection(target) {
    let comment_section = target.closest('.acts').closest('.post').children[6];
    comment_section.classList.toggle('show');
  }
  // -------------------- like post function ----------------------------
  function likePost(target) {
    if (target.classList.contains('fa-regular')) {
      target.classList.replace('fa-regular', 'fa-solid');
    } else if (target.classList.contains('fa-solid')) {
      target.classList.replace('fa-solid', 'fa-regular');
    }
    let likeEl = target.closest('.acts').closest('.post').children[3]
      .children[0];
    let likes = parseInt(
      target.closest('.acts').closest('.post').children[3].children[0].innerText
    );
    const post_id = target.closest('.acts').dataset.post_id;
    ajax('POST', likePostUrl, 'post_id=' + post_id, function (res) {
      if (res.response == 'liked') {
        likes++;
        likeEl.innerText = likes + (likes > 1 ? ' likes' : ' like');
      } else {
        ajax('POST', unlikePostUrl, 'post_id=' + post_id, function (res) {
          if (res.response == 'unliked') {
            likes--;
            likeEl.innerText = likes + (likes > 1 ? ' likes' : ' like');
          }
        });
      }
    });
  }
});
