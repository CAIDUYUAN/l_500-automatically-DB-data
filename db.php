<?php
    $host='localhost';
    $user='coehdnjs';
    $pw='Coehdnjs0131cn';
    $dbName='coehdnjs';
    $db=new mysqli($host,$user,$pw,$dbName);
    $db->set_charset("utf8");

    
    if(mysqli_connect_errno())
    {
        echo'데이터베이스 접속 실패';
        echo mysqli_connect_error();
    }
?>
