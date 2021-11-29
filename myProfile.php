<?php
session_start();
require_once("controller/CouplifyDB.php");
require_once("controller/Utility.php");
require_once("model/User.php");
$db = new CouplifyDB();
$utility = new Utility();

if(!isset($_SESSION["userID"])){
    header("Location: login.php");
}
$currentUser = unserialize($_SESSION["currentUser"]);

$error = "";
if(isset($_FILES["uploadPhoto"])){
    if($_FILES["uploadPhoto"]["size"] > 2097152){
        $error = "Sorry your uploaded file is too large. (Limit < 2MB)";
    }else{
        if (!file_exists("assets/photos/".$currentUser->getUserID())) {
            mkdir("assets/photos/".$currentUser->getUserID(), 0777, true);
        }

        $fileNameWithExtension = $_FILES["uploadPhoto"]["name"];
        $pathToStore = "assets/photos/" . $currentUser->getUserID() ."/". $fileNameWithExtension;
        if(!move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $pathToStore)){
            $error = "File Not Uploaded Successfully";
        }else{
            $db->addPhoto($fileNameWithExtension, $currentUser->getUserID());
        }
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include_once("UI/head.php"); ?>
        <style>
            .interestDetailList {
                list-style-type: disc;
                padding-left: 20px;
                line-height: 100%;
            }
            .errorMsg {
                color: red;
                font-weight: bold;
                font-size: 20px;
                font-variant: all-petite-caps;
            }
        </style>
    </head>
    <body>
    <?php include_once("UI/preloader.php"); ?>
    <?php include_once("UI/navigation.php"); ?>

    <!-- Body design starts here   -->
    <div class="view-wrapper">
        <div id="profile-about" class="navbar-v2-wrapper">
            <div class="container is-custom">
                <div class="view-wrap is-headless">

                    <div class="columns is-multiline no-margin">
                        <div class="column is-paddingless">
                            <div class="avatar is-hidden-mobile">
                                <img style="border-radius: 50%;height: 17%; width: 17%;margin-left: 42%;" id="user-avatar" class="avatar-image" src="<?= $currentUser->getUserPhoto(); ?>" alt="">
                            </div>
                            <div class="avatar is-hidden-desktop">
                                <img style="border-radius: 50%;height: 35%; width: 35%;margin-left: 30%;" id="user-avatar" class="avatar-image" src="<?= $currentUser->getUserPhoto(); ?>" alt="">
                            </div>

                            <div class="profile-subheader">
                                <div class="subheader-end is-hidden-mobile">
                                </div>
                                <div class="subheader-middle is-hidden-desktop" style="margin-left: 20%;margin-top: -10%;">
                                    <h2><?= $currentUser->getUserFullName() ?></h2>
                                    <span><?= $currentUser->getGender() ?></span>
                                    <a href="updateProfile.php" class="button has-icon is-bold is-hidden-desktop" style="margin-top: 10%;">
                                        <i data-feather="user"></i>
                                        &nbsp;
                                        <span>Update Profile</span>
                                    </a>
                                </div>
                                <div class="subheader-middle is-hidden-mobile">
                                    <h2><?= $currentUser->getUserFullName() ?></h2>
                                    <span><?= $currentUser->getGender() ?></span>
                                </div>
                                <div class="subheader-end">
                                    <a href="updateProfile.php" class="button has-icon is-bold is-hidden-mobile">
                                        <i data-feather="user"></i>
                                        &nbsp;
                                        <span>Update Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="profile-about side-menu">
                            <div class="right-content" style="width: 100%;">

                                <!--  Overview Content -->
                                <div id="overview-content" class="content-section is-active">
                                    <div class="columns">
                                        <div class="column">
                                            <div class="flex-block">
                                                <img src="assets/img/custom/work.png" alt="">
                                                <div class="flex-block-meta">
                                                    <span>I am working as <a><?= $currentUser->getJob(); ?></a></span>
                                                </div>
                                            </div>

                                            <div class="flex-block">
                                                <img src="assets/img/custom/location.png" alt="">
                                                <div class="flex-block-meta">
                                                    <span>Lives in <a><?= $currentUser->getUserAddress()["city"].", ".$currentUser->getUserAddress()["state"]; ?></a></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="column">
                                            <div class="flex-block">
                                                <img src="assets/img/custom/love.png" alt="">
                                                <div class="flex-block-meta">
                                                    <span>I am <a><?= $currentUser->getMaritalStatus(); ?></a></span>
                                                </div>
                                            </div>

                                            <div class="flex-block">
                                                <img src="assets/img/custom/search.png" alt="">
                                                <div class="flex-block-meta">
                                                    <span>Looking for <a><?= $currentUser->getLookingFor(); ?></a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="about-summary" style="margin-top: -10px;">
                                        <div class="content">
                                            <h3>About Me</h3>
                                            <p><?= $currentUser->getAboutMe(); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!--  Photos Content -->
                                <div id="photos-content" style="margin-top: 20px;">
                                    <div class="about-card">
                                        <div class="header">
                                            <div class="icon-title">
                                                <i class="mdi mdi-camera"></i>
                                                <h3>Photos</h3>
                                            </div>
                                            <?php
                                                $userPhotos = $db->getPhotos($currentUser->getUserID());
                                                if(count($userPhotos) < 5){
                                            ?>
                                                <div class="actions">
                                                    <div class="button-wrapper">
                                                        <a class="button" onclick="document.getElementById('uploadPhoto').click();">
                                                            <i data-feather="camera" style="width: 20px; height: 20px; margin-right: 4px;"></i>
                                                            &nbsp;Add Photos
                                                        </a>
                                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="uploadForm" enctype="multipart/form-data">
                                                            <input type="file" name="uploadPhoto" id="uploadPhoto" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('uploadForm').submit();" hidden required/>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </div>

                                        <div class="body has-flex-list">
                                            <h2 class='errorMsg'><?= $error ?></h2>
                                            <div class="photo-list" style="width: 100%;">
                                                <?php
                                                    if(count($userPhotos) > 0){
                                                        foreach ($userPhotos as $photo){
                                                            echo '<a href="assets/photos/'.$currentUser->getUserID().'/'.$photo.'" data-fancybox="cl-group-demo" data-thumb="assets/photos/'.$currentUser->getUserID().'/'.$photo.'">';
                                                            echo '<div class="photo-wrapper" style="width: 335px;height: 250px;cursor: pointer;">';
                                                            echo '<div class="photo-overlay"></div>';
                                                            echo '<img src="assets/photos/'.$currentUser->getUserID().'/'.$photo.'" alt="" style="width: 335px;height: 250px;cursor: pointer;">';
                                                            echo '</div></a>';
                                                        }
                                                    }else{
                                                        echo '<div class="photo-wrapper">';
                                                        echo "<h2 style='font-variant: all-petite-caps; font-size: 22px;'>No photos uploaded yet.</h2>";
                                                        echo '</div>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--  Interests Content -->

                                <div id="interests-content" class="columns has-portrait-padding" style="margin-top: 10px;">
                                    <div class="column">
                                        <div class="card page-about-card">
                                            <div class="card-title">
                                                <h4>About <?= $currentUser->getUserFullName() ?></h4>
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
                                                                    foreach ($currentUser->getUserHobbies() as $hobby) {
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
                                                                    foreach ($currentUser->getUserLanguages() as $language) {
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
                                                                    foreach ($currentUser->getUserCuisines() as $cuisine) {
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
                                                                            <span>Looking for: <?= $currentUser->getLookingFor(); ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class='flex-inner'>
                                                                            <span>Marital Status: <?= $currentUser->getMaritalStatus(); ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class='flex-inner'>
                                                                            <span>Age: <?php echo date_diff(date_create($currentUser->getDateOfBirth()), date_create('today'))->y; ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                    if($currentUser->getTotalChildren() > 0){
                                                                        echo "<li>";
                                                                        echo "<div class='flex-inner'>";
                                                                        echo "<span>Total Children: ".$currentUser->getTotalChildren()."</span>";
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
    <!-- Body design ends here   -->

    </body>
<?php include_once("UI/scripts.php"); ?>
    </html>
