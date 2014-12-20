var outside_temp_shown = true;
var previous_minute = 0; //start the timed minute check
var previous_second = 0; //start the timed second check
var num_of_warnings = 0; //hold the number of active warnings
var warnings_timeout = []; //hold the point at which a warning should be removed

//init function
function init(){
	startTime();
	second_update();
	minute_update();
	outdoor_temp();
}

//run on the minute
function minute_update(){
	if (outside_temp_shown){ //check is the outside temp is currently displayed
		outdoor_temp(); //update outside temp
	}else{ //if inside temp is displayed
			indoor_temp(); //update indoor temp
	}

	var minute = setTimeout(minute_update, 60000);
}

//run on the second
function second_update(){
	for (var i = 0; i < warnings_timeout.length; i++){ //for the number of warnings displayed
		if (warnings_timeout[i] == s){ //if the current second is the same as the end time for the warning
			warning_id = "warning_";
            warning_row_id = "warning_row_"
            var current_id_num = num_of_warnings - 1;
            warning_id += current_id_num.toString();
            warning_row_id += current_id_num.toString();

			var e = document.getElementById(warning_id);
			e.setAttribute("id", "toDelete");
			e = document.getElementById(warning_row_id);
            e.setAttribute("id", "toDelete_row");
			warnings_timeout.splice(i,1);
			num_of_warnings--;
		}

	}
	remove_warning();
	var second = setTimeout(second_update, 1000);
}

function startTime() {
	var today=new Date();
	h = today.getHours();
	m = today.getMinutes();
	s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	/*if (h => 12){ //turn the 24 hour clock, into a 12 hour clock

		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" PM"; 
	}else{
		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" AM";
	}*/
	document.getElementById('clock').innerHTML = h+":"+m+":"+s;

	var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
	return i;
}

//weather api interface
function weather_update(){
	var xmlhttp = new XMLHttpRequest();
	var url = "http://api.openweathermap.org/data/2.5/weather?q=kingston,canada";
	xmlhttp.open("GET", url, false);
	xmlhttp.send();
	
	console.log(xmlhttp.status);
	console.log(xmlhttp.statusText);
	
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { //check to see if connection was successful
		var api_input = xmlhttp.responseText; //hold the api JSON input
		var weather_outside_info = JSON.parse(api_input); //Format input
	}
	
	return (weather_outside_info) //return the current temp
}

//display indoor temp
function indoor_temp(){
	document.getElementById("temp_outdoor").style.display = "none";
	document.getElementById("weather_icon").src= "01d.png"; // update weather icon
	document.getElementById("temp_indoor").style.display = "inline";
	outside_temp_shown = false;
}

//display outside temp
function outdoor_temp(){
	document.getElementById("temp_indoor").style.display = "none";

	var outside_temp = Math.round(weather_update().main.temp - 273.15); //calculate the temp in C
	var icon_name = weather_update().weather[0].icon; //hold icon name
	document.getElementById("temp_outdoor_h1").innerHTML = outside_temp+"&#176C"; //get current outside temp from api
	document.getElementById("weather_icon").src= icon_name+".png"; // update weather icon
	document.getElementById("temp_outdoor").style.display = "inline";
	outside_temp_shown = true;
}


//add warnings
function add_warning(){
	if (num_of_warnings < 0){num_of_warnings = 0;} //make sure the number of warnings isn't below zero

	// Find a <table> element with id="warnings_table":
	var table = document.getElementById("warnings_table");

	// Create an empty <tr> element and add it to the 2nd position of the table:
	var row = table.insertRow(1);
	row.setAttribute("id", "warning_row_"+num_of_warnings);

	// Insert new cells (<td> elements) at the 1st position of the "new" <tr> element:
	var cell1 = row.insertCell(0);
	cell1.style.backgroundColor = "red";
	cell1.style.paddingLeft = "2px";
	cell1.style.paddingRight = "2px";
	cell1.style.opacity="0.0"
	cell1.setAttribute("id", "warning_"+num_of_warnings);

	// Add some text to the new cells:
	cell1.innerHTML = "Motion Detected!: " + s;
	fade_in(cell1);

	//add timeout to array
	warnings_timeout.push(s-1);
	num_of_warnings++;
}

//remove warnings (needs a lot of work)
function remove_warning(){
		fade_out(document.getElementById("toDelete"), "toDelete_row");
}


//testing for menu animation
function menu_open(){
	/*// Find a <table> element with id="menu_table":
	var table = document.getElementById("menu_table");

	// Create an empty <tr> element and add it to the 2nd position of the table:
	var row = table.insertRow(1);
	row.className = "menu_row";

	// Insert new cells (<td> elements) at the 1st position of the "new" <tr> element:
	var button_home = row.insertCell(0);
	button_home.className = "menu_content";
	button_home.innerHTML = "<a href='index.html' class='menu_button'><h1>Home</h1></a>";*/
}

/////////////////////////
/////tool functions/////
////////////////////////

//fade in element
function fade_in(element) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 10){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += 0.1;
    }, 100);
}

//fade out element
function fade_out(element, row) {
    var op = 10;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
            document.getElementById(row).remove();
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}

//return if a string is a number
function isNumber(num_to_check){
    re = /^[A-Za-z]+$/; //parameters for the check
    if(re.test(num_to_check)){return false;} //if it contains characters that match the parameters
    else{return true;} //if it passes
}

//use to remove elements cleanly
Element.prototype.remove = function() { //usage 'document.getElementById(element).remove()'
    this.parentElement.removeChild(this);
}
