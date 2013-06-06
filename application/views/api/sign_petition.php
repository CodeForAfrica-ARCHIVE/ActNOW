<?php

// array for JSON response
$response = array();


        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Petition successfully signed";

  
        echo json_encode($response);


?>