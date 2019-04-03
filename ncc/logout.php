<?php
require_once 'classes/session.php';
session::userLogout();
header("location: index.php");
die();
?>