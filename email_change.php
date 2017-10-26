<?
    include_once "./config.php";
    
    $o_mail     = $_REQUEST["o_mail"];
    $c_mail     = $_REQUEST["c_mail"];

    $return_flag    =change_mail($o_mail, $c_mail);

    if ($return_flag = "Y")
    {
        alert("이메일이 정상적으로 변경 되었습니다.");
        self.close();
    }else{
        alert("시스템 오류입니다. 다시 시도해 주세요.");
        self.close();        
    }
?>