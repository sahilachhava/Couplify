<?php

class CouplifyDB {
    private ?PDO $connectionToDatabase = null;

    //Constructor to Initialize Database
    function __construct() {
        $this->connectionToDatabase = new PDO('mysql:host=127.0.0.1:3306;dbname=couplify','root','' );
        if ($this->connectionToDatabase->errorCode()) {
            die("Connection failed: " . $this->connectionToDatabase->errorCode());
        }
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
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from additionalDetails where userID = ".$userID);
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function getUserAddress($userID): array
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from address where userID = ".$userID);
        $resultOfQuery->execute();
        return $resultOfQuery->fetch();
    }

    public function isUserExists($userID): bool
    {
        $resultOfQuery = $this->connectionToDatabase->prepare("select * from userDetails where userID = ".$userID);
        $resultOfQuery->execute();
        if($resultOfQuery->fetch()){
            return true;
        }else{
            return false;
        }
    }

    public function filterByCuisines($cuisineName, $maxUserLimit): array
    {
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from additionalDetails order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            $userCuisines = explode(",", $row["cuisinePreferences"]);
            if(in_array($cuisineName, $userCuisines) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
            }
        }

        return $filteredUsers;
    }

    public function filterByLanguage($languageName, $maxUserLimit): array
    {
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from additionalDetails order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            $userLanguages = explode(",", $row["knownLanguages"]);
            if(in_array($languageName, $userLanguages) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
            }
        }

        return $filteredUsers;
    }

    public function filterByHobbies($hobby, $maxUserLimit): array
    {
        $filteredUsers = [];
        $userLimitCount = 0;

        $resultOfQuery = $this->connectionToDatabase->prepare("select * from additionalDetails order by rand()");
        $resultOfQuery->execute();
        while($row = $resultOfQuery->fetch()){
            $userHobbies = explode(",", $row["hobbies"]);
            if(in_array($hobby, $userHobbies) && $userLimitCount < $maxUserLimit){
                $userLimitCount++;
                array_push($filteredUsers, $this->getUserDetails($row["userID"]));
            }
        }

        return $filteredUsers;
    }
}
