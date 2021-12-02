<?php

class CouplifyDB
{
    private ?PDO $connectionToDatabase = null;
    private const databaseHost = "localhost";
    private const databasePort = 3306;
    private const databaseName = "couplify";
    private const databaseUsername = "project";
    private const databasePassword = "project";
    private const connectionString = "mysql:host=".self::databaseHost.";dbname=".self::databaseName.";port=".self::databasePort;

    //Constructor to Initialize Database
    function __construct() {
        try{
            $this->connectionToDatabase = new PDO(self::connectionString, self::databaseUsername, self::databasePassword);
            $this->connectionToDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $exception){
            die("Connection failed: " . $exception->getMessage());
        }
    }

    function __destruct() {
        $this->connectionToDatabase = null;
    }

    public function validateLogin($userEmail, $userPassword)
    {
        $encryptedPassword = md5($userPassword);
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails where userEmail = ? and userPassword = ?");
        $resultOfQuery->execute(array($userEmail, $encryptedPassword));

        $userRow = $resultOfQuery->fetch();
        if($userRow){
            return (count($userRow) > 0) ? $userRow["userID"] : -1;
        }else{
            return -1;
        }
    }

    public function registerNewUser($basicUserDetails): bool
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("insert into userDetails(useremail, userpassword, firstname, lastname) values(?,?,?,?)");
        if($resultOfQuery->execute($basicUserDetails)){
            return true;
        }else{
            return false;
        }
    }

    public function changePassword($currentUserID, $newPassword): bool
    {
        $encryptedPassword = md5($newPassword);
        $resultOfQuery = $this->connectionToDatabase->prepare("update userDetails set userPassword = ? where userID = ?");
        if(!$resultOfQuery->execute(array($encryptedPassword, $currentUserID))){
            return false;
        }
        return true;
    }

    public function createProfile($profile): bool
    {
        $queryString = "UPDATE userDetails SET profilePhoto = {$profile['photoPath']}, 
                       gender = {$profile['gender']}, dateOfBirth = {$profile['dateOfBirth']}, 
                       aboutMe = {$profile['aboutMe']}, lookingFor = {$profile['lookingFor']}, 
                       maritalStatus = {$profile['maritalStatus']}, totalChildren = {$profile['children']}, 
                       job = {$profile['job']} where userID = {$profile['currentUserID']}";

        //UPDATING USER DETAILS
        $resultOfQuery = $this->connectionToDatabase->prepare($queryString);
        $queryStatus = $resultOfQuery->execute();
        echo $queryStatus;
        if(!$queryStatus){
            return false;
        }

        //ADDING ADDRESS OF USER
        $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO address(city, state, country, userID) values(?,?,?,?)");
        $queryStatus = $resultOfQuery->execute(array($profile['city'], $profile['state'], $profile['country'], $profile['currentUserID']));
        if(!$queryStatus){
            return false;
        }

        //ADDING NOTIFICATION SETTINGS OF USER
        $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO notificationSettings(userID) value(?)");
        $queryStatus = $resultOfQuery->execute(array($profile['currentUserID']));
        if(!$queryStatus){
            return false;
        }

        //ADDING HOBBIES OF USER
        foreach ($profile["hobbies"] as $hobby){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userHobbies(hobby, userID) values(?,?)");
            $resultOfQuery->execute(array($hobby, $profile['currentUserID']));
        }

        //ADDING CUISINES OF USER
        foreach ($profile["cuisines"] as $cuisine){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userCuisines(cuisine, userID) values(?,?)");
            $resultOfQuery->execute(array($cuisine, $profile['currentUserID']));
        }

        //ADDING LANGUAGES OF USER
        foreach ($profile["languages"] as $language){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userLanguages(language, userID) values(?,?)");
            $resultOfQuery->execute(array($language, $profile['currentUserID']));
        }

        return true;
    }

    public function updateProfile($profile): bool
    {
        $queryString = "UPDATE userDetails SET profilePhoto = {$profile['photoPath']}, 
                       gender = {$profile['gender']}, dateOfBirth = {$profile['dateOfBirth']}, 
                       aboutMe = {$profile['aboutMe']}, lookingFor = {$profile['lookingFor']}, 
                       maritalStatus = {$profile['maritalStatus']}, totalChildren = {$profile['children']}, 
                       job = {$profile['job']} where userID = {$profile['currentUserID']}";

        //UPDATING USER DETAILS
        $resultOfQuery = $this->connectionToDatabase->prepare($queryString);
        $queryStatus = $resultOfQuery->execute();
        echo $queryStatus;
        if(!$queryStatus){
            return false;
        }

        //ADDING ADDRESS OF USER
        $resultOfQuery = $this->connectionToDatabase->prepare("UPDATE address SET city = ?, state = ?, country = ? where userID = ?");
        $queryStatus = $resultOfQuery->execute(array($profile['city'], $profile['state'], $profile['country'], $profile['currentUserID']));
        if(!$queryStatus){
            return false;
        }

        //DELETING OLD HOBBIES
        $resultOfQuery = $this->connectionToDatabase->prepare("DELETE FROM userHobbies where userID = ?");
        $resultOfQuery->execute(array($profile['currentUserID']));

        //DELETING OLD CUISINES
        $resultOfQuery = $this->connectionToDatabase->prepare("DELETE FROM userCuisines where userID = ?");
        $resultOfQuery->execute(array($profile['currentUserID']));

        //DELETING OLD LANGUAGES
        $resultOfQuery = $this->connectionToDatabase->prepare("DELETE FROM userLanguages where userID = ?");
        $resultOfQuery->execute(array($profile['currentUserID']));

        //ADDING HOBBIES OF USER
        foreach ($profile["hobbies"] as $hobby){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userHobbies(hobby, userID) values(?,?)");
            $resultOfQuery->execute(array($hobby, $profile['currentUserID']));
        }

        //ADDING CUISINES OF USER
        foreach ($profile["cuisines"] as $cuisine){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userCuisines(cuisine, userID) values(?,?)");
            $resultOfQuery->execute(array($cuisine, $profile['currentUserID']));
        }

        //ADDING LANGUAGES OF USER
        foreach ($profile["languages"] as $language){
            $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userLanguages(language, userID) values(?,?)");
            $resultOfQuery->execute(array($language, $profile['currentUserID']));
        }

        return true;
    }

    public function updateNotificationSettings($updatedNotificationSettings): bool
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("UPDATE notificationSettings SET allNotification = ?, addFavourite = ?, removeFavourite = ?, messages = ?, winks = ? where userID = ?");
        $queryResult = $resultOfQuery->execute($updatedNotificationSettings);
        if(!$queryResult){
            return false;
        }
        return true;
    }

    public function getLastInsertedID(): string
    {
        return $this->connectionToDatabase->lastInsertId();
    }

    public function addPhoto($photoName, $userID)
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("INSERT INTO userPhotos(photo, userID) values(?,?)");
        $resultOfQuery->execute(array($photoName, $userID));
    }

    public function getPhotos($userID): array
    {
        $allPhotos = [];

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userPhotos where userID = {$userID}");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allPhotos, $row['photo']);
        }

        return $allPhotos;
    }

    public function getAllUsers(): array
    {
        $allUsers = [];

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allUsers, $row);
        }
        return $allUsers;
    }

    public function getUserDetails($userID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails where userID = ".$userID);
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getAdditionalDetails($userID): array
    {
        //Getting Hobbies
        $hobbies = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userHobbies where userID = {$userID}");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($hobbies, $row["hobby"]);
        }

        //Getting languages
        $languages = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userLanguages where userID = {$userID}");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($languages, $row["language"]);
        }

        //Getting cuisines
        $cuisines = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userCuisines where userID = {$userID}");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($cuisines, $row["cuisine"]);
        }

        return array("hobbies" => $hobbies, "languages" => $languages, "cuisines" => $cuisines);
    }

    public function getUserAddress($userID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from address where userID = ".$userID);
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getHobbies(): array
    {
        $allHobbies = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from hobbies");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allHobbies, $row["hobby"]);
        }
        return $allHobbies;
    }

    public function getHobby($hobbyID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from hobbies where hobbyID = {$hobbyID}");
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getLanguages(): array
    {
        $allLanguages = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from languages");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allLanguages, $row["language"]);
        }
        return $allLanguages;
    }

    public function getLanguage($languageID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from languages where languageID = {$languageID}");
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getCuisines(): array
    {
        $allCuisines = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from cuisines");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allCuisines, $row["cuisine"]);
        }
        return $allCuisines;
    }

    public function getCuisine($cuisineID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from cuisines where cuisineID = {$cuisineID}");
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getJobs(): array
    {
        $allJobs = [];
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from jobs");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allJobs, $row["job"]);
        }
        return $allJobs;
    }

    public function getJob($jobID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from jobs where jobID = {$jobID}");
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getNotificationSettings($currentUserID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from notificationSettings where userID = {$currentUserID}");
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function isUserExists($userID): bool
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails where userID = {$userID}");
        $resultOfQuery->execute();
        if($resultOfQuery->fetch()){
            return true;
        }else{
            return false;
        }
    }
    public function isEmailExists($userEmail): int|bool //for Forgot password
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails where userEmail = '{$userEmail}'");
        $resultOfQuery->execute();
        $row = $resultOfQuery->fetch();
        if($row){
            return $row["userID"];
        }else{
            return false;
        }
    }

    public function sendNotification($userID, $receiverID, $notificationType){
        date_default_timezone_set('UTC');
        $timeStamp = date('Y-m-d H:i:s');
        $notificationSettings = $this->getNotificationSettings($receiverID);
        $sendFlag = false;

        if($notificationSettings["allNotification"] == 0){
            return;
        }else{
            if($notificationType == "wink" && $notificationSettings["winks"] == 1){
                $sendFlag = true;
            }else if($notificationType == "message" && $notificationSettings["messages"] == 1){
                $sendFlag = true;
            }else if($notificationType == "addfavourite" && $notificationSettings["addFavourite"] == 1){
                $sendFlag = true;
            }else if($notificationType == "removefavourite" && $notificationSettings["removeFavourite"] == 1){
                $sendFlag = true;
            }
        }

        if($sendFlag){
            $resultOfQuery = $this->connectionToDatabase->prepare("insert into notifications(userID, receiverID, type, timeStamp) values(?,?,?,?)");
            $resultOfQuery->execute(array($userID, $receiverID, $notificationType, $timeStamp));
        }
    }

    public function getNotifications($currentUserID): array
    {
        $allNotifications = [];

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from notifications where receiverID = {$currentUserID} order by timeStamp desc");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allNotifications, $row);
        }

        return $allNotifications;
    }

    public function deleteNotifications($currentUserID): bool
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("delete from notifications where receiverID = {$currentUserID}");
        if($resultOfQuery->execute()){
            return true;
        }
        return false;
    }

    public function addToPremium($userID, $planType)
    {
        date_default_timezone_set('UTC');
        $startDate = date('Y-m-d H:i:s');
        if($planType == "weekly"){
            $endDate = date('Y-m-d H:i:s', strtotime("+7 day", strtotime($startDate)));
        }else{
            $endDate = date('Y-m-d H:i:s', strtotime("+30 day", strtotime($startDate)));
        }
        $resultOfQuery = $this->connectionToDatabase->prepare("insert into premiumPlan(userID, startDate, endDate, planType) values(?,?,?,?)");
        $resultOfQuery->execute(array($userID, $startDate, $endDate, $planType));
    }

    public function getPremiumDetails($userID): array|bool
    {
        date_default_timezone_set('UTC');
        $currentDate = date('Y-m-d H:i:s');
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from premiumPlan where userID = {$userID}");
        $resultOfQuery->execute();
        $row = $resultOfQuery->fetch();

        if($row){
            if($currentDate > $row['endDate']){
                //Premium Expired
                $resultOfQuery = $this->connectionToDatabase->prepare("delete from premiumPlan where userID = {$userID}");
                $resultOfQuery->execute();
                return false;
            }
        }else{
            return false;
        }

        return $row;
    }

    public function sendMessage($senderID, $receiverID, $message)
    {
        date_default_timezone_set('UTC');
        $currentDate = date('Y-m-d H:i:s');
        $resultOfQuery = $this->connectionToDatabase->prepare("insert into messages(senderID, receiverID, message, timeStamp) values(?,?,?,?)");
        $queryResult = $resultOfQuery->execute(array($senderID, $receiverID, $message, $currentDate));
        if($queryResult){
            if($message == "wink"){
                $this->sendNotification($senderID, $receiverID, "wink");
            }else{
                $this->sendNotification($senderID, $receiverID, "message");
            }
        }
    }

    public function getMessages($senderID, $receiverID): array
    {
        $allMessages = [];

        $searchQuery = "select * from messages where 
        (senderID = {$senderID} or senderID = {$receiverID}) 
        and 
        (receiverID = {$receiverID} or receiverID = {$senderID})";
        
        $resultOfQuery = $this->connectionToDatabase->prepare($searchQuery);
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            array_push($allMessages, $row);
        }

        return  $allMessages;
    }

    public function deleteMessages($senderID, $receiverID)
    {
        $deleteQuery = "delete from messages where 
        (senderID = {$senderID} or senderID = {$receiverID}) 
        and 
        (receiverID = {$receiverID} or receiverID = {$senderID})";

        $resultOfQuery = $this->connectionToDatabase->prepare($deleteQuery);
        $resultOfQuery->execute();
    }

    public function readMessages($currentUserID, $senderID)
    {
        $updateQuery = "update messages set isRead = 1 where (receiverID = {$currentUserID} and senderID = {$senderID}) and isRead = 0";
        $resultOfQuery = $this->connectionToDatabase->prepare($updateQuery);
        $resultOfQuery->execute();
    }

    public function getUnreadMessages($currentUserID, $senderID): int
    {
        $unreadCount = 0;
        $searchQuery = "select * from messages where (receiverID = {$currentUserID} and senderID = {$senderID}) and isRead = 0";
        $resultOfQuery = $this->connectionToDatabase->prepare($searchQuery);
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            $unreadCount++;
        }
        return $unreadCount;
    }

    public function getAllMessages($currentUserID): array
    {
        $allUsers = [];
        $allUserIDs = [];
        $searchQuery = "select * from messages where senderID = {$currentUserID} or receiverID = {$currentUserID}";
        $resultOfQuery = $this->connectionToDatabase->prepare($searchQuery);
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            if($row["senderID"] == $currentUserID){
                array_push($allUserIDs, $row["receiverID"]);
            }else{
                array_push($allUserIDs, $row["senderID"]);
            }
        }

        //Removing Duplicates //DISTINCT was not used because it will not get me my desire result
        $allUserIDs = array_unique($allUserIDs);

        foreach ($allUserIDs as $userID){
            $user = $this->getUserDetails($userID);
            $user["unreadCount"] = $this->getUnreadMessages($currentUserID, $userID);
            array_push($allUsers, $user);
        }

        return $allUsers;
    }

    public function addToFavourite($userID, $favouritedUserID)
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("insert into favourites(userID, favouritedUserID) value({$userID}, {$favouritedUserID})");
        $queryResult = $resultOfQuery->execute();
        if($queryResult){
            $this->sendNotification($userID, $favouritedUserID, "addfavourite");
        }
    }

    public function removeFromFavourite($userID, $unFavouritedUserID)
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("delete from favourites where userID = {$userID} and favouritedUserID = {$unFavouritedUserID}");
        $queryResult = $resultOfQuery->execute();
        if($queryResult){
            $this->sendNotification($userID, $unFavouritedUserID, "removefavourite");
        }
    }

    public function getMyFavourites($userID): array
    {
        $favouritedUsers = [];

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from favourites where userID = {$userID}");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()) {
            $user = $this->getUserDetails($row["favouritedUserID"]);
            array_push($favouritedUsers, $user);
        }

        return $favouritedUsers;
    }

    public function filterByCuisines($cuisineName, $maxUserLimit): array
    {
        $userIDs = [];
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userCuisines order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            if($cuisineName == $row["cuisine"] && !in_array($row["userID"], $userIDs) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
                array_push($userIDs, $row["userID"]);
            }
        }

        return $filteredUsers;
    }

    public function filterByLanguage($languageName, $maxUserLimit): array
    {
        $userIDs = [];
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userLanguages order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            if($languageName == $row["language"] && !in_array($row["userID"], $userIDs) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
                array_push($userIDs, $row["userID"]);
            }
        }

        return $filteredUsers;
    }

    public function filterByHobbies($hobby, $maxUserLimit): array
    {
        $userIDs = [];
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userHobbies order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            if($hobby == $row["hobby"] && !in_array($row["userID"], $userIDs) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
                array_push($userIDs, $row["userID"]);
            }
        }

        return $filteredUsers;
    }
}
