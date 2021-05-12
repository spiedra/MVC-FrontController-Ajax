<?php

class ActorController {

    public function __construct() {
        require_once 'model/ActorModel.php';
        $this->view = new View();
        $this->actorModel = new ActorModel();
    }

    public function listAllActors() {
        return $this->actorModel->getAllActors();
    }

    public function registerActor() {
        $this->actorModel->registerActor($_GET['actorName'], $_GET['actorLastName']);
        $this->showActorRegisterView();
    }

    public function showActorRegisterView() {
        $this->view->show("actorRegisterView.php", null);
    }

}

?>