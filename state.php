<?php
    $hidhide = "hidden";
    if(isset($_SESSION))
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == "admin")
            $hidhide = "";
    }
        
?>