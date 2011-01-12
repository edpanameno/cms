<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nice_timespan')) {

//	function nice_timespan($tm, $rcs = 0) {
//
//		$cur_tm = time();
//		$dif = $cur_tm - $tm;
//    	$pds = array('second','minute','hour','day','week','month','year','decade');
//    	$lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
//    	for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--);
//		if($v < 0)
//			$v = 0;
//
//		$_tm = $cur_tm-($dif%$lngh[$v]);
//
//    	$no = floor($no);
//		if($no <> 1) $pds[$v] .='s';
//		$x=sprintf("%d %s ",$no,$pds[$v]);
//
//    	if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0))
//			$x .= time_ago($_tm);
//
//		return $x;
//	}

	function nice_timespan($date) {

		if(empty($date)) {
			return "No date provided";
		}

		$periods  = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths  = array("60","60","24","7","4.35","12","10");

		$now  = time();
		$unix_date = strtotime($date);

		   // check validity of date
		if(empty($unix_date)) {
			return "Bad date";
		}

		// is it future date or past date
		if($now > $unix_date) {
			$difference = $now - $unix_date;
			$tense = "ago";

		}
		else {
			$difference = $unix_date - $now;
			$tense = "from now";
		}

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1) {
			$periods[$j].= "s";
		}

		return "$difference $periods[$j] {$tense}";
	}
}