<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $currentUser = null;
    $notificationSettings = null;

    if(isset($_SESSION["userID"])){
        $utility->setCurrentUser($db);
        $currentUser = unserialize($_SESSION["currentUser"]);
        $notificationSettings = $db->getNotificationSettings($currentUser->getUserID());
    }else{
        header("Location: login.php");
    }

    $errorPassword = "";
    if(isset($_POST["saveNewPassword"])){
        $currentPassword = $_POST["currentPassword"];
        $newPassword = $_POST["newPassword"];
        $repeatedPassword = $_POST["repeatedPassword"];

        if($newPassword != $repeatedPassword){
            $errorPassword = "password not matched";
        }else if($db->validateLogin($currentUser->getUserEmail(), $currentPassword) == -1){
            $errorPassword = "Invalid current password";
        }else{
            if($db->changePassword($currentUser->getUserID(), $newPassword)){
                $errorPassword = "New password changed successfully";
            }else{
                $errorPassword = "Something went wrong, Please try again later.";
            }
        }
    }

    $errorNotifications = "";
    if(isset($_POST["saveNotificationSettings"])){
        $updatedNotificationSettings = [];

        if(isset($_POST["allNotifications"])){
            $updatedNotificationSettings[0] = 1;
        }else{
            $updatedNotificationSettings[0] = 0;
        }
        if(isset($_POST["addFavourite"])){
            $updatedNotificationSettings[1] = 1;
        }else{
            $updatedNotificationSettings[1] = 0;
        }
        if(isset($_POST["removeFavourite"])){
            $updatedNotificationSettings[2] = 1;
        }else{
            $updatedNotificationSettings[2] = 0;
        }
        if(isset($_POST["newMessages"])){
            $updatedNotificationSettings[3] = 1;
        }else{
            $updatedNotificationSettings[3] = 0;
        }
        if(isset($_POST["newWinks"])){
            $updatedNotificationSettings[4] = 1;
        }else{
            $updatedNotificationSettings[4] = 0;
        }
        $updatedNotificationSettings[5] = $currentUser->getUserID();
        if($db->updateNotificationSettings($updatedNotificationSettings)){
            $notificationSettings = $db->getNotificationSettings($currentUser->getUserID());
            $errorNotifications = "Notification Settings Saved Successfully";
        }else{
            $errorNotifications = "Something went wrong, Please try again later.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
    <style>
        .errorMessage {
            margin-left: 2%;
            font-variant: all-petite-caps;
            font-size: 22px;
        }
    </style>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>
<div class="navbar-v2">
    <?php include_once("UI/topNavigation.php"); ?>
</div>
<!-- Body design starts here   -->
<div class="view-wrapper is-full">
    <!--  Sidebar  -->
    <div class="settings-sidebar is-active">
        <div class="settings-sidebar-inner">

            <div class="user-block" style="margin-top: 25%;">
                <a class="close-settings-sidebar is-hidden">
                    <i data-feather="x"></i>
                </a>
                <div class="avatar-wrap">
                    <img src="<?= $currentUser->getUserPhoto(); ?>" alt="">
                    <div class="badge">
                        <i data-feather="check"></i>
                    </div>
                </div>
                <h4><?= $currentUser->getUserFullName(); ?></h4>
                <p>Settings</p>
            </div>

            <div class="user-menu">
                <div class="user-menu-inner has-slimscroll">
                    <div class="menu-block">
                        <ul>
                            <li data-section="security" class="is-active">
                                <a>
                                    <i data-feather="lock"></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
                            <li data-section="notifications">
                                <a>
                                    <i data-feather="bell"></i>
                                    <span>Notifications</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="separator"></div>
                    <div class="menu-block">
                        <ul>
                            <li>
                                <a href="index.php">
                                    <i data-feather="arrow-left"></i>
                                    <span>Back to home</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="settings-wrapper">

        <div id="security-settings" class="settings-section is-active">
            <div class="settings-panel">

                <div class="title-wrap">
                    <a class="mobile-sidebar-trigger">
                        <i data-feather="menu"></i>
                    </a>
                    <h2>Change password</h2>
                </div>

                <div class="settings-form-wrapper">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="settings-form">
                        <div class="columns is-multiline">

                            <div class="column is-12">
                                <!--Field-->
                                <div class="field field-group">
                                    <label>Current Password</label>
                                    <div class="control has-icon">
                                        <input type="password" class="input is-fade" name="currentPassword">
                                        <div class="form-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6">
                                <!--Field-->
                                <div class="field field-group">
                                    <label>New Password</label>
                                    <div class="control has-icon">
                                        <input type="password" class="input is-fade" name="newPassword">
                                        <div class="form-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6">
                                <!--Field-->
                                <div class="field field-group">
                                    <label>Repeat Password</label>
                                    <div class="control has-icon">
                                        <input type="password" class="input is-fade" name="repeatedPassword">
                                        <div class="form-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="errorMessage" style="color: red;"><?= $errorPassword ?></h2>

                            <div class="column is-12">
                                <div class="buttons">
                                    <button type="submit" name="saveNewPassword" class="button is-solid accent-button form-button">Save Changes</button>
                                    <button type="reset" class="button is-light form-button">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <div class="illustration">
                        <img src="assets/img/illustrations/settings/2.svg" alt="">
                        <p>If you'd like to change your current password, you can do that from here.</p>
                    </div>
                </div>

            </div>
        </div>

        <div id="notifications-settings" class="settings-section">
            <div class="settings-panel">

                <div class="title-wrap">
                    <a class="mobile-sidebar-trigger">
                        <i data-feather="menu"></i>
                    </a>
                    <h2>Notifications</h2>
                </div>

                <div class="settings-form-wrapper">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="settings-form">
                        <div class="columns is-multiline">
                            <div class="column is-12">

                                <div class="sub-heading">
                                    <h3>General notifications</h3>
                                </div>

                                <!--Field-->
                                <div class="field spaced-field">
                                    <div class="switch-block">
                                        <label class="f-switch">
                                            <input type="checkbox" class="is-switch" name="allNotifications" <?php echo (count($notificationSettings) > 0) ? (($notificationSettings["allNotification"] == 1) ? 'checked' : '') : '' ?>>
                                            <i></i>
                                        </label>
                                        <div class="meta">
                                            <h4>Notifications</h4>
                                            <p>Enable to activate notifications.</p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if($currentUser->isPremium()){
                                ?>
                                <div class="sub-heading">
                                    <h3>Social notifications</h3>
                                </div>
                                <!--Field-->
                                <div class="field spaced-field">
                                    <div class="switch-block">
                                        <label class="f-switch is-accent">
                                            <input type="checkbox" class="is-switch" name="addFavourite" <?php echo (count($notificationSettings) > 0) ? (($notificationSettings["addFavourite"] == 1) ? 'checked' : '') : '' ?>>
                                            <i></i>
                                        </label>
                                        <div class="meta">
                                            <h4>Add to Favourites</h4>
                                            <p>Enable to receive notifications if someone adds you to favourites.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--Field-->
                                <div class="field">
                                    <div class="switch-block">
                                        <label class="f-switch is-accent">
                                            <input type="checkbox" class="is-switch" name="removeFavourite" <?php echo (count($notificationSettings) > 0) ? (($notificationSettings["removeFavourite"] == 1) ? 'checked' : '') : '' ?>>
                                            <i></i>
                                        </label>
                                        <div class="meta">
                                            <h4>Remove from Favourites</h4>
                                            <p>Enable to receive notifications if someone removes you from favourites.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>

                                <div class="sub-heading">
                                    <h3>Chat notifications</h3>
                                </div>
                                <!--Field-->
                                <div class="field spaced-field">
                                    <div class="switch-block">
                                        <label class="f-switch is-accent">
                                            <input type="checkbox" class="is-switch" name="newMessages" <?php echo (count($notificationSettings) > 0) ? (($notificationSettings["messages"] == 1) ? 'checked' : '') : '' ?>>
                                            <i></i>
                                        </label>
                                        <div class="meta">
                                            <h4>New Messages</h4>
                                            <p>Enable to receive new messages notifications.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--Field-->
                                <div class="field">
                                    <div class="switch-block">
                                        <label class="f-switch is-accent">
                                            <input type="checkbox" class="is-switch" name="newWinks" <?php echo (count($notificationSettings) > 0) ? (($notificationSettings["winks"] == 1) ? 'checked' : '') : '' ?>>
                                            <i></i>
                                        </label>
                                        <div class="meta">
                                            <h4>New Winks</h4>
                                            <p>Enable to receive new winks notifications.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="errorMessage" style="color: red;"><?= $errorNotifications ?></h2>

                            <div class="column is-12">
                                <div class="buttons">
                                    <button type="submit" name="saveNotificationSettings" class="button is-solid accent-button form-button">Save Changes</button>
                                </div>
                            </div>

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