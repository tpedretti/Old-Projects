<?php
require_once 'classes/view.php';
require_once 'classes/session.php';
if (session::isSessionStarted() === FALSE) {session_status();}
require_once 'header.html';
$view = new view();
echo $view->publicView();
require_once 'footer.html';
?>