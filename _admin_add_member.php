<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['aid']))
        header('location:_admin.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:_admin.php');
    }

    if(isset($_POST['submit']))
    {
		//password_hash
		$hash = password_hash($_POST['n_password'], PASSWORD_BCRYPT);
		$SQL = "INSERT INTO member (mName, account, pwd) VALUES (:mName, :account, :pwd)";
		$stmt = $dbh->prepare($SQL);
        $stmt->bindValue(':mName', $_POST['mName']);
        $stmt->bindValue(':account', $_POST['account']);
        $stmt->bindValue(':pwd', $hash);
		$e = $stmt->execute();
		if($e)
	        echo "
	        <script type=\"text/javascript\">
	            window.alert(\"新增成功\");
	            window.location.assign(\"_admin_list_member.php\");
	        </script>
	        ";
	    else
	        echo "
	        <script type=\"text/javascript\">
	            window.alert(\"新增失敗\");
	        </script>
	        ";
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Admin-<?php echo $title; ?></title>

        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="bookmark" href="favicon.ico"/>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/admin.css"  rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<div class="form-group">
							<label for="mName" class="col-sm-2 control-label">展館名稱</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="mName" name="mName" required>
							</div>
						</div>
						<div class="form-group">
							<label for="account" class="col-sm-2 control-label">帳號</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="account" name="account" required>
							</div>
						</div>
						<div class="form-group">
							<label for="n_password" class="col-sm-2 control-label">密碼</label>
							<div class="col-sm-10">
							<input type="password"  class="form-control" id="n_password" name="n_password" required>
							</div>
						</div>
						<div class="form-group">
							<label for="n_password2" class="col-sm-2 control-label">再輸入一次</label>
							<div class="col-sm-10">
							<input type="password"  class="form-control" id="n_password2" name="n_password2" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button name="submit" onclick="check()" class="btn btn-default">送出</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			function check(){
				with(document.all){
					if(n_password.value!=n_password2.value){
						alert("密碼輸入不相同")
						input1.value = "";
						input2.value = "";
					}
					else
						document.forms[0].submit();
				}
			}
		</script>
	</body>
</html>