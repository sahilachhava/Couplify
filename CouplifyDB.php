<?php

class CouplifyDB {
    private ?PDO $connectionToDatabase = null;

    //Constructor to Initialize Database
    function __construct() {
        try{
            $this->connectionToDatabase = new PDO('mysql:host=127.0.0.1:3306;dbname=couplify','root','' );
            $this->connectionToDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $exception){
            die("Connection failed: " . $exception->getMessage());
        }
    }

    function __destruct() {
        $this->connectionToDatabase = null;
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
