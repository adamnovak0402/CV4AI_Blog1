<?php
$host = "192.168.100.88";
$dbname = "tester_blog1";
$username = "tester";
$password = "tester";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"]) && is_numeric($_GET["id"])){
        $id = $_GET["id"];

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $pdo = new PDO($dsn, $username, $password);
            //Nastavuje vyhazování vyjímek při chybě
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Výchozí formát dat bude asociativní pole
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Příprava SQL dotazu s otazníky jako zástupnámi znaky
            $sql = "SELECT * FROM posts WHERE id = ?";
            $statement = $pdo->prepare($sql);

            $statement->execute([$id]);
            $row = $statement->fetch();
            echo ('
                <h1>' . $row["title"] . '</h1>
                <p>' .$row["content"] .'</p>
            ');

        } catch (PDOException $e) {
            die("Chyba připojení " . $e->getMessage());
        }
    }
}
?>