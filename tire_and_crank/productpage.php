<?php

// Front Controller

require_once('./libs/PHPTAL-1.3.0/PHPTAL.php');
require_once('init.php');
loadScripts();


    if(!Utils::isGET()) {
        $data = array("status" => "error", "msg" => "Only GET allowed.");
    }

    $parameters = new Parameters("GET");

    $showUserProfileAction = new ShowUserProfileAction();
    $showUserProfileAction->setParameters($parameters);
    $profile = $showUserProfileAction->getProfile();


    // here's where we can choose how to render: AJAX or non-AJAX
    // this might affect how we output the data (i.e., JSON vs HTML)
    if(Utils::isAJAX()) {
        $data = array();
        // AJAX means that we'll send it as JSON - at least for this call
        if($profile == null) {
            // didn't find a profile with that name
            $data = array("status" => "error", "msg" => Messages::getMessages());
        } else {
            $data = array("status" => "success", "profile" => $profile);
        }
        echo json_encode($data, JSON_FORCE_OBJECT);
        return;

    } else {
        // render the whole page using PHPTAL

        // finally, create a new template object
        $template = new PHPTAL('templating/productspage.xhtml');

        // now add the variables for processing and that you created from above:
        $template->page_title = "Tire_and_crank";
        $template->profile = $profile;

        // messages last
        $template->messages = Messages::getMessages();

        // execute the template
        try {
            echo $template->execute();
        }
        catch (Exception $e){
            // not much else we can do here if the template engine barfs
            echo $e;
        }

    }

?>