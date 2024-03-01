<?php
session_start();
if(!isset($_SESSION['uid'])){exiter("index");}
unset($_SESSION['uid']);session_destroy();
exiter("index");
?>