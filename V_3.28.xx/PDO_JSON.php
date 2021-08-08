<?php
/*
 ┌────────────────────────────────────────────────────────────┐
 |  For More Modules Or Updates Stay Connected to Kodi dot AL |
 └────────────────────────────────────────────────────────────┘
 ┌───────────┬────────────────────────────────────────────────┐
 │ Product   │ Ovoo Movie & Video Stremaing CMS Pro API       │
 │ Version   │ v1.1                                           │
 │ Provider  │ https://yourhost.com/api                       │
 │ Support   │ JSON TO VLC/Smart TV Converter                 │
 │ Licence   │ MIT                                            │
 │ Author    │ Olsion Bakiaj                                  │
 │ Email     │ TRC4@USA.COM                                   │
 │ Author    │ Endrit Pano                                    │
 │ Email     │ INFO@ALBDROID.AL                               │
 │ Website   │ https://kodi.al                                │
 │ Facebook  │ /albdroid.official/                            │
 │ Created   │ Monday, March 16, 2020                         │
 │ Modified  │ 08 August 2021                                 │
 └────────────────────────────────────────────────────────────┘
// TESTED ON Version 3.2.9

NOTE: IF Y SEE SOME ERRORS IN YOUR PANEL ADD THE CODE IN ALL PHPS IN -> APPLICATION\MODELS
EXAMPLE
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0); // << THIS CODE

THE STRUCTURE IS ONLY TO GET HLS/M3U8 STREAMS
*/

// PHP7 SQLI
{
$con = new PDO("mysql:host=localhost; dbname=tv_test", "root", "root");
	$query="SELECT * FROM live_tv where stream_from='hls';";

	$statement = $con->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();

	$output = array();
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$temp_array = array();
			$temp_array['title'] = $row['tv_name'];
			$temp_array['stream_url'] = $row['stream_url'];
			$temp_array['thumbnail'] = "https://png.kodi.al/tv/albdroid/black.png";
			$output[] = $temp_array;
		}
	}
	else
	{
		$output['tv_name'] = '';
		$output['label'] = 'No Streams Found';
	}

echo str_replace("\/", "/", json_encode(["success"=>true,"Albdroid_Streaming_Data"=>$output]));
}
?>