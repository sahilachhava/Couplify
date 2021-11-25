<?php

class Utility{
    public static array $allHobbies = ["Singing", "Dancing", "Reading", "Cooking", "Gaming", "Painting", "Photography", "Sports", "Yoga", "Workout", "Teaching", "Swimming", "Travelling", "Fishing", "Surfing"];
    public static array $allLanguages = ["Chinese", "Spanish", "English", "Arabic", "Hindi", "Portuguese", "Russian", "Japanese", "German", "Urdu", "Vietnamese", "French", "Korean", "Italian"];
    public static array $allCuisines = ["French Cuisine", "Chinese Cuisine", "Japanese Food", "Italian Food", "Greek Food", "Spanish Food", "Lebanese Cuisine", "Moroccan Cuisine", "Mediterranean Cuisine", "Turkish Cuisine", "Thai Cuisine", "Indian Cuisine", "Cajun Food", "Mexican Cuisine", "Caribbean Cuisine", "German Food", "Russian Cuisine", "Hungarian Cuisine", "American Food"];
    public static array $allIndustries = ["IT Professional", "Doctor", "Lawyer", "Scientist", "Dentist", "Businessperson", "Entrepreneur", "Professor", "Operations Manager", "Truck Driver", "Chef", "Food Server", "Police Officer", "Marketing Specialist", "Registered Nurse", "Electrician", "Carpenter", "Mechanic", "Bookkeeper", "Construction Worker", "Medical Assistant", "Line Supervisor", "Administrative Assistant", "Office Clerk", "Customer Service Representative", "Laborer", "Stocking Associate", "Retail Sales Associate", "Bartender", "Janitor", "Food Preparation Worker", "Cashier"];

    public function getUserPhotos($userID): bool|array
    {
        $photoDirectory = scandir("./assets/photos/".$userID."/");
        if($photoDirectory){
            $allFilesExcludingHiddenFiles = preg_grep('/^([^.])/', $photoDirectory);
            $allFilesRemovedExtras = array_diff($allFilesExcludingHiddenFiles, array('..', '.'));
            return array_values($allFilesRemovedExtras);
        }else{
            return $photoDirectory;
        }
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
            $filterDesign .= '<div class="column is-3">';
            $filterDesign .= '<article class="group-box">';
            $filterDesign .= '<div class="box-img has-background-image" data-demo-background="'.$user["profilePhoto"].'"></div>';
            $filterDesign .= '<a href = "profile.php?userID='.$user["userID"].'" class="box-link" >';
            $filterDesign .= '<div class="box-img--hover has-background-image" data-demo-background="'.$user["profilePhoto"].'" ></div>';
            $filterDesign .= '</a>';
            $filterDesign .= '<div class="box-info" >';
            $filterDesign .= '<h3 class="box-title">'.$user["lastName"].' '.$user["firstName"].'</h3>';
            $filterDesign .= '<span class="box-category">Looking for '.$user["lookingFor"].'</span>';
            $filterDesign .= '</div></article></div>';
        }
        $filterDesign .= '</div></div>';

        return $filterDesign;
    }
}
