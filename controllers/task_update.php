<?php
    require('../database/db.php');

    $Connection = new Connection_DB();
    $connection = $Connection->connect();

    $title = $_POST["title"];
    $description = $_POST["description"];
    $id = $_POST["id"];
    $response = array();

    try {
        $connection->beginTransaction();

        $query = $connection->prepare("UPDATE task SET title = :title, description = :description WHERE id = :id");
        $query->bindParam(":title", $title);
        $query->bindParam(":description", $description);
        $query->bindParam(":id", $id);
        $query->execute();

        $connection->commit();

        $response["status"] = true;
        $response["icon"] = "success";
        $response["answer"] = "Tarea actualizada";
    } catch (\Throwable $th) {
        $connection->rollBack();

        $response["status"] = false;
        $response["icon"] = "warning";
        $response["answer"] = "Tarea no actualizada";

        exit();
    }

    echo json_encode($response);

    exit();