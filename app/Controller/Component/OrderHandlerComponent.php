<?php
/**
 * Created by PhpStorm.
 * User: mizan
 * Date: 22/10/14
 * Time: 16:53
 */
App::uses('Component', 'Controller');
class OrderHandlerComponent extends Component {

    public $components = array('Session');

    public function getPackage($id=null) {
        $this->Package = ClassRegistry::init('Package');
        $this->Package->recursive=2;
        $package = $this->Package->find('all',array('conditions' => array('id'=>$id)));
        $package = $package[0];
        return $package;
    }


    public function orderPackage($id=null) {
        $this->Package = ClassRegistry::init('Package');
        $this->Package->recursive=2;
        $package = $this->Package->find('all',array('conditions' => array('id'=>$id)));
        //pr($package[0]);
        $package = $package[0];
        if(!empty($package)){
            $i=0;
            $not_required = array('status', 'date_created', 'date_updated');
            foreach($package['ProductPackage'] as $product_package) {

                foreach($product_package['Product'] as $key=>$value) {
                    if($key=='id'){
                        $product_array['OrderProducts'][$i]['product_id']=$value;
                        $product_array['UserProducts'][$i]['product_id']=$value;
                        $product_array['UserProducts'][$i]['quantity']=$product_package['quantity'];
                        $product_array['UserProducts'][$i]['user_id']=1;
                    }else if(!in_array($key, $not_required)){

                        $product_array['OrderProducts'][$i][$key]=$value;
                    }


                }
                $i++;
            }

            $create_package= array(
                'package_id'=>$package['Package']['id'],
                'package_name'=>$package['Package']['name'],
                'package_slug'=>$package['Package']['slug'],
                'package_type'=>$package['Package']['package_type'],
                'package_price'=>$package['Package']['price'],
                'package_photo'=>$package['Package']['photo'],
                'package_description'=>$package['Package']['description'],
            );


            $order= array(
                'Order'=>$create_package,
                'OrderProduct'=>$product_array['OrderProducts'],
                'UserProduct'=>$product_array['UserProducts']
            );


            return $order;
        }
    }




    /**
     * @param $package
     * @param $quantity
     * @return array
     */
    public function calculateProduct($package, $quantity){
        if(!empty($package)){
            $base_price = $package['Package']['price'];
            $package['Package']['price'] = $base_price * $quantity;

            $i=0;
            $not_required = array('status', 'created', 'modified');
            foreach($package['ProductPackage'] as $product_package) {
                $product_quantity = $product_package['quantity'] * $quantity;
                foreach($product_package['Product'] as $key=>$value) {

                    if($key=='id'){
                        $product_array['OrderProducts'][$i]['product_id']=$value;
                    }else if(!in_array($key, $not_required)){
                        $product_array['OrderProducts'][$i][$key]=$value;
                    }
                }
                $product_array['OrderProducts'][$i]['package_id']   = $package['Package']['id'];
                $product_array['OrderProducts'][$i]['quantity']     = $product_quantity;
                $product_array['OrderProducts'][$i]['visibility']   = 1;
                $i++;
            }
            if($package['Package']['package_type']=='Coin'){
                $coin_product       = $this->getProductInfoBySlug('coin');
                $coin_package_id    = $this->getPackageIdBySlug('coin-package');
                foreach($coin_product['Product'] as $key=>$value) {
                    if($key=='id'){
                        $product_array['OrderProducts'][$i]['product_id']=$value;
                    }else if(!in_array($key, $not_required)){
                        $product_array['OrderProducts'][$i][$key]=$value;
                    }
                }
                $product_array['OrderProducts'][$i]['package_id']   = $coin_package_id;
                $product_array['OrderProducts'][$i]['quantity']     = -$package['Package']['price'];
                $product_array['OrderProducts'][$i]['visibility']   = 0;
            }

            $create_package= array(
                'package_id'        =>$package['Package']['id'],
                'quantity'          =>$quantity,
                'name'              =>$package['Package']['name'],
                'description'       =>$package['Package']['description'],
                'slug'              =>$package['Package']['slug'],
                'type'              =>$package['Package']['package_type'],
                'price'             =>$package['Package']['price'],
                'unit_price'        =>$base_price,
                'photo'             =>$package['Package']['photo'],
                'OrderProduct'      =>$product_array['OrderProducts']
            );
            $order= array(
                'OrderPackage'      =>$create_package
            );

            return $order;
        }
    }




    /**
     * @param $user_id
     * @param $cart
     * @return int
     */
    public function checkBalance($user_id, $payment_price ){
        $short_balance = 0;
        $user_model = ClassRegistry::init('User');
        $prefix = $user_model->getDatabasePrefix();
        $sql = "SELECT  SUM(`quantity`) quantity
                        FROM  ".$prefix."user_products UserProduct, ".$prefix."products Product
                      WHERE
                        UserProduct.product_id=Product.id AND
                        UserProduct.user_id=$user_id AND
                        Product.slug ='coin' AND
                        Product.status =1
                    ";

        $result = $user_model->query($sql);
        $current_balance = $result[0][0]['quantity'];
        if($payment_price>$current_balance){
            $short_balance = $payment_price-$current_balance;
        }
        return $short_balance;
    }

    /**
     * @param $user_id
     * @param $cart
     *
     */
    public function setUserDetails($user_id){
        $this->User = ClassRegistry::init('User');
        $user = $this->User->find('first',array('conditions' => array('User.id'=>$user_id,'status'=>1)));
        $user_info = null;
        if(!empty($user)){
            foreach($user['User'] as $key=>$value ){
                $user_info[$key] = $value;
            }

            $this->Session->write('user',$user_info);
        }
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getProductInfoBySlug($slug){
        $user_model = ClassRegistry::init('User');
        $prefix = $user_model->getDatabasePrefix();
        $sql = "SELECT  *
                        FROM  ".$prefix."products Product
                      WHERE
                        Product.slug ='coin'
               ";

        $result = $user_model->query($sql);

        return $result[0];
    }


    /**
     * @return mixed
     */
    public function getDefaultPackage(){
        $package_model = ClassRegistry::init('Package');
        $prefix = $package_model->getDatabasePrefix();
        $sql = "SELECT  slug
                        FROM  ".$prefix."packages Package
                      WHERE
                        Package.default =1
                        LIMIT 1
               ";

        $result = $package_model->query($sql);

        return $result[0]['Package']['slug'];
    }

    /**
     * @param $cart
     * @param $cart_data
     * @return bool
     */
    public function isPackageExist($current_package,$exist_package) {
        $new_package_id = $current_package['OrderPackage']['package_id'];
        $existed_package_id =  $exist_package['OrderPackage']['package_id'];
        if($new_package_id==$existed_package_id)
            $is_exist = true;
        else
            $is_exist = false;


        return $is_exist;
    }

    /**
     * @param $current_package
     * @param $cart_data
     * @return mixed
     */
    public function updateCartData($cart_data, $package, $quantity, $payment) {
        $is_exists = false;
        $current_package_id = $package['Package']['id'];
        if($payment['type']==$package['Package']['package_type']){
            foreach($cart_data as $cart){
               $package_id = $cart['OrderPackage']['package_id'];
               if($current_package_id==$package_id){
                   $is_exists = true;
                   $quantity = $quantity+$cart['OrderPackage']['quantity'];
                   $cart_array['packages'][] = $this->calculateProduct($package,$quantity);
               }else{
                    $cart_array['packages'][] = $cart;
               }
                $packages[]= $cart;
            }
        }
        if(!$is_exists){
            $current_package = $this->calculateProduct($package, $quantity);
            $cart_array['packages'][] = $current_package;
        }

        return $cart_array['packages'];
        //$this->Session->write('Cart.packages',$cart_array['packages']);
    }


    public function isPackageMatch($cart,$cart_data) {

        $is_package_match=true;
        $new_package_type = $cart['Order']['package_type'];
        foreach($cart_data['packages'] as $package){
            $existed_package_type=$package['Order']['package_type'];
            if($new_package_type!=$existed_package_type) {
                $is_package_match=false;
            }
        }

        return $is_package_match;
    }


    /**
     * @param $cart
     * @return array
     */
    public  function getPaymentInfo($cart){
        //debug($cart);die;
        $payment_price = null;
        foreach($cart as $cart_info) {

            $payment_price+= $cart_info['OrderPackage']['unit_price']*$cart_info['OrderPackage']['quantity'];
            $package_type = $cart_info['OrderPackage']['type'];
        }

        $package_payment = array(
            'price'             =>$payment_price,
            'type'              =>$package_type
        );

        return $package_payment;
    }

    public function addCartData($package, $quantity) {
        $cart_array = array();
        $current_package = $this->calculateProduct($package, $quantity);
        $cart_array['packages'][0] = $current_package;
        return $cart_array['packages'];
        //$this->Session->write('Cart.packages',$cart_array['packages']);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getPackageIdBySlug($slug){
        $user_model = ClassRegistry::init('User');
        $prefix = $user_model->getDatabasePrefix();
        $sql = "SELECT  id
                        FROM  ".$prefix."packages Package
                      WHERE
                        Package.slug ='".$slug."'
               ";

        $result = $user_model->query($sql);
        return $result[0]['Package']['id'];
    }


    /**
     * @param $username
     * @param $password
     * @return null
     */
    public function getUserDetails($email,$password=null){
        if($password){
            $password_hashed = AuthComponent::password($password,null, true); // hashing password
            $condition = array('email'=>$email,'password'=>$password_hashed,'status'=>1);
        }else{
            $condition = array('email'=>$email,'status'=>1);
        }

        $this->User = ClassRegistry::init('User');

        $user = $this->User->find(
            'first',
            array(
                'fields'=>array(
                    'id',
                    'first_name',
                    'last_name',
                    'phone',
                    'address_line1',
                    'address_line2',
                    'city',
                    'state',
                    'zip',
                    'country',
                    'email',
                    'password',
                    'username',
                    'photo'
                ),
                'conditions' => $condition
            )
        );

        $user_info = null;
        if($user){
            foreach($user['User'] as $key=>$value ){
                if($key=='password'){
                    $user_info[$key] = $value;
                }else{
                    $user_info[$key] = $value;
                }
            }
        }

        return $user_info;
    }

    /**
     * generate api order data for single package
     * @param $package_name
     * @param null $total_price
     * @param null $quantity
     * @return bool
     */
    public function generateApiOrderData($slug,$quantity=null){
        if(!empty($slug)){
            $this->Package = ClassRegistry::init('Package');
            $this->Package->recursive=2;
            $package = $this->Package->findBySlugAndStatus($slug,0);

            //$this->log($package,'debug');
            //pr($package);die;

            $OrderPackage = array(
                'OrderPackage'=>array(
                    'package_id'        => $package['Package']['id'],
                    'quantity'          => $quantity,
                    'name'              => $package['Package']['name'],
                    'description'       => $package['Package']['description'],
                    'slug'              => $package['Package']['slug'],
                    'type'              => $package['Package']['package_type'],
                    'price'             => $package['Package']['price']*$quantity,
                    'unit_price'        => $package['Package']['price'],
                    'photo'             => $package['Package']['photo']
                    )
                );

            if($package['ProductPackage']){
                $product_array = array();
                foreach($package['ProductPackage'] as $products){
                        $product_array = array(
                            'product_id'         => $products['Product']['id'],
                            'slug'               => $products['Product']['slug'],
                            'name'               => $products['Product']['name'],
                            'price'              => $products['Product']['price'],
                            'product_type'       => $products['Product']['product_type'],
                            'photo'              => $products['Product']['photo'],
                            'description'        => $products['Product']['description'],
                            'has_udid'           => $products['Product']['has_udid'],
                            'package_id'         => $products['package_id'],
                            'quantity'           => $products['quantity'],
                            'visibility'         => 1
                        );
                    $OrderPackage['OrderPackage']['OrderProduct'][]=$product_array;

                }
            }

            $cart['packages'][0] = $OrderPackage;
            $cart['payment']['price'] = $package['Package']['price']*$quantity;
            $cart['payment']['type'] =  $package['Package']['package_type'];

            //pr($cart);die;

            return $cart;
        }else{
            return false;
        }
    }

}

