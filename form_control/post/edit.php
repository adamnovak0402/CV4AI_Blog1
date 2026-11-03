<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["title"];
    $content = $_POST["content"];
    $minTitleLength = 5;

    $host = "192.168.100.88";
    $dbname = "tester_blog1";
    $username = "tester";
    $password = "tester";


    if(empty($title)) {
        echo "Musíš vyplnit nadpis";
        die();
    }
    if(empty($content)) {
        echo "Musíš vyplnit obsah";
        die();
    }
    if(strlen($title) < $minTitleLength) {
        echo "Minimální délka nadpisu je: " . $minTitleLength;
        die();
    }


    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        //Nastavuje vyhazování vyjímek při chybě
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Výchozí formát dat bude asociativní pole
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // Příprava SQL dotazu s otazníky jako zástupnámi znaky

        $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $statement = $pdo->prepare($sql);

        $statement->execute([$title, $content, $_POST["id"]]);
        echo "Editováno";

    } catch (PDOException $e) {
        die("Chyba připojení " . $e->getMessage());
    }

}

?>