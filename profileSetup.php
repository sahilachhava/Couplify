<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    $db = new CouplifyDB();
    $utility = new Utility();

    $currentUser = [];
    $error = array("photo" => "", "hobby" => "", "cuisine" => "", "language" => "");
    if(isset($_COOKIE["tempUserID"])){
        $currentUser = $db->getUserDetails($_COOKIE["tempUserID"]);
    }else{
        header("Location: login.php");
    }

    if(isset($_POST["saveProfile"])){
        if($_FILES["profilePhoto"]["size"] > 2097152){
            $error["photo"] = "Sorry your uploaded file is too large. (Limit < 2MB)";
        }else if(count($_POST["hobbies"]) > 5 || count($_POST["hobbies"]) == 0){
            $error["hobby"] = "Please select minimum 1 or maximum 5 hobbies";
        }else if(count($_POST["cuisines"]) > 5 || count($_POST["cuisines"]) == 0){
            $error["cuisine"] = "Please select minimum 1 or maximum 5 cuisines";
        }else if(count($_POST["languages"]) > 5 || count($_POST["languages"]) == 0){
            $error["language"] = "Please select minimum 1 or maximum 5 languages";
        }else{
            $fileNameWithExtension = $_FILES["profilePhoto"]["name"];
            $fileExtension = "." . pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
            $pathToStore = "assets/profilePhotos/" . $_COOKIE["tempUserID"] . $fileExtension;
            if(!move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $pathToStore)){
                $error["photo"] = "File Not Uploaded Successfully";
            }else{
                $dateOfBirth = date_format(date_create($_POST["dateOfBirth"]),"Y-m-d");
                $profileDetails = array(
                    "photoPath" => "'".$pathToStore."'",
                    "gender" => "'".$_POST["gender"]."'",
                    "maritalStatus" => "'".$_POST["maritalStatus"]."'",
                    "children" => $_POST["children"],
                    "lookingFor" => "'".$_POST["lookingFor"]."'",
                    "dateOfBirth" => "'".$dateOfBirth."'",
                    "job" => "'".$_POST["job"]."'",
                    "aboutMe" => "'".$_POST["aboutMe"]."'",
                    "city" => $_POST["city"],
                    "state" => $_POST["state"],
                    "country" => $_POST["country"],
                    "hobbies" => $_POST["hobbies"],
                    "languages" => $_POST["languages"],
                    "cuisines" => $_POST["cuisines"],
                    "currentUserID" => $_COOKIE["tempUserID"]
                );

                if($db->createProfile($profileDetails)){
                    $_SESSION["userID"] = $_COOKIE["tempUserID"];
                    unset($_COOKIE['tempUserID']);
                    setcookie('tempUserID', null, -1, '/');
                    header("Location: index.php");
                }else{
                    $error["photo"] = "Something went wrong, Please try again later!";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
    <style>
        .interestsSelect option {
            font-variant: all-petite-caps;
            margin: 5px;
            font-size: 20px;
            font-weight: bold;
        }
        .sectionTitle {
            font-variant: all-petite-caps;
            font-weight: bold;
            font-size: 22px;
        }
        .errorText {
            color: red;
            font-weight: bold;
            font-size: 20px;
            font-variant: all-petite-caps;
        }
        .removeIcon::-webkit-inner-spin-button,
        .removeIcon::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
        #profilePhoto {
            opacity: 0;
        }
        #photoPreview {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>
<!-- Body design starts here   -->
<!--navigation-->
<div class="signup-wrapper">
    <div class="fake-nav">
        <a href="login.php" class="logo">
            <img class="light-image" src="assets/img/logo.png" width="112" height="28" alt="">
            <img class="dark-image" src="assets/img/logo.png" width="112" height="28" alt="">
        </a>
    </div>

    <div class="view-wrapper is-sidebar-v1 is-fold">
    <div id="settings" class="container sidebar-boxed" data-page-title="My Profile">
        <div class="settings-wrapper is-full">

            <div id="general-settings" class="settings-section is-active">
                <div class="settings-panel">

                    <div class="title-wrap">
                        <h2>Setup your profile</h2>
                    </div>

                    <div class="settings-form-wrapper">
                        <div class="settings-form">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div class="columns is-multiline">

                                <div class="column is-12">
                                    <div class="picture-container"></div>
                                    <div class="photo-upload">
                                        <div class="preview">
                                            <a class="upload-button" onclick="document.getElementById('profilePhoto').click();">
                                                <i data-feather="plus"></i>
                                            </a>
                                            <img id="photoPreview" src="assets/profilePhotos/default.jpg" alt="">
                                            <input type="file" name="profilePhoto" id="profilePhoto" accept="image/png, image/jpg, image/jpeg" required/>
                                        </div>
                                        <div class="limitation">
                                            <small>Upload profile picture</small>
                                            <br />
                                            <small style="font-size: 12px;">Only images with a size lower than 2MB are accepted.</small>
                                        </div>
                                        <h3 class="errorText" style="text-align: center;"><?= $error["photo"]; ?></h3>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Gender</label>
                                        <div class="control has-icon">
                                            <select name="gender" class="input is-fade" required>
                                                <option value=""></option>
                                                <option value="Male" <?= (isset($_POST["gender"])) ? ($_POST["gender"] == "Male") ? "selected" : "" : "" ?>>Male</option>
                                                <option value="Female" <?= (isset($_POST["gender"])) ? ($_POST["gender"] == "Female") ? "selected" : "" : "" ?>>Female</option>
                                            </select>
                                            <div class="form-icon">
                                                <i data-feather="smile"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Marital Status</label>
                                        <div class="control has-icon">
                                            <select name="maritalStatus" class="input is-fade" required>
                                                <option value=""></option>
                                                <option value="Single" <?= (isset($_POST["maritalStatus"])) ? ($_POST["maritalStatus"] == "Single") ? "selected" : "" : "" ?>>Single</option>
                                                <option value="Divorced" <?= (isset($_POST["maritalStatus"])) ? ($_POST["maritalStatus"] == "Divorced") ? "selected" : "" : "" ?>>Divorced</option>
                                                <option value="Widowed" <?= (isset($_POST["maritalStatus"])) ? ($_POST["maritalStatus"] == "Widowed") ? "selected" : "" : "" ?>>Widowed</option>
                                            </select>
                                            <div class="form-icon">
                                                <i data-feather="hash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Total Children</label>
                                        <div class="control has-icon">
                                            <input type="number" name="children" class="input is-fade" value="<?= (isset($_POST["children"])) ? $_POST["children"] : '0' ?>" required>
                                            <div class="form-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Looking For</label>
                                        <div class="control has-icon">
                                            <select name="lookingFor" class="input is-fade" required>
                                                <option value=""></option>
                                                <option value="Male" <?= (isset($_POST["lookingFor"])) ? ($_POST["lookingFor"] == "Male") ? "selected" : "" : "" ?>>Male</option>
                                                <option value="Female" <?= (isset($_POST["lookingFor"])) ? ($_POST["lookingFor"] == "Female") ? "selected" : "" : "" ?>>Female</option>
                                            </select>
                                            <div class="form-icon">
                                                <i data-feather="smile"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Date of Birth</label>
                                        <div class="control has-icon">
                                            <input type="date" name="dateOfBirth" class="input is-fade removeIcon" value="<?= (isset($_POST["dateOfBirth"])) ? $_POST["dateOfBirth"] : '' ?>" required>
                                            <div class="form-icon">
                                                <i data-feather="calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>Work / Study</label>
                                        <div class="control has-icon">
                                            <select name="job" class="input is-fade" required>
                                                <option value=""></option>
                                                <?php
                                                foreach ($db->getJobs() as $job){
                                                    if(isset($_POST["job"]) && $_POST["job"] == $job){
                                                        echo '<option value="'.$job.'" selected>'.$job.'</option>';
                                                    }else{
                                                        echo '<option value="'.$job.'">'.$job.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="form-icon">
                                                <i data-feather="briefcase"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>About Me</label>
                                        <div class="control">
                                            <textarea type="text" class="textarea is-fade" name="aboutMe" rows="3" maxlength="200" placeholder="Tell us about yourself in 200 characters..." required><?= (isset($_POST["aboutMe"])) ? $_POST["aboutMe"] : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <div class="form-text sectionTitle">
                                        Your Address
                                    </div>
                                </div>

                                <div class="column is-4">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>City</label>
                                        <div class="control has-icon">
                                            <input type="text" class="input is-fade" name="city" placeholder="City name" value="<?= (isset($_POST["city"])) ? $_POST["city"] : '' ?>" required>
                                            <div class="form-icon">
                                                <i data-feather="map-pin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-4">
                                    <!--Field-->
                                    <div class="field field-group">
                                        <label>State</label>
                                        <div class="control has-icon">
                                            <input type="text" class="input is-fade" name="state" maxlength="2" placeholder="Two-Letter Abbreviation" value="<?= (isset($_POST["state"])) ? $_POST["state"] : '' ?>" required>
                                            <div class="form-icon">
                                                <i data-feather="navigation"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-4">
                                    <!--Field-->
                                    <div class="field field-group is-autocomplete">
                                        <label>Country</label>
                                        <div class="control has-icon">
                                            <input id="country-autocpl" type="text" name="country" class="input is-fade" placeholder="Country name" value="<?= (isset($_POST["country"])) ? $_POST["country"] : '' ?>" required>
                                            <div class="form-icon">
                                                <i data-feather="globe"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <div class="form-text sectionTitle">
                                        Your Interests (Select up to 5)
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <!--Field-->
                                    <h3 class="errorText"><?= $error["hobby"]; ?></h3>
                                    <div class="field field-group is-autocomplete">
                                        <label>Your Hobbies</label>
                                        <div class="control has-icon">
                                            <select name="hobbies[]" class="input is-fade interestsSelect hobbySelector" style="height: 200px;" multiple="multiple" required="required">
                                                <?php
                                                    $counter = 1;
                                                    foreach ($db->getHobbies() as $hobby){
                                                        if(isset($_POST["hobbies"]) && $error["hobby"] == "" && in_array($hobby, $_POST["hobbies"])){
                                                            echo '<option value="'.$hobby.'" selected>'.$counter.'. '.$hobby.'</option>';
                                                        }else{
                                                            echo '<option value="'.$hobby.'">'.$counter.'. '.$hobby.'</option>';
                                                        }
                                                        $counter++;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <!--Field-->
                                    <h3 class="errorText"><?= $error["cuisine"]; ?></h3>
                                    <div class="field field-group is-autocomplete">
                                        <label>Your Cuisine Preferences</label>
                                        <div class="control has-icon">
                                            <select name="cuisines[]" class="input is-fade interestsSelect cuisineSelector" style="height: 200px;" multiple="multiple" required="required">
                                                <?php
                                                $counter = 1;
                                                foreach ($db->getCuisines() as $cuisine){
                                                    if(isset($_POST["cuisines"]) && $error["cuisine"] == "" && in_array($cuisine, $_POST["cuisines"])) {
                                                        echo '<option value="' . $cuisine . '" selected>' . $counter . '. ' . $cuisine . '</option>';
                                                    }else{
                                                        echo '<option value="' . $cuisine . '">' . $counter . '. ' . $cuisine . '</option>';
                                                    }
                                                    $counter++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12">
                                    <!--Field-->
                                    <h3 class="errorText"><?= $error["language"]; ?></h3>
                                    <div class="field field-group is-autocomplete">
                                        <label>Your Known Languages</label>
                                        <div class="control has-icon">
                                            <select name="languages[]" class="input is-fade interestsSelect languageSelector" style="height: 200px;" multiple="multiple" required="required">
                                                <?php
                                                $counter = 1;
                                                foreach ($db->getLanguages() as $language){
                                                    if(isset($_POST["languages"]) && $error["language"] == "" && in_array($language, $_POST["languages"])) {
                                                        echo '<option value="' . $language . '" selected>' . $counter . '. ' . $language . '</option>';
                                                    }else{
                                                        echo '<option value="' . $language . '">' . $counter . '. ' . $language . '</option>';
                                                    }
                                                    $counter++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="column is-12">
                                    <div class="buttons">
                                        <button type="submit" name="saveProfile" class="button is-solid accent-button form-button">Save Changes</button>
                                        <button type="reset" class="button is-light form-button">Reset</button>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Edit Credit card Modal-->
    <div id="crop-modal" class="modal is-small crop-modal is-animated">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="modal-card">
                <header class="modal-card-head">
                    <h3>Crop your picture</h3>
                    <div class="close-wrap">
                        <button class="close-modal" aria-label="close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                </header>
                <div class="modal-card-body">
                    <div id="cropper-wrapper" class="cropper-wrapper">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once("UI/scripts.php"); ?>
<script>
    $("#profilePhoto").change(function (){
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photoPreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
</html>
