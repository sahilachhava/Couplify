<?php

class Utility
{
    public function setCurrentUser($db){
        $userDetails = $db->getUserDetails($_SESSION["userID"]);
        $additionalDetails = $db->getAdditionalDetails($_SESSION["userID"]);
        $userAddress = $db->getUserAddress($_SESSION["userID"]);
        $favouritedUsers = $db->getMyFavourites($_SESSION["userID"]);
        $premiumInfo = $db->getPremiumDetails($_SESSION["userID"]);
        $_SESSION["currentUser"] = serialize(new User($userDetails, $userAddress, $additionalDetails, $favouritedUsers, $premiumInfo));
    }

    public function getRandomIndex($totalIndex, $maxLength): array
    {
        $allIndex = [];
        for($index = 0; $index < $totalIndex; $index++){
            $newIndex = rand(0, $maxLength - 1);
            if(!in_array($newIndex, $allIndex)){
                array_push($allIndex, $newIndex);
            }else{
                $index--;
            }
        }
        return $allIndex;
    }

    public function createFilteredDesignCode($filterType, $filterBy, $filteredUsers): string
    {
        $filterDesign = "";

        if($filterType == "cuisine" || $filterType == "hobby"){
            $filterDesign = '<div class="groups-grid"><div class="grid-header"><div class="header-inner">'.
                '<h2>Likes '.$filterBy.'</h2>'.
                '</div></div><div class="columns is-multiline">';
        }else if($filterType == "language"){
            $filterDesign = '<div class="groups-grid"><div class="grid-header"><div class="header-inner">'.
                '<h2>Speaks '.$filterBy.'</h2>'.
                '</div></div><div class="columns is-multiline">';
        }

        foreach($filteredUsers as $user) {
            if($user["userID"] != ((isset($_SESSION["userID"]))? $_SESSION["userID"] : "")) {
                $filterDesign .= '<div class="column is-3">';
                $filterDesign .= '<article class="group-box">';
                $filterDesign .= '<div class="box-img has-background-image" data-demo-background="' . $user["profilePhoto"] . '"></div>';
                $filterDesign .= '<a href = "profile.php?userID=' . $user["userID"] . '" class="box-link" >';
                $filterDesign .= '<div class="box-img--hover has-background-image" data-demo-background="' . $user["profilePhoto"] . '" ></div>';
                $filterDesign .= '<div class="box-info" >';
                $filterDesign .= '<h3 class="box-title">' . $user["lastName"] . ' ' . $user["firstName"] . '</h3>';
                $filterDesign .= '<span class="box-category">Looking for ' . $user["lookingFor"] . '</span>';
                $filterDesign .= '</div></a></article></div>';
            }
        }
        $filterDesign .= '</div></div>';

        return $filterDesign;
    }

    public function addUsersToDataFileForSearch($allUsers){
        $fileData = 'var tipuedrop = {';
        $fileData .= '"pages": [';

        foreach ($allUsers as $user){
            if($user["userID"] != ((isset($_SESSION["userID"]))? $_SESSION["userID"] : "")) {
                $fileData .= '{
                "title": "' . $user["lastName"] . ' ' . $user["firstName"] . '",
                "thumb": "' . $user["profilePhoto"] . '",
                "text": "<small>Looking for ' . $user["lookingFor"] . '</small>",
                "url": "profile.php?userID=' . $user["userID"] . '"},';
            }
        }

        $fileData = rtrim($fileData, ", ");
        $fileData .= ']};';

        $dataFile = fopen("assets/data/tipuedrop_content.js", "w") or die("Unable to open file!");
        fwrite($dataFile, $fileData);
        fclose($dataFile);
    }

    public function createMessageDesignCode($profilePhoto, $time, $msg, $type, $divIDCount, $isRead, $isPremium): string
    {
        if($type == "received"){
            $messageDeign = '<div class="chat-message is-received">';
        }else{
            $messageDeign = '<div class="chat-message is-sent">';
        }
        $messageDeign .= '<img src="'.$profilePhoto.'">';
        $messageDeign .= '<div class="message-block">';
        $messageDeign .= '<span>'.$time.'</span>';

        if($msg != "wink"){
            $messageDeign .= '<div class="message-text">'.$msg.'</div>';
        }else{
            $messageDeign .= '<div class="message-text" id="'.$divIDCount.'">';
            echo '<script type="text/javascript"> 
                    var image = new Image();
                    image.src = "assets/img/custom/wink.gif";
                    image.onload = function() {
                        document.getElementById("'.$divIDCount.'").appendChild(image.cloneNode(true));
                    } 
                  </script>';
            $messageDeign .= '</div>';
        }

        if($isRead && $type == "sent" && $isPremium){
            $messageDeign .= '<span class="readReceipts"><i style="width: 15px; height: 15px;" data-feather="check-circle"></i></span>';
        }

        $messageDeign .= '</div></div>';
        return $messageDeign;
    }

    public function myChatDesignCode($user): string
    {
        $chatDesign = '<div class="card-flex friend-card">';
        $chatDesign .= '<div class="img-container">';

        $chatDesign .= '<img class="avatar" src="'.$user["profilePhoto"].'" alt=""></div>';
        $chatDesign .= '<div class="friend-info"><h3>'.$user["lastName"].' '.$user["firstName"].'</h3></div>';
        $chatDesign .= '<div class="friend-stats"><div class="stat-block">';
        $chatDesign .= '<label>New Messages</label><div class="stat-number">'.$user["unreadCount"].'</div></div></div>';
        $chatDesign .= '<a href="message.php?userID='.$user["userID"].'" class="friend-stats button">Message</a>';

        $chatDesign .= '</div>';
        return $chatDesign;
    }

    public function myFavouritesDesignCode($user): string
    {
        $favouriteDesign = '<div class="card-flex friend-card">';
        $favouriteDesign .= '<div class="img-container">';

        $favouriteDesign .= '<img class="avatar" src="'.$user["profilePhoto"].'" alt=""></div>';
        $favouriteDesign .= '<div class="friend-info"><h3>'.$user["lastName"].' '.$user["firstName"].'</h3></div>';
        $favouriteDesign .= '<div class="friend-stats"><a href="profile.php?userID='.$user["userID"].'" class="button">View Profile</a>';
        $favouriteDesign .= '&nbsp;<a href="message.php?userID='.$user["userID"].'" class="button">Message</a></div>';

        $favouriteDesign .= '</div>';
        return $favouriteDesign;
    }

    public function notificationDesignCode($notification, $user, $currentUser): string
    {
        $type = $notification["type"];
        $messageTime = date_format(date_create($notification["timeStamp"]),"d-m-Y H:i");
        $icon = "";
        $notificationDesign = '';
        $notificationDesign .= '<div class="media"><figure class="media-left">';
        $notificationDesign .= '<p class="image"><img src="'.$user["profilePhoto"].'" alt=""></p></figure>';
        $notificationDesign .= '<div class="media-content"><span>';

        if($type == "message"){
            $notificationDesign .= '<a href="profile.php?userID='.$user["userID"].'">'.$user["firstName"].'</a> sent you a <a href="message.php?userID='.$user["userID"].'">new message.</a>';
            $icon = "message-square";
        }else if($type == "wink"){
            $notificationDesign .= '<a href="profile.php?userID='.$user["userID"].'">'.$user["firstName"].'</a> sent you a <a href="message.php?userID='.$user["userID"].'">wink.</a>';
            $icon = "eye";
        }else if($type == "addfavourite"){
            $notificationDesign .= '<a href="profile.php?userID='.$user["userID"].'">'.$user["firstName"].'</a> added you in favourites.';
            $icon = "star";

            if(!$currentUser->isPremium()){
                return "";
            }
        }
        else if($type == "removefavourite"){
            $notificationDesign .= '<a href="profile.php?userID='.$user["userID"].'">'.$user["firstName"].'</a> removed you from favourites.</a>';
            $icon = "x-circle";

            if(!$currentUser->isPremium()){
                return "";
            }
        }

        $notificationDesign .= '</span> <span class="time">'.$messageTime.'</span>';
        $notificationDesign .= '</div><div class="media-right"><div class="added-icon">';
        $notificationDesign .= '<i data-feather="'.$icon.'"></i></div></div></div>';

        return $notificationDesign;
    }
}
