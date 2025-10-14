const menuToggle = document.querySelector('#menu-toggle');
const headerRight = document.querySelector('#header-right');

menuToggle.addEventListener('click', () => {
  headerRight.classList.toggle('open'); 
  menuToggle.classList.toggle('active'); 
});
