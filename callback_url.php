<?php
 		header("Content-Type: application/json");

     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
 
     // DATA
     $mpesaResponse = file_get_contents('php://input');
 
     // log the response
     $logFile = "M_PESAConfirmationResponse.txt";
 
     // write to file
     $log = fopen($logFile, "a");
 
     fwrite($log, $mpesaResponse);
     fclose($log);
 
     echo $response;
     $con = mysqli_connect("localhost","root","","mpesa"); //Connets to the dashboard

    $sql = "INSERT INTO `responses` (`Response`) VALUES ('$mpesaResponse')";
    $rs = mysqli_query($con, $sql); //Record the response to the database
    if($rs)
    {
        echo "Records Inserted";
    }
