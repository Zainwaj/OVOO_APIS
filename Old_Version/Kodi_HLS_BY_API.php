<?php
// OVOO - Live TV & Movie Portal CMS APIS
// TESTED ON Version 3.1.2

date_default_timezone_set('Europe/Tirane');
// error_reporting(0);
$referer = "http://kodi.al";
$Podcast_Artist = "Albdroid Streaming";
$Podcast_Type = "TV";
$albdroidlogo = "https://png.kodi.al/tv/albdroid/"; // black.png  Albdroidtv.png  albdroid.png  albdroidflat.png
date_default_timezone_set("Europe/Tirane");
$MAIN_API_URL = "http://localhost/api/"; // PANEL API

$GET_STREAMS_ATTRIBUTES = "get_all_tv_channel";
$API_SECRET_KEY_ATTRIBUTES = "?api_secret_key="; // DO NOT TOUCH IT
$API_SECRET_KEY = "dvyl8x2trizhcd5pj4rs207e"; // API FROM /admin/android_setting/
$CATEGORY_ID = '&id='."18"; // CHANGE CAT ID ONLY 1 2 3 ETC

$ALL_ATTRIBUTES = $MAIN_API_URL.$GET_STREAMS_ATTRIBUTES.$API_SECRET_KEY_ATTRIBUTES.$API_SECRET_KEY.$CATEGORY_ID;
//echo $ALL_ATTRIBUTES;

$vod_channels_url = $ALL_ATTRIBUTES;
$vod_channels_url_object  = file_get_contents($vod_channels_url);
$get_all_tv_channel  = json_decode($vod_channels_url_object);

header("Content-type: application/json; charset=utf-8");
foreach($get_all_tv_channel as $item)
if ($item->{'stream_from'}=='hls')
{
echo "<item>\n";
echo "<title>[COLOR lime][B]$item->tv_name[/COLOR][/B]</title>\n";
echo "<link>$item->stream_url</link>\n";
echo "<thumbnail>".$albdroidlogo."black.png</thumbnail>\n";
echo "<fanart>".$albdroidlogo."black.png</fanart>\n";
echo "<Format>$item->stream_label</Format>\n";
echo "</item>\n\n";
}
?>