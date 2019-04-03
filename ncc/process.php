<?php
require_once 'classes/database.php';
require_once 'classes/session.php';
require_once 'classes/sendMail.php';
if(isset($_POST['locSelect']) && isset($_POST['problemPriority']) && isset($_POST['problemDic'])) {
    //For processing the data for a new post within the system
    $locSelect = $_POST['locSelect'];
    $problemPriority = $_POST['problemPriority'];
    $problemDic = $_POST['problemDic'];
    $user = new database();
    $mail = new sendMail();
    $result = $user->createPost($locSelect, $problemPriority, $problemDic);
    
    //For other type of SQL statements, INSERT, UPDATE, DELETE, DROP, etc, mysql_query() returns TRUE on success or FALSE on error. 
    if($result == FALSE) {
        $_SESSION['postFail'] = TRUE;
        header("Location: postCheck.php");
        flush();
        die('Should have redirected by now');
    }
    else {
        //echo '</br></br></br></br></br>Hello there FAIL!!';
        $_SESSION['postFail'] = FALSE;
        header("Location: postCheck.php");
        $mail->insertMail($locSelect, $problemPriority, $problemDic);
        flush();
        die('Should have redirected by now');
    }
}
if(isset($_POST['userName']) && isset($_POST['password'])) {
    //For the user login system
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $user = new database();
    $result = $user->userLogin($userName, $password);    
    if($result == FALSE) {
        //echo '</br></br></br></br></br> What?';
        $login_failed = TRUE;
        header("Location: login.php");
    } 
    else {
        //echo '</br></br></br></br></br> WORKED!';
        session::login($user->userName);
        header("Location: admin.php");
        flush();
        die('Should have redirected by now');
    }
}
//Old Delete process *Keeping for backup*
/*if(isset($_POST['postID']) && is_numeric($_POST['postID'])) {
    $postDelete = new database();
    $postID = $_POST['postID'];
    
    $result = $postDelete->deletePost($postID);
    if($result == FALSE) {
        header("Location: admin.php");
        flush();
        die('Should have redirected by now');
    }
}*/
if((isset($_POST['deleteID']) && is_numeric($_POST['deleteID']))) {
    //Used for processing the delete info
    $deletePost = $_POST['deleteID'];
    $postDelete = new database();
    $result = $postDelete->deletePost($deletePost);
    if($result == FALSE) {
        $_SESSION['postFail'] = TRUE;
        header("Location: admin.php");
        flush();
        die('Should have redirected by now');
    }
    else {
        //echo '</br></br></br></br></br>Hello there FAIL!!';
        $_SESSION['postFail'] = FALSE;
        header("Location: admin.php");
        flush();
        die('Should have redirected by now');
    }
}
?>