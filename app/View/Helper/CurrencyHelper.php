<?php
/**
 * Helper for Currency operations.
 *
 *
 */

/**
 * Currency helper library.
 *
 * Helps doing AJAX using the Prototype library.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 */
class CurrencyHelper extends AppHelper {
/**
 * Included helpers.
 *
 * @var array
 */
	var $helpers = array('Html', 'Form', 'Javascript');
    function showCurrency($type) {
        $currency = '';
        if (isset($type)) {
            if($type=='Dollar')
                $currency = '$';

            else if($type=='Coin')
               $currency = "<i class='fa fa-dot-circle-o'></i> &nbsp;";
        }
        return $currency;
    }

}

