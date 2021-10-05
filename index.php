<?php
    require("database/db.php");

    $Connection = new Connection_DB();
    $connection = $Connection->connect();

    $query = $connection->prepare("SELECT * FROM task");
    $query->execute();
    $datos = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CRUD</title>
   <link rel="stylesheet" href="styles/normalize.css">
   <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="navbar">
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </div>
    <div class="container-grid">
        <div class="form-grid">
            <div class="alert warning"><strong>please fill in the fields</strong><a href="#" class="close-alert"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></a></div>
            <div class="alert check"><strong>registered task</strong><a href="#" class="close-a"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></a></div>
            <div class="card-form">
                <form action="">
                    <input type="text" name="title" placeholder="Title" autocomplete="off" autofocus>
                    <textarea name="description" placeholder="Description"></textarea>
                    <button type="submit">Save Task</button>
                </form>
            </div>
        </div>
        <div class="table-grid">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($datos as $key) {
                    ?>
                    <tr>
                        <td><?= $key["title"] ?></td>
                        <td><?= $key["description"] ?></td>
                        <td><?= $key["created_at"] ?></td>
                   
                        <td><a href="#" value="<?= $key["id"] ?>" class="delete"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg><!--<i class="fas fa-trash-alt"></i>--></a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/task_create.js"></script>
    <script src="js/task_delete.js"></script>
    <script src="js/alerts.js"></script>
    <script src="https://kit.fontawesome.com/4f179539b6.js" crossorigin="anonymous"></script>
</body>
</html>