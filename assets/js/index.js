const items = document.querySelectorAll('.select-example li');
const contents = document.querySelectorAll('.content-item');

items.forEach(item => {
  item.addEventListener('click', () => {
    // eerst alles verbergen
    contents.forEach(c => c.style.display = 'none');
    // juiste content tonen
    const id = item.dataset.content;
    document.getElementById(id).style.display = 'block';
  });
});
