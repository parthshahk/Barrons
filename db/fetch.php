<?php

    $con = mysqli_connect("localhost","parth","parth","vocab");
    include 'curl.php';


    $result = mysqli_query($con, "SELECT * FROM words WHERE word LIKE 'z%'");

    while ($row=mysqli_fetch_row($result)){

        $word = $row[0];

        $get_data = callAPI('GET', 'https://api.datamuse.com/words?sp='.$word.'&md=d&max=1', false);
        $response = json_decode($get_data, true);

        if(isset($response[0]['defs'])){
        
            for($i=0; $i<sizeof($response[0]['defs']); $i++){
        

                $def = $response[0]['defs'][$i];
                mysqli_query($con, "INSERT INTO definitions VALUES('$word', $i+1, '$def')");
            
            }

        }
    }
?>