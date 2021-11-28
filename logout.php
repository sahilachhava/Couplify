<?php
session_start();
require_once("controller/Utility.php");
Utility::$currentUser = null;
session_destroy();
header("Location: login.php");
