//Update counters on home page hero section
const counters = document.querySelectorAll(".counter");

counters.forEach((counter) => {
  const target = +counter.dataset.target;
  let current = 0;

  setTimeout(() => {
    function updateCounter() {
      if (current < target) {
        current++;
        counter.textContent = current;
        setTimeout(updateCounter, 50);
      }
    }
    updateCounter();
  }, 1000);
});

//select example items to show corresponding content
const items = document.querySelectorAll(".select-example li");
const contents = document.querySelectorAll(".content-item");

items.forEach((item) => {
  item.addEventListener("click", () => {
    contents.forEach((c) => (c.style.display = "none"));
    const id = item.dataset.content;
    document.getElementById(id).style.display = "flex";
    items.forEach((i) => i.classList.remove("selected"));
    item.classList.add("selected");
  });
});
items[0].click();
