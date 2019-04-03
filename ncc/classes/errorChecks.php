<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class errorChecks {
    public $setPostFailed = NULL;
    public static function setFailCheck($postFailed) {
        $setPostFailed = $postFailed;
    }
    public static function postFailCheck() {
        return isset($setPostFailed);
    }
}
