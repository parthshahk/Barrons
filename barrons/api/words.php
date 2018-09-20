<?php

    include 'connection.php';

    $action = $_REQUEST['action'];

    if($action == 'getRandom'){

        $index = mt_rand(1,903);
        $grammer = [];

        $result = mysqli_query($con, "SELECT words.word AS Word, definitions.definition AS Definition FROM words JOIN definitions ON words.word = definitions.word WHERE words.Position=$index");

        while ($row=mysqli_fetch_assoc($result)){
            
            $grammer['word'] = $row['Word'];
            $grammer['definition'][] = str_replace("\t"," ",$row['Definition']);
        }

        sleep(2);
        echo json_encode($grammer);

        exit(0);
    }


?>