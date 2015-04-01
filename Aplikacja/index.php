<html>
<head>

<link rel="Stylesheet" type="text/css" href="style/main.css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">

	function get(){
		$.post('data.php', {}, 
			function(output) {
				$('#scena').html(output).show();
			});
	}

</script>

</head>

<body>

	<center><input type="button" value="Pokaż koncerty" onClick="get();"/></center>
	<p></p>




<div id="scena">

	
	


</body>
</html>