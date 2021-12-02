<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $statusFlag = "";

    if(!isset($_GET["id"]) && !isset($_POST["userID"])){
        header("Location: error404.php");
    }

    if(isset($_POST["changePassword"])){
        if($_POST["newPassword"] == $_POST["repeatPassword"]){
            if($db->changePassword($_POST["userID"], $_POST["newPassword"])){
                header("Location: login.php");
            }else{
                $statusFlag = "Something went wrong, please try again later.";
            }
        }else{
            $statusFlag = "Password not matched";
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
                    <img class="light-image login-image" src="assets/img/custom/login.svg" alt="">
                    <img class="dark-image login-image" src="assets/img/custom/login-dark.svg" alt="">
                </div>

                <div class="column is-6">
                    <h2 class="errorMessage"><?= $statusFlag ?></h2>

                    <h2 class="form-title">Setup new password</h2>
                    <h3 class="form-subtitle">Enter new password to change.</h3>

                    <!--Form-->
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="login-form">
                            <div class="form-panel">
                                <div class="field">
                                    <label>New Password</label>
                                    <div class="control">
                                        <input type="password" class="input" name="newPassword" placeholder="Enter new password" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Repeat Password</label>
                                    <div class="control">
                                        <input type="password" class="input" name="repeatPassword" placeholder="Repeat your new password" required>
                                    </div>
                                </div>
                                <input type="text" name="userID" value="<?= (isset($_GET["id"])) ? $_GET["id"] : '' ?>" hidden />
                                <div class="field is-flex">
                                    <div class="switch-block"></div>
                                </div>
                            </div>

                            <div class="buttons">
                                <button type="submit" name="changePassword" class="button is-solid primary-button is-fullwidth raised">Set new password</button>
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
</html>
