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
