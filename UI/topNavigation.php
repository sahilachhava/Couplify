<div class="top-nav">
    <div class="left">
        <div class="brand">
            <a href="index.php" class="navbar-logo">
                <img class="logo light-image" src="assets/img/logo.png" width="112" height="28" alt="">
                <img class="logo dark-image" src="assets/img/logo.png" width="112" height="28" alt="">
            </a>
        </div>
        <div class="search">
            <div class="navbar-item">
                <div id="global-search" class="control">
                    <input id="tipue_drop_input" class="input is-rounded" type="text" placeholder="Search" required>
                    <span id="clear-search" class="reset-search">
                                    <i data-feather="x"></i>
                                </span>
                    <span class="search-icon">
                                    <i data-feather="search"></i>
                                </span>

                    <div id="tipue_drop_content" class="tipue-drop-content"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="right">
        <div id="open-mobile-search" class="navbar-item is-icon is-hidden-desktop">
            <a class="icon-link is-primary" href="javascript:void(0);">
                <i data-feather="search"></i>
            </a>
        </div>

        <?php
        if(isset($_SESSION["userID"])){
            ?>
            <div class="navbar-item is-icon drop-trigger">
                <a class="icon-link" href="javascript:void(0);">
                    <i data-feather="bell"></i>
                    <span class="indicator"></span>
                </a>

                <div class="nav-drop is-right">
                    <div class="inner">
                        <div class="nav-drop-header">
                            <span>Notifications</span>
                            <a href="#">
                                <i data-feather="bell"></i>
                            </a>
                        </div>
                        <div class="nav-drop-body is-notifications">

                            <?php
                            $allNotifications = $db->getNotifications($currentUser->getUserID());
                            foreach($allNotifications as $notification){
                                $user = $db->getUserDetails($notification["userID"]);
                                echo $utility->notificationDesignCode($notification, $user, $currentUser);
                            }

                            if(count($allNotifications) < 1){
                                echo '<div class="media"><div class="media-content"><span><h3 style="text-align: center">No new notifications</h3></span></div></div>';
                            }

                            if(isset($_GET["deleteNotifications"])){
                                $db->deleteNotifications($currentUser->getUserID());
                            }
                            ?>

                        </div>
                        <div class="nav-drop-footer">
                            <a href="<?= basename($_SERVER['PHP_SELF'])."?deleteNotifications" ?>">Delete all</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div id="account-dropdown" class="navbar-item is-account drop-trigger has-caret">
            <div class="user-image">
                <?php
                if(isset($_SESSION["userID"])){
                    echo '<img src='.$currentUser->getUserPhoto().' alt="">';
                }else{
                    echo '<img src="assets/profilePhotos/default.jpg" alt="">';
                }
                ?>
                <span class="indicator"></span>
            </div>

            <div class="nav-drop is-account-dropdown">
                <div class="inner">

                    <div class="nav-drop-header">
                        <?php
                        if(isset($_SESSION["userID"])){
                            echo '<span class="username">'.$currentUser->getUserFullName().'</span>';
                        }else{
                            echo '<span class="username">Guest User</span>';
                        }
                        ?>
                        <label class="theme-toggle">
                            <input type="checkbox">
                            <span class="toggler">
                                            <span class="dark">
                                                <i data-feather="moon"></i>
                                            </span>
                                    <span class="light">
                                                <i data-feather="sun"></i>
                                            </span>
                                    </span>
                        </label>
                    </div>

                    <div class="nav-drop-body account-items">
                        <?php
                        if(isset($_SESSION["userID"])){
                            ?>
                            <a id="profile-link" href="myProfile.php" class="account-item">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="image">
                                            <img src="<?= $currentUser->getUserPhoto() ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="media-content">
                                        <h3><?= $currentUser->getUserFullName() ?></h3>
                                        <small>Manage Profile</small>
                                    </div>
                                    <div class="media-right">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }else{
                            ?>
                            <a id="profile-link" class="account-item">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="image">
                                            <img src="assets/profilePhotos/default.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="media-content">
                                        <h3>Guest</h3>
                                    </div>
                                    <div class="media-right">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                        <hr class="account-divider">
                        <?php
                        if(isset($_SESSION["userID"])){
                            ?>
                            <a href="settings.php" class="account-item">
                                <div class="media">
                                    <div class="icon-wrap">
                                        <i data-feather="settings"></i>
                                    </div>
                                    <div class="media-content">
                                        <h3>Settings</h3>
                                        <small>Manage your account</small>
                                    </div>
                                </div>
                            </a>
                            <?php
                            if(!$currentUser->isPremium()){
                                ?>
                                <a href="upgrade.php" class="account-item">
                                    <div class="media">
                                        <div class="icon-wrap">
                                            <i data-feather="key"></i>
                                        </div>
                                        <div class="media-content">
                                            <h3>Unlock Premium</h3>
                                            <small>Upgrade your account</small>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                            ?>

                            <a href="logout.php" class="account-item">
                                <div class="media">
                                    <div class="icon-wrap">
                                        <i data-feather="power"></i>
                                    </div>
                                    <div class="media-content">
                                        <h3>Log out</h3>
                                        <small>Log out from your account.</small>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="login.php" class="account-item">
                                <div class="media">
                                    <div class="icon-wrap">
                                        <i data-feather="log-in"></i>
                                    </div>
                                    <div class="media-content">
                                        <h3>Log In</h3>
                                        <small>Log In to your account.</small>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Search-->
    <div class="mobile-search is-hidden">
        <div class="control">
            <input id="tipue_drop_input_mobile" class="input" placeholder="Search...">
            <div class="form-icon">
                <i data-feather="search"></i>
            </div>
            <div class="close-icon">
                <i data-feather="x"></i>
            </div>
            <div id="tipue_drop_content_mobile" class="tipue-drop-content"></div>
        </div>
    </div>
</div>