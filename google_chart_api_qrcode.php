<?php
	$width=$_POST["wid"];
	$height=$_POST["hei"];
	$info=$_POST["str"];
	echo "<img src=\"https://chart.googleapis.com/chart?chs=" . $width . "x" . $height . "&cht=qr&chl=" . $info . "&choe=UTF-8\">";
?>
<html>
	<head>
		<title>Google Chart API產生QR Code</title>
	</head>
	<body>
		<form method="post" action="">
			data<input type="text" name="str"><br/>
			width<input type="text" name="wid"><br>
			height<input type="text" name="hei"><br/>
			<input type="submit">
		</form>
	</body>
</html>