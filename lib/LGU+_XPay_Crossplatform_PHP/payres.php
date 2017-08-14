<?php
	session_save_path($_SERVER['DOCUMENT_ROOT']."/session");
	ini_set("session.cache_expire", 180); // ���� ��ȿ�ð� : ��
	ini_set("session.gc_maxlifetime", 180); // ���� ������ �÷���(�α��ν� �������� �ð�) :
	session_start();
	header("Content-Type: text/html; charset=UTF-8");

	include_once $_SERVER['DOCUMENT_ROOT']."/include/global.php"; 				//��������
	include_once $_SERVER['DOCUMENT_ROOT']."/include/function.php"; 				//�Լ�����
	include_once $_SERVER['DOCUMENT_ROOT']."/include/dbi.php"; 					//DB ��������
	include_once $_SERVER['DOCUMENT_ROOT']."/include/dir.php"; 					//�������

	/*
     * [����������û ������(STEP2-2)]
	 *
	 * �Ŵ��� "5.1. XPay ���� ��û ������ ����"�� "�ܰ� 5. ���� ���� ��û �� ��û ��� ó��" ����
     *
     * LG���÷������� ���� �������� LGD_PAYKEY(����Key)�� ������ ���� ������û.(�Ķ���� ���޽� POST�� ����ϼ���)
     */

	$configPath = $_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom"; //LG���÷������� ������ ȯ������("/conf/lgdacom.conf,/conf/mall.conf") ��ġ ����. 

    /*
     *************************************************
     * 1.�������� ��û - BEGIN
     *  (��, ���� �ݾ�üũ�� ���Ͻô� ��� �ݾ�üũ �κ� �ּ��� ���� �Ͻø� �˴ϴ�.)
     *************************************************
     */
    $CST_PLATFORM               = $_POST["CST_PLATFORM"];
    $CST_MID                    = $_POST["CST_MID"];
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
    $LGD_PAYKEY                 = $_POST["LGD_PAYKEY"];

    require_once($_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom/XPayClient.php");

	// (1) XpayClient�� ����� ���� xpay ��ü ����
	// (2) Init: XPayClient �ʱ�ȭ(ȯ�漳�� ���� �ε�) 
	// configPath: ��������
	// CST_PLATFORM: - test, service ���� ���� lgdacom.conf�� test_url(test) �Ǵ� url(srvice) ���
	//				- test, service ���� ���� �׽�Ʈ�� �Ǵ� ���񽺿� ���̵� ����
    $xpay = &new XPayClient($configPath, $CST_PLATFORM);
	
	// (3) Init_TX: �޸𸮿� mall.conf, lgdacom.conf �Ҵ� �� Ʈ������� ������ Ű TXID ����
	$xpay->Init_TX($LGD_MID);    
    $xpay->Set("LGD_TXNAME", "PaymentByKey");
    $xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);
    
    //�ݾ��� üũ�Ͻñ� ���ϴ� ��� �Ʒ� �ּ��� Ǯ� �̿��Ͻʽÿ�.
	//$DB_AMOUNT = "DB�� ���ǿ��� ������ �ݾ�"; //�ݵ�� �������� �Ұ����� ��(DB�� ����)���� �ݾ��� �������ʽÿ�.
	//$xpay->Set("LGD_AMOUNTCHECKYN", "Y");
	//$xpay->Set("LGD_AMOUNT", $DB_AMOUNT);
	    
    /*
     *************************************************
     * 1.�������� ��û(�������� ������) - END
     *************************************************
     */

    /*
     * 2. �������� ��û ���ó��
     *
     * ���� ������û ��� ���� �Ķ���ʹ� �����޴����� �����Ͻñ� �ٶ��ϴ�.
     */
	// (4) TX: lgdacom.conf�� ������ URL�� ���� ����Ͽ� ���� ������û, ��������� true, false ����
    if ($xpay->TX()) {
        //1)������� ȭ��ó��(����,���� ��� ó���� �Ͻñ� �ٶ��ϴ�.)
        echo "������û�� �Ϸ�Ǿ����ϴ�.  <br>";
        echo "TX ��� �����ڵ� = " . $xpay->Response_Code() . "<br>";		//��� �����ڵ�("0000" �� �� ��� ����)
        echo "TX ��� ����޽��� = " . $xpay->Response_Msg() . "<p>";
            
        echo "�ŷ���ȣ : " . $xpay->Response("LGD_TID",0) . "<br>";
        echo "�������̵� : " . $xpay->Response("LGD_MID",0) . "<br>";
        echo "�����ֹ���ȣ : " . $xpay->Response("LGD_OID",0) . "<br>";
        echo "�����ݾ� : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
        echo "����ڵ� : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";	//LGD_RESPCODE �� �ݵ�� "0000" �϶��� ���� ����, �� �ܴ� ��� ����
        echo "����޼��� : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
            
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        echo "<p>";
        
		// (5) DB�� ��û ��� ó��
        if( "0000" == $xpay->Response_Code() ) {
			//��Ż��� ������ ������
         	//����������û ��� ���� DBó��(LGD_RESPCODE ���� ���� ������ ��������, �������� DBó��)
           	//echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br>";

            //����������û ����� DBó���մϴ�. (�������� �Ǵ� ���� ��� DBó�� ����)
			$pay_query		= "INSERT INTO ".$_gl['payment_info_table']."(LGD_RESPCODE, LGD_RESPMSG, LGD_MID, LGD_OID, LGD_AMOUNT, LGD_TID, LGD_PAYTYPE, LGD_PAYDATE, LGD_HASHDATA, LGD_TIMESTAMP, LGD_BUYER, LGD_PRODUCTINFO, LGD_BUYERID, LGD_BUYERADDRESS, LGD_BUYERPHONE, LGD_BUYEREMAIL, LGD_PRODUCTCODE, LGD_RECEIVER, LGD_RECEIVERPHONE, LGD_DELIVERYINFO, LGD_FINANCECODE, LGD_FINANCENAME, LGD_FINANCEAUTHNUM, LGD_ESCROWYN, LGD_CASHRECEIPTNUM, LGD_CASHRECEIPTSELFYN, LGD_CASHRECEIPTKIND, LGD_CARDNUM, LGD_CARDINSTALLMONTH, LGD_CARDNOINTYN, LGD_AFFILIATECODE, LGD_CARDGUBUN1, LGD_CARDGUBUN2, LGD_CARDACQUIRER, LGD_PCANCELFLAG, LGD_PCANCELSTR, LGD_TRANSAMOUNT, LGD_EXCHANGERATE, LGD_DISCOUNTUSEYN, LGD_DISCOUNTUSEAMOUNT, LGD_ACCOUNTNUM, LGD_ACCOUNTOWNER, LGD_PAYER, LGD_CASTAMOUNT, LGD_CASCAMOUNT, LGD_CASFLAG, LGD_CASSEQNO, LGD_SAOWNER, LGD_TELNO, LGD_OCBAMOUNT, LGD_OCBSAVEPOINT, LGD_OCBTOTALPOINT, LGD_OCBUSABLEPOINT, LGD_OCBTID) values('".$xpay->Response_Code()."','".iconv("EUC-KR","UTF-8",$xpay->Response_Msg())."','".$xpay->Response("LGD_MID",0)."','".$xpay->Response("LGD_OID",0)."','".$xpay->Response("LGD_AMOUNT",0)."','".$xpay->Response("LGD_TID",0)."','".$xpay->Response("LGD_PAYTYPE",0)."','".$xpay->Response("LGD_PAYDATE",0)."','".$xpay->Response("LGD_HASHDATA",0)."','".$xpay->Response("LGD_TIMESTAMP",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYER",0))."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_PRODUCTINFO",0))."','".$xpay->Response("LGD_BUYERID",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYERADDRESS",0))."','".$xpay->Response("LGD_BUYERPHONE",0)."','".$xpay->Response("LGD_BUYEREMAIL",0)."','".$xpay->Response("LGD_PRODUCTCODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_RECEIVER",0))."','".$xpay->Response("LGD_RECEIVERPHONE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_DELIVERYINFO",0))."','".$xpay->Response("LGD_FINANCECODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_FINANCENAME",0))."','".$xpay->Response("LGD_FINANCEAUTHNUM",0)."','".$xpay->Response("LGD_ESCROWYN",0)."','".$xpay->Response("LGD_CASHRECEIPTNUM",0)."','".$xpay->Response("LGD_CASHRECEIPTSELFYN",0)."','".$xpay->Response("LGD_CASHRECEIPTKIND",0)."','".$xpay->Response("LGD_CARDNUM",0)."','".$xpay->Response("LGD_CARDINSTALLMONTH",0)."','".$xpay->Response("LGD_CARDNOINTYN",0)."','".$xpay->Response("LGD_AFFILIATECODE",0)."','".$xpay->Response("LGD_CARDGUBUN1",0)."','".$xpay->Response("LGD_CARDGUBUN2",0)."','".$xpay->Response("LGD_CARDACQUIRER",0)."','".$xpay->Response("LGD_PCANCELFLAG",0)."','".$xpay->Response("LGD_PCANCELSTR",0)."','".$xpay->Response("LGD_TRANSAMOUNT",0)."','".$xpay->Response("LGD_EXCHANGERATE",0)."','".$xpay->Response("LGD_DISCOUNTUSEYN",0)."','".$xpay->Response("LGD_DISCOUNTUSEAMOUNT",0)."','".$xpay->Response("LGD_ACCOUNTNUM",0)."','".$xpay->Response("LGD_ACCOUNTOWNER",0)."','".$xpay->Response("LGD_PAYER",0)."','".$xpay->Response("LGD_CASTAMOUNT",0)."','".$xpay->Response("LGD_CASCAMOUNT",0)."','".$xpay->Response("LGD_CASFLAG",0)."','".$xpay->Response("LGD_CASSEQNO",0)."','".$xpay->Response("LGD_SAOWNER",0)."','".$xpay->Response("LGD_TELNO",0)."','".$xpay->Response("LGD_OCBAMOUNT",0)."','".$xpay->Response("LGD_OCBSAVEPOINT",0)."','".$xpay->Response("LGD_OCBTOTALPOINT",0)."','".$xpay->Response("LGD_OCBUSABLEPOINT",0)."','".$xpay->Response("LGD_OCBTID",0)."')";
			$pay_result 		= mysqli_query($my_db, $pay_query);

print_r($pay_query);

			//������ DB�� ��� ������ ó���� ���� ���Ѱ�� false�� ������ �ּ���.
          	$isDBOK = true; 
          	if( !$isDBOK ) {
           		echo "<p>";
           		$xpay->Rollback("���� DBó�� ���з� ���Ͽ� Rollback ó�� [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
            		
                echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br>";
                echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
            		
                if( "0000" == $xpay->Response_Code() ) {
                  	echo "�ڵ���Ұ� ���������� �Ϸ� �Ǿ����ϴ�.<br>";
                }else{
          			echo "�ڵ���Ұ� ���������� ó������ �ʾҽ��ϴ�.<br>";
                }
          	}            	
        }else{
          	//��Ż��� ���� �߻�(����������û ��� ���� DBó��)
         	echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br>";            	            
        }
    }else {
        //2)API ��û���� ȭ��ó��
        echo "������û�� �����Ͽ����ϴ�.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //����������û ��� ���� DBó��
        echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br>";            	                        
    }
?>
