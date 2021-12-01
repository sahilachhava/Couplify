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
<div class="view-wrapper">
    <div id="friends-page" class="friends-wrapper main-container">
        <div class="card-row-wrap is-active" style="margin-top: 5%;">
            <div class="card-row-placeholder">
                <span class="light-image" style="color: black;">No favorited members found.</span>
                <span class="dark-image" style="color: white;">No favorited members found.</span>
            </div>
            <div class="card-row">

                <?php
                    $allMyFavourites = $db->getMyFavourites($currentUser->getUserID());
                    foreach ($allMyFavourites as $user){
                        echo $utility->myFavouritesDesignCode($user);
                    }
                ?>

            </div>
        </div>
    </div>
</div>
<!-- Body design ends here   -->
</body>
<?php include_once("UI/scripts.php"); ?>
</html>