<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['aid']))
        header('location:_admin.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:_admin.php');
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
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>展館名稱</th>
								<th>帳戶狀態</th>
								<th>有效期限</th>
								<th>編輯</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$SQL = "SELECT * FROM member ORDER BY mid ASC";
							    $stmt = $dbh->prepare($SQL);
							    $stmt->execute();
							    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
							    	switch ($rs->status) {
							    		case 'active':
							    			$color = "info";
							    			$status = "使用中";
							    			break;
							    		case 'expired':
							    			$color = "danger";
							    			$status = "已過期";
							    			break;
							    		case 'inactive':
							    			$color = "active";
							    			$status = "未啟用";
							    			break;
							    		default:
							    			$color = "";
							    			$status = "";
							    			break;
							    	}
							    	echo '
										<tr class="'.$color.'">
											<td>'.$rs->mid.'</td>
											<td>'.$rs->mName.'</td>
											<td>'.$status.'</td>
											<td>'.$rs->expireDate.'</td>
											<td></td>
										</tr>
							    	';
							    }
							?>
						</tbody>
					</table>
				</div>
				<div class="col-md-2"><a href="_admin_add_member.php" class="btn btn-info">新增</a></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/delete.js"></script>
	</body>
</html>