const hamburgerMenu = document.querySelector('.hamburger-menu');
const nav = document.querySelector('nav');
hamburgerMenu.addEventListener('click', () => {
  nav.classList.toggle('active');
});


    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            ratingInput.value = rating;

            // Frissítjük a csillagok megjelenését
            stars.forEach(s => {
                s.innerHTML = s.getAttribute('data-value') <= rating ? '&#9733;' : '&#9734;';
            });
        });
    });
