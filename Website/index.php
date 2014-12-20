<?php
	include("connect.php"); 	
	$conn=Connection();
	include('update_indoor_temp.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Morey - Home Information</title>
	<link rel="stylesheet" href="styles.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="script_functions.js"></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
	<script type="text/javascript">
	//reload the weather div every minute
	$(document).ready(function() {
			setInterval(function() {
				$('#weather_content_div').load(document.URL +  ' #weather_content_div');
			}, 60000);
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
									<h1>
										<h1>Menu</h1>
									</h1>
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
								<tr class="menu_row_inactive">
									<td class="menu_content">
										<h1 onclick="add_warning()" class="menu_button" id="add_warning_button">Add Warning</h1>
									</td>
								</tr>
								<tr class="menu_row_inactive">
									<td class="menu_content">
										<h1 onclick="remove_warning()" class="menu_button">Remove Warning</h1>
									</td>
								</tr>
								<tr class="menu_row_inactive">
									<td class="menu_content">
										<h1 onclick="indoor_temp('22')" class="menu_button">Indoor Temp</h1>
									</td>
								</tr>
								<tr class="menu_row_inactive">
									<td class="menu_content">
										<h1 onclick="outdoor_temp()" class="menu_button">Outdoor Temp</h1>
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
											<div id="weather_content_div">
												<img src="icons/01d.png" alt="Sunny" id="weather_icon" width="70px" height="70px">
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
							<td id="content_video_feed" align="center">
								<h1>Video Feed</h1>
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
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html> 
