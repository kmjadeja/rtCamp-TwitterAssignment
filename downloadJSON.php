<?php session_start();

    // Check For Data
        if(!isset($_SESSION["downloadData"])) {
            header("location: tweets.php");
            exit();
        }

    // Set File Name And Prepare Variables
        $file_name = "Tweets.json";
        $json = $_SESSION["downloadData"];
        $file_path = "files/".$file_name;

    // Force Download
        header('Content-Description: Attachment');
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename='.$file_name);
        echo json_encode($json);
        exit();

 ?>