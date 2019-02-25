<?php

    $con = mysqli_connect("localhost","parth","parth","vocab");

    $file = fopen("words.txt", "r");


    while($word = htmlspecialchars(fgets($file))){
        
        $def = htmlspecialchars(fgets($file));
        
        $def = str_replace("'","&apos;",$def);

        $result = mysqli_query($con, "SELECT * FROM words WHERE Word = '$word'");

        if(!mysqli_num_rows($result)){
            mysqli_query($con, "INSERT INTO words (Word, Definition) VALUES('$word', '$def')");
        }

    }

    fclose($file);
?>