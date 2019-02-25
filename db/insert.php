<?php
    $con = mysqli_connect("localhost","parth","parth","vocab");
    $word = htmlspecialcharacters(trim($_REQUEST['word']));
    $def = htmlspecialcharacters(trim($_REQUEST['def']));
    
    $result = mysqli_query($con, "SELECT * FROM words WHERE Word = '$word'");
    
    if(!mysqli_num_rows($result)){
        mysqli_query($con, "INSERT INTO words (Word, Definition) VALUES('$word', '$def')");
    }
?>