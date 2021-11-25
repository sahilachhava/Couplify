<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./head.php"); ?>
</head>
<body>
<?php include_once("./preloader.php"); ?>
<?php include_once("./navigation.php"); ?>

<!-- Body design starts here   -->
<div class="view-wrapper">
    <div id="profile-about" class="navbar-v2-wrapper">
        <div class="container is-custom">
            <div class="view-wrap is-headless">

                <div class="columns is-multiline no-margin">
                    <div class="column is-paddingless">
                        <div class="avatar">
                            <img style="border-radius: 50%;margin-left: 420px;height: 200px; width: 200px;" id="user-avatar" class="avatar-image" src="assets/profilePhotos/1.jpg" alt="">
                        </div>

                        <div class="profile-subheader">
                            <div class="subheader-start is-hidden-mobile">
                                <span></span>
                                <span></span>
                            </div>
                            <div class="subheader-middle" style="margin-left: -100px;">
                                <h2>Bulma Brief</h2>
                                <span>Female</span>
                            </div>
                            <div class="subheader-end is-hidden-mobile">
                                <a class="button has-icon is-bold">
                                    <i data-feather="star"></i>
                                    <span>Add to Favourites</span>
                                </a>
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
                                                <span>I am working as <a>Doctor</a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/location.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>Lives in <a>Toronto, ON</a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/love.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>I am <a>Single</a></span>
                                            </div>
                                        </div>

                                        <div class="flex-block">
                                            <img src="assets/img/custom/search.png" alt="">
                                            <div class="flex-block-meta">
                                                <span>Looking for <a>Male</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column">
                                        <div class="about-summary">
                                            <div class="content">
                                                <h3>About Me</h3>
                                                <p>A biography, or simply bio, is a detailed description of a person's life. It involves more than just the basic facts like education, work, relationships, and death; it portrays a person's experience of these life events.</p>
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
                                            <div class="photo-wrapper" style="width: 250px;height: 200px;cursor: pointer;">
                                                <div class="photo-overlay"></div>
                                                <img src="assets/img/demo/groups/1.jpg" alt="" style="width: 250px;height: 200px;cursor: pointer;">
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
<?php include_once("./scripts.php"); ?>
</html>