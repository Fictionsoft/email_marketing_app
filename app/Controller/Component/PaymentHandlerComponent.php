<?php
/**
 * Created by PhpStorm.
 * User: mizan
 * Date: 22/10/14
 * Time: 16:53
 */
App::uses('Component', 'Controller');
class PaymentHandlerComponent extends Component {
    public $components = array('Session');

    /**
     * check payment info
     * @return bool
     */
    public function checkPayment($credit_card) {
        $cart = $this->Session->read('Cart');
        $user = $this->Session->read('user');

        //pr($credit_card);
        //pr($cart); die;

        $price = $cart['payment']['price'];

        $curlUrl = "https://www.eway.com.au/gateway_cvn/xmltest/testpage.asp";
        //$curlUrl = "https://www.eway.com.au/gateway_cvn/xmlpayment.asp";
        $eWaySOAPActionURL = "https://www.eway.com.au/gateway/managedpayment";
        $eWayCustomerId = "87654321"; /* test account */
        //$eWayCustomerId = "17473872"; /* ashiq sir account */
        $eWayTotalAmount = $price * 100; // $price; /* 1$ = 100 cent */


        $ewayCustomerEmail = trim($user['email']);

        $ewayCardNumber = trim($credit_card['ccnumber']);
        $ewayCustomerFirstName = trim($user['first_name']);
        $ewayCustomerLastName = trim($user['last_name']);
        $ewayCustomerAddress = trim($user['address_line1']);

        if(strlen($user['address_line2'])>0){
            $ewayCustomerAddress .=' '.$user['address_line2'];
        }
        $ewayCardHoldersName = trim($credit_card['ccname']);
        $ewayCardExpiryMonth = trim($credit_card['month']);
        $ewayCardExpiryYear = trim($credit_card['year']);
        $ewayCVN = trim($credit_card['cvnumber']);

        $directXML = "<ewaygateway>".
            "<ewayCustomerID>".$eWayCustomerId."</ewayCustomerID>".
            "<ewayTotalAmount>".$eWayTotalAmount."</ewayTotalAmount>".
            "<ewayCustomerFirstName>".$ewayCustomerFirstName."</ewayCustomerFirstName>".
            "<ewayCustomerLastName>".$ewayCustomerLastName."</ewayCustomerLastName>".
            "<ewayCustomerEmail>".$ewayCustomerEmail."</ewayCustomerEmail>".
            "<ewayCustomerAddress>".$ewayCustomerAddress."</ewayCustomerAddress>".
            "<ewayCustomerPostcode></ewayCustomerPostcode>".
            "<ewayCustomerInvoiceDescription></ewayCustomerInvoiceDescription>".
            "<ewayCustomerInvoiceRef> Invoice Reference </ewayCustomerInvoiceRef>".
            "<ewayCardHoldersName>".$ewayCardHoldersName."</ewayCardHoldersName>".
            "<ewayCardNumber>".$ewayCardNumber."</ewayCardNumber>".
            "<ewayCardExpiryMonth>".$ewayCardExpiryMonth."</ewayCardExpiryMonth>".
            "<ewayCardExpiryYear>".$ewayCardExpiryYear."</ewayCardExpiryYear>".
            "<ewayCVN>".$ewayCVN."</ewayCVN>".
            "<ewayTrxnNumber></ewayTrxnNumber>".
            "<ewayOption1></ewayOption1>".
            "<ewayOption2></ewayOption2>".
            "<ewayOption3></ewayOption3>".
            "</ewaygateway>";

        $result = $this->__makeCurlCall(
            $curlUrl, /* CURL URL */
            "POST", /* CURL CALL METHOD */
            array( /* CURL HEADERS */
                "Content-Type: text/xml; charset=utf-8",
                "Accept: text/xml",
                "Pragma: no-cache",
                "SOAPAction: ".$eWaySOAPActionURL,
                "Content_length: ".strlen(trim($directXML))
            ),
            null, /* CURL GET PARAMETERS */
            $directXML /* CURL POST PARAMETERS AS XML */
        );

        //pr($result);die;

        if($result != null && isset($result["response"])) {
            $response = new SimpleXMLElement($result["response"]);
            $response = $this->__simpleXMLToArray($response);
            if(isset($response['ewayTrxnStatus']) && $response['ewayTrxnStatus']=='True'){
                $order_data_response['ewayTrxnStatus']  = $response['ewayTrxnStatus'];
                $order_data_response['ewayTrxnNumber']  = $response['ewayTrxnNumber'];
                $order_data_response['ewayAuthCode']    = $response['ewayAuthCode'];
                return $order_data_response;
            }else{
                return false;
            }
        }

        return false;
    }


    public function __makeCurlCall($url, $method = "GET", $headers = null, $gets = null, $posts = null) {
        $ch = curl_init();
        if($gets != null)
        {
            $url.="?".(http_build_query($gets));
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if($posts != null)
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
        }
        if($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
        } else if($method == "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        } else if($method == "HEAD") {
            curl_setopt($ch, CURLOPT_NOBODY, true);
        }
        if($headers != null && is_array($headers))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        curl_close($ch);
        return array(
            "code" => $code,
            "response" => $response
        );
    }

    public function __simpleXMLToArray(\SimpleXMLElement $xml,$attributesKey=null,$childrenKey=null,$valueKey=null)
    {

        if($childrenKey && !is_string($childrenKey)){
            $childrenKey = '@children';
        }
        if($attributesKey && !is_string($attributesKey)){
            $attributesKey = '@attributes';
        }
        if($valueKey && !is_string($valueKey)){
            $valueKey = '@values';
        }

        $return = array();
        $name = $xml->getName();
        $_value = trim((string)$xml);
        if(!strlen($_value)){
            $_value = null;
        };

        if($_value!==null){
            if($valueKey){
                $return[$valueKey] = $_value;
            }
            else{$return = $_value;
            }
        }

        $children = array();
        $first = true;
        foreach($xml->children() as $elementName => $child){
            $value = $this->__simpleXMLToArray($child,$attributesKey, $childrenKey,$valueKey);
            if(isset($children[$elementName])){
                if(is_array($children[$elementName])){
                    if($first){
                        $temp = $children[$elementName];
                        unset($children[$elementName]);
                        $children[$elementName][] = $temp;
                        $first=false;
                    }
                    $children[$elementName][] = $value;
                }else{
                    $children[$elementName] = array($children[$elementName],$value);
                }
            }
            else{
                $children[$elementName] = $value;
            }
        }
        if($children){
            if($childrenKey){
                $return[$childrenKey] = $children;
            }
            else{$return = array_merge($return,$children);
            }
        }

        $attributes = array();
        foreach($xml->attributes() as $name=>$value){
            $attributes[$name] = trim($value);
        }
        if($attributes){
            if($attributesKey){
                $return[$attributesKey] = $attributes;
            }
            else{
                if (!is_array($return)) {
                    $return = array('returnValue' => $return);
                }
                $return = array_merge($return, $attributes);
            }
        }

        return $return;
    }

}

