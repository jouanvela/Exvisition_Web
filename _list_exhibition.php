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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Exvisition</title>

        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="bookmark" href="favicon.ico"/>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css"  rel="stylesheet"/>
	</head>
	<body class="align-center">
		<div class="container">
			<?php include("_navdark.php");?>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<!-- 展場logo -->
					<img src="./img/member/<?php echo $_SESSION['mid'];?>.png" id="member-logo"><p></p>
					<!-- 新增展覽 -->
					<div id="add-exhibition">
						<a href="_edit_exhibition.php" class="button-exvisition">新增展覽</a>
					</div>
<?php
	$SQL = "SELECT * FROM exhibition WHERE mid = '".$_SESSION['mid']."'";
    $stmt = $dbh->prepare($SQL);
    $stmt->execute();
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
    	echo '<div class="exhibition-box">';
    	echo 	'<div class="col-md-4 date">'.$rs->eStartTime.'-'.$rs->eEndTime.'</div>';
    	echo 	'<div class="col-md-6 name">'.$rs->eName.'</div>';
    	echo 	'<div class="col-md-2 edit">';
    	echo 		'<a href="_edit_exhibition.php?eid='.$rs->eid.'"><span class="glyphicon glyphicon-pencil"></span></a>';
    	echo 		'<a href="_edit_exhibition.php?eid='.$rs->eid.'"><span class="glyphicon glyphicon-remove"></span></a>';
    	echo 	'</div>';
    	echo '</div>';
    }
?>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>