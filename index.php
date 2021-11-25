<?php
    include_once("CouplifyDB.php");
    include_once("Utility.php");
    const MAX_PAIRS_OF_FILTER_TO_CREATE = 3;
    const MAX_USER_PER_ROW = 4;

    $db = new CouplifyDB();
    $utility = new Utility();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./head.php"); ?>
</head>
<body>
    <?php include_once("./preloader.php"); ?>
    <?php include_once("./navigation.php"); ?>

    <!-- Body design code starts here   -->
    <div class="view-wrapper">
        <div id="groups" class="navbar-v2-wrapper">
            <div class="container">
                <?php
                    $randomIndexForCuisines = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count(Utility::$allCuisines));
                    $randomIndexForHobbies = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count(Utility::$allHobbies));
                    $randomIndexForLanguages = $utility->getRandomIndex(MAX_PAIRS_OF_FILTER_TO_CREATE, count(Utility::$allLanguages));

                    for ($index = 0; $index < MAX_PAIRS_OF_FILTER_TO_CREATE; $index++){
                        $cuisineIndex = $randomIndexForCuisines[$index];
                        $hobbyIndex = $randomIndexForHobbies[$index];
                        $languageIndex = $randomIndexForLanguages[$index];

                        //Cuisine Preference
                        $filteredUsers = $db->filterByCuisines(Utility::$allCuisines[$cuisineIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("cuisine", Utility::$allCuisines[$cuisineIndex], $filteredUsers);
                        }

                        //Hobbies
                        $filteredUsers = $db->filterByHobbies(Utility::$allHobbies[$hobbyIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("hobby", Utility::$allHobbies[$hobbyIndex], $filteredUsers);
                        }

                        //Known Languages
                        $filteredUsers = $db->filterByLanguage(Utility::$allLanguages[$languageIndex], MAX_USER_PER_ROW);
                        if(count($filteredUsers) > 0) {
                            echo $utility->createFilteredDesignCode("language", Utility::$allLanguages[$languageIndex], $filteredUsers);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Body design code ends here   -->

</body>
<?php include_once("./scripts.php"); ?>
</html>