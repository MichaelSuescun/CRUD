const table = document.querySelector("table");

table.addEventListener("click", function(event) {

    const target = event.target.closest("A");

    if (target && this.contains(target)) {
        const formDataDelete = new FormData();
        const ajax = new XMLHttpRequest();
        const id = target.attributes[1].nodeValue;

        ajax.open("POST", "controllers/task_delete.php");
        formDataDelete.append("id", id);

        ajax.onload = function() {
            location.reload();
        }

        ajax.send(formDataDelete);
    }
});