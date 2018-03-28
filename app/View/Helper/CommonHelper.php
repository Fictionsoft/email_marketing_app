<?php
/**
 * Helper for Common
 *
 *
 */
class CommonHelper extends AppHelper {
/**
 * Included helpers.
 *
 * @var array
 */
	var $helpers = array('Html', 'Form', 'Javascript');

    function generateFaqQuestions($faq_category) {
        $html = '<h3> <a href="#'.$faq_category['FaqCategory']['slug'].'">'.$faq_category['FaqCategory']['name'].'</a></h3>';
        foreach( $faq_category['Faq'] as $faq) {

            if( $faq['status'] == 1 ) {
                $html .='<div><a href="#'.$faq['slug'].'">'.$faq['question'].'</a></div>';
            }
        }

        return $html;
    }

    function generateFaqAnswers($faq_category) {
        $html = '<h3 id="'.$faq_category['FaqCategory']['slug'].'">'.$faq_category['FaqCategory']['name'].'</h3>';
        if(!empty($faq_category['FaqCategory']['note'])){
            $html .= '<p>'.$faq_category['FaqCategory']['note'].'</p>';
        }
        foreach( $faq_category['Faq'] as $faq) {

            if( $faq['status'] == 1 ) {
                $html .='
                        <li id="'.$faq['slug'].'">'.$faq['question'].'</li>
                        <p>'.nl2br($faq['answer']).'</p>
                        ';
            }
        }

        return $html;
    }


    function getDateTime( $get_date_time ){
        return date( 'd/m/Y  h:i A', strtotime( $get_date_time ) );
    }

    function getDate( $get_date ){
        return date('d/m/Y', strtotime($get_date));
    }



}

