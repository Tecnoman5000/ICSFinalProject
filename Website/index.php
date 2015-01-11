<?php
	include("connect.php"); 	
	$conn=Connection();
	include('update_indoor_temp.php');
	include('exception_check.php');
	static $old_motion_id = 0;
	static $motion_id = 0;
	static $motion_timer = 0;
	$motion_id = get_exception_id();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Morey - Home Information</title>
	<link rel="shortcut icon" href="/logo.ico" >
	<link rel="stylesheet" href="styles.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="script_functions.js"></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
	<script type="text/javascript">
	//reload the weather div every minute
	$(document).ready(function() {
			setInterval(function() {
				$('#weather_content_div').load(document.URL +  ' #weather_content_div');
				temp_load();
				console.log('Weather Update')
			}, 60000);
			setInterval(function() {
				$('#warnings_cell_motion').load(document.URL +  ' #warnings_cell_motion');
				console.log('Alert Update')
			}, 1000);
		});
	</script>
</head>
<body onload="init()">
	<table id="main_table">
		<tr id="main_row">
			<td id="main_menu_cell">
				<div id="main_menu_div">
					<table id="menu_table">
						<tbody id="menu_tbody">
							<tr class="menu_row">
								<td class="menu_content" onmouseover="">
									<img src="/logo.png" alt="logo" width="50px" height="50px">
								</td>
							</tr>
							<div id="menu_display_div">
								<tr class="menu_row_inactive">
									<td class="menu_content">
										<a href="index.php" class="menu_button">
											<h1>Home</h1>
										</a>
									</td>
								</tr>
							</div>
						</tbody>
					</table>
				</div>
			</td>
			<td id="main_mid_cell"  align="center">
				<div id="content_div">
					<table id="content_table">
						<tr class="content_row" align="center">
							<td id="content_weather">
								<table id="weather_table">
									<tr id="weather_row">
										<td id="weather_content">
											<img src="/01d.png" alt="Sunny" id="weather_icon" width="70px" height="70px" title="Click to Toggle" onclick="temp_toggle()">
											<div id="weather_content_div" align="left">
												<span id="temp_indoor" title="<?php print get_temp_timestamp(); ?>">
													<h1 id="temp_indoor_h1">
														<?php 
															print get_temp();
															print "&#176C";
														?>
													</h1>
												</span>
												<span id="temp_outdoor">
													<h1 id="temp_outdoor_h1">
													</h1>
												</span>
											</div>
										</td>
									</tr>
									<tr id="time_row">
										<td id="time_content">
											<div id="clock"></div> <!-- clock -->
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr align="center">
							<td id="content_video_feed" align="center" onclick="video_toggle()">
								<h1>Video Feed</h1>
								<p>Video feed is disabled (Clicked to Enable)</p>
							</td>
						</tr>
					</table>
				</div>
			</td>
			<td id="main_warnings_cell">
				<div id="warnings_div">
					<table id="warnings_table">
						<tr class="warnings_row">
							<td id="warnings_cell">
								<h1>Warnings</h1>
							</td>
						</tr>
						<tr class="warnings_row">
							<div id="warning_motion_div">
								<td id="warnings_cell_motion">
									<?php
										/*$old_motion_id = $motion_id -1;
										print $old_motion_id;
										print "\r\n";
										$motion_id = get_exception_id();
										print $motion_id;
										print "\r\n";
										print $motion_timer;
										print "\r\n";
										if ($old_motion_id != $motion_id){
											$motion_timer = 30;
											print 'different';
											$motion_timer -= 1;
											if ($motion_timer < 1){
												print 'same';
											}
										}*/
										//print $old_motion_id;
										//print "\r\n";
										
										if (get_exception_text() == 'motion_detected'){
										//if ($old_motion_id != $motion_id){ # If the id has changed
										//$motion_timer = 30;
											print '<h1>';
											print 'Motion Detected';
											print '</h1>';
											print "\n";
											print get_exception_timestamp();
											print "\r\n";
											print '<img alt="http://192.168.1.24:8083/" src="http://192.168.1.24:8083/" width="64" height="48"/>';
										//}
										}
										/*}else{ # If the id is the same
											$motion_timer--;
											print $motion_timer;
											if ($motion_timer < 1){
												print 'No New Motion Found';
											}
										}*/
										//print "\r\n";
										//print $GLOBALS['motion_id'];
									?>
								</td>
							</div>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html> 