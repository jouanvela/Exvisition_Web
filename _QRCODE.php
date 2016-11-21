<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
        header('location:index.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $title; ?></title>
	</head>
	<body>
<?php
	$width=500;
	$height=500;
	$info=$_GET["iid"];
	echo "<img src=\"https://chart.googleapis.com/chart?chs=" . $width . "x" . $height . "&cht=qr&chl=" . $info . "&choe=UTF-8\">";
?>
	</body>
</html>