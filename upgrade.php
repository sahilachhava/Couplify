<?php
    session_start();
    require_once("controller/CouplifyDB.php");
    require_once("controller/Utility.php");
    require_once("model/User.php");

    $db = new CouplifyDB();
    $utility = new Utility();
    $currentUser = null;

    if(isset($_SESSION["userID"])){
        $utility->setCurrentUser($db);
        $currentUser = unserialize($_SESSION["currentUser"]);
    }else{
        header("Location: login.php");
    }

    const WEEKLY_RATE = 3.80;
    const MONTHLY_RATE = 12.37;
    const TAX_RATE = 5;

    if(isset($_POST["plan"]) && $_POST["plan"] == "weekly"){
        $_SESSION["subTotal"] = WEEKLY_RATE;
        $_SESSION["tax"] = $_SESSION["subTotal"] * TAX_RATE / 100;
        $_SESSION["totalAmount"] = $_SESSION["subTotal"] + $_SESSION["tax"];
    }

    if(isset($_POST["plan"]) && $_POST["plan"] == "monthly"){
        $_SESSION["subTotal"] = MONTHLY_RATE;
        $_SESSION["tax"] = $_SESSION["subTotal"] * TAX_RATE / 100;
        $_SESSION["totalAmount"] = $_SESSION["subTotal"] + $_SESSION["tax"];
    }

    if(isset($_POST["buyPlan"])){
        $db->addToPremium($currentUser->getUserID(), $_POST["buyPlan"]);
        $currentUser->setPremiumInfo($db->getPremiumDetails($currentUser->getUserID()));
        $currentUser->setIsPremium(true);
        $_SESSION["currentUser"] = serialize($currentUser);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("UI/head.php"); ?>
    <style>
        .premiumFeatures {
            margin-top: 2%;
            width: 100%;
            padding: 10px;
            border: 1px solid #5596e6;
        }
        .premiumFeatures tr th {
            font-variant: all-petite-caps;
            padding: 10px;
            font-size: 19px;
            color: #fff;
            border: 1px solid #5596e6;
        }
        .dark-image .premiumFeatures tr th {
            color: #fff;
        }
        .light-image .premiumFeatures tr th {
            color: #000;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
</head>
<body>
<?php include_once("UI/preloader.php"); ?>
<?php include_once("UI/navigation.php"); ?>
<!-- Body design starts here   -->
<div class="view-wrapper">
    <div id="shop-page" class="navbar-v2-wrapper">

        <div class="container is-desktop">
            <!--Payment Wrapper-->
            <div class="shop-wrapper">
                <div class="cart-container">

                    <div class="cart-header">
                        <div class="header-inner">
                            <h2 id="checkout-step-title">Upgrade to Premium Account</h2>
                        </div>
                    </div>

                    <!--Checkout content-->
                    <div class="cart-content">
                        <div class="columns">

                            <div class="column is-6">

                                <div id="checkout-section-1" class="checkout-section is-active">
                                    <div class="flex-table">

                                        <div class="flex-table-header">
                                            <span class="product"><span>Product</span></span>
                                            <span class="price" style="width: 20%;">Price</span>
                                        </div>

                                        <form method="post" action="upgrade.php" hidden>
                                            <input type="submit" name="plan" value="weekly" id="weekly" hidden>
                                        </form>
                                        <form method="post" action="upgrade.php" hidden>
                                            <input type="submit" name="plan" value="monthly" id="monthly" hidden>
                                        </form>
                                        <form method="post" action="upgrade.php" hidden>
                                            <input type="submit" name="buyPlan" value="<?= $_POST['plan'] ?? '' ?>" id="buyPlan" hidden>
                                        </form>
                                        <input type="text" id="paymentText" class="is-hidden" value="<?= $_POST['buyPlan'] ?? '' ?>" />

                                        <div class="flex-table-item">
                                            <div class="product">
                                                <img src="assets/img/logo.png" alt="">
                                                <span class="product-name">Weekly Plan</span>
                                            </div>
                                            <div class="price" style="width: 20%;">
                                                <span class="has-price"><?= number_format((float)WEEKLY_RATE, 2, '.', ''); ?></span>
                                            </div>
                                            <div class="price"></div>
                                            <div class="button-wrap">
                                                <a onclick="document.getElementById('weekly').click();" style="margin-top: 5%;" class="button is-solid primary-button is-fullwidth">Select</a>
                                            </div>
                                        </div>

                                        <div class="flex-table-item">
                                            <div class="product">
                                                <img src="assets/img/logo.png" alt="">
                                                <span class="product-name">Monthly Plan</span>
                                            </div>
                                            <div class="price" style="width: 20%;">
                                                <span class="has-price"><?= number_format((float)MONTHLY_RATE, 2, '.', ''); ?></span>
                                            </div>
                                            <div class="price"></div>
                                            <div class="button-wrap">
                                                <a onclick="document.getElementById('monthly').click();" style="margin-top: 5%;" class="button is-solid primary-button is-fullwidth">Select</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="premiumFeatures" class="cart-summary" style="margin-right: 4%;margin-top: 3%;">
                                    <div id="shipping-placeholder-box" class="summary-card has-text-centered">
                                        <h4 style="font-size: 28px;font-variant: all-petite-caps;font-weight: bolder">Premium Plan Features</h4>
                                        <div class="dark-image">
                                            <table class="premiumFeatures">
                                                <tr><th>Add people in your favourite list</th></tr>
                                                <tr><th>Remove people from your favourite list</th></tr>
                                                <tr><th>See who reads your messages / winks</th></tr>
                                                <tr><th>Get notified if someone adds you in favourite list</th></tr>
                                                <tr><th>Get notified if someone removes you from favourite list</th></tr>
                                            </table>
                                        </div>
                                        <div class="light-image">
                                            <table class="premiumFeatures">
                                                <tr><th>Add people in your favourite list</th></tr>
                                                <tr><th>Remove people from your favourite list</th></tr>
                                                <tr><th>See who reads your messages / winks</th></tr>
                                                <tr><th>Get notified if someone adds you in favourite list</th></tr>
                                                <tr><th>Get notified if someone removes you from favourite list</th></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6">
                                <?php
                                    if(isset($_POST["plan"])){
                                ?>
                                    <div class="cart-summary" id="summaryContainer">
                                        <div class="summary-header">
                                            <h3>Order Summary</h3>
                                        </div>
                                        <div class="summary-card">
                                            <div class="order-line">
                                                <span>Subtotal</span>
                                                <span><?= number_format((float)$_SESSION["subTotal"] ?? 0, 2, '.', ''); ?></span>
                                            </div>
                                            <div class="order-line">
                                                <span>Taxes (5%)</span>
                                                <span><?= number_format((float)$_SESSION["tax"] ?? 0, 2, '.', ''); ?></span>
                                            </div>
                                            <div id="total-amount" class="order-line">
                                                <span class="is-total">Total</span>
                                                <span class="is-total"><?= number_format((float)$_SESSION["totalAmount"] ?? 0, 2, '.', ''); ?></span>
                                            </div>
                                            <div class="button-wrap">
                                                <button onclick="document.getElementById('buyPlan').click();" class="button is-solid primary-button raised is-fullwidth">Confirm Payment</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="confirmation-container" class="checkout-container is-hidden" style="margin-top: -5%;">
                <div class="confirmation-box">
                    <svg id="successAnimation" class="animated" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70">
                        <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z" />
                        <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent" />
                        <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent" />
                    </svg>
                    <h3>Your payment was successful.</h3>
                    <p>Thank you for being premium member.</p>
                    <div class="order-summary">
                        <h4>Order Summary</h4>
                        <div class="order-line">
                            <div class="item">
                                <span>Subtotal</span>
                            </div>
                            <div class="amount">
                                <span data-currency="USD">$<?= number_format((float)$_SESSION["subTotal"] ?? 0, 2, '.', ''); ?></span>
                            </div>
                        </div>
                        <div class="order-line">
                            <div class="item">
                                <span>Taxes</span>
                            </div>
                            <div class="amount">
                                <span data-currency="USD">$<?= number_format((float)$_SESSION["tax"] ?? 0, 2, '.', ''); ?></span>
                            </div>
                        </div>
                        <div class="order-line">
                            <div class="item is-total">
                                <span>Total</span>
                            </div>
                            <div class="amount is-total">
                                <span data-currency="USD">$<?= number_format((float)$_SESSION["totalAmount"] ?? 0, 2, '.', ''); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="button-wrap">
                        <a href="index.php" class="button is-solid primary-button raised is-fullwidth">Setup My Premium Account</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Body design ends here   -->
</body>
<?php include_once("UI/scripts.php"); ?>
</html>