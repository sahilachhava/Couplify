<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $allUsers = $db->getAllUsers();
    $currentUser = null;

    if(isset($_SESSION["currentUser"])){
        $currentUser = unserialize($_SESSION["currentUser"]);
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

<!-- Body design code starts here   -->
<div class="view-wrapper">
    <div id="groups" class="navbar-v2-wrapper">
        <div class="container">
            <div class="groups-grid">

                <div class="grid-header">
                    <div class="header-inner">
                        <h2>Members</h2>
                    </div>
                </div>

                <div class="columns is-multiline">

                    <?php
                    foreach ($allUsers as $user) {
                        if($user["userID"] != ((isset($_SESSION["userID"]))? $_SESSION["userID"] : "")) {
                            echo '<div class="column is-3">';
                            echo '<article class="group-box">';
                            echo '<div class="box-img has-background-image" data-demo-background="' . $user["profilePhoto"] . '"></div>';
                            echo '<a href = "profile.php?userID=' . $user["userID"] . '" class="box-link" >';
                            echo '<div class="box-img--hover has-background-image" data-demo-background="' . $user["profilePhoto"] . '" ></div>';
                            echo '</a>';
                            echo '<div class="box-info" >';
                            echo '<h3 class="box-title">' . $user["lastName"] . ' ' . $user["firstName"] . '</h3>';
                            echo '<span class="box-category">Looking for ' . $user["lookingFor"] . '</span>';
                            echo '</div></article></div>';
                        }
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Body design code ends here   -->
</body>
<?php include_once("UI/scripts.php"); ?>
</html>