<?php
include_once("CouplifyDB.php");

$db = new CouplifyDB();
$allUsers = $db->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./head.php"); ?>
</head>
<body>
<?php include_once("./preloader.php"); ?>
<?php include_once("./navigation.php"); ?>

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
                        echo '<div class="column is-3">';
                        echo '<article class="group-box">';
                        echo '<div class="box-img has-background-image" data-demo-background="'.$user["profilePhoto"].'"></div>';
                        echo '<a href = "profile.php?userID='.$user["userID"].'" class="box-link" >';
                        echo '<div class="box-img--hover has-background-image" data-demo-background="'.$user["profilePhoto"].'" ></div>';
                        echo '</a>';
                        echo '<div class="box-info" >';
                        echo '<h3 class="box-title">'.$user["lastName"].' '.$user["firstName"].'</h3>';
                        echo '<span class="box-category">Looking for '.$user["lookingFor"].'</span>';
                        echo '</div></article></div>';
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Body design code ends here   -->
</body>
<?php include_once("./scripts.php"); ?>
</html>