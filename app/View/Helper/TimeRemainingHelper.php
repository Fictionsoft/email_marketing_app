<?php
/**
 * Helper for time remaining.
 *
 *
 */
class TimeRemainingHelper extends AppHelper {
/**
 * Included helpers.
 *
 * @var array
 */
	var $helpers = array('Html', 'Form', 'Javascript');

    function getRemainingTime($date) {

        $timeshift=0;
        $start_date = strtotime('now');
        $end_date = $date;

        $time = $end_date - $start_date;

        if($time<0 && $time>= -3599) {
            // - Minutes
            $pmin = ($start_date - $end_date) / 60;
            $premin = explode('.', $pmin);
            $timeshift = '-'.$premin[0].' min ';

        }elseif($time<= -3600 && $time>= -86399){
            //- Hour, Minutes
            $phour = ($start_date - $end_date) / 3600;
            $prehour = explode('.',$phour);

            $premin = $phour-$prehour[0];
            $min = explode('.',$premin*60);
            $timeshift = '-'.$prehour[0].' hrs '.$min[0].' min ';

        }elseif($time <= -86400) {
            // - Days, Hours,  Minutes
            $pday = ($start_date - $end_date) / 86400;
            $preday = explode('.',$pday);

            $phour = $pday-$preday[0];
            $prehour = explode('.',$phour*24);

            $premin = ($phour*24)-$prehour[0];
            $min = explode('.',$premin*60);

            $timeshift = '-'.$preday[0].' days '.$prehour[0].' hrs '.$min[0].' min ';

        }elseif($time>=0 && $time<=59) {
            // Seconds
            $timeshift = '0 min ';

        } elseif($time>=60 && $time<=3599) {
            // Minutes + Seconds
            $pmin = ($end_date - $start_date) / 60;
            $premin = explode('.', $pmin);

            $timeshift = $premin[0].' min ';

        } elseif($time>=3600 && $time<=86399) {
            // Hours, Minutes
            $phour = ($end_date - $start_date) / 3600;
            $prehour = explode('.',$phour);

            $premin = $phour-$prehour[0];
            $min = explode('.',$premin*60);


            $timeshift = $prehour[0].' hrs '.$min[0].' min ';


        } elseif($time>=86400) {
            // Days, Hours, Minutes
            $pday = ($end_date - $start_date) / 86400;
            $preday = explode('.',$pday);

            $phour = $pday-$preday[0];
            $prehour = explode('.',$phour*24);

            $premin = ($phour*24)-$prehour[0];
            $min = explode('.',$premin*60);

            $timeshift = $preday[0].' days '.$prehour[0].' hrs '.$min[0].' min ';

        }

        $string = trim($timeshift);
        if($string[0]=='-'){
            $html = '<div style="color:#F6791F">'.$timeshift.'</div>';
        }else{
            $html = '<div style="color:green">'.$timeshift.'</div>';
        }

        return $html;
    }

}

