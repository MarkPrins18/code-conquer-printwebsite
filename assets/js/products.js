let allProducts = [];

const imgBase = "/assets/images/products-images/";
const imgPlaceholder = imgBase + "placeholder-image.webp";

fetch("/api/products")
  .then(response => response.json())
  .then(data => {
    allProducts = data;
    displayProducts(data);
  })
  .catch((error) => console.error(error));

// Creates html elements with image, title, description, price, and button with values from the bouw3d_db database, then adds all those elements to the gridcontainer
const displayProducts = function (products) {
  const gridContainer = document.querySelector(".products-container");
  gridContainer.innerHTML = "";

  if (products.length === 0) {
    const noResults = document.createElement("div");
    noResults.classList.add("no-results");
    noResults.textContent = "Geen zoekresultaten gevonden";
    gridContainer.appendChild(noResults);
    return;
  }

  for (const { name, description, price, img_url } of products) {
    const card = document.createElement("article");
    card.classList.add("grid-card");

    const imageDiv = document.createElement("div");
    imageDiv.classList.add("image-container");

    const img = document.createElement("img");
    // if img src is not found run .onerror
    img.src = imgBase + img_url;
      img.onerror = () => {    
        img.onerror = null;     
        img.src = imgPlaceholder;
      };

    console.log(img.src);
    img.alt = `Afbeelding van ${name}`;
    imageDiv.appendChild(img);

    const infoDiv = document.createElement("div");
    infoDiv.classList.add("info-container");

    const title = document.createElement("h4");
    title.textContent = name;

    const desc = document.createElement("p");
    desc.textContent = description;

    const priceRow = document.createElement("div");
    priceRow.classList.add("price-row");

    const priceEl = document.createElement("p");

    // parseFloat required because php returns price as string
    priceEl.textContent = `€${parseFloat(price).toFixed(2)}`;
    
    const buyButton = document.createElement("button");
    buyButton.classList.add("button", "button--small");
    buyButton.textContent = "Voeg toe aan winkelwagen";

    buyButton.addEventListener("click", () => {
      alert(`Je hebt "${name}" toegevoegd aan je winkelwagen!`);
    });

    priceRow.appendChild(priceEl);
    priceRow.appendChild(buyButton);

    infoDiv.appendChild(title);
    infoDiv.appendChild(desc);
    infoDiv.appendChild(priceRow);

    card.appendChild(imageDiv);
    card.appendChild(infoDiv);
    gridContainer.appendChild(card);
  }
};

const searchInput = document.querySelector("#search-input");
const resetSearch = document.querySelector("#reset-search");

// Listens for user input in search box. If the value matches a title or description of the allproducts array, sent that new array to the displayProducts function.
searchInput.addEventListener("input", () => {
  const query = searchInput.value.toLowerCase();
  resetSearch.style.display = query ? "inline-block" : "none";
  const filtered = allProducts.filter(
    (product) =>
      product.name.toLowerCase().includes(query) ||
      product.description.toLowerCase().includes(query)
  );
  displayProducts(filtered);
});

// Clicking the reset icon clears input and shows all products
resetSearch.addEventListener("click", () => {
  searchInput.value = "";
  resetSearch.style.display = "none";
  displayProducts(allProducts);
  searchInput.focus();
});
