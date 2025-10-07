const menuToggle = document.querySelector('#menu-toggle');
const headerRight = document.querySelector('#header-right');

menuToggle.addEventListener('click', () => {
  headerRight.style.display = headerRight.style.display === 'block' ? 'none' : 'block';
  menuToggle.classList.toggle('active'); 
});
