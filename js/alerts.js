let close_button = document.querySelector('.close-alert');
let warning2 = document.querySelector('.warning');

close_button.addEventListener('click', (e) => {
    warning2.style.display = "none";
});