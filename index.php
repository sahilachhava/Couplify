<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    const MAX_PAIRS_OF_FILTER_TO_CREATE = 3;
    const MAX_USER_PER_ROW = 4;

    $db = new CouplifyDB();
    $utility = new Utility();

    if(isset($_SESSION["userID"])){
        $userDetails = $db->getUserDetails($_SESSION["userID"]);
        $additionalDetails = $db->getAdditionalDetails($_SESSION["userID"]);
        $_SESSION["currentUser"] = serialize(new User($userDetails, $additionalDetails));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
</head>
<body>
    <?php include_once("UI/preloader.php"); ?>
    <?php include_once("UI/navigation.php"); ?>

    <!-- Body design code starts here   -->
    <div class="view-wrapper">
        <div id="groups" class="navbar-v2-wrapper">
            <div class="container">
                <?php
                    $randomIndexForCuisines = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($db->getCuisines()));
                    $randomIndexForHobbies = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($db->getHobbies()));
                    $randomIndexForLanguages = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count($db->getLanguages()));

                    for ($index = 0; $index < MAX_PAIRS_OF_FILTER_TO_CREATE; $index++){
                        $cuisineIndex = $randomIndexForCuisines[$index];
                        $hobbyIndex = $randomIndexForHobbies[$index];
                        $languageIndex = $randomIndexForLanguages[$index];

                        //Cuisine Preference
                        $filteredUsers = $db->filterByCuisines($db->getCuisines()[$cuisineIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("cuisine", $db->getCuisines()[$cuisineIndex], $filteredUsers);
                        }

                        //Hobbies
                        $filteredUsers = $db->filterByHobbies($db->getHobbies()[$hobbyIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("hobby", $db->getHobbies()[$hobbyIndex], $filteredUsers);
                        }

                        //Known Languages
                        $filteredUsers = $db->filterByLanguage($db->getLanguages()[$languageIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("language", $db->getLanguages()[$languageIndex], $filteredUsers);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Body design code ends here   -->

</body>
<?php include_once("UI/scripts.php"); ?>
</html>