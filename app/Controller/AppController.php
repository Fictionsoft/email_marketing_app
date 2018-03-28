<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Email',
        'Session',
        'RequestHandler',
        'Auth' => array(
            'userModel' => 'User',
            'loginRedirect' => array('controller' => 'videos', 'action' => 'video_categories'),
            'logoutRedirect' => array('controller' => 'pages'),
            'authError' => false,
            'loginError' => 'Invalid Username or Password entered, please try again.',
            'authorize' => array('Controller')
        )
    );


    public function isAuthorized($user) {
        //pr($user);
        //if the prefix is setup, make sure the prefix matches their role
        if( isset($this->params['prefix']) and $this->Auth->user('role_id')==1){
            return true;
        }
    }

    public function beforeFilter() {
        if($this->params['controller']=="pages"){
            $this->Auth->allow();
        }else{
            $this->Auth->allow(array('login','display'));
        }

        if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))) {
            $this->layout = 'admin';
        }

        $this->loadModel('Setting');
        $setting = $this->Setting->findByKey('site_name');
        $this->set('site_name',$setting['Setting']['value']);
    }
}
