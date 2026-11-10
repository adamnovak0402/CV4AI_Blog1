<?php
session_start();
if(isset($_SESSION["username"])) {
    echo("Stránka dostupná jen pro přihlášené");
    echo("Jsi přihlášen za: ") . $_SESSION["username"];
}else {
    header('Location: /login.php');
}

?>
