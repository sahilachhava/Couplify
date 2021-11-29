<?php

class User
{
    private int $userID;
    private string $firstName, $lastName, $userFullName, $dateOfBirth, $gender, $userEmail,
        $userPhoto, $aboutMe, $lookingFor, $maritalStatus, $totalChildren, $job;
    private array $userAddress;
    private array $userHobbies;
    private array $userCuisines;
    private array $userLanguages;

    public function __construct($userData, $userAddress, $additionalDetails)
    {
        $this->userID = $userData["userID"];
        $this->firstName = $userData["firstName"];
        $this->lastName = $userData["lastName"];
        $this->userFullName = $userData["lastName"] . " " . $userData["firstName"];
        $this->dateOfBirth = $userData["dateOfBirth"];
        $this->gender = $userData["gender"];
        $this->userEmail = $userData["userEmail"];
        $this->userPhoto = $userData["profilePhoto"];
        $this->aboutMe = $userData["aboutMe"];
        $this->lookingFor = $userData["lookingFor"];
        $this->maritalStatus = $userData["maritalStatus"];
        $this->totalChildren = $userData["totalChildren"];
        $this->job = $userData["job"];
        $this->userAddress = $userAddress;
        $this->userHobbies = $additionalDetails["hobbies"];
        $this->userCuisines = $additionalDetails["cuisines"];
        $this->userLanguages = $additionalDetails["languages"];
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getUserFullName(): string
    {
        return $this->userFullName;
    }

    public function setUserFullName($userFullName): void
    {
        $this->userFullName = $userFullName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    public function getUserPhoto()
    {
        return $this->userPhoto;
    }

    public function setUserPhoto($userPhoto): void
    {
        $this->userPhoto = $userPhoto;
    }

    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    public function setAboutMe($aboutMe): void
    {
        $this->aboutMe = $aboutMe;
    }

    public function getLookingFor()
    {
        return $this->lookingFor;
    }

    public function setLookingFor($lookingFor): void
    {
        $this->lookingFor = $lookingFor;
    }
    
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus($maritalStatus): void
    {
        $this->maritalStatus = $maritalStatus;
    }

    public function getTotalChildren()
    {
        return $this->totalChildren;
    }

    public function setTotalChildren($totalChildren): void
    {
        $this->totalChildren = $totalChildren;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob($job): void
    {
        $this->job = $job;
    }

    public function getUserAddress(): array
    {
        return $this->userAddress;
    }

    public function setUserAddress(array $userAddress): void
    {
        $this->userAddress = $userAddress;
    }

    public function getUserHobbies(): array
    {
        return $this->userHobbies;
    }

    public function setUserHobbies($userHobbies): void
    {
        $this->userHobbies = $userHobbies;
    }

    public function getUserCuisines(): array
    {
        return $this->userCuisines;
    }

    public function setUserCuisines($userCuisines): void
    {
        $this->userCuisines = $userCuisines;
    }

    public function getUserLanguages(): array
    {
        return $this->userLanguages;
    }

    public function setUserLanguages($userLanguages): void
    {
        $this->userLanguages = $userLanguages;
    }
}