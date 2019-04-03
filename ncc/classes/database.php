<?php

/*
Calss for connecting and working with the database in question.
 */

require_once '../../config.inc.php';

class database {
    private $db;
    
    public $location;
    public $priority;
    public $reason;
    public $userName;
    public $password;
    
    function __construct() {
        $this->db = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
        mysqli_select_db($this->db, DB_NAME);
    }
    function createPost($location, $priority, $reason) {
        //For other type of SQL statements, INSERT, UPDATE, DELETE, DROP, etc, mysql_query() returns TRUE on success or FALSE on error.
        $createQuery = "INSERT INTO `NCCReport`(`location`, `priority`, `reason`) VALUES ('$location', '$priority', '$reason')";
        $result = mysqli_query($this->db, $createQuery);        
        return $result;
    }
    function getPost() {
        $createQuery = "SELECT * FROM `NCCReport`";
        $result = mysqli_query($this->db, $createQuery);
        return $result;
    }
    function deletePost($postID) {
        $createQuery = "DELETE FROM `NCCReport` WHERE `uniqueID` = '$postID'";
        $result = mysqli_query($this->db, $createQuery);
        return $result;
    }
    public function copyrow($row) {
        //echo '</br></br></br></br></br>OMG COPYROW!</br>';
        $this->userName = $row['userName'];
        //echo $this->userName;
        $this->password = $row['password'];
    }
    public function userLogin($userName, $userPass) {
        $hash = md5($userPass);
        $query = "SELECT * FROM `NCCUser` WHERE `userName` = '$userName' and `password` = '$hash'";
        $result = mysqli_query($this->db, $query);        
        if($result == FALSE) {
            die("Someothing went wrong! Please Report this to an Admin!");
            return FALSE;
        }
        else {
            while($row = mysqli_fetch_assoc($result)) {
                    $this->copyrow($row);
                    return TRUE;
            }
        }
    }
}
