<?php
App::import('Vendor', 'PhpMailer', array('file' => 'PHPMailer' . DS . 'PHPMailerAutoload.php'));
App::import('Vendor', 'checkEmail', array('file' => 'checkEmail' . DS . 'autoload.php' ));


class EmailHandlerComponent extends PHPMailer{
    // phpmailer
    var $Mailer = 'smtp'; // choose 'sendmail', 'mail', 'smtp'
    var $unhtml_bin = '/usr/bin/unhtml';

    // component
    var $controller;

    function startup( &$controller )
    {

        $this->controller = &$controller;
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $this->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $this->Debugoutput = 'html';

        $this->IsHTML(true);

        //Set the hostname of the mail server
        $this->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $this->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $this->SMTPAuth = true;

        $mode = Configure::read('Mode');

        if(strtolower($mode)=='live'){
            $this->Username = "mizan92cse@gmail.com";
            $this->Password = "Password0022";
            
        }else{
            $this->Username = "mizan92cse@gmail.com";
            $this->Password = "Password0022";

        }


    }

    function beforeRender(){

        Configure::write('debug',0);

    }

    function isNotDisposable($email=null){ // true: not disposable, false: disposable
        $checker = new \EmailChecker\EmailChecker();

        return $checker->isValid($email);
    }


    function renderBody($view)
    {

        // render the view and use its output to set the body text of the email
        $this->Body = $this->controller->render('/Emails/html/' . $view);

        // reset the output of the controller
        $this->controller->output = '';

        // create plain text version of the email
        // create temporary files
        $html_file = tempnam(TMP, 'html_file');
        $text_file = tempnam(TMP, 'text_file');

        // write html to temporary file
        file_put_contents($html_file, $this->Body);

        // convert the html file to plain text
        //$cmd = "cat $html_file | $this->unhtml_bin > $text_file";
        //system($cmd);

        // set the plain text body of the email
        $this->AltBody = file_get_contents($text_file);

        // remove temporary files
        unlink($html_file);
        unlink($text_file);
    }



    function submit($info){

        if(!empty($info['to'])) {

            $email_from = (!empty($info['email_form'])) ? $info['email_form'] : $this->controller->Common->settings('site_email');

            $site_name = $this->controller->Common->settings('site_name');


            $smtp = Configure::read('SMTP');

            $reply_to = $email_from;


            $info['view_var']['site_name'] = $site_name;
            $email_bcc = (!empty($info['email_bcc'])) ? $info['email_bcc'] : $info['to'];

            $email_status = false;

            if ($smtp == true) {

                $this->controller->layout = 'ajax';
                $this->controller->set('data', $info['view_var']);

                // the email content is just a (html) view in app/views/{controller}/emails/testmail.ctp
                $this->renderBody($info['email_template']);


                // subject
                $this->Subject = $info['subject'];

                //Set who the message is to be sent to
                $this->addAddress($info['to']);


                //Set who the message is to be sent from
                $this->setFrom($email_from, $site_name);


                //Set an alternative reply-to address
                $this->addReplyTo($reply_to, $site_name);


                // send!
                $email_status = $this->Send();

                $this->controller->layout = 'default';

            } else {

                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    $this->controller->Email->to = $info['to'];
                    $this->controller->Email->bcc = $email_bcc;
                    $this->controller->Email->subject = $info['subject'];
                    $this->controller->Email->replyTo = $reply_to;
                    $this->controller->Email->from = $site_name . '<' . $email_from . '>';
                    $this->controller->Email->template = $info['email_template'];
                    $this->controller->Email->sendAs = 'html';
                    $this->controller->set('data', $info['view_var']);
                    //$this->Email->delivery = 'debug';
                    $email_status = $this->controller->Email->send();
                }
            }

            $info['is_email_sent'] = $email_status;

            //$this->__createEmailoLog($info);

            return $email_status;

        }else{
            return false;
        }
    }



    public function reset() {
        $this->template = null;
        $this->to = array();
        $this->from = null;
        $this->replyTo = null;
        $this->return = null;
        $this->cc = array();
        $this->bcc = array();
        $this->subject = null;
        $this->additionalParams = null;
        $this->date = null;
        $this->attachments = array();
        $this->htmlMessage = null;
        $this->textMessage = null;
        $this->messageId = true;
        $this->delivery = 'mail';
    }

    /**
     * Variables to be set on render
     *
     * @param array $viewVars Variables to set for view.
     * @return array|$this
     */
    public function viewVars($viewVars = null) {
        if ($viewVars === null) {
            return $this->_viewVars;
        }
        $this->_viewVars = array_merge($this->_viewVars, (array)$viewVars);
        return $this;
    }

     public function initialize() {}
     public function shutdown() {}
     public function beforeRedirect() {}

    function __createEmailoLog($params){

        $file_name = 'log_'.$params['to'].'_'.time();

        CakeLog::config('emails', array(
            'engine' => 'File',
            'file' => 'emails/'.$file_name,
        ));

        $result = print_r($params,true);

        CakeLog::write($file_name,$result);
    }

    

    function error_notification_email($info){
        if ($_SERVER['HTTP_HOST'] != 'localhost') {

            $site_name = $this->controller->Common->settings('site_name');
            if(empty($site_name)){
                $site_name = 'Carhood';
            }

            $email_from = $this->controller->Common->settings('site_email');
            if(empty($email_from)){
                $email_from = 'support@carhood.com.au';
            }
            

            $this->controller->Email->to = array('mizan@bitmascot.com','bakar@bitmascot.com','mizanur@bitmascot.com','alvee@bitmascot.com');
            
            $this->controller->Email->bcc = 'mizan@bitmascot.com';
            $this->controller->Email->subject = $info['subject'];
            $this->controller->Email->replyTo = $email_from;
            $this->controller->Email->from = $site_name . '<' . $email_from . '>';
            $this->controller->Email->template = $info['email_template'];
            $this->controller->Email->sendAs = 'html';
            $this->controller->set('data', $info['view_var']);
            $email_status = $this->controller->Email->send();
            return $email_status;

            /*$Email = new CakeEmail();
            $Email->from(array($email_from => $site_name));
            $Email->to(array('mizan@bitmascot.com','mizan92cse@yahoo.com'));
            $Email->subject($info['subject']);
            $this->controller->set('data', $info['view_var']);
            $Email->template($info['email_template']);
            $Email->emailFormat('html');
            $Email->send();*/

        }
    }


    function fileToArray($file_path, $upload_file_id) {
        $string = file_get_contents($file_path); // Load text file contents
        $string = explode("\n",$string);

        $string_to_array = $this->formattedData($string, $upload_file_id);
        return $string_to_array;
    }

    function formattedData($lines, $upload_file_id) {
        $new_array = array();

        if($lines) {
            foreach ($lines as $line) {
                $line_array = explode(',', $line);


                $i = 1;
                $tmp_array = array();
                foreach($line_array as $key => $value){

                    if($i==1 and trim($value)!='' ){
                        $tmp_array['email'] = $value;
                        $tmp_array['upload_file_id'] = $upload_file_id;

                    }elseif($i==2) {
                        $tmp_array['first_name'] = $value;

                    }elseif($i==3) {
                        $tmp_array['last_name'] = $value;

                    }elseif($i==4) {
                        $tmp_array['fb_link'] = $value;
                    }

                    $i++;
                }

                if($tmp_array){
                    $new_array[] = $tmp_array;
                }

            }
        }

        return $new_array;
    }

    function is_user_available($email, $is_update_mode= false){
        $this->controller->autoRender = false;

        if($is_update_mode){
            $user = '';
        }else{
            $user = $this->controller->User->findByEmail($email);
        }

        if(empty($user)){
            $is_not_disposable = $this->isNotDisposable($email);

            if($is_not_disposable) {
                //$result = $this->validateEmailSmtp($email, 'info@amzrockets.com', false);

                //pr($result);die;

                $result = $this->domain_exists($email);
                if ($result === true) {
                    $status = true;
                    $msg = 'Valid';

                } else {
                    $status = false;
                    $msg = 'Email account does not exist';
                }

            }else{
                $status = false;
                $msg = 'Email address is disposable';
            }

        }else{
            $status = false;
            $msg = 'Email already used';
        }

        return array('status' => $status, 'msg' => $msg );
    }

    function domain_exists($email, $record = 'MX'){
        list($user, $domain) = explode('@', $email);
        return checkdnsrr($domain, $record);
    }

    function validateEmailSmtp($email, $probe_address="", $debug=false) {
        # --------------------------------
        # function to validate email address
        # through a smtp connection with the
        # mail server.
        # by Giulio Pons
        # http://www.barattalo.it
        # --------------------------------
        $output = "";
        # --------------------------------
        # Check syntax with regular expression
        # --------------------------------

        if (!$probe_address) $probe_address = $_SERVER["SERVER_ADMIN"];
        if (preg_match('/^([a-zA-Z0-9\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $email, $matches)) {

            $user = $matches[1];
            $domain = $matches[2];
            # --------------------------------
            # Check availability of DNS MX records
            # --------------------------------
            if (function_exists('checkdnsrr')) {
                # --------------------------------
                # Construct array of available mailservers
                # --------------------------------
                if(getmxrr($domain, $mxhosts, $mxweight)) {
                    for($i=0;$i<count($mxhosts);$i++){
                        $mxs[$mxhosts[$i]] = $mxweight[$i];
                    }
                    asort($mxs);
                    $mailers = array_keys($mxs);
                } elseif(checkdnsrr($domain, 'A')) {
                    $mailers[0] = gethostbyname($domain);
                } else {
                    $mailers=array();
                }
                $total = count($mailers);


                # --------------------------------
                # Query each mailserver
                # --------------------------------
                if($total > 0) {

                    # --------------------------------
                    # Check if mailers accept mail
                    # --------------------------------
                    for($n=0; $n < $total; $n++) {
                        # --------------------------------
                        # Check if socket can be opened
                        # --------------------------------
                        if($debug) { $output .= "Checking server $mailers[$n]...\n";}
                        $connect_timeout = 2;
                        $errno = 0;
                        $errstr = 0;
                        # --------------------------------
                        # controllo probe address
                        # --------------------------------
                        if (preg_match('/^([a-zA-Z0-9\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $probe_address,$fakematches)) {
                            $probe_domain = str_replace("@","",strstr($probe_address, '@'));

                            # --------------------------------
                            # Try to open up socket
                            # --------------------------------
                            if($sock = @fsockopen($mailers[$n], 25, $errno , $errstr, $connect_timeout)) {
                                $response = fgets($sock);
                                if($debug) {$output .= "Opening up socket to $mailers[$n]... Success!\n";}
                                stream_set_timeout($sock, 5);
                                $meta = stream_get_meta_data($sock);
                                if($debug) { $output .= "$mailers[$n] replied: $response\n";}
                                # --------------------------------
                                # Be sure to set this correctly!
                                # --------------------------------
                                $cmds = array(
                                    "HELO $probe_domain",
                                    "MAIL FROM: <$probe_address>",
                                    "RCPT TO: <$email>",
                                    "QUIT",
                                );
                                # --------------------------------
                                # Hard error on connect -> break out
                                # --------------------------------
                                if(!$meta['timed_out'] && !preg_match('/^2\d\d[ -]/', $response)) {
                                    $codice = trim(substr(trim($response),0,3));
                                    if ($codice=="421") {
                                        //421 #4.4.5 Too many connections to this host.
                                        $error = $response;
                                        break;
                                    } else {
                                        if($response=="" || $codice=="") {
                                            //c'è stato un errore ma la situazione è poco chiara
                                            $codice = "0";
                                        }
                                        $error = "Error: $mailers[$n] said: $response\n";
                                        break;
                                    }
                                    break;
                                }
                                foreach($cmds as $cmd) {
                                    $before = microtime(true);
                                    fputs($sock, "$cmd\r\n");
                                    $response = fgets($sock, 4096);
                                    $t = 1000*(microtime(true)-$before);
                                    if($debug) {$output .= "$cmd\n$response" . "(" . sprintf('%.2f', $t) . " ms)\n";}
                                    if(!$meta['timed_out'] && preg_match('/^5\d\d[ -]/', $response)) {
                                        $codice = trim(substr(trim($response),0,3));
                                        if ($codice<>"552") {
                                            $error = "Unverified address: $mailers[$n] said: $response";
                                            break 2;
                                        } else {
                                            $error = $response;
                                            break 2;
                                        }
                                        # --------------------------------
                                        // il 554 e il 552 sono quota
                                        // 554 Recipient address rejected: mailbox overquota
                                        // 552 RCPT TO: Mailbox disk quota exceeded
                                        # --------------------------------
                                    }
                                }
                                fclose($sock);
                                if($debug) { $output .= "Succesful communication with $mailers[$n], no hard errors, assuming OK\n";}
                                break;
                            } elseif($n == $total-1) {
                                $error = "None of the mailservers listed for $domain could be contacted";
                                $codice = "0";
                            }
                        } else {
                            $error = "Il probe_address non è una mail valida.";
                        }
                    }

                } elseif($total <= 0) {
                    $error = "No usable DNS records found for domain '$domain'";
                }
            }

        } else {
            $error = 'Address syntax not correct';
        }

        if($debug) {
            print nl2br(htmlentities($output));
        }

        if(!isset($codice)) {$codice="n.a.";}

        if(isset($error)) return array($error,$codice); else return true;
    }
}

