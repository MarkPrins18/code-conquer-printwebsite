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

const counters = document.querySelectorAll(".counter"); // Select all elements with the class "counter" in the document

counters.forEach((counter) => {
  // Loop through each counter element
  const target = +counter.dataset.target; // Read the 'data-target' attribute and convert it to a number
  let current = 0; // Keep track of the current counter value, starting at 0

  setTimeout(() => {
    // Wait 1 second before starting the animation
    function updateCounter() {
      // Define a function that updates the counter
      let temp = current; // Make a temporary copy of the current value
      let steps = 1; // Number of increments per update (always 1 here)

      while (temp < target && temp < current + steps) {
        // Run the while loop as long as temp is less than the target and within one step
        temp++; // Increase the temporary counter by 1
        counter.textContent = temp; // Update the element’s text content to show the new value
      }
      current = temp; // Update the current value with the new one

      if (current < target) {
        // Check if the target has not yet been reached
        setTimeout(updateCounter, 50); // Wait 50ms and then call the update function again (creates the animation effect)
      }
    }
    updateCounter(); // Start the first update after the delay
  }, 1000); // 1000 milliseconds (1 second) delay before starting the counter
});
