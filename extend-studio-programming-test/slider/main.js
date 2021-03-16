const slider = document.querySelector('.slider');
const sliderImages = document.querySelectorAll('.slider img');

const prevButton = document.getElementById('prevBtn');
const nextButton = document.getElementById('nextBtn');

let photoIndex = 0;
let photoNumber = sliderImages.length - 2;
const photoWidth = sliderImages[0].clientWidth;

slider.style.transform = 'translateX(' + (-photoWidth * ++photoIndex) + 'px)'; 

nextButton.addEventListener('click', () => {
    if (photoIndex >= photoNumber + 1) return;
    slider.classList.add('photo-transition');
    slider.style.transform = 'translateX(' + (-photoWidth * ++photoIndex) + 'px)'; 
});

prevButton.addEventListener('click', () => {
    if (photoIndex <= 0) return;
    slider.classList.add('photo-transition');
    slider.style.transform = 'translateX(' + (-photoWidth * --photoIndex) + 'px)'; 
});

slider.addEventListener('transitionend', () => {
    if(sliderImages[photoIndex].id == 'lastClone') {
        slider.classList.remove('photo-transition');
        photoIndex = photoNumber;
        slider.style.transform = 'translateX(' + (-photoWidth * photoIndex) + 'px)';
    }

    if(sliderImages[photoIndex].id == 'firstClone') {
        slider.classList.remove('photo-transition');
        photoIndex = 1;
        slider.style.transform = 'translateX(' + (-photoWidth * photoIndex) + 'px)';
    }
})