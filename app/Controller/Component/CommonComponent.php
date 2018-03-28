<?php
/**
 * Created by PhpStorm.
 * User: mizan
 * Date: 22/10/14
 * Time: 16:53
 */
App::uses('Component', 'Controller');

class CommonComponent extends Component {

    public $components = array('Email','Session');

    public function __construct() {
        $models = array('Setting','Country','Photo');
        foreach($models as $model){
            $this->$model = ClassRegistry::init($model);
        }
    }

    var $controller;

    function startup(Controller $controller ){
        $this->controller = $controller;
    }

    /**
     * @param $upload_directory
     * @param $current_file
     * @return array
     */
    public function fileUp($upload_directory,$current_file) {
        $upload_path = WWW_ROOT . 'uploads' . DS . $upload_directory;
        $current_file_name = $current_file['name'];

        if(!empty($current_file_name)){
            $array_ext=array('jpg','jpeg','gif','png');
            $ext = substr(strtolower(strrchr($current_file_name, '.')), 1); //get the extension
            $invalid_extension = false;
            $file_name = null;
            if(in_array($ext, $array_ext))
            {
                $rename_file = explode(".",$current_file_name);
                $file_name = $rename_file[0].time().'.'.$rename_file[1];

                // Move the image
                move_uploaded_file($current_file['tmp_name'],$upload_path.DS .basename($file_name));

            }else{
                $invalid_extension = true;

            }

        }

        return array('file_name'=>$file_name,'invalid_extension'=>$invalid_extension);
    }




    /*
     * @param $from
     * @param $to
     * @param $subject
     * @param $template
     * @param $emailType
     * @param null $theme
     * @param null $viewVars
     */
    public function sendEmail($from, $to, $subject, $template,$viewVars)
    {
        if($_SERVER['HTTP_HOST']!='localhost'){
            $this->Email->to = $to;
            $this->Email->bcc = $to;
            $this->Email->subject = $subject;
            $this->Email->replyTo =$from[1];
            $this->Email->from = $from[0].'<'.$from[1].'>';
            $this->Email->template =$template;
            $this->Email->sendAs = 'html';
            $this->Email->viewVars=$viewVars;
            //$this->Email->delivery = 'debug';
            $this->Email->send();
        }
    }


    // site settings
    public function settings($key){
        $setting = $this->Setting->find('first',array('conditions'=>array('key'=>$key ) ) );
        return $setting['Setting']['value'];
    }


    //card month and year
    public function ccMonth(){
        $month = date('m');
        $month_array = null;
        while($month<=12){
            if(strlen($month)==1)
                $month = '0'.$month;

            $month_array[$month]=$month;
            $month++;
        }

        return $month_array;
    }

    public function ccYears(){
        $Years = date('Y');
        $upto = $Years+5;
        $year_array = null;
        while($Years<=$upto){
            $year_array[$Years]=$Years;
            $Years++;
        }

        return $year_array;
    }

    // country drop down
    public function Country(){
        $country = $this->Country->find('list');
        $countries = array(''=>'Select');
        foreach($country as $key=>$value){
            $countries[$value] = $value;
        }

        return $countries;
    }

    // count days
    public function countDays($start_date){
        $startTimeStamp = strtotime($start_date);
        $endTimeStamp =   strtotime(date("Y-m-d H:i:s"));

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = $timeDiff/86400;  // 86400 seconds in one day
        return $numberDays;
    }

    // get token
    public function getToken(){
        return String::uuid();
    }

    function getUploadedPhotos($product_id,$root_url){
        $photos = $this->Photo->find('all',array('conditions'=>array('Photo.product_id'=>$product_id),'order'=>array('Photo.id'=>'DESC') ) );

        if(!empty($photos)){
            $html='';
            foreach($photos as $photo){
                $html.='
            <div class="col-md-2">
                <div><a href="javascript:void(0)" onclick="deletePhoto('.$photo['Photo']['id'].','.$product_id.')" title="Delete">X</a></div>
                <div><img src="'.$root_url.'uploads/products/'.$photo['Photo']['name'].'" alt="Photo" width="150" style="border:1px solid #ddd;" /></div>
            </div>';
            }

            return $html;
        }

    }


}

