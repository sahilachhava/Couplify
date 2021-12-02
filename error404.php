<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>

<!-- Body design starts here   -->
<div class="error-container">
    <div class="error-wrapper">
        <div class="error-inner has-text-centered">
            <div class="bg-number dark-inverted">404</div>
            <img class="light-image" src="assets/img/custom/3.svg" alt="" />
            <img class="dark-image" src="assets/img/custom/3.svg" alt="" />
            <h3 class="dark-inverted">We couldn't find that page</h3>
            <p>Please try again or contact an administrator if the problem persists.</p>
            <div class="button-wrap">
                <a class="button h-button is-primary is-elevated" href="index.php">Take me Back</a>
            </div>
        </div>
    </div>
</div>
<!-- Body design ends here   -->

</body>
<?php include_once("UI/scripts.php"); ?>
</html>