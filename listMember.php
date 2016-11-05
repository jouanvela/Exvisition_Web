<?php

	include("db.php");

    $SQL = 'SELECT * FROM `member` WHERE 1 ORDER BY mid';
    $stmt = $dbh->prepare("$SQL");
    $stmt->execute();

    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        $mid        = $rs->mid;
        $mName		= $rs->mName;
        $pwd		= $rs->pwd;
        //$a = array("mid" => $mid, "mName" => $mName);
        echo $mid.";";
        //echo json_encode($a, JSON_UNESCAPED_UNICODE);
    }
?>
