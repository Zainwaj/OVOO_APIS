<?php
// OVOO - Live TV & Movie Portal CMS APIS
// TESTED ON Version 3.1.2

ob_start();
date_default_timezone_set("Europe/Tirane");
//error_reporting(0);

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "root";
$DB_NAME = "ovo_movie_portal";
$streams_limit = 20; // SET STREAM LIMIT [PART OF STREAM LIMIT ]
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if(!$con){
        die("Connection Failed : ".mysqli_connect_error());
    }
// ------------------------------------------------------------------------------------------------
// ALL HLS STREAMS
$query = mysqli_query($con,"SELECT * FROM live_tv where stream_from='hls';");
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// WITH PUBLISH UNLIMITED
//$query = mysqli_query($con,"SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC");
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// PART OF STREAM LIMIT 1
//$query = mysqli_query($con,"SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC LIMIT 0, 20;"); // CHANGE LIMIT
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// PART OF STREAM LIMIT 2
//$query = mysqli_query($con,"SELECT * FROM live_tv where stream_from='hls' AND publish >= '1' ORDER BY tv_name DESC LIMIT ". $streams_limit);
// ------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------
// ALL STREAMS SOURCES OK
// $query = mysqli_query($con,"SELECT * FROM `live_tv` ORDER BY `live_tv`.`stream_from` DESC");
// ------------------------------------------------------------------------------------------------
?>
<?php
$stream_info = "Mixed Streams";
header('Content-Type: text/plain');
echo("#EXTM3U Albdroid TV Streaming $stream_info\n");
while ($item = mysqli_fetch_assoc($query)):
$thumbnail = "https://png.kodi.al/tv/albdroid/smart_x1.png"; // CHANGE WITH YOUR LOGO
$TVG_ID = 'tvg-id="Hosted by Albdroid"';
$TVG_NAME = ' tvg-name="' .$item ['tv_name'].'"';
$TVG_LOGO = ' tvg-logo="' .$thumbnail.'"';
$GROUP_TITLE = ' group-title="Mixed Streams",';
echo "\n#EXTINF:-1 " . $TVG_ID . $TVG_NAME . $TVG_LOGO . $GROUP_TITLE. $item['tv_name']."\n";
echo $item['stream_url']."\n";
endwhile;
ob_end_flush();
?>