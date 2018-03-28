<?php
App::uses('AppController', 'Controller');

class SystemsController extends AppController {
    var $name = 'Systems';
    public $helpers = array('Html', 'Form');
    public $uses = array('System');
    public $components = array( 'Common', 'Auth', 'Session', 'Cookie', 'RequestHandler', 'Email', 'PaymentHandlerPaypal' );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('products','faq'));
    }

    public function products() {}
    public function faq() {}

}
?>