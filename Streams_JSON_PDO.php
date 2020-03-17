<?php
// OVOO - Live TV & Movie Portal CMS APIS
// TESTED ON Version 3.1.2
{
$con = new PDO("mysql:host=localhost; dbname=ovo_movie_portal", "root", "root");
$streams_limit = 20; // SET STREAM LIMIT
	//$query = ("SELECT * FROM `live_tv` ORDER BY `live_tv`.`stream_from` ASC LIMIT ". $streams_limit);
	$query="SELECT * FROM live_tv where stream_from='hls';";
//$query = mysqli_query($con,"SELECT * FROM `live_tv` ORDER BY `live_tv`.`stream_from` ASC LIMIT ". $streams_limit);
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
			//$temp_array['tv_name'] = $row['tv_name'];
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