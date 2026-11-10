<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_again = $_POST["password_again"];

    if(empty($username)){
        echo "Není zadánu uživatelské jméno";
        die();
    }

    if(empty($password) || empty($password_again)){
        echo "Není zadáno heslo";
        die();
    }


    if($password !== $password_again){
        echo "Hesla se neshodují!";
        die();
    }
    print_r($password);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $host = "192.168.100.88";
    $dbname = "tester_blog1";
    $username_db = "tester";
    $password_db = "tester";

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
            die();
        }else{
            echo "Jméno jde zaregistrovat";

            try {
                $dsn = "mysql:host=$host;dbname=$dbname";
                $pdo = new PDO($dsn, $username_db, $password_db);
                //Nastavuje vyhazování vyjímek při chybě
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Výchozí formát dat bude asociativní pole
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                // Příprava SQL dotazu s otazníky jako zástupnámi znaky

                $sql = "INSERT INTO users (username, hash_password) VALUES (?, ?)";
                $statement = $pdo->prepare($sql);

                $statement->execute([$username, $hash]);
                echo "Přidáno";

            } catch (PDOException $e) {
                die("Chyba připojení " . $e->getMessage());
            }
        }

    } catch (PDOException $e) {
        die("Chyba připojení " . $e->getMessage());
    }

}
