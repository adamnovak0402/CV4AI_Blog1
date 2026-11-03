<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){

    $host = "192.168.100.88";
    $dbname = "tester_blog1";
    $username = "tester";
    $password = "tester";

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        //Nastavuje vyhazování vyjímek při chybě
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Výchozí formát dat bude asociativní pole
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // Příprava SQL dotazu s otazníky jako zástupnámi znaky

        //DELETE SQL Příkaz
        // =)
        $sql = "DELETE from posts WHERE id = ?";
        $statement = $pdo->prepare($sql);

        $statement->execute([$_GET["id"]]);
        echo "Smazáno";
        echo '<a href="../../index.php">Back</a>';

    } catch (PDOException $e) {
        die("Chyba připojení " . $e->getMessage());
    }

}

?>