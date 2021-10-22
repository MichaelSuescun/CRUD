// Agregar animación a la ultima tarea realizada
let registro = document.querySelector("tbody tr");

window.onload = function() {
    if (sessionStorage.getItem("create")) {
        registro.classList.add("color");
        sessionStorage.removeItem("create");
    }
}

// Función para alertas
function alerts(answer, icon) {
    swal.fire({
        title: answer,
        icon: icon,
        timer: 700
    }).then(() => location.reload());
}

// Crear task
const formCreate = document.querySelector("#formCreate");
const titleCreate = document.querySelector('#titleCreate');
const descriptionCreate = document.querySelector('#descriptionCreate');
const btnCreate = document.querySelector("#formCreate button");

formCreate.addEventListener('submit', (e) => {
    e.preventDefault();

    if ((titleCreate.value.length != 0) && (descriptionCreate.value.length != 0)) {

        btnCreate.disabled = true;

        const formDataCreate = new FormData(formCreate);

        fetch("controllers/task_create.php", {
            method: "POST",
            body: formDataCreate
        }).then((response) => {
            if (response.ok) {
                btnCreate.disabled = false;
                sessionStorage.setItem("create", true);
                return response.json();
            } else {
                throw new Error(response.status);
            }
        }).then((alert) => {
            console.log("alert");
            if (alert["status"]) {
                alerts(alert["answer"], alert["icon"]);
            }
        }).catch((error) => {
            console.log("Error en la petición fetch: " + error.message);
        });
    } else {
        swal.fire({
            title: "Llene los campos",
            icon: "warning",
            timer: 700
        });
    }
});

// Eliminar task
const table = document.querySelector("table"); // Usado en eliminar y actualizar

table.addEventListener("click", (event) => {
    const origenEvent = event.target;

    if (origenEvent.tagName != "BUTTON" || origenEvent.className == "update") { return; }

    const formDataDelete = new FormData();
    const id = origenEvent.attributes[1].nodeValue; //origenEvent anteriormente targen

    formDataDelete.append("id", id);

    fetch("controllers/task_delete.php", {
        method: "POST",
        body: formDataDelete
    }).then((response) => {
        if (response.ok) {
            return response.json(); 
        }
    }).then((alert) => {
        alerts(alert["answer"], alert["icon"]);
    }).catch((error) => {
        console.log("Error en la petición fetch: " + error.message);
    });
});

// Actualizar task
const titleUpdate = document.querySelector('#titleUpdate');
const descriptionUpdate = document.querySelector('#descriptionUpdate');
const cardForm = document.querySelectorAll('.card-form');

table.addEventListener("click", function(event) {

    const formUpdate = document.querySelector("#formUpdate");
    const buttonCancel = document.querySelector('#buttonCancel');

    const origenEvent = event.target;

    if (origenEvent.tagName != "BUTTON" || origenEvent.className == "delete") { return; }

    cardForm[0].style.display = "none"; // form create
    cardForm[1].style.display = "block"; // form update

    buttonCancel.addEventListener('click', (e) => {
        cardForm[0].style.display = "block"; // form create
        cardForm[1].style.display = "none"; // form update
    });

    formUpdate.addEventListener('submit', (e) => {
        e.preventDefault();

        const formDataUpdate = new FormData(formUpdate);
        const id = origenEvent.attributes[1].nodeValue; //origenEvent anteriormente targen

        formDataUpdate.append("id", id);
        console.log("evento update");

        fetch("controllers/task_update.php", {
            method: "POST",
            body: formDataUpdate
        }).then((response) => {
            if (response.ok) {
                return response.json(); 
            }
        }).then((alert) => {
            alerts(alert["answer"], alert["icon"]);
        }).catch((error) => {
            console.log("Error en la petición fetch: " + error.message);
        });
    });
});