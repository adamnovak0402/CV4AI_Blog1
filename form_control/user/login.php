<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "192.168.100.88";
    $dbname = "tester_blog1";
    $username_db = "tester";
    $password_db = "tester";

    if (empty($_POST["username"])) {
        echo "Vyplň uživatelské jméno!";
        die();
    } else if (empty($_POST["password"])) {
        echo "Vyplň heslo!";
        die();
    }
    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM users WHERE username = ?";
        $statement = $pdo->prepare($sql);

        $statement->execute([$_POST["username"]]);
        $user = $statement->fetch();

        if($user){
            echo "Jméno už existuje!";
            if(password_verify($_POST["password"], $user["hash_password"])){
                session_start();
                $_SESSION["username"] = $user["username"];
                header("Location: /dashboard.php");

            } else {
                echo "Heslo není správně!";
            }
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}