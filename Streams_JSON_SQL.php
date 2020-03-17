<?php

// OVOO - Live TV & Movie Portal CMS APIS
// TESTED ON Version 3.1.2

//error_reporting(0);

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "root";
$DB_NAME = "ovo_movie_portal";
$streams_limit = 2; // SET STREAM LIMIT [PART OF STREAM LIMIT ]
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if(!$con){
        die("Connection Failed : ".mysqli_connect_error());
    }

// ------------------------------------------------------------------------------------------------
// ALL HLS STREAMS
//$query = "SELECT * FROM live_tv where stream_from='hls';";
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// WITH PUBLISH UNLIMITED
//$query = "SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC";
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// PART OF STREAM LIMIT 1
//$query = "SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC LIMIT 0, 20;"; // CHANGE LIMIT
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// PART OF STREAM LIMIT 2
//$query = "SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC LIMIT ". $streams_limit;
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// ALL STREAMS SOURCES OK
$query = "SELECT * FROM `live_tv` ORDER BY `live_tv`.`stream_from` DESC";
// ------------------------------------------------------------------------------------------------

$res = mysqli_query($con,$query);

$result = array();
while($row = mysqli_fetch_array($res)){

	array_push($result,array(
		"title"=>$row['tv_name'],
		"stream"=>$row['stream_url']
	));
}
echo str_replace("\/", "/", json_encode(["success"=>true,"Albdroid_Streaming_Data"=>$result]));
mysqli_close($con);