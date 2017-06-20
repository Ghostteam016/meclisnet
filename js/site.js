$(document).ready(function () {
$(".responsive-calendar").responsiveCalendar({
  time: '2013-05',
  events: {
	"2013-04-30": {"number": 5, },
	"2013-04-26": {"number": 1, }, 
	"2013-05-03":{"number": 1}, 
	"2013-06-12": {},
        "2013-04-30": {"number": 5, "badgeClass": "badge-warning", "url": "http://w3widgets.com/responsive-calendar"},
        "2013-04-26": {"number": 1, "badgeClass": "badge-warning", "url": "http://w3widgets.com"}, 
        "2013-05-03": {"number": 1, "badgeClass": "badge-error"}, 
        "2013-06-12": {}
        }
	});
});

$(".container").on("click", "#mesajlink", function() {
	$.ajax({
		url: "ajax/mesaj.php",
		cache: false
	}).done(function(data) {
		$("#container2").html(data);
	});
});

$("#dilekcelink").on("click", function(){
	$.ajax({
		url: "ajax/dilekce.php",
		cache: false
	}).done(function(data) {
		$("#container2").html(data);
	});
});

$("#tutanaklink").on("click", function(){
	$.ajax({
		url: "ajax/tutanak.php",
		cache: false
	}).done(function(data) {
		$("#container2").html(data);
	});
});

$("#editlink").on("click", function(){
	$.ajax({
		url: "ajax/edit.php",
		cache: false
	}).done(function(data) {
		$("#container2").html(data);
	});
});

$("#inboxlink").on("click", function(){
	$.ajax({
		url: "ajax/inbox.php",
		cache: false
	}).done(function(data) {
		$("#ortakisim").html(data);
	});
});
$("#fileboxlink").on("click", function() {
        $.ajax({
		url: "ajax/filebox.php",
		cache: false
	}).done(function(data) {
		$("#ortakisim").html(data);
	});
});
$("#read").on("click", function(){
	$.ajax({
		url: "ajax/read-mail.php",
		cache: false
	}).done(function(data) {
		$("#ortakisim").html(data);
	});
});
$("#viewprofil").on("click", function(){
	$.ajax({
		url: "ajax/viewprofil.php",
		cache: false
	}).done(function(data) {
		$("#container2").html(data);
	});
});

$(".container").on("click", "#inbox", function(){
	$.ajax({
		url: "ajax/inbox.php",
		cache: false
	}).done(function(data) {
		$("#inboxing").html(data);
	});
});
$(".container").on("click", "#composelink", function(){
	$.ajax({
		url: "ajax/compose.php",
		cache: false
	}).done(function(data) {
		$("#inboxing").html(data);
	});
	
});
$(".container").on("click","#read",function(){
  $.ajax({
  	url:"ajax/read-mail.php",
  	cache: false
  }).done(function(data) {
  	 $("#readmessage").html(data);

	});
});

