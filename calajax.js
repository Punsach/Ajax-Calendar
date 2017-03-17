function loginAjax(event){
	
	var username = document.getElementById("username").value; // Get the username from the form
	var password = document.getElementById("password").value; // Get the password from the form

	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 	
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "callogin.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	alert("dosumthing");

	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			alert("You've been Logged In!");
		}else{
			alert("You were not logged in.  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}
function registerAjax(event){
	
	var new_username = document.getElementById("new_username").value; // Get the username from the form
	var new_password = document.getElementById("new_password").value; // Get the password from the form

	// Make a URL-encoded string for passing POST data:
	var dataString = "new_username=" + encodeURIComponent(new_username) + "&new_password=" + encodeURIComponent(new_password);
 	
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "calnewaccount.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.send(dataString); // Send the data

	// xmlHttp.addEventListener("load", function(event){
	// 	var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
	// 	if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
	// 		alert("You've successfully registered!");
	// 	}else{
	// 		alert("Registration failure.  "+jsonData.message);
	// 	}
	// }, false); // Bind the callback to the load event
	
}

function newEventAjax(event){
	var date = document.getElementById("date").value;
	var time = document.getElementById("time").value;
	var event_title = document.getElementById("event_title").value;
	var user = "user1";
	

	var dataString = "date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time)+ "&event_title=" + encodeURIComponent(event_title)+"&user=" + encodeURIComponent(user);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "calnewevent.php", true); // Starting a POST request 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlHttp.send(dataString);
} 
function getEvents(event){
	
	//var username="user1";
	
	var date = document.getElementById("getevents_date").value;

	var dataString = "date=" + encodeURIComponent(date);
 
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "calshowevents.php", true); 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); 
		alert(event.target.responseText);
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}
function getCount(event){

	var date="2017-01-02";

	var dataString = "date=" + encodeURIComponent(date);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "checkeventcount.php", true); 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); 
		alert(event.target.responseText);
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data

}
function deleteEvent(event){

	var id = document.getElementById("id").value;

	var dataString = "id=" + encodeURIComponent(id);
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "caldeleteevent.php", true); 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.send(dataString); // Send the data

}
function editEvent(event){

	var id = document.getElementById("edit_id").value;
	var date = document.getElementById("edit_date").value;
	var time = document.getElementById("edit_time").value;
	var title = document.getElementById("edit_title").value;

	var dataString = "id=" +encodeURIComponent(id) + "&date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time)+ "&title=" + encodeURIComponent(title);
	
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "caleditevent.php", true); // Starting a POST request 
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlHttp.send(dataString);



}
document.getElementById("register_btn").addEventListener("click", registerAjax, false); // Bind the AJAX calls to button click 
document.getElementById("login_btn").addEventListener("click", loginAjax, false); 
document.getElementById("event_btn").addEventListener("click", newEventAjax, false);
document.getElementById("getevents_btn").addEventListener("click", getEvents, false);
document.getElementById("count_btn").addEventListener("click", getCount, false);
document.getElementById("delete_btn").addEventListener("click", deleteEvent, false);
document.getElementById("edit_btn").addEventListener("click", editEvent, false);

