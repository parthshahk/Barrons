<?php
    $con = mysqli_connect("localhost","parth","parth","test");
    $word = trim($_REQUEST['word']);
    
    $result = mysqli_query($con, "SELECT * FROM words WHERE word = '$word'");
    
    if(!mysqli_num_rows($result)){
        mysqli_query($con, "INSERT INTO words VALUES('$word')");
    }
?>