window.addEventListener('pageshow', function () {
  const lis = document.querySelectorAll('.menu li');
  lis.forEach((li) => {
    li.onmouseenter = () => {
      li.children[0].classList.add('show');
    };
    li.onmouseleave = () => {
      li.children[0].classList.remove('show');
    };
  });
});
