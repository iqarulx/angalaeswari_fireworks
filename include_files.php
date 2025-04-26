<?php
    session_start();
    
      
    include("include/label.php");
    include("include/functions.php");
    include("include/validation.php");
    
    $obj = new billing();
    $valid = new validation();
?>