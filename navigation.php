<div class="navbar-v2">

    <div class="top-nav">
        <div class="left">
            <div class="brand">
                <a href="index.php" class="navbar-logo">
                    <img class="logo light-image" src="assets/img/logo/friendkit-bold.svg" width="112" height="28" alt="">
                    <img class="logo dark-image" src="assets/img/logo/friendkit-white.svg" width="112" height="28" alt="">
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
            <div id="open-mobile-search" class="navbar-item is-icon">
                <a class="icon-link is-primary" href="javascript:void(0);">
                    <i data-feather="search"></i>
                </a>
            </div>

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
                            <!-- Notification -->
                            <div class="media">
                                <figure class="media-left">
                                    <p class="image">
                                        <img src="../via.placeholder.com/300x300.png" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <span><a href="#">David Kim</a> commented on <a href="#">your post</a>.</span>
                                    <span class="time">30 minutes ago</span>
                                </div>
                                <div class="media-right">
                                    <div class="added-icon">
                                        <i data-feather="message-square"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Notification -->
                            <div class="media">
                                <figure class="media-left">
                                    <p class="image">
                                        <img src="../via.placeholder.com/300x300.png" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <span><a href="#">Daniel Wellington</a> liked your <a href="#">profile.</a></span>
                                    <span class="time">43 minutes ago</span>
                                </div>
                                <div class="media-right">
                                    <div class="added-icon">
                                        <i data-feather="heart"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Notification -->
                            <div class="media">
                                <figure class="media-left">
                                    <p class="image">
                                        <img src="../via.placeholder.com/300x300.png" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <span><a href="#">Stella Bergmann</a> shared a <a href="#">New video</a> on your wall.</span>
                                    <span class="time">Yesterday</span>
                                </div>
                                <div class="media-right">
                                    <div class="added-icon">
                                        <i data-feather="youtube"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Notification -->
                            <div class="media">
                                <figure class="media-left">
                                    <p class="image">
                                        <img src="../via.placeholder.com/300x300.png" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <span><a href="#">Elise Walker</a> shared an <a href="#">Image</a> with you an 2 other people.</span>
                                    <span class="time">2 days ago</span>
                                </div>
                                <div class="media-right">
                                    <div class="added-icon">
                                        <i data-feather="image"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav-drop-footer">
                            <a href="#">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="account-dropdown" class="navbar-item is-account drop-trigger has-caret">
                <div class="user-image">
                    <img src="../via.placeholder.com/400x400.png" data-demo-src="assets/img/avatars/jenna.png" alt="">
                    <span class="indicator"></span>
                </div>

                <div class="nav-drop is-account-dropdown">
                    <div class="inner">

                        <div class="nav-drop-header">
                            <span class="username">Jenna Davis</span>
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
                            <a id="profile-link" href="profile-main.html" class="account-item">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="image">
                                            <img src="../via.placeholder.com/400x400.png" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                        </div>
                                    </div>
                                    <div class="media-content">
                                        <h3>Jenna Davis</h3>
                                        <small>Manage Profile</small>
                                    </div>
                                    <div class="media-right">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                            </a>
                            <hr class="account-divider">
                            <a href="options-settings.html" class="account-item">
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
                            <a class="account-item">
                                <div class="media">
                                    <div class="icon-wrap">
                                        <i data-feather="life-buoy"></i>
                                    </div>
                                    <div class="media-content">
                                        <h3>Help</h3>
                                        <small>Contact our support.</small>
                                    </div>
                                </div>
                            </a>
                            <a class="account-item">
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

    <div class="sub-nav">
        <div class="sub-nav-tabs">
            <div class="tabs is-centered">
                <ul>
                    <li class="is-active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="navbar-v2-profile-friends.html">Members</a>
                    </li>
                    <li>
                        <a href="navbar-v2-groups.html">Messages</a>
                    </li>
                    <li>
                        <a href="navbar-v2-ecommerce-products.html">Forums</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>