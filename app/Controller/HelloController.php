<!-- File: /app/controller/ResourcesController.php -->
<?php
class HelloController extends AppController {
    public $helpers = array('Html', 'Form');
    //public $uses = array('User','Resource');
    //public $components = array('Common');

    public function index() {
        echo 'Hello world !';

    }

}



?>