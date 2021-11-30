<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $currentUser = null;

    if(isset($_SESSION["userID"])){
        $utility->setCurrentUser($db);
        $currentUser = unserialize($_SESSION["currentUser"]);
    }else{
        header("Location: login.php");
    }

    $userDetails = [];
    $allMessages = [];
    if(isset($_GET["userID"])){
        if($db->isUserExists($_GET["userID"])){
            $userDetails = $db->getUserDetails($_GET["userID"]);
            $allMessages = $db->getMessages($currentUser->getUserID(), $userDetails["userID"]);

            //Set Read Ticks
            $db->readMessages($currentUser->getUserID(), $userDetails["userID"]);
        }else{
            header("Location: error404.php");
        }
    }else{
        header("Location: error404.php");
    }

    $error = "";
    if(isset($_POST["sendMessage"])){
        if($_POST["messageText"] != ""){
            $db->sendMessage($currentUser->getUserID(), $userDetails["userID"], $_POST["messageText"]);
            $allMessages = $db->getMessages($currentUser->getUserID(), $userDetails["userID"]);
        }else{
            $error = "Please enter message first!";
        }
    }

    if(isset($_POST["sendWink"])){
        $db->sendMessage($currentUser->getUserID(), $userDetails["userID"], "wink");
        $allMessages = $db->getMessages($currentUser->getUserID(), $userDetails["userID"]);
    }
    if(isset($_POST["deleteAll"])){
        $db->deleteMessages($currentUser->getUserID(), $userDetails["userID"]);
        $allMessages = $db->getMessages($currentUser->getUserID(), $userDetails["userID"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
    <style>
        .errorMsg {
            color: red;
            font-weight: bold;
            font-size: 20px;
            font-variant: all-petite-caps;
            margin-top: -15%;
        }
    </style>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>
<?php include_once("UI/navigation.php"); ?>
<!-- Body design starts here   -->

<div class="chat-wrapper is-standalone">
    <div class="chat-inner">

        <div class="chat-nav">
            <div class="nav-start">
                <div class="recipient-block">
                    <div class="avatar-container">
                        <img class="user-avatar" src="<?= $userDetails["profilePhoto"]; ?>" alt="">
                    </div>
                    <div class="username">
                        <a href="profile.php?userID=<?= $userDetails["userID"] ?>"><span><?= $userDetails["lastName"]." ". $userDetails["firstName"]; ?></span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat sidebar -->
        <div id="chat-sidebar" class="users-sidebar">
            <a href="index.php" class="header-item">
                <img src="assets/img/logo.png" alt="">
            </a>
            <div class="footer-item">
                <a href="message.php?userID=<?= $userDetails["userID"] ?>">
                    <div class="add-button">
                        <i data-feather="refresh-cw"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Chat body -->
        <div id="chat-body" class="chat-body is-opened">
            <div class="chat-body-inner has-slimscroll">
                <?php
                    if(count($allMessages) < 1){
                ?>
                    <div class="page-placeholder">
                        <div class="placeholder-content">
                            <img class="light-image" src="assets/img/1.svg" alt="" />
                            <img class="dark-image" src="assets/img/1.svg" alt="" />
                            <h3>You don't have any messages yet.</h3>
                            <p class="is-large">Start conversation with <?= $userDetails["lastName"]." ". $userDetails["firstName"]; ?> now.</p>
                        </div>
                    </div>
                <?php
                    }
                ?>

                <?php
                    $divIDCount = 1;
                    foreach ($allMessages as $message){
                        $messageTime = date_format(date_create($message["timeStamp"]),"d-m-Y H:i");
                        if($message["senderID"] == $userDetails["userID"]){
                            echo $utility->createMessageDesignCode($userDetails["profilePhoto"], $messageTime, $message["message"], "received", $divIDCount,$message["isRead"] );
                        }else{
                            echo $utility->createMessageDesignCode($currentUser->getUserPhoto(), $messageTime, $message["message"], "sent", $divIDCount, $message["isRead"]);
                        }
                        $divIDCount++;
                    }
                ?>
            </div>

            <!-- Compose message area -->
            <div class="chat-action">
                <div class="chat-action-inner">
                    <div class="control">
                        <form action="message.php?userID=<?= $userDetails['userID'] ?>" method="post">
                            <textarea style="resize: none;" class="textarea comment-textarea" id="messageText" name="messageText" rows="1" placeholder="type a message..."></textarea>
                            <div class="dropdown compose-dropdown is-spaced is-accent is-up dropdown-trigger">
                                <div>
                                    <div class="add-button">
                                        <div class="button-inner">
                                            <i data-feather="type"></i>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="errorMsg"><?= $error ?></h3>
                            </div>
                            <div style="margin-left: 95%;" class="dropdown compose-dropdown is-spaced is-accent is-up dropdown-trigger">
                                <div>
                                    <div class="add-button submit-btn is-hidden-mobile">
                                        <button type="submit" name="sendMessage" class="button-inner">
                                            <i data-feather="send"></i>
                                        </button>
                                    </div>
                                    <div class="add-button submit-btn is-hidden-desktop" style="margin-left: -60%;">
                                        <button type="submit" name="sendMessage" class="button-inner">
                                            <i data-feather="send"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="chat-panel" class="chat-panel is-opened">
            <div class="panel-inner">
                <div class="panel-header">
                    <h3>Details</h3>
                    <a class="panel-close is-hidden-desktop">
                        <i data-feather="x"></i>
                    </a>
                </div>

                <div class="panel-body is-user-details">
                    <div class="panel-body-inner">

                        <div class="subheader">
                            <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                <div>
                                    <div class="action-icon">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <form method="post" action="message.php?userID=<?= $userDetails['userID']; ?>" hidden>
                                            <button type="submit" name="sendWink" id="sendWink" hidden></button>
                                        </form>
                                        <a onclick="document.getElementById('sendWink').click();" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="eye"></i>
                                                <div class="media-content">
                                                    <h3>Send wink</h3>
                                                    <small>Send wink to user.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a href="profile.php?userID=<?= $userDetails["userID"]; ?>" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="user"></i>
                                                <div class="media-content">
                                                    <h3>View profile</h3>
                                                    <small>View this user's profile.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <form method="post" action="message.php?userID=<?= $userDetails['userID']; ?>" hidden>
                                            <button type="submit" name="deleteAll" id="deleteAll" hidden></button>
                                        </form>
                                        <a onclick="document.getElementById('deleteAll').click();" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="trash-2"></i>
                                                <div class="media-content">
                                                    <h3>Delete</h3>
                                                    <small>Delete this conversation.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details-avatar">
                            <img src="<?= $userDetails["profilePhoto"] ?>" alt="">
                            <div class="call-me" style="background-color: black;">
                                <i class="mdi mdi-emoticon-wink"></i>
                            </div>
                        </div>

                        <div class="user-meta has-text-centered">
                            <h3><?= $userDetails["lastName"]." ". $userDetails["firstName"]; ?></h3>
                            <h4>Looking for <?= $userDetails["lookingFor"]; ?></h4>
                        </div>
                        <div class="user-about">
                            <label>About Me</label>
                            <div class="about-block">
                                <i class="mdi mdi-bio"></i>
                                <div class="about-text">
                                    <span>About me</span>
                                    <span><a class="is-inverted" href="#"><?= $userDetails["aboutMe"]; ?></a></span>
                                </div>
                            </div>
                            <div class="about-block">
                                <i class="mdi mdi-account-heart"></i>
                                <div class="about-text">
                                    <span>Marital Status</span>
                                    <span><a class="is-inverted" href="#"><?= $userDetails["maritalStatus"]; ?></a></span>
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