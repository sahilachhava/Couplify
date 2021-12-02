<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    $db = new CouplifyDB();
    $utility = new Utility();

    $statusFlag = "";
    if(isset($_POST["saveDetails"])){
        $basicUserDetails = array($_POST["enteredEmail"], md5($_POST["enteredPassword"]), $_POST["firstName"], $_POST["lastName"]);
        $queryFlag = $db->registerNewUser($basicUserDetails);
        if($queryFlag){
            setcookie("tempUserID", $db->getLastInsertedID(), strtotime("+1 month"), "/");
            header("Location: profileSetup.php");
        }else{
            $statusFlag = "Something went wrong! Try again later";
        }
    }
    if(isset($_SESSION["userID"])){
        if($db->isUserExists($_SESSION["userID"])){
            header("Location: index.php");
        }else{
            unset($_SESSION["userID"]);
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
        <div class="login-container is-centered">
            <div class="columns is-vcentered">
                <div class="column">
                    <h2 class="errorMessage"><?= $statusFlag ?></h2>

                    <h2 class="form-title has-text-centered">Hey there!</h2>
                    <h3 class="form-subtitle has-text-centered">Lets create your account.</h3>

                    <!--Form-->
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="login-form">
                        <div class="form-panel" style="margin-bottom: 30px;">
                            <div class="columns is-multiline">
                                <div class="column is-6">
                                    <div class="field">
                                        <label>First Name</label>
                                        <div class="control">
                                            <input type="text" name="firstName" class="input" placeholder="Enter your first name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="field">
                                        <label>Last Name</label>
                                        <div class="control">
                                            <input type="text" name="lastName" class="input" placeholder="Enter your last name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12">
                                    <div class="field">
                                        <label>Email</label>
                                        <div class="control">
                                            <input type="email" name="enteredEmail" class="input" placeholder="Enter your email address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12">
                                    <div class="field">
                                        <label>Password</label>
                                        <div class="control">
                                            <input type="password" name="enteredPassword" class="input" placeholder="Enter your password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="buttons mt-2">
                            <button type="submit" name="saveDetails" class="button is-solid primary-button is-fullwidth raised">Create Account</button>
                        </div>

                        <div class="account-link has-text-centered">
                            <a href="login.php">Have an account? Sign In</a>
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
