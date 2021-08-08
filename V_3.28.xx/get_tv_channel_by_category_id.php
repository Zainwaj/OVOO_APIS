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

$Stream_Provider = "Albdroid TV";
$Stream_Type = "Streaming";
$Stream_Types = " Live Stream";

// CHANGE CAT ID ONLY 1 2 3 ETC
$category_id = "1";
//////////////////////////////////////////////////////////////////
// FULL PANEL HOST URL https://localhost/api/get_tv_channel_by_category_id/?api_secret_key=b81f85ee2eb54ab&id=1
// START YOUR SETTINGS
$main_panel_url = "http://localhost/"; // PANEL HOST URL 'WITH OR WITHOUT / TO END'
$api_path = "api"; // DO NOT TOUCH IT
$api_key_attributes = "?api_secret_key="; // DO NOT TOUCH IT
$api_key = "b81f85ee2eb54ab"; // API KEY FROM admin/api_setting/ key from Legacy API(for Android v1.1.4 or Old)
// END YOUR SETTINGS
$get_parameter = "get_tv_channel_by_category_id"; // DO NOT TOUCH IT
$slash = "/"; // DO NOT TOUCH IT
$id = "&id="; // DO NOT TOUCH IT
//////////////////////////////////////////////////////////////////
$api_call_all_parameters = $main_panel_url.$slash.$api_path.$slash.$get_parameter.$slash.$api_key_attributes.$api_key.$id.$category_id;
//echo $api_call_all_parameters;

$get_all_tv_channels  = file_get_contents($api_call_all_parameters);
$json_tv_channels  = json_decode($get_all_tv_channels);
if (is_null($json_tv_channels))
{
echo "Check Your Settings From [START YOUR SETTINGS to END YOUR SETTINGS]";
}
else
{
echo("#EXTM3U Albdroid TV Streaming"."\n");
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
foreach($json_tv_channels as $item)
{
if ($item->{'stream_from'}=='hls')
{
$title = $item->tv_name;
$stream_url = $item->stream_url;
$thumbnail_url = $item->thumbnail_url;
$poster_url = $item->poster_url;
$thumbnail = "https://png.kodi.al/tv/albdroid/smart_x1.png";
$tvgid = "Hosted by Albdroid.AL";
$tvg_id = ('tvg-id="'. $tvgid .'"');
$tvg_name = ('tvg-name="'. $Stream_Provider .'"');
$tvg_logo = ('tvg-logo="'. $thumbnail .'"');
$grouptitle = "$Stream_Provider $Stream_Type";
$group_title = ('group-title="'. $grouptitle .'"');
echo "\r#EXTINF:-1 $tvg_id $tvg_name $tvg_logo $group_title,$title\n";
echo $stream_url."\n";
}
}
}
ob_end_flush();
?>