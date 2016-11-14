<?php
    include("db.php");
    session_start();
    if(isset($_SESSION['mid']))
    {
        header('location:p2.php');
    }
    else if(isset($_POST['account']))
    {
        $account  = $_POST['account'];
        $password   = $_POST['password'];

        $SQL = "SELECT * FROM member WHERE mid = '".$account."'";
        $stmt = $dbh->prepare("$SQL");
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        //password_hash
        $pwdcheck = password_verify($password, $rs->pwd);

        if( $rs == NULL )
        {
            echo "
            <script type=\"text/javascript\">
            window.alert(\"帳號錯誤\");
            </script>
            ";
        }
        else if($pwdcheck != 1)
        {
            echo "
            <script type=\"text/javascript\">
            window.alert(\"密碼錯誤\");
            </script>
            ";
        }
        else if($pwdcheck)
        {
            //------
            $_SESSION['mid']   = $rs->mid;
            $_SESSION['mName'] = $rs->mName;
            header('location:p2.php');
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css"  rel="stylesheet"/>
	</head>
	<body class="bg-brown align-center">
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<img src="img/logo.png" id="index-logo">
					<!-- 登入帳密 -->
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					  	<div class="form-group">
							<input type="text" class="form-control" name="account" id="account" placeholder="帳號">
					  	</div>
					  	<div class="form-group">
					      	<input type="password" class="form-control" name="password" id="password" placeholder="密碼">
					  	</div>
						<div class="form-group">
                            <br>
						    <button type="submit" class="btn btn-default" name="submit">登入</button>
						</div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>