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

ob_start();
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");

//////////////////////////////////////////////////////////////////
// FULL PANEL HOST URL http://localhost/rest-api/v100/all_tv_channel/?API-KEY=04453d46be88997
// START YOUR SETTINGS
$main_panel_url = "http://localhost/"; // PANEL HOST URL 'WITH OR WITHOUT / TO END'
$api_path = "rest-api/v100"; // DO NOT TOUCH IT
$api_key_attributes = "?API-KEY="; // DO NOT TOUCH IT
$api_key = "04453d46be88997"; // API KEY FROM admin/api_setting/
// END YOUR SETTINGS
$get_parameter = "all_tv_channel";
$slash = "/";
$api_call_all_parameters = $main_panel_url.$slash.$api_path.$slash.$get_parameter.$slash.$api_key_attributes.$api_key;
//echo $api_call_all_parameters;
//////////////////////////////////////////////////////////////////

$get_all_tv_channels  = file_get_contents($api_call_all_parameters);
$json_tv_channels  = json_decode($get_all_tv_channels);
if (is_null($json_tv_channels))
{
echo "Check Your Settings From [START YOUR SETTINGS to END YOUR SETTINGS]";
}
else
{
header("Content-type: application/json; charset=utf-8");
foreach($json_tv_channels as $item)
{
if ($item->{'stream_from'}=='hls')
{
$title = $item->tv_name;
$stream_url = $item->stream_url;
$thumbnail_url = $item->thumbnail_url;
$poster_url = $item->poster_url;
$stream_label = $item->stream_label;
$thumbnail = "https://png.kodi.al/tv/albdroid/smart_x1.png";
echo "<item>"."\n";
echo "<title>[COLOR lime][B]".$title."[/COLOR][/B]</title>"."\n";
echo "<link>".$stream_url."</link>"."\n";
echo "<thumbnail>".$albdroidlogo."black.png</thumbnail>"."\n";
echo "<fanart>".$albdroidlogo."black.png</fanart>"."\n";
echo "<Format>".$stream_label."</Format>"."\n";
echo "</item>"."\n\n";
}
}
}
ob_end_flush();
?>