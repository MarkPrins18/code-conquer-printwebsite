const images = document.querySelectorAll('.carousel-img');
let carouselIndex = 0;
let intervalId = null;

// function to rotate through a series of images automatically with a 5s delay between images
startCarousel();

function startCarousel() {
    images[carouselIndex].classList.add("showImage");
    intervalId = setInterval(nextImage, 5000);
}

function nextImage() {
    carouselIndex++
    runCarousel(carouselIndex);
}

function runCarousel() {
    if (carouselIndex >= images.length) {
        carouselIndex = 0;
    }
    else if (carouselIndex < 0) {
        carouselIndex = images.length - 1;
    }

    images.forEach(image => {
        image.classList.remove("showImage");
    })
    images[carouselIndex].classList.add("showImage");
}

