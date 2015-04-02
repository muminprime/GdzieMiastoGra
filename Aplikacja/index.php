<html>
<head>

<link rel="Stylesheet" type="text/css" href="style/main.css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">

	function get(){
		$('#scena').hide();
		$.post('data.php', {}, 
			function(output) {
				$('#scena').html(output).fadeIn(1000);
			});
	}

</script>

</head>

<body>

	<center><input type="button" value="Pokaż koncerty" onClick="get();"/></center>
	<p></p>



<div id="scena_do_pojawiania">
	<div id="scena">
	</div>
</div>
</body>
</html>