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
const exampleItems = document.querySelectorAll(".list-item");
const contents = document.querySelectorAll(".content-item");
function activeExample() {
  exampleItems.forEach((item) => item.classList.remove("active-example"));
  this.classList.add("active-example");
  const contentId = this.dataset.content;
  console.log(contentId);
  contents.forEach((content) => {
    if (content.id === contentId) {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
  });
}
document.addEventListener("DOMContentLoaded", () => {
  contents[0].style.display = "block";
});
exampleItems.forEach((item) => item.addEventListener("click", activeExample));
