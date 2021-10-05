const description = document.querySelector('textarea');
const warning = document.querySelector('.warning');
const check = document.querySelector('.check');
const title = document.querySelector('input');
const btn = document.querySelector("button");
const form = document.querySelector("form");

form.onsubmit = e => {

    e.preventDefault();

    if ((title.value.length != 0) && (description.value.length != 0)) {

        btn.disabled = true;

        const formData = new FormData(form);
        const ajax = new XMLHttpRequest();

        ajax.open("POST", "controllers/task_create.php");

        ajax.onload = function() {
            btn.disabled = false;
            location.reload();
        }

        ajax.send(formData);

        // check.style.display = "flex";
        // console.log("Tarea guardada");
    } else {        
        warning.style.display = "flex";
    }

};