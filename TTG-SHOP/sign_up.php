<?php 
require_once 'includes/signup/sign_up_view.inc.php';
include_once "header.php";
?>
        <main class="main">
            <div class="container-login">
                <h4>Rejestracja</h4>
                <form action="includes/signup/sign_up.inc.php" method="post">
                    <?php sign_up_inputs() ?>
                    <button type="submit">Zarejestruj</button>
                </form>

                <?php check_sign_up_errors() ?>

            </div>
        </main>
<?php include_once "footer.php"; ?>