<?
    include_once "./config.php";
    
    $o_mail     = $_REQUEST["o_mail"];
    $c_mail     = $_REQUEST["c_mail"];

    $return_flag    = change_mail($o_mail, $c_mail);

    if ($return_flag = "Y")
    {
        echo "<script>alert('이메일이 정상적으로 변경 되었습니다.');</script>";
        echo "<script>self.close();</script>";
    }else{
        echo "<script>alert('시스템 오류입니다. 다시 시도해 주세요.');</script>";
        echo "<script>self.close();</script>";
    }
?>