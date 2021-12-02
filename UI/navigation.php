<div class="navbar-v2">

    <?php include_once("topNavigation.php"); ?>

    <div class="sub-nav">
        <div class="sub-nav-tabs">
            <div class="tabs is-centered">
                <ul>
                    <li class="is-active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="members.php">Members</a>
                    </li>
                    <?php
                        if(isset($_SESSION["userID"])){
                            echo '<li>
                                    <a href="myChats.php">Messages</a>
                                  </li>';
                            if($currentUser->isPremium()) {
                                echo '<li>
                                    <a href="favourites.php">My Favourites</a>
                                  </li>';
                            }
                            echo '<li>
                                    <a href="myProfile.php">My Profile</a>
                                  </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>