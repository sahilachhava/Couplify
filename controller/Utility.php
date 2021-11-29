<?php

class Utility
{
    public function setCurrentUser($db){
        $userDetails = $db->getUserDetails($_SESSION["userID"]);
        $additionalDetails = $db->getAdditionalDetails($_SESSION["userID"]);
        $userAddress = $db->getUserAddress($_SESSION["userID"]);
        $_SESSION["currentUser"] = serialize(new User($userDetails, $userAddress, $additionalDetails));
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
                $filterDesign .= '</a>';
                $filterDesign .= '<div class="box-info" >';
                $filterDesign .= '<h3 class="box-title">' . $user["lastName"] . ' ' . $user["firstName"] . '</h3>';
                $filterDesign .= '<span class="box-category">Looking for ' . $user["lookingFor"] . '</span>';
                $filterDesign .= '</div></article></div>';
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
}
