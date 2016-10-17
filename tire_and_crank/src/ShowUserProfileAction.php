<?php

//require_once('./UserManager.php');
//require_once('./Session.php');
//require_once('./Messages.php');

// Command
class ShowUserProfileAction {

    private $userManager;
    private $params;

    public function __construct() {
        $this->userManager = new UserManager();
    }

    public function setParameters($params) {
        $this->params = $params;
    }

    public function getProfile() {

        // for true/false values, see:
        // http://php.net/manual/en/types.comparisons.php


        if(Session::get('isLoggedIn') && Session::get('user_name')) {
            // here's where we call the user manager which will talk to
            // the DB for us
            $profile = $this->userManager->getUserProfile(Session::get('user_name'));

            if($profile != null) {
                // found a user by that name
                return $profile;
            } else {
                // this shouldn't happen since this is not a log in - this is a
                // profile request. Would be good to report this here as well
                // in a log file
                Messages::addMessage("info", "No user of that name.");
                return null;
            }

        } else {
            // most likely session timed out.
        }

        // otherwise
        return null;
    }

}

?>
