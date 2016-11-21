<?php
    include("db.php");
    session_start();
    if(isset($_SESSION['aid']))
        header('location:_admin_list_member.php');
    else if(isset($_POST['account'])){
        $account  = $_POST['account'];
        $password   = $_POST['password'];

        $SQL = "SELECT * FROM admin WHERE account = :account";
        $stmt = $dbh->prepare($SQL);
        $stmt->bindValue(':account', $account);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if( $rs == NULL ){
            echo "
            <script type=\"text/javascript\">
            window.alert(\"帳號錯誤\");
            </script>
            ";
        }
        else{
            $pwdcheck = password_verify($password, $rs->pwd);
            if($pwdcheck != 1){
                echo "
                <script type=\"text/javascript\">
                window.alert(\"密碼錯誤\");
                </script>
                ";
            }
            else if($pwdcheck){
                $_SESSION['aid']   = $rs->aid;
                $_SESSION['aName'] = $rs->aName;
                header('location:_admin_list_member.php');
            }
        }
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
        <link href="css/style.css"  rel="stylesheet"/>
    </head>
    <body class="bg-brown">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <img src="img/logo.png" id="index-logo">
                    <!-- 登入帳密 -->
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1 item-text">
                                <input type="text" class="form-control" name="account" id="account" placeholder="帳號">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1 item-text">
                                <input type="password" class="form-control" name="password" id="password" placeholder="密碼">
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <button type="submit" class="button-exvisition" name="submit">登入</button>
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