<?php
session_start();
if(!isset($_SESSION["username"])) {
    header('Location: /login.php');
}

require_once('layout/header.php');
require_once('layout/navigation.php');
?>
    <div class="container">
        <div class="border rounded-3 overflow-auto">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>John</td>
                    <td>Doe</td>
                    <td>@social</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
require_once('layout/footer.php');
