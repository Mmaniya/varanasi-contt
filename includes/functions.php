<?php

function removeItemString($str, $item) {
	$parts = explode(',', $str);
	while(($i = array_search($item, $parts)) !== false) {
	unset($parts[$i]);
	}
	return implode(',', $parts);
	}


	function randomPassword() {
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 6; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}

	function check_Date(){
		$qry ='SELECT *  FROM '.TBL_BJP_MASTER_BOOTH_MEETINGS_SETTINGS.' where id=1';
		$rsDtls = dB::sExecuteSql($qry); 
		$start_meeting_date = $rsDtls->start_meeting_date; 
		$end_meeting_date = $rsDtls->next_meeting_date;

		return $selectedDate = $start_meeting_date.'::'.$end_meeting_date;
	}


	function getSeoName($seoname){	
	$seoname = strtolower(stripslashes($seoname));
	$seoname = str_replace("(", "", $seoname) ;
	$seoname = str_replace(")", "", $seoname) ;
	$seoname = str_replace(":", "", $seoname) ;
	$seoname = str_replace(",", "", $seoname) ;
	$seoname = str_replace("-", "", $seoname) ;
	$seoname = str_replace(".", "", $seoname) ;
	$seoname = str_replace("/", "", $seoname) ;
	$seoname = str_replace("&", "", $seoname) ;
	$seoname = str_replace("amp;", "", $seoname) ;
	$seoname = str_replace("#", "", $seoname) ;
	$seoname = str_replace("'", "", $seoname) ;
	$seoname=str_replace("39;", "-", $seoname);
	$seoname = str_replace("\ ", "", $seoname);
	$seoname = str_replace("?", "", $seoname) ;
	$seoname=str_replace("45;", "", $seoname);
	$seoname = str_replace("'", "", $seoname) ;
	$seoname = str_replace("'", "", $seoname) ;
	
	while(strpos($seoname, "  ")){
		$seoname = str_replace("  ", " ", $seoname) ;
	}
	$seoname = str_replace(" ", "-", $seoname) ;
	$seoname = str_replace("~", "-", $seoname) ;
	$seoname = str_replace(".", "-", $seoname) ;
	$seoname = str_replace("--", "-", $seoname) ;
	
	return $seoname;
}
	
function get_extra_fields() {
	
                $blood_group = array('A+','O+','B+','AB+','A-','O-','B-','AB-');

               
                $job_category = array(
                                array('short_name'=>'B','value'=>'Entrepreneur / சுயதொழில்'),
                                array('short_name'=>'D','value'=>'Doctor/மருத்துவர்'),
                                array('short_name'=>'L','value'=>'Lawyer/வழக்கறிஞர்'),
                                array('short_name'=>'E','value'=>'Educationalist/கல்வியாளர்'),
                                array('short_name'=>'Engg.','value'=>'Engineer/பொறியாளர்'),
                                array('short_name'=>'O','value'=>'Others/மற்றவை'));

				$interested_sector[] = array('short_name'=>'BM','value'=>'Booth Management/கிளை மேலாண்மை');
				$interested_sector[] = array('short_name'=>'EM','value'=>'Events & Meetings/நிகழ்ச்சிகள்');
				$interested_sector[] = array('short_name'=>'GS','value'=>'Government Scheme/அரசாங்க திட்டங்கள்');
				$interested_sector[] = array('short_name'=>'FN','value'=>'Finance/நிதி');
				$interested_sector[] = array('short_name'=>'SM','value'=>'Social Media/சமூக ஊடகம்');
				$interested_sector[] = array('short_name'=>'O','value'=>'Others/மற்றவை');  

				$type_of_member[] = array('short_name'=>'K','value'=>'Karyakartha','value_ta'=>'கார்யகர்த்தா');
				$type_of_member[] = array('short_name'=>'PT','value'=>'Part Time','value_ta'=>'பகுதி நேரம்');
				$type_of_member[] = array('short_name'=>'EW','value'=>'Election Work','value_ta'=>'தேர்தல் வேலை');
				$type_of_member[] = array('short_name'=>'S','value'=>'Supporter','value_ta'=>' ஆதரவாளர்');

                $extra_fields = array('blood_group'=>$blood_group,
                                                 'job_category'=>$job_category,
                                                 'interest_category'=>$interest_category,
                                                 'interested_sector'=>$interested_sector,
                                                 'type_of_member'=>$type_of_member);
												 
			return 	$extra_fields;								 
        }		 
	


function getSeoUrl($argvs=array()){
	$argvs = is_array($argvs) ? $argvs : array(); extract($argvs);	
	//$pn = $pn.'?seo=1';
	
	$seourl = '';
   	$siteprefix = BASE_URL;
	//print_r($siteprefix);
	switch($pn)
	{
		case 'index.php':
		{
		$seourl='index.html';
		break;
		}
		case 'contact.php':
		{
		$seourl='contact-us';
		break;
		}
		case 'aboutus.php':
		{
		$seourl='profile';
		break;
		}
		case 'wallputty.php':
		{
		$seourl='products-wallputty';
		break;
		}
		case 'dealer.php':
		{
		$seourl='dealer';
		break;
		}
		default:
		$seourl=$pn;
		break;	
	}
	if($htaccess<=0)
	 	$seoprefix=BASE_URL;
		
	return $seoprefix.$seourl; 	
}


function check_input($value)
{
// Stripslashes
	if (get_magic_quotes_gpc())
	{
	$value = stripslashes($value);
	}
	// Quote if not a number
	if (!is_numeric($value))
	{
		
	$value = mysqli_real_escape_string(mysqli_connect(BA_DBHOST, BA_DBUSER, BA_DBPASSWORD),$value);
	}
	
	$value = trim($value);
	$value = htmlspecialchars($value);
	//  $ostring = htmlentities($ostring);
	return $value;
}
	

function getTimeDifference($fromTime, $toTime) {
	 //echo $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 return $timeArr[0]." hours, ".$timeArr[1]." mins.";
}

function getTimeDifferenceInHours($fromTime, $toTime) {
	 //echo $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 if($timeArr[1]>0) return ($timeArr[0]+1);
	 
	 //return $timeArr[0]." Hours ".$timeArr[1]." Minutes";
}


function getTimeDifferenceinMinutes($fromTime, $toTime) {
	 $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 return ($timeArr[0]*60) + $timeArr[1];
}

function getRangeFromArray($valueToCheck, $rangeArr) {

	if(count($rangeArr) > 0) {
		foreach($rangeArr as $K=>$V) {
			$valArr = explode('-',$V);
			if ($valueToCheck >= $valArr[0] && $valueToCheck <= $valArr[1]) {
				return $V;
			}	
		}
	}
	return '';
}

function getDaysBetweenDates($fromdate, $todate) {
  
  $start_ts = strtotime($fromdate);
  $end_ts = strtotime($todate);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);

}

function currentYearMonth() {
	//$current_month_number = date('m');
	$month_arr=array();
	for ($m=1; $m<=12; $m++) {
		$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
        $month_arr[sprintf("%02s", $m)] = ($month);
	}
    return $month_arr;          
}

function listofyears($limit, $limitend) {
	
	if($limit=="") $limit = 2014; else $limit=$limit;
	if($limitend=="") $limitend = 2100; else $limitend=$limitend;
	
	$year_arr=array();
	for ($y=$limit; $y<=$limitend; $y++) {
        $year_arr[$y] = ($y);
	}
    return $year_arr; 
	
}

function getTimeDifferenceT($date) {
	
	$diff = abs( time() - strtotime($date));
	$days = intval( $diff / 86400 );
	$hours = round( ( $diff % 86400 ) / 3600);
	$mins = round( ( $diff / 60 ) % 60 );
	$secs = round( $diff % 60 );
	
	if($days>0) {
		if($days>1) $plural = " days"; else $plural = " day";
		$lastBookTime = $days.$plural;
	} elseif($hours>0) {
		if($hours>1) $plural = " hours"; else $plural = " hour";
		$lastBookTime = $hours.$plural;
	} elseif($mins>0) {
		if($mins>1) $plural = " mins"; else $plural = " min";
		$lastBookTime = $mins.$plural;
	} elseif($secs>0) {
		if($secs>1) $plural = " secs"; else $plural = " sec";
		$lastBookTime = $secs.$plural;
	} else {
		$lastBookTime = "";
	}
	
	return $lastBookTime;
		
}



function getDayDifference($from_date,$to_date) {
	
	$actualDiff = strtotime($from_date) - strtotime($to_date);
	$diff = abs( strtotime($from_date) - strtotime($to_date));
	$days = intval( $diff / 86400 );
	$hours = round( ( $diff % 86400 ) / 3600);
	$mins = round( ( $diff / 60 ) % 60 );
	$secs = round( $diff % 60 );
	
	if($days>0) {
		if($actualDiff<0) $days = 0-$days;
	}
	return $days;
		
}


function generatePagination($functionName="", $arrayCount, $arraySliceCount, $pageLimit=10, $adjacent=1, $page=1, $type="") {

	$resultCount = $arrayCount;
	$resultSplitCount = $arraySliceCount;
	
	$start = ($page-1) * $pageLimit;
	$adjacents = 1;
		
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($resultCount/$pageLimit);
	$lpm1 = $lastpage - 1;   
	$pagination = "";

	if($lastpage > 1)
    {   

        if ($page > 1)
            $pagination.= "<a style='cursor:pointer' class='pagination_box' border='0' id='pagination_prev' onClick='".$functionName."Paging(".($prev).", &quot;".$type."&quot;);'></a>";
        else
            $pagination.= "<span class='disabled pagination_box' id='pagination_prev' style='cursor:pointer' border='0'></span>";
			   
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {  
                if ($counter == $page)
                    $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                else
                    $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
                         
            }
        }
        elseif($lastpage > 4 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                    else
                        $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
                }
                $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>...</span>";
                $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lpm1).", &quot;".$type."&quot;);'>".sprintf("%02s", $lpm1)."</a>";
                $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lastpage).", &quot;".$type."&quot;);'>".sprintf("%02s", $lastpage)."</a>";   
           
           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(1, &quot;".$type."&quot;);'>1</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(2, &quot;".$type."&quot;);'>2</a>";
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>...</span>";
               for($counter = ($page - $adjacents)+1; $counter <= ($page + $adjacents)+1; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</span>";
                   else
                       $pagination.= "<a style='cursor:pointer' class='pagination_box' border='0' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
               }
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>..</span>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lpm1).", &quot;".$type."&quot;);'>".sprintf("%02s", $lpm1)."</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lastpage).", &quot;".$type."&quot;);'>".sprintf("%02s", $lastpage)."</a>";   
           }
           else
           {
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(1, &quot;".$type."&quot;);'>".sprintf("%02s", 1)."</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(2, &quot;".$type."&quot;);'>".sprintf("%02s", 2)."</a>";
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>..</span>";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                   else
                        $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' id='pagination_next' onClick='".$functionName."Paging(".($next).", &quot;".$type."&quot;);'></a>";
        else
            $pagination.= "<span class='disabled pagination_box' id='pagination_next' style='cursor:pointer' border='0'></span>";
        
    }
	$table_val = "<span style='float:left; line-height:25px;'><b>Showing ".($start+1)." to ".($start+$resultSplitCount)." of ".$resultCount." entries</b></span>";
	$table_val .= "<span style='float:right;'>".$pagination."</span>";
	
	return $table_val;
		 
}

function getContentAsTable($contentDtls, $page) {

	$totalColumns = count($contentDtls['Fields']);
	$totalRows = count($contentDtls['Rows']);
	$records = $contentDtls['Rows'];
	
	$page = $page;
	$totalRows = $totalRows;
	$pageLimit=10;
	$adjacent=1;
	
	$totalPages= ceil(($totalRows)/($pageLimit));
	if($totalPages==0) $totalPages=1;
	$StartIndex= ($page-1)*$pageLimit;
	
	if(count($records)>0) $recordsArr = array_slice($records,$StartIndex,$pageLimit,true);
	
	if(count($records)>0 && $totalPages > 1){ 
		$rs_pagination = generatePagination("mdashboardDlts", $totalRows, count($recordsArr), $pageLimit, $adjacent, $page); 
	}
	
	$html = "<table border='0' cellpadding='0' cellsapcing='0' width='100%' class='".$contentDtls['TableClass']."'>";
	
	$html .= "	<tr>";
	
		foreach($contentDtls['Fields'] as $hk=>$hv){
			$html .= '<th>'.$hv.'</th>';
		}
		
	$html .= "	</tr>";

	if(count($recordsArr)>0) {
		foreach($recordsArr as $rk=>$rv){ 
			$html .= "	<tr>";
				foreach($rv as $kk=>$vv){ 
					if($kk=="Total") { $txtalign = "align='right' style='background:#ffb330;'"; } else $txtalign = "align=''";
					$html .= '<td '.$txtalign.'>'.$vv.'</td>';
				}
			$html .= "	</tr>";
		}
		
		if($rs_pagination!='') {
			$html .= "	<tr height='39'>";
				$html .= "<td colspan='$totalColumns' style='width:97%;'>".$rs_pagination."</td>";
			$html .= "	</tr>";
		}
		
	} else {
		$html .= "	<tr>";
			$html .= "<td colspan='".$totalColumns."' style='width:97%;'>No Results Found</td>";
		$html .= "	</tr>";
	}
	
	$html .= "<table>";

	return $html;
	
}


function getDistance($lat1, $lng1, $lat2, $lng2, $unit = 'mi') {
	// radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
	if ($unit == 'km') $radius = 6371.009; // in kilometers
	elseif ($unit == 'mi') $radius = 3958.761; // in miles

	// convert degrees to radians
	$lat1 = deg2rad((float) $lat1);
	$lng1 = deg2rad((float) $lng1);
	$lat2 = deg2rad((float) $lat2);
	$lng2 = deg2rad((float) $lng2);

	// great circle distance formula
	return $radius * acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lng1 - $lng2));
}

// Get STATE from Google GeoData
function reverse_geocode($address) {
	$address = str_replace(" ", "+", "$address");
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	$result = file_get_contents("$url");
	$json = json_decode($result);

	foreach ($json->results as $result)
	{
		foreach($result->address_components as $addressPart) {
			if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$city = $addressPart->long_name;
	    	else if(((in_array('administrative_area_level_1', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$state = $addressPart->short_name;
	    	else if(((in_array('administrative_area_level_2', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$disctrict = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
		}
		
		$lat = $result->geometry->location->lat;
		$long = $result->geometry->location->lng;
	}
	
	if(($city != '') && ($state != '') && ($country != ''))
		$address = $city.', '.$state.', '.$country;
	else if(($city != '') && ($state != ''))
		$address = $city.', '.$state;
	else if(($state != '') && ($country != ''))
		$address = $state.', '.$country;
	else if($country != '')
		$address = $country;
		
	$addressArr=array();
	$addressArr['Lat']=$lat;
	$addressArr['Long']=$long;
	$addressArr['Country']=$country;
	$addressArr['State']=$state;
	$addressArr['District']=$disctrict;
	$addressArr['City']=$city;
	
	// return $address;
	//return "$lat/$long/$country/$state/$disctrict/$city";
	return $addressArr;
}


/**
* easy image resize function
* @param $file - file name to resize
* @param $string - The image data, as a string
* @param $width - new image width
* @param $height - new image height
* @param $proportional - keep image proportional, default is no
* @param $output - name of the new file (include path if needed)
* @param $delete_original - if true the original image will be deleted
* @param $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
* @param $quality - enter 1-100 (100 is best quality) default is 100
* @return boolean|resource
*/
function smart_resize_image($file, $string = null, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false, $quality = 100) {
	
	if ( $height <= 0 && $width <= 0 ) return false;
	if ( $file === null && $string === null ) return false;
	
	# Setting defaults and meta
	$info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
	$image = '';
	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
	
	# Calculating proportionality
	if ($proportional) {
		if ($width == 0) $factor = $height/$height_old;
		elseif ($height == 0) $factor = $width/$width_old;
		else $factor = min( $width / $width_old, $height / $height_old );
		$final_width = round( $width_old * $factor );
		$final_height = round( $height_old * $factor );
	}
	else {
		$final_width = ( $width <= 0 ) ? $width_old : $width;
		$final_height = ( $height <= 0 ) ? $height_old : $height;
		$widthX = $width_old / $width;
		$heightX = $height_old / $height;
		$x = min($widthX, $heightX);
		$cropWidth = ($width_old - $width * $x) / 2;
		$cropHeight = ($height_old - $height * $x) / 2;
	}
	
	# Loading image to memory according to type
	switch ( $info[2] ) {
		case IMAGETYPE_JPEG: $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string); break;
		case IMAGETYPE_GIF: $file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string); break;
		case IMAGETYPE_PNG: $file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string); break;
		default: return false;
	}
	
	# This is the resizing/resampling/transparency-preserving magic
	$image_resized = imagecreatetruecolor( $final_width, $final_height );
	if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
		$transparency = imagecolortransparent($image);
		$palletsize = imagecolorstotal($image);
		if ($transparency >= 0 && $transparency < $palletsize) {
			$transparent_color = imagecolorsforindex($image, $transparency);
			$transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
			imagefill($image_resized, 0, 0, $transparency);
			imagecolortransparent($image_resized, $transparency);
		}
		elseif ($info[2] == IMAGETYPE_PNG) {
			imagealphablending($image_resized, false);
			$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
			imagefill($image_resized, 0, 0, $color);
			imagesavealpha($image_resized, true);
		}
	}
	imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	# Taking care of original, if needed
	if ( $delete_original ) {
		if ( $use_linux_commands ) exec('rm '.$file);
		else @unlink($file);
	}
	
	# Preparing a method of providing result
	switch ( strtolower($output) ) {
		case 'browser':
		$mime = image_type_to_mime_type($info[2]);
		header("Content-type: $mime");
		$output = NULL;
		break;
		case 'file':
		$output = $file;
		break;
		case 'return':
		return $image_resized;
		break;
		default:
		break;
	}
	# Writing image according to type to the output destination and image quality
	switch ( $info[2] ) {
		case IMAGETYPE_GIF: imagegif($image_resized, $output); break;
		case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, $quality); break;
		case IMAGETYPE_PNG:
		$quality = 9 - (int)((0.9*$quality)/10.0);
		imagepng($image_resized, $output, $quality);
		break;
		default: return false;
	}
	
return true;
}

function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getYesorNo($value) {
	if($value=="N") $val = "No";
	else if($value=="Y") $val = "Yes";
	else $val = "";
	return $val;
}

function randomCharacter($length=6) {
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getCountryByIp($ip) {
    return file_get_contents("http://ipinfo.io/{$ip}/country");
}


function money($value,$symbol='') {
if($symbol=='') {
return round($value,2);
}
if($symbol=='-') {
return number_format($value,2);
}
return $symbol.'&nbsp;'.number_format($value,2);
}


function moneyCsv($value,$symbol='') {
if($symbol=='') {
return round($value,2);
}
if($symbol=='-') {
return number_format($value,2);
}
return $symbol.' '.number_format($value,2);
}



function generateRandomCode($l = 10){   
     return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    
}

function isSurchargeFee($current_time,$from_time,$to_time) {
	
	if(LOCAL) {
		$date1 = strtotime($current_time);
		$date2=strtotime($from_time);
		$date3 = strtotime($to_time);
		
	} else {
		$date1 = DateTime::createFromFormat('H:i a', $current_time);
		$date2 = DateTime::createFromFormat('H:i a', $from_time);
		$date3 = DateTime::createFromFormat('H:i a', $to_time);
	}
	if ($date1 > $date2 && $date1 < $date3) return 1;
	return 0;
	
}


function getTime($target_date,$target_time,$action,$number_of_hours,$minutes,$return_format='date_time') {
if(LOCAL) {
	$source_timestamp=strtotime(date('m/d/Y',strtotime($target_date)).' '.$target_time);
	if($action=='before') $interval = "-".$number_of_hours." hour ".$minutes.' minute'; else
	$interval = "+".$number_of_hours." hour ".$minutes.' minute';
	$new_timestamp=strtotime($interval, $source_timestamp);
	if($return_format=='date_time')	return date('d M,Y-h:i a', $new_timestamp);
	if($return_format=='date')	return date('d M,Y', $new_timestamp);
	if($return_format=='time')	return date('h:i a', $new_timestamp);
	
}else {
	$date = new DateTime($target_date.' '.$target_time);
	$interval = "PT".$number_of_hours."H";
	if($minutes!='0') $interval.=$minutes.'M';
	if($action=='before') {
	$tosub = new DateInterval($interval);
	$date->sub($tosub);	
	}else{
	$toadd = new DateInterval($interval);
	$date->add($toadd);	
    }
   if($return_format=='date_time')   return $date->format('d M,Y-h:i a');
   if($return_format=='date')	return $date->format('d M,Y');
   if($return_format=='time')	return $date->format('H:i a');
}
}


function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 


function applyGratuityDetails($percent){

foreach($_SESSION['reservationDtls']['details']['total'] as $K=>$V) $$K=$V;
$gratuity = money($fare_amount*($percent/100));
if($_SESSION['reservationDtls']['details']['trip_type']=='O') {
	
	 $_SESSION['reservationDtls']['details']['car']['trip1']['gratuity_percent']=$percent;
	 $_SESSION['reservationDtls']['details']['car']['trip1']['gratuity_amount']=$gratuity; 
	 $tripDtls = $_SESSION['reservationDtls']['details']['car']['trip1'];
	 $_SESSION['reservationDtls']['details']['car']['trip1']['total_amount']=money($tripDtls['fare_amount']+$tripDtls['surcharge_fee']+$tripDtls['airport_fee']+$tripDtls['gratuity_amount']);
	 } else {
	 $trip_gratuity = money(floatval($gratuity/2));
	
	 $_SESSION['reservationDtls']['details']['car']['trip1']['gratuity_percent']=$percent;
	 $_SESSION['reservationDtls']['details']['car']['trip1']['gratuity_amount']=$trip_gratuity;
	  $tripDtls = $_SESSION['reservationDtls']['details']['car']['trip1'];
	 $_SESSION['reservationDtls']['details']['car']['trip1']['total_amount']=money($tripDtls['fare_amount']+$tripDtls['surcharge_fee']+$tripDtls['airport_fee']+$tripDtls['gratuity_amount']);
	
	 $_SESSION['reservationDtls']['details']['car']['trip2']['gratuity_percent']=$percent;
	 $_SESSION['reservationDtls']['details']['car']['trip2']['gratuity_amount']=$trip_gratuity;
	  $tripDtls = $_SESSION['reservationDtls']['details']['car']['trip2'];
	 $_SESSION['reservationDtls']['details']['car']['trip2']['total_amount']=money($tripDtls['fare_amount']+$tripDtls['surcharge_fee']+$tripDtls['airport_fee']+$tripDtls['gratuity_amount']);

}

$_SESSION['reservationDtls']['details']['total']['gratuity_percent']=$percent;
$_SESSION['reservationDtls']['details']['total']['gratuity_amount']=$gratuity;
 $totalAmount = $_SESSION['reservationDtls']['details']['total']['final_amount']= money($fare_amount+$gratuity+$airport_fee+$surcharge_amount);
$_SESSION['reservationDtls']['details']['car']['total'] = $_SESSION['reservationDtls']['details']['total'];
return money($gratuity).':'.money($totalAmount).':'.money($totalAmount);
}




function convertNumberToWordsForIndia($no){
	
	
        $words = array(
        '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
        '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
        '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
        '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
        '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
        '80' => 'eighty','90' => 'ninty');

        //First find the length of the number
		$number = round($no);
        $number_length = strlen($number);
        //Initialize an empty array
        $number_array = array(0,0,0,0,0,0,0,0,0);        
        $received_number_array = array();

        //Store all received numbers into an array
        for($i=0;$i<$number_length;$i++){    $received_number_array[$i] = substr($number,$i,1);    }

        //Populate the empty array with the numbers received - most critical operation
        for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ $number_array[$i] = $received_number_array[$j]; }
        $number_to_words_string = "";        
        //Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
        for($i=0,$j=1;$i<9;$i++,$j++){
            if($i==0 || $i==2 || $i==4 || $i==7){
                if($number_array[$i]=="1"){
                    $number_array[$j] = 10+$number_array[$j];
                    $number_array[$i] = 0;
                }        
            }
        }

        $value = "";
        for($i=0;$i<9;$i++){
            if($i==0 || $i==2 || $i==4 || $i==7){    $value = $number_array[$i]*10; }
            else{ $value = $number_array[$i];    }            
            if($value!=0){ $number_to_words_string.= $words["$value"]." "; }
            if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
            if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
            if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
            if($i==6 && $value!=0){    $number_to_words_string.= "Hundred "; }
        }
        if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
        $rupees = ucwords(strtolower("Rupees ".$number_to_words_string));
		
		
		
		$point = (round($no - $number, 2) * 100);
		
		$point = abs($point);
		$tenth_digit = floor($point/10)*10;
		$hundredth_digit = $point%10;
		
		
		$points = ($point) ?
			" and " . $words[$tenth_digit] . " " . 
				  $words[$hundredth_digit]. ' Paise ' : ' ';		
	   return $rupees.$points." Only.";			  
    }
	
	
function getPageCount($totalCount) {
	 return ceil($totalCount/PAGE_LIMIT);
}


function customizeBillNo($billNo) {
	if($billNo<10) return 'GI00'.$billNo;
	if($billNo>=10 && $billNo<100) return 'GI0'.$billNo;
	if($billNo>=100 && $billNo<999) return 'GI'.$billNo;
}

function getInvoiceDisplay($invoiceNo) {
  $invoice_date  = date('m-Y',time());	
  $invoiceMonth = date('m',time());
  $invoiceYear = date('Y',time());
  
  if($invoiceMonth<=3) $invoiceDisplay = 'GI'.($invoiceYear-1).'-'.($invoiceYear).'/'.$invoiceNo;
  if($invoiceMonth>3) $invoiceDisplay = 'GI'.($invoiceYear).'-'.($invoiceYear+1).'/'.$invoiceNo;
  
  return $invoiceDisplay;
}
?>