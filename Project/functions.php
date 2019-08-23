<?php
function set_date($date_str, $dateFormat)
{
	$date_obj = date_create($date_str);
	$formatted_date = date_format($date_obj, $dateFormat);
	return $formatted_date;
}

function checkEmpty($postArray)
{	
	$postStatus = true;
	
	foreach($postArray as $postVal)
	{
		if(empty($postVal))
		{
			$postStatus = false;
		}
	}
	
	return $postStatus;
}
function check($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>