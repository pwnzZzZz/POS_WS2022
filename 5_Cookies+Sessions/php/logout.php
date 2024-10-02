<?php
    session_start();
    setcookie(session_name(), '', time()-42000, '/', '', false, true);
    session_destroy();
    header('Location: ../index.php');

?>