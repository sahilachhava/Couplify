<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    const MAX_PAIRS_OF_FILTER_TO_CREATE = 3;
    const MAX_USER_PER_ROW = 4;

    $db = new CouplifyDB();
    $utility = new Utility();
    $utility->addUsersToDataFileForSearch($db->getAllUsers());
    $currentUser = null;

    if(isset($_SESSION["userID"])){
        $utility->setCurrentUser($db);
        $currentUser = unserialize($_SESSION["currentUser"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("commonUI/head.php"); ?>
</head>
<body>
    <?php include_once("commonUI/preloader.php"); ?>
    <?php include_once("commonUI/navigation.php"); ?>

    <!-- Body design code starts here   -->
    <div class="view-wrapper">
        <div id="groups" class="navbar-v2-wrapper">
            <div class="container">
                <?php
                    $allCuisines = []; $allHobbies = []; $allLanguages = [];
                    $randomIndexForCuisines = []; $randomIndexForHobbies = []; $randomIndexForLanguages = [];

                    if(isset($_SESSION["userID"])) {
                        $allCuisines = $currentUser->getUserCuisines();
                        $allHobbies = $currentUser->getUserHobbies();
                        $allLanguages = $currentUser->getUserLanguages();

                        shuffle($allCuisines);
                        $shuffledCuisines  = array_slice($allCuisines, 0, MAX_PAIRS_OF_FILTER_TO_CREATE);

                        shuffle($allHobbies);
                        $shuffledHobbies  = array_slice($allHobbies, 0, MAX_PAIRS_OF_FILTER_TO_CREATE);

                        shuffle($allLanguages);
                        $shuffledLanguages  = array_slice($allLanguages, 0, MAX_PAIRS_OF_FILTER_TO_CREATE);

                        for ($index = 0; $index < MAX_PAIRS_OF_FILTER_TO_CREATE; $index++){
                            //Cuisine Preference
                            $filteredUsers = $db->filterByCuisines($shuffledCuisines[$index], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("cuisine", $shuffledCuisines[$index], $filteredUsers);
                            }

                            //Hobbies
                            $filteredUsers = $db->filterByHobbies($shuffledHobbies[$index], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("hobby", $shuffledHobbies[$index], $filteredUsers);
                            }

                            //Known Languages
                            $filteredUsers = $db->filterByLanguage($shuffledLanguages[$index], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("language", $shuffledLanguages[$index], $filteredUsers);
                            }
                        }
                    }else{
                        $allCuisines = $db->getCuisines();
                        $allHobbies = $db->getHobbies();
                        $allLanguages = $db->getLanguages();

                        $randomIndexForCuisines = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($allCuisines));
                        $randomIndexForHobbies = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($allHobbies));
                        $randomIndexForLanguages = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($allLanguages));

                        for ($index = 0; $index < MAX_PAIRS_OF_FILTER_TO_CREATE; $index++){
                            $cuisineIndex = $randomIndexForCuisines[$index];
                            $hobbyIndex = $randomIndexForHobbies[$index];
                            $languageIndex = $randomIndexForLanguages[$index];

                            //Cuisine Preference
                            $filteredUsers = $db->filterByCuisines($allCuisines[$cuisineIndex], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("cuisine", $allCuisines[$cuisineIndex], $filteredUsers);
                            }

                            //Hobbies
                            $filteredUsers = $db->filterByHobbies($allHobbies[$hobbyIndex], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("hobby", $allHobbies[$hobbyIndex], $filteredUsers);
                            }

                            //Known Languages
                            $filteredUsers = $db->filterByLanguage($allLanguages[$languageIndex], MAX_USER_PER_ROW);
                            if(count($filteredUsers) > 0) {
                                echo $utility->createFilteredDesignCode("language", $allLanguages[$languageIndex], $filteredUsers);
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Body design code ends here   -->

</body>
<?php include_once("commonUI/scripts.php"); ?>
</html>