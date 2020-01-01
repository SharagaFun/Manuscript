<?php 
    $text = htmlspecialchars($_POST['text']);
    $text = nl2br($text);
    
    echo $text; 
?>