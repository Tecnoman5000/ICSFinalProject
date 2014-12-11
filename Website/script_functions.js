var outside_temp_shown = false;
var previous_minute = 0;
var num_of_warnings = 0;


function startTime() {
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	if (h>12){ //turn the 24 hour clock, into a 12 hour clock
		h = h-12;
		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" PM"; 
	}else{
		document.getElementById('clock').innerHTML = h+":"+m+":"+s+" AM";
	}
	var t = setTimeout(function(){startTime()},500);
	
	if (m > previous_minute && outside_temp_shown){
		outdoor_temp();
		previous_minute = m;
	}else{
		if (m > previous_minute && !outside_temp_shown){
			indoor_temp();
			previous_minute = m;
		}
	}
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
	
	return (weather_outside_info.main.temp - 273.15) //return the current temp in C
}

function indoor_temp(){
	document.getElementById("temp").innerHTML = "22&#176C";
	outside_temp_shown = false;
}

function outdoor_temp(){
	document.getElementById("temp").innerHTML = Math.round(weather_update())+"&#176C"; //get current outside temp from api
	outside_temp_shown = true;		
}

function add_warning(){
	// Find a <table> element with id="warnings_table":
	var table = document.getElementById("warnings_table");

	// Create an empty <tr> element and add it to the 2nd position of the table:
	var row = table.insertRow(1);
	row.setAttribute("id", "warning_row_"+num_of_warnings);

	// Insert new cells (<td> elements) at the 1st position of the "new" <tr> element:
	var cell1 = row.insertCell(0);
	cell1.style.backgroundColor = "red";
	cell1.setAttribute("id", "warning_"+num_of_warnings);

	// Add some text to the new cells:
	cell1.innerHTML = "Motion Detected!";
	fade_in(cell1);

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
	alert(num_of_warnings);
	var warning_id = "warning_";
	var warning_row_id = "warning_row_"
	var current_id_num = num_of_warnings - 1;
	warning_id += current_id_num.toString();
	warning_row_id += current_id_num.toString();
	fade_out(document.getElementById(warning_id));
    //delete_row(warning_row_id);
    //document.getElementById(element).remove();
	num_of_warnings--;
	alert(num_of_warnings);
}

function fade_out(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}

function delete_row(row_id)
{
    var row = document.getElementById(row_id);
    var table = row.parentNode;
    while ( table && table.tagName != 'TABLE' )
        table = table.parentNode;
    if ( !table )
        return;
    table.deleteRow(row.rowIndex);
}

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}