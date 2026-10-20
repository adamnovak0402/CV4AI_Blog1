<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="form_control/edit.php">
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
        <input type="hidden" name="id" value="'.$row["id"].'">
        <input type="text" name="title" value="'.$row["title"].'">
        <br>
        <textarea name="content">' .$row["content"] .'</textarea>
        <br>
            ');

                } catch (PDOException $e) {
                    die("Chyba připojení " . $e->getMessage());
                }
            }
        }
        ?>




        <input type="submit">
    </form>
</body>
</html>
