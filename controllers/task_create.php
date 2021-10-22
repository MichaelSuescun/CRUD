<?php
    require('../database/db.php');

    $Connection = new Connection_DB();
    $connection = $Connection->connect();

    $title = $_POST["title"];
    $description = $_POST["description"];
    $response = array();

    try {
        $connection->beginTransaction();

        $query = $connection->prepare("INSERT INTO task(title, description) VALUES(:title, :description)");
        
        $query->bindParam(":title", $title);
        $query->bindParam(":description", $description);
        $query->execute();

        $connection->commit();

        $response["status"] = true;
        $response["icon"] = "success";
        $response["answer"] = "Tarea registrada";
    } catch (\Throwable $th) {
        $connection->rollBack();

        $response["status"] = false;
        $response["icon"] = "warning";
        $response["answer"] = "Tarea no registrada";

        exit();
    }

    echo json_encode($response);

    exit();