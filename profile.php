<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $currentUser = null;

    $userDetails = [];
    $additionalDetails = [];
    $userAddress = [];

    if(isset($_GET["userID"])){
        if($db->isUserExists($_GET["userID"])){
            $userDetails = $db->getUserDetails($_GET["userID"]);
            $additionalDetails = $db->getAdditionalDetails($_GET["userID"]);
            $userAddress = $db->getUserAddress($_GET["userID"]);
        }else{
            header("Location: error404.php");
        }
    }else{
        header("Location: error404.php");
    }

    if(isset($_SESSION["currentUser"])){
        $currentUser = unserialize($_SESSION["currentUser"]);
    }

    if(isset($_POST["sendWink"])){
        $db->sendMessage($currentUser->getUserID(), $userDetails["userID"], "wink");
        header("Location: message.php?userID=".$userDetails["userID"]);
    }

    if(isset($_POST["addToFavourite"])){
        $db->addToFavourite($currentUser->getUserID(), $userDetails["userID"]);
        $utility->setCurrentUser($db);
        header("Location: profile.php?userID=".$userDetails["userID"]);
    }

    if(isset($_POST["removeFromFavourite"])){
        $db->removeFromFavourite($currentUser->getUserID(), $userDetails["userID"]);
        $utility->setCurrentUser($db);
        header("Location: profile.php?userID=".$userDetails["userID"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("commonUI/head.php"); ?>
    <style>
        .interestDetailList {
            list-style-type: disc;
            padding-left: 20px;
            line-height: 100%;
        }
    </style>
</head>
<body>
<?php include_once("commonUI/preloader.php"); ?>
<?php include_once("commonUI/navigation.php"); ?>

<!-- Body design starts here   -->
<div class="view-wrapper">
    <div id="profile-about" class="navbar-v2-wrapper">
        <div class="container is-custom">
            <div class="view-wrap is-headless">

                <div class="columns is-multiline no-margin">
                    <div class="column is-paddingless">
                        <div class="avatar is-hidden-mobile">
                            <img style="border-radius: 50%;height: 17%; width: 17%;margin-left: 42%;" id="user-avatar" class="avatar-image" src="<?= $userDetails["profilePhoto"]; ?>" alt="">
                        </div>
                        <div class="avatar is-hidden-desktop">
                            <img style="border-radius: 50%;height: 35%; width: 35%;margin-left: 32%;" id="user-avatar" class="avatar-image" src="<?= $userDetails["profilePhoto"]; ?>" alt="">
                        </div>
                        <form method="post" action="profile.php?userID=<?= $userDetails['userID']; ?>" hidden>
                            <button type="submit" name="addToFavourite" id="addToFavourite" hidden></button>
                        </form>
                        <form method="post" action="profile.php?userID=<?= $userDetails['userID']; ?>" hidden>
                            <button type="submit" name="removeFromFavourite" id="removeFromFavourite" hidden></button>
                        </form>
                        <div class="profile-subheader">
                            <div class="subheader-end is-hidden-mobile" style="text-align: left;">
                                <?php
                                    if(isset($_SESSION["userID"])){
                                            if($currentUser->isPremium()){
                                            if(in_array($userDetails, $currentUser->getFavouritedUsers())){
                                ?>
                                        <a onclick="document.getElementById('removeFromFavourite').click();" class="button has-icon is-bold">
                                            <i data-feather="x-circle"></i>&nbsp;<span>Remove from favourites</span>
                                        </a>
                                <?php
                                        }else{
                                ?>
                                    <a onclick="document.getElementById('addToFavourite').click();" class="button has-icon is-bold">
                                        <i data-feather="star"></i>&nbsp;<span>Add to favourites</span>
                                    </a>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div class="subheader-middle is-hidden-desktop" style="margin-top: -10%;">
                                <h2><?php echo $userDetails["lastName"]." ".$userDetails["firstName"]; ?></h2>
                                <span><?php echo $userDetails["gender"]; ?></span>
                                <?php
                                if(isset($_SESSION["userID"])){
                                    if($currentUser->isPremium()){
                                            if(in_array($userDetails, $currentUser->getFavouritedUsers())){
                                ?>
                                        <a onclick="document.getElementById('removeFromFavourite').click();" class="button has-icon is-bold is-hidden-desktop" style="margin-top: 10%;">
                                            <i data-feather="x-circle"></i>&nbsp;<span>Remove from favourites</span>
                                        </a>
                                <?php
                                        }else{
                                ?>
                                        <a onclick="document.getElementById('addToFavourite').click();" class="button has-icon is-bold is-hidden-desktop" style="margin-top: 10%;">
                                            <i data-feather="star"></i>&nbsp;<span>Add to favourites</span>
                                        </a>
                                <?php
                                        }
                                    }
                                ?>
                                    <br />
                                    <a href="message.php?userID=<?= $userDetails["userID"] ?>" class="button has-icon is-bold is-hidden-desktop" style="margin-top: 5%; margin-bottom: 5%;">
                                        <i data-feather="message-circle"></i>&nbsp;<span>Send Message</span>
                                    </a>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="subheader-middle is-hidden-mobile">
                                <h2><?php echo $userDetails["lastName"]." ".$userDetails["firstName"]; ?></h2>
                                <span><?php echo $userDetails["gender"]; ?></span>
                            </div>
                            <div class="subheader-end is-hidden-mobile">
                                <?php
                                    if(isset($_SESSION["userID"])){
                                ?>
                                    <a href="message.php?userID=<?= $userDetails["userID"] ?>" class="button has-icon is-bold">
                                        <i data-feather="message-circle"></i>
                                        <span>Send Message</span>
                                    </a>
                                <?php
                                    }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="profile-about side-menu">
                        <div class="left-menu">
                            <div class="left-menu-inner">
                                <div class="menu-item is-active" data-content="overview-content">
                                    <div class="menu-icon">
                                        <i class="mdi mdi-progress-check"></i>
                                        <span>Overview</span>
                                    </div>
                                </div>
                                <div class="menu-item" data-content="photos-content">
                                    <div class="menu-icon">
                                        <i class="mdi mdi-camera"></i>
                                        <span>Photos</span>
                                    </div>
                                </div>
                                <div class="menu-item" data-content="interests-content">
                                    <div class="menu-icon">
                                        <i class="mdi mdi-book"></i>
                                        <span>Interests</span>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION["userID"])){
                                ?>
                                    <form method="post" action="profile.php?userID=<?= $userDetails['userID']; ?>" hidden>
                                        <button type="submit" name="sendWink" id="sendWink" hidden></button>
                                    </form>
                                    <a onclick="document.getElementById('sendWink').click();">
                                        <div class="menu-item is-active winks" data-content="innocent-wink">
                                            <div class="menu-icon" style="background-color: #ff2e1c">
                                                <i class="mdi mdi-emoticon-wink"></i>
                                                <span>Send Wink</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="right-content">

                            <!--  Overview Content -->
                            <div id="overview-content" class="content-section is-active">
                                <div class="columns">
                                    <div class="column">
                                        <div class="flex-block">
                                            <img src="assets/img/custom/work.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>I am working as <a><?php echo $userDetails["job"]; ?></a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/location.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>Lives in <a><?php echo $userAddress["city"].", ".$userAddress["state"]; ?></a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/love.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>I am <a><?php echo $userDetails["maritalStatus"]; ?></a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/search.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>Looking for <a><?php echo $userDetails["lookingFor"]; ?></a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="about-summary">
                                            <div class="content">
                                                <h3>About Me</h3>
                                                <p><?php echo $userDetails["aboutMe"]; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--  Photos Content -->
                            <div id="photos-content" class="content-section">
                                <div class="about-card">
                                    <div class="header">
                                        <div class="icon-title">
                                            <i class="mdi mdi-camera"></i>
                                            <h3>Photos</h3>
                                        </div>
                                    </div>

                                    <div class="body has-flex-list">
                                        <div class="photo-list">
                                            <?php
                                                $userPhotos = $db->getPhotos($userDetails["userID"]);
                                                if(count($userPhotos) > 0){
                                                    foreach ($userPhotos as $photo){
                                                        echo '<a href="assets/photos/'.$userDetails["userID"].'/'.$photo.'" data-fancybox="cl-group-demo" data-thumb="assets/photos/'.$userDetails["userID"].'/'.$photo.'">';
                                                        echo '<div class="photo-wrapper" style="width: 250px;height: 200px;cursor: pointer;">';
                                                        echo '<div class="photo-overlay"></div>';
                                                        echo '<img src="assets/photos/'.$userDetails["userID"].'/'.$photo.'" alt="" style="width: 250px;height: 200px;cursor: pointer;">';
                                                        echo '</div></a>';
                                                    }
                                                }else{
                                                    echo '<div class="photo-wrapper">';
                                                    echo "No photos found";
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!--  Interests Content -->

                                <div id="interests-content" class="columns content-section has-portrait-padding">
                                    <div class="column">
                                        <div class="card page-about-card">
                                            <div class="card-title">
                                                <h4>About <?php echo $userDetails["lastName"]." ".$userDetails["firstName"]; ?></h4>
                                            </div>
                                            <div class="about-body">
                                                <div class="columns">
                                                    <div class="column is-4">
                                                        <!-- Hobbies -->
                                                        <div class="about-block">
                                                            <div class="block-header">
                                                                <h4>Hobbies</h4>
                                                            </div>
                                                            <div class="block-content">
                                                                <ul class="interestDetailList">
                                                                    <?php
                                                                        foreach ($additionalDetails["hobbies"] as $hobby) {
                                                                            echo "<li>";
                                                                            echo "<div class='flex-inner'>";
                                                                            echo "<span>".$hobby."</span>";
                                                                            echo "</div>";
                                                                            echo "</li>";
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!-- Languages -->
                                                        <div class="about-block">
                                                            <div class="block-header">
                                                                <h4>Known Languages</h4>
                                                            </div>
                                                            <div class="block-content">
                                                                <ul class="interestDetailList">
                                                                    <?php
                                                                        foreach ($additionalDetails["languages"] as $language) {
                                                                            echo "<li>";
                                                                            echo "<div class='flex-inner'>";
                                                                            echo "<span>".$language."</span>";
                                                                            echo "</div>";
                                                                            echo "</li>";
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-4">
                                                        <!-- Cuisine Preferences -->
                                                        <div class="about-block">
                                                            <div class="block-header">
                                                                <h4>Cuisine Preferences</h4>
                                                            </div>
                                                            <div class="block-content">
                                                                <ul class="interestDetailList">
                                                                    <?php
                                                                        foreach ($additionalDetails["cuisines"] as $cuisine) {
                                                                            echo "<li>";
                                                                            echo "<div class='flex-inner'>";
                                                                            echo "<span>".$cuisine."</span>";
                                                                            echo "</div>";
                                                                            echo "</li>";
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column is-4">
                                                        <!-- Total Children -->
                                                        <div class="about-block">
                                                            <div class="block-header">
                                                                <h4>Other details</h4>
                                                            </div>
                                                            <div class="block-content">
                                                                <ul>
                                                                    <li>
                                                                        <div class='flex-inner'>
                                                                            <span>Looking for: <?php echo $userDetails["lookingFor"] ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class='flex-inner'>
                                                                            <span>Marital Status: <?php echo $userDetails["maritalStatus"] ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class='flex-inner'>
                                                                            <span>Age: <?php echo date_diff(date_create($userDetails["dateOfBirth"]), date_create('today'))->y; ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                        if($userDetails["totalChildren"] > 0){
                                                                            echo "<li>";
                                                                            echo "<div class='flex-inner'>";
                                                                            echo "<span>Total Children: ".$userDetails["totalChildren"]."</span>";
                                                                            echo "</div>";
                                                                            echo "</li>";
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- Body design ends here   -->
</body>
<?php include_once("commonUI/scripts.php"); ?>
</html>