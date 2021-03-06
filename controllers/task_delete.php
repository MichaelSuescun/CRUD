<?php
    require('../database/db.php');

    $Connection = new Connection_DB();
    $connection = $Connection->connect();

    $id = $_POST["id"];
    $response = array();

    try {
        $connection->beginTransaction();

        $query = $connection->prepare("DELETE FROM task WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();

        $connection->commit();

        $response["status"] = true;
        $response["icon"] = "success";
        $response["answer"] = "Tarea eliminada";
    } catch (\Throwable $th) {
        $connection->rollBack();

        $response["status"] = false;
        $response["icon"] = "warning";
        $response["answer"] = "Tarea no eliminada";

        exit();
    }

    echo json_encode($response);

    exit();