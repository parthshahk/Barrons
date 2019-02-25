<?php

    include 'connection.php';

    $action = $_REQUEST['action'];

    if($action == 'getRandom'){

        $index = mt_rand(1,1003);
        $grammer = [];

        $result = mysqli_query($con, "SELECT * FROM words WHERE ID = $index");

        while ($row=mysqli_fetch_assoc($result)){
            
            $grammer['word'] = $row['Word'];
            $grammer['definition'][] = str_replace("\t"," ",$row['Definition']);
        }

        echo json_encode($grammer);

        exit(0);
    }


?>