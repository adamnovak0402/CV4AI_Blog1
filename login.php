<?php
require_once('layout/header.php');
require_once('layout/navigation.php');
?>
<div class="container">
    <form method="POST" action="form_control/user/login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
        </div>
        <br>
        <input type="submit" class="btn btn-primary">
    </form>
</div>
<?php
require_once('layout/footer.php');