<?php
    /*
     * [����������û ������(STEP2-2)]
	 *
	 * �Ŵ��� "5.1. XPay ���� ��û ������ ����"�� "�ܰ� 5. ���� ���� ��û �� ��û ��� ó��" ����
     *
     * LG���÷������� ���� �������� LGD_PAYKEY(����Key)�� ������ ���� ������û.(�Ķ���� ���޽� POST�� ����ϼ���)
     */

	$configPath = $_SERVER['DOCUMENT_ROOT']."/dev/lib/LGU+_SmartXPay_PHP/lgdacom"; //LG���÷������� ������ ȯ������("/conf/lgdacom.conf,/conf/mall.conf") ��ġ ����. 

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

    require_once("./lgdacom/XPayClient.php");

	// (1) XpayClient�� ����� ���� xpay ��ü ����
	// (2) Init: XPayClient �ʱ�ȭ(ȯ�漳�� ���� �ε�) 
	// configPath: ��������
	// CST_PLATFORM: - test, service ���� ���� lgdacom.conf�� test_url(test) �Ǵ� url(srvice) ���
	//				- test, service ���� ���� �׽�Ʈ�� �Ǵ� ���񽺿� ���̵� ����
    $xpay = new XPayClient($configPath, $CST_PLATFORM);
	
	// (3) Init_TX: �޸𸮿� mall.conf, lgdacom.conf �Ҵ� �� Ʈ������� ������ Ű TXID ����
    if (!$xpay->Init_TX($LGD_MID)) {
    	echo "LG���÷������� ������ ȯ�������� ���������� ��ġ �Ǿ����� Ȯ���Ͻñ� �ٶ��ϴ�.<br/>";
    	echo "mall.conf���� Mert Id = Mert Key �� �ݵ�� ��ϵǾ� �־�� �մϴ�.<br/><br/>";
    	echo "������ȭ LG���÷��� 1544-7772<br/>";
    	exit;
    }
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
        echo "������û�� �Ϸ�Ǿ����ϴ�.  <br/>";
        echo "TX ��� �����ڵ� = " . $xpay->Response_Code() . "<br/>";		//��� �����ڵ�("0000" �� �� ��� ����)
        echo "TX ��� ����޽��� = " . $xpay->Response_Msg() . "<p>";
            
        echo "�ŷ���ȣ : " . $xpay->Response("LGD_TID",0) . "<br/>";
        echo "�������̵� : " . $xpay->Response("LGD_MID",0) . "<br/>";
        echo "�����ֹ���ȣ : " . $xpay->Response("LGD_OID",0) . "<br/>";
        echo "�����ݾ� : " . $xpay->Response("LGD_AMOUNT",0) . "<br/>";
        echo "����ڵ� : " . $xpay->Response("LGD_RESPCODE",0) . "<br/>";	//LGD_RESPCODE �� �ݵ�� "0000" �϶��� ���� ����, �� �ܴ� ��� ����
        echo "����޼��� : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
            
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            echo $name . " = " . $xpay->Response($name, 0) . "<br/>";
        }
          
        echo "<p>";
        
		// (5) DB�� ��û ��� ó��
        if( "0000" == $xpay->Response_Code() ) {
			//��Ż��� ������ ������
         	//����������û ��� ���� DBó��(LGD_RESPCODE ���� ���� ������ ��������, �������� DBó��)
           	echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br/>";

            //����������û ����� DBó���մϴ�. (�������� �Ǵ� ���� ��� DBó�� ����)
			//������ DB�� ��� ������ ó���� ���� ���Ѱ�� false�� ������ �ּ���.
          	$isDBOK = true; 
          	if( !$isDBOK ) {
           		echo "<p>";
           		$xpay->Rollback("���� DBó�� ���з� ���Ͽ� Rollback ó�� [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
            		
                echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br/>";
                echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
            		
                if( "0000" == $xpay->Response_Code() ) {
                  	echo "�ڵ���Ұ� ���������� �Ϸ� �Ǿ����ϴ�.<br/>";
                }else{
          			echo "�ڵ���Ұ� ���������� ó������ �ʾҽ��ϴ�.<br/>";
                }
          	}            	
        }else{
          	//��Ż��� ���� �߻�(����������û ��� ���� DBó��)
         	echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br/>";            	            
        }
    }else {
        //2)API ��û���� ȭ��ó��
        echo "������û�� �����Ͽ����ϴ�.  <br/>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br/>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //����������û ��� ���� DBó��
        echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br/>";            	                        
    }
?>
