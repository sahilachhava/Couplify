<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $currentUser = null;

    if(isset($_SESSION["userID"])){
        $utility->setCurrentUser($db);
        $currentUser = unserialize($_SESSION["currentUser"]);
    }else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>
<?php include_once("UI/navigation.php"); ?>

<!-- Body design starts here   -->

<!-- Body design ends here   -->

</body>
<?php include_once("UI/scripts.php"); ?>
</html>