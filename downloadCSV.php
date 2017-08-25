<?php session_start();

    // Check For Data
        if(!isset($_SESSION["downloadData"]) || !isset($_SESSION["dUserScreen"])) {
            header("location: logout.php");
            exit();
        }

    $csvString = "Sr,Name,UserName,Created On,Tweet\r\n";

    $srNo = 1;
    $screen_name = $_SESSION["dUserScreen"];
    foreach($_SESSION["downloadData"] as $data) {
        $csvString .= str_replace(array(",","\r\n"),           "  ",    $srNo).          ",";                                                                                                           ",";
        $csvString .= str_replace(array(",","\r\n"),           "  ",    preg_replace('/[\n\r]+/', ',', trim($data["name"]))).          ",";
        $csvString .= str_replace(array(",","\r\n"),           "  ",    preg_replace('/[\n\r]+/', ',', trim($data["screen_name"]))).   ",";
        $csvString .= str_replace(array(",","\r\n"),           "  ",    preg_replace('/[\n\r]+/', ',', trim($data["time"]))).          ",";
        $csvString .= str_replace(array(",",".","\r\n"),       "  ",    preg_replace('/[\n\r]+/', ',', trim($data["text"]))).          "\r\n";
        $srNo++;
    }

    // Force Download
        $filename = $_SESSION["dUserScreen"]."-Tweets.csv";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=".$filename); 
        echo $csvString;
        exit();
 ?>