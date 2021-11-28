<?php
session_start();
require_once("controller/CouplifyDB.php");
require_once("controller/Utility.php");

$statusFlag = "";
if(isset($_POST['validateLogin'])){
    $db = new CouplifyDB();
    $currentUser = $db->validateLogin($_POST["userEmail"], $_POST["userPassword"]);
    if($currentUser != -1){
        $_SESSION["userID"] = $currentUser;
        header("Location: index.php");
    }else{
        $statusFlag = "Invalid email or password, Please try valid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
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
<?php include_once("UI/preloader.php"); ?>
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
                    <img class="light-image login-image" src="assets/img/illustrations/login/login.svg" alt="">
                    <img class="dark-image login-image" src="assets/img/illustrations/login/login-dark.svg" alt="">
                </div>

                <div class="column is-6">
                    <h2 class="errorMessage"><?= $statusFlag ?></h2>

                    <h2 class="form-title">Welcome to Couplify</h2>
                    <h3 class="form-subtitle">Enter your credentials to sign in.</h3>

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
                            <div class="field">
                                <label>Password</label>
                                <div class="control">
                                    <input type="password" class="input" name="userPassword" placeholder="Enter your password" required>
                                </div>
                            </div>
                            <div class="field is-flex">
                                <div class="switch-block"></div>
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>

                        <div class="buttons">
                            <button type="submit" name="validateLogin" class="button is-solid primary-button is-fullwidth raised">Login</button>
                        </div>

                        <div class="account-link has-text-centered">
                            <a href="signup.php">Don't have an account? Sign Up</a>
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
<?php include_once("UI/scripts.php"); ?>
</html><?php