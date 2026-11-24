<?php
$host = "192.168.100.88";
$dbname = "tester_blog1";
$username = "tester";
$password = "tester";
$prispevky = null;
try {
    $dsn = "mysql:host=$host;dbname=$dbname";

    $pdo = new PDO($dsn, $username, $password);

    //Nastavuje vyhazování vyjímek při chybě
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Výchozí formát dat bude asociativní pole
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Příprava SQL dotazu s otazníky jako zástupnámi znaky
    $sql = "SELECT * FROM posts";
    $statement = $pdo->query($sql);

    $prispevky = $statement->fetchAll();

} catch (PDOException $e) {
    die("Chyba připojení " . $e->getMessage());
}
?>
<?php
require_once("layout/header.php");
require_once("layout/navigation.php");
?>
    <div class="container mt-3">
        <a href="create_post.php" class="btn btn-primary mt-2 mb-2">Přidat příspěvek</a>
        <?php
        foreach ($prispevky as $prispevek) {
            echo ('
            <div class="post">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">'.$prispevek['title'].'</h5>
                    <p class="card-text">'.$prispevek["content"].'</p>
                     <a href="edit.php?id='.$prispevek["id"].'" class="btn btn-warning">Editovat</a>
                     <a href="delete.php?id='.$prispevek["id"].'" class="btn btn-danger">Smazat</a>
                </div>
            </div>
            <br>
        </div>
            ');
        }
        ?>

    </div>

<?php
require_once("layout/footer.php");