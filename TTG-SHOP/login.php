<?php
require_once 'includes/login/login_view.inc.php';
include_once "header.php";
?>
        <main class="main">
        <div class="container-login">
                <h4>Logowanie</h4>
                <form action="includes/login/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="Nazwa Użytkownika">
                    <input type="password" name="pwd" placeholder="Hasło">
                    <button type="submit">Zaloguj</button>
                </form>
                <a href="sign_up.php">Nie masz konta? Zarejestruj się!</a>

                <?php check_login_errors() ?>

            </div>
            <br><br><br>
        </main>
<?php include_once "footer.php"; ?>