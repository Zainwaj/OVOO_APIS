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
ob_start();
date_default_timezone_set("Europe/Tirane");
error_reporting(0);

$database_host = "localhost";
$database_user = "root";
$database_pass = "root";
$database_name = "tv_test";
$stream_info = "TEST";
    $con = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
    if(!$con){
        die("Connection Failed : ".mysqli_connect_error());
    }

$query = mysqli_query($con,"SELECT * FROM `live_tv` ORDER BY `tv_name` ASC");

echo("#EXTM3U Albdroid TV Streaming $stream_info\n");
header('Content-Type: text/plain');
//header('Content-Type: application/json');
//header("Content-type: application/ld+json; charset=utf-8");

while ($row = mysqli_fetch_array($query)):

$tvg_id = 'tvg-id="Hosted by Albdroid"';
$tvg_name = ' tvg-name="' .$row ['tv_name'].'"';
$tvg_logo = ' tvg-logo="' .$row ['thumbnail'].'"';
$group_title = ('group-title="'. $stream_info .'"');
echo "\n#EXTINF:-1 " . $tvg_id . $tvg_name . $tvg_logo . $group_title. $row['tv_name']."\n";
echo $row['stream_url']."\n";
endwhile;
ob_end_flush();
?>