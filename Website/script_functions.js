var outside_temp_shown = false;
var previous_minute = 0;
var previous_second = 0;
var num_of_warnings = 0;
var warnings_timeout = [];

function minute_update(){
	if (outside_temp_shown){
		outdoor_temp();
	}else{
		if (!outside_temp_shown){
			indoor_temp();
		}
	}
	previous_minute = m;
}

function second_update(){
	for (var i = 0; i < warnings_timeout.length; i++){
		if (warnings_timeout[i] == s){
			remove_warning();
			warnings_timeout.splace(i,1);
		}
	}
	
	previous_second = s;
}

function startTime() {
	var today=new Date();
	h = today.getHours();
	m = today.getMinutes();
	s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	/*if (h=>12){ //turn the 24 hour clock, into a 12 hour clock
		h = h-12;
		if (h == 0){h = 12;}
		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" PM"; 
	}else{
		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" AM";
	}*/
	document.getElementById('clock').innerHTML = h+":"+m+":"+s;
	
	var t = setTimeout(function(){startTime()},500);
	
	if (previous_second > s){
		previous_second = s;
	}
	if (previous_minute > m){
		previous_minute = m;
	}
	
	if (m > previous_minute){minute_update()};
	if (s > previous_second){second_update()};
}

function checkTime(i) {
	if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
	return i;
}

function weather_update(){
	var xmlhttp = new XMLHttpRequest();
	var url = "http://api.openweathermap.org/data/2.5/weather?q=kingston,canada";
	xmlhttp.open("GET", url, false);
	xmlhttp.send();
	
	console.log(xmlhttp.status);
	console.log(xmlhttp.statusText);
	
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var api_input = xmlhttp.responseText;
		var weather_outside_info = JSON.parse(api_input);
	}
	
	return (weather_outside_info) //return the current temp in C
}

function indoor_temp(){
	document.getElementById("temp").innerHTML = "22&#176C";
	document.getElementById("weather_icon").src="icons/01d.png";
	outside_temp_shown = false;
}

function outdoor_temp(){
	var outside_temp = Math.round(weather_update().main.temp - 273.15);
	var icon_name = weather_update().weather[0].icon;
	document.getElementById("temp").innerHTML = outside_temp+"&#176C"; //get current outside temp from api
	document.getElementById("weather_icon").src="icons/"+icon_name+".png";
	outside_temp_shown = true;		
}

function add_warning(){
	if (num_of_warnings < 0){num_of_warnings = 0;}

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
	cell1.setAttribute("id", "warning_"+num_of_warnings);

	// Add some text to the new cells:
	cell1.innerHTML = "Motion Detected!: " + s;
	fade_in(cell1);

	warnings_timeout.push(s);
	num_of_warnings++;
}

function fade_in(element) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);
}

function remove_warning(){
	warning_id = "warning_";
	warning_row_id = "warning_row_"
	var current_id_num = num_of_warnings - 1;
	warning_id += current_id_num.toString();
	warning_row_id += current_id_num.toString();
	fade_out(document.getElementById(warning_id), warning_row_id);
	num_of_warnings--;
}

function fade_out(element, number) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
            document.getElementById(number).remove();
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}

Element.prototype.remove = function() { //use 'document.getElementById(element).remove()'
    this.parentElement.removeChild(this);
}