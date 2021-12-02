<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $statusFlag = "";

    if(isset($_POST["validateAccount"])){
        $result = $db->isEmailExists($_POST["userEmail"]);
        if($result != false){
            header("Location: newPassword.php?id=".$result);
        }else{
            $statusFlag = "No user found with this email.";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include_once("commonUI/head.php"); ?>
        <style>
            .errorMessage {
                color: red;
                font-weight: bold;
                font-variant: all-petite-caps;
                font-size: 16px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
    <?php include_once("commonUI/preloader.php"); ?>
    <!-- Body design starts here   -->
    <div class="signup-wrapper">
        <!--navigation-->
        <div class="fake-nav">
            <a href="login.php" class="logo">
                <img class="light-image" src="assets/img/logo.png" width="112" height="28" alt="">
                <img class="dark-image" src="assets/img/logo.png" width="112" height="28" alt="">
            </a>
        </div>

        <div class="container">
            <!--Container-->
            <div class="login-container">
                <div class="columns is-vcentered">
                    <div class="column is-6 image-column">
                        <!--Illustration-->
                        <img class="light-image login-image" src="assets/img/custom/login.svg" alt="">
                        <img class="dark-image login-image" src="assets/img/custom/login-dark.svg" alt="">
                    </div>

                    <div class="column is-6">
                        <h2 class="errorMessage"><?= $statusFlag ?></h2>

                        <h2 class="form-title">Forgot password</h2>
                        <h3 class="form-subtitle">Enter your email to change your password.</h3>

                        <!--Form-->
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="login-form">
                                <div class="form-panel">
                                    <div class="field">
                                        <label>Email</label>
                                        <div class="control">
                                            <input type="email" class="input" name="userEmail" placeholder="Enter your email address" required>
                                        </div>
                                    </div>
                                    <div class="field is-flex">
                                        <div class="switch-block"></div>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <button type="submit" name="validateAccount" class="button is-solid primary-button is-fullwidth raised">Validate My Account</button>
                                </div>

                                <div class="account-link has-text-centered">
                                    <a href="login.php">Back to login? Click here</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body design ends here   -->

    </body>
<?php include_once("commonUI/scripts.php"); ?>
</html>
