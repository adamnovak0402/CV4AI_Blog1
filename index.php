<?php
$host = "192.168.100.88";
$dbname = "tester_blog1";
$username = "tester";
$password = "tester";
?>
<a href="create_post.php">Vytvořit příspěvek</a>
<?php
try {
    $dsn = "mysql:host=$host;dbname=$dbname";

    $pdo = new PDO($dsn, $username, $password);

    //Nastavuje vyhazování vyjímek při chybě
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Výchozí formát dat bude asociativní pole
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Příprava SQL dotazu s otazníky jako zástupnámi znaky
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $statement = $pdo->query($sql);

    $prispevky = $statement->fetchAll();

    foreach ($prispevky as $prispevek) {
        echo ('
            
            <h1><a href="prispevek.php?id='.$prispevek["id"].'"> # '.$prispevek["id"].' ' . $prispevek["title"] . ' </a></h1>
            <p>' . $prispevek["content"] . '</p>
            <a href="edit.php?id='.$prispevek["id"].'">Editovat</a>
            <a href="form_control/delete.php?id='.$prispevek["id"].'">Smazat</a>
        ');
    }

} catch (PDOException $e) {
    die("Chyba připojení " . $e->getMessage());
}