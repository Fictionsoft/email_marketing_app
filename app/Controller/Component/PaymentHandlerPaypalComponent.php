<?php
/**
 * Created by PhpStorm.
 * User: mizan
 * Date: 22/10/14
 * Time: 16:53
 */
App::uses('Component', 'Controller');
class PaymentHandlerPaypalComponent extends Component {

    public $components = array('Email','Session');

    // pay pal function
    public function PayPalBuyNowButtonCustom(
        $PayPalGateway="https://www.sandbox.paypal.com/cgi-bin/webscr",
        $Command="_cart",
        $BusinessEmail="",
        $Item=array(
            array("Name"=>"Test item A", "Code"=>"000001", "UnitPrice"=>0.02, "Quantity"=>1, "UseShippingCost"=>false, "ShippingCost"=>0, "UseHandlingCost"=>false, "HandlingCost"=>0),
            array("Name"=>"Test item B", "Code"=>"000002", "UnitPrice"=>0.01, "Quantity"=>2, "UseShippingCost"=>false, "ShippingCost"=>0, "UseHandlingCost"=>false, "HandlingCost"=>0)
        ),
        $CurrencyCode="",
        $UseShippingCost=true,
        $ShippingCost=0,
        $NoShippingAddress=false,
        $UseHandlingCost=true,
        $HandlingCost=0,
        $TAX=0,
        $NotificationURL="",
        $ReturnURLOnSuccess="",
        $ReturnURLOnFailure="",
        $ButtonCaption="Proceed to payment",
        $ImageButtonSource= "images/buyNow.gif",
        $ExtraOption=array(
            array(
                "Type"=>"Select",
                "Caption"=>"Color",
                "Item"=>array(
                    array("Caption"=>"Grey", "Value"=>"Grey"),
                    array("Caption"=>"Pink", "Value"=>"Pink"),
                    array("Caption"=>"Blue", "Value"=>"Blue"),
                    array("Caption"=>"Yellow", "Value"=>"Yellow")
                )
            ),
            array("Type"=>"Text", "Caption"=>"Note")
        ),
        $NoteCaption="",
        $NoNote=true,
        $Custom="",
        $InvoiceNumber="",
        $ReturnToMerchantButtonCaption="Please click here to complete the process",
        $SimulationMode=false
    ){
        $ItemHTML=$ShippingCostHTML=$HandlingCostHTML=$ButtonHTML=$ImageButtonHTML=$ExtraOptionHTML=$CommandCartHTML="";
        $ItemCounter=$ExtraOptionCounter=0;

        if($Command=="_cart")$CommandCartHTML="<input type=\"hidden\" name=\"upload\" value=\"1\">";

        foreach($Item as $ThisItem){
            $ItemCounter++;
            if($ThisItem["Code"]!="")$ItemHTML.="<input type=\"hidden\" name=\"item_number_$ItemCounter\" value=\"{$ThisItem["Code"]}\">";
            $ItemHTML.="
				<input type=\"hidden\" name=\"item_name_$ItemCounter\" value=\"{$ThisItem["Name"]}\">
		        <input type=\"hidden\" name=\"amount_$ItemCounter\" value=\"{$ThisItem["UnitPrice"]}\">
		        <input type=\"hidden\" name=\"quantity_$ItemCounter\" value=\"{$ThisItem["Quantity"]}\">
			";
            if($ThisItem["UseShippingCost"])$ItemHTML.="<input type=\"hidden\" name=\"shipping_$ItemCounter\" value=\"{$ThisItem["ShippingCost"]}\">";
            if($ThisItem["UseHandlingCost"])$ItemHTML.="<input type=\"hidden\" name=\"handling_$ItemCounter\" value=\"{$ThisItem["HandlingCost"]}\">";
        }

        if($UseShippingCost)$ShippingCostHTML="<input type=\"hidden\" name=\"shipping\" value=\"$ShippingCost\">";
        if($NoShippingAddress){$NoShippingAddress=1;}else{$NoShippingAddress=0;}
        if($UseHandlingCost)$HandlingCostHTML="<input type=\"hidden\" name=\"handling\" value=\"$HandlingCost\">";

        if($ButtonCaption!="")$ButtonHTML="<div style=\"margin: 0 0 10px; width: 100%;\"><div style=\"margin: auto; width: 83%;\"><input id=\"paypalBuyButton\" SRC=\"images/buyNow.gif\" type=\"image\" BORDER=\"0\" ALT=\"\"></div></div>";
        if($ImageButtonSource!="")$ImageButtonHTML="<input type=\"submit\" value=\"$ImageButtonSource\">";

        foreach($ExtraOption as $ThisExtraOption){
            $ExtraOptionCounter++;
            if($ThisExtraOption["Type"]=="Text")$ExtraOptionHTML.="<tr valign=\"middle\"><td><input type=\"hidden\" name=\"on".($ExtraOptionCounter-1)."\" value=\"{$ThisExtraOption["Caption"]}\">{$ThisExtraOption["Caption"]}</td><td><input type=\"text\" name=\"os".($ExtraOptionCounter-1)."\" maxlength=\"200\"></td></tr>";
            if($ThisExtraOption["Type"]=="Select"){
                $ExtraOptionHTML.="<tr valign=\"middle\"><td><input type=\"hidden\" name=\"on".($ExtraOptionCounter-1)."\" value=\"{$ThisExtraOption["Caption"]}\">{$ThisExtraOption["Caption"]}</td><td><select name=\"os".($ExtraOptionCounter-1)."\">";
                foreach($ThisExtraOption["Item"] as $ThisItem)$ExtraOptionHTML.="<option value=\"{$ThisItem["Value"]}\">{$ThisItem["Caption"]}</option>";
                $ExtraOptionHTML.="</select></td></tr>";
            }
        }
        if(count($ExtraOption)>0)$ExtraOptionHTML="<table>$ExtraOptionHTML</table>";

        if($NoNote){$NoNote=1;}else{$NoNote=0;}

        $HTML="
			<form id=\"checkout\" target=\"_parent\" action=\"$PayPalGateway\" method=\"post\">
				<input type=\"hidden\" name=\"bn\" value>
				<input type=\"hidden\" name=\"cmd\" value=\"$Command\">
				$CommandCartHTML
				<input type=\"hidden\" name=\"business\" value=\"$BusinessEmail\">
                $ItemHTML
				$ShippingCostHTML
				<input type=\"hidden\" name=\"no_shipping\" value=\"$NoShippingAddress\">
				$HandlingCostHTML
				<input type=\"hidden\" name=\"tax\" value=\"$TAX\">
				$ExtraOptionHTML
				<input type=\"hidden\" name=\"cn\" value=\"$NoteCaption\">
				<input type=\"hidden\" name=\"no_note\" value=\"$NoNote\">
				<input type=\"hidden\" name=\"custom\" value=\"$Custom\">
				<!--<input type=\"hidden\" name=\"invoice\" value=\"$InvoiceNumber\">-->
				<input type=\"hidden\" name=\"currency_code\" value=\"$CurrencyCode\">
				<input type=\"hidden\" name=\"rm\" value=\"1\"><!-- Use GET method to return to merchant's site -->
				<input type=\"hidden\" name=\"notify_url\" value=\"$NotificationURL\">
				<input type=\"hidden\" name=\"return\" value=\"$ReturnURLOnSuccess\">
				<input type=\"hidden\" name=\"cancel_return\" value=\"$ReturnURLOnFailure\">

				$ButtonHTML
				$ImageButtonHTML
			</form>
		";

        if($SimulationMode)$HTML.="Simulate: <a href=\"$ReturnURLOnSuccess\" onclick=\"window.open('$NotificationURL');\">Success</a> or <a href=\"$ReturnURLOnFailure\">Cancel</a><br>(JavaScript must be enabled in order to allow the IPN to work)";

        return $HTML;
    }

}

