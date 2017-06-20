<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<!-- Include JS File Here -->
<link href="style.css" rel="stylesheet"/>
<!-- Include JS File Here -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#btn").click(function(){
var vmesaj = $("#mesaj").val();
var vemail = $("#email").val();
if(vmesaj=='' && vemail=='')
{
alert("Please fill out the form");
}
else if(vmesaj=='' && vemail!==''){alert('Name field is required')}
else if(vemail=='' && vmesaj!==''){alert('Email field is required')}
else{
$.post("fmesaj.php", //Required URL of the page on server
{ // Data Sending With Request To Server
mesaj:vmesaj,
email:vemail
},
function(response,status){ // Required Callback Function
alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
$("#form")[0].reset();
});
}
});
});
</script>
</head>
<body>
<div id="main">
<h2>jQuery Ajax $.post() Method</h2>
<hr>
<form id="form" method="post">
<div id="namediv"><label>Name</label>
<input type="text" name="name" id="mesaj" placeholder="Name"/><br></div>
<div id="emaildiv"><label>Email</label>
<input type="text" name="email" id="email" placeholder="Email"/></div>
</form>
<button id="btn">Send Data</button>
</div>
</body>
</html>