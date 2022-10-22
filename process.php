<?php
    if(isset($_POST['btnLogin']))
    {
        $us = $_POST['txtUsername'];
        $pa = $_POST['txtPass'];
        echo "You have loged in with ".$us." and password is ".$pa;
    }
?>