<?php
    $allUsers = [];

    $connectionToDatabase = new PDO('mysql:host=127.0.0.1:3306;dbname=couplify','root','' );
    if ($connectionToDatabase->errorCode()) {
        die("Connection failed: " . $connectionToDatabase->errorCode());
    }

    $resultOfQuery = $connectionToDatabase->prepare("select * from userDetails");
    $resultOfQuery->execute();
    while($row = $resultOfQuery->fetch()){
        array_push($allUsers, $row);
    }
    $resultOfQuery->closeCursor();
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
                            <h2>All Users</h2>
                        </div>
                    </div>

                    <div class="columns is-multiline">

                        <?php
                           foreach ($allUsers as $user) {
                                echo '<div class="column is-3">';
                                echo '<article class="group-box">';
                                echo '<div class="box-img has-background-image" data-demo-background="'.$user["profilePhoto"].'"></div>';
                                echo '<a href = "#" class="box-link" >';
                                echo '<div class="box-img--hover has-background-image" data-demo-background="'.$user["profilePhoto"].'" ></div>';
                                echo '</a>';
                                echo '<div class="box-info" >';
                                echo '<h3 class="box-title">'.$user["lastName"].' '.$user["firstName"].'</h3>';
                                echo '<span class="box-category">'.$user["aboutMe"].'</span>';
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