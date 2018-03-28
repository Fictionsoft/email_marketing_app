<?php
/**
 * Created by PhpStorm.
 * User: mizan
 * Date: 22/10/14
 * Time: 16:53
 */
App::uses('Component', 'Controller');
class ApiLoginHandlerComponent extends Component {
    public $components = array('Session');

    /**
     * @return RFC
     */
    public function generateToken(){
        return String::uuid();
    }

    /**
     * @param $email
     * @param $token
     */
    public function addToken($email,$old_token,$new_token){
        $this->UserToken = ClassRegistry::init('UserToken');
        $token = $this->UserToken->findByEmailAndToken($email,$old_token);
        if(!empty($token))
        $user_token['UserToken']['id'] = $token['UserToken']['id'];

        $user_token['UserToken']['token'] = $new_token;
        $user_token['UserToken']['email'] = $email;

       $this->UserToken->create();
       $this->UserToken->save($user_token);
    }

    /**
     * @param $email
     * @param $login_duration
     */
    public function isValidToken($email,$old_token,$new_token){
        $this->UserToken = ClassRegistry::init('UserToken');
        $token = $this->UserToken->findByEmailAndToken($email,$old_token);
        //pr($token);die;

        if(!empty($token))
            return $this->__updateToken($token['UserToken']['id'],$new_token);
        else
            return false;

    }

    /**
     * @param $email
     */
    public function destroyToken($old_token){
        $this->UserToken = ClassRegistry::init('UserToken');
        $token = $this->UserToken->findByToken($old_token);
        if(!empty($token)){
            if($this->UserToken->delete($token['UserToken']['id'])){
                //Successfully logged out
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    /**
     * @param $email
     */
    public function __updateToken($id,$new_token){
        $this->UserToken = ClassRegistry::init('UserToken');
        $user_token = array(
            'UserToken'=>array(
                'token'=>$new_token,
                'id'=>$id
            )
        );

        $this->UserToken->create();
        return $this->UserToken->save($user_token);

    }
}

