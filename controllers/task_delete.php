<?php
    require('../database/db.php');

    $Connection = new Connection_DB();
    $connection = $Connection->connect();

    $id = $_POST["id"];

    try {
        $connection->beginTransaction();

        $query = $connection->prepare("DELETE FROM task WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();

        $connection->commit();
    } catch (\Throwable $th) {
        $connection->rollBack();
        exit();
    }

    exit();