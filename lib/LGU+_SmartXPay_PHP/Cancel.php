<?php
    /*
     * [������� ��û ������]
     *
	 * �Ŵ��� "6. ���� ��Ҹ� ���� ���߻���(API)"�� "�ܰ� 3. ���� ��� ��û �� ��û ��� ó��" ����
     * LG���÷������� ���� �������� �ŷ���ȣ(LGD_TID)�� ������ ��� ��û�� �մϴ�.(�Ķ���� ���޽� POST�� ����ϼ���)
     * (���ν� LG���÷������� ���� �������� PAYKEY�� ȥ������ ������.)
     */
    $CST_PLATFORM               = $_POST["CST_PLATFORM"];					//LG���÷��� ���� ���� ����(test:�׽�Ʈ, service:����)
    $CST_MID                    = $_POST["CST_MID"];						//�������̵�(LG���÷������� ���� �߱޹����� �������̵� �Է��ϼ���)
																			//�׽�Ʈ ���̵�� 't'�� �ݵ�� �����ϰ� �Է��ϼ���.
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;  //�������̵�(�ڵ�����)    
    $LGD_TID                	= $_POST["LGD_TID"];						//LG���÷������� ���� �������� �ŷ���ȣ(LGD_TID)
    
 	/* �� �߿�
	* ȯ�漳�� ������ ��� �ݵ�� �ܺο��� ������ ������ ��ο� �νø� �ȵ˴ϴ�.
	* �ش� ȯ�������� �ܺο� ������ �Ǵ� ��� ��ŷ�� ������ �����ϹǷ� �ݵ�� �ܺο��� ������ �Ұ����� ��ο� �νñ� �ٶ��ϴ�. 
	* ��) [Window �迭] C:\inetpub\wwwroot\lgdacom ==> ����Ұ�(�� ���丮)
	*/
 	$configPath 				= "C:/lgdacom"; 						 //LG���÷������� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����.   
    
    require_once("./lgdacom/XPayClient.php");
    
	// (1) XpayClient�� ����� ���� xpay ��ü ����
	// (2) Init: XPayClient �ʱ�ȭ(ȯ�漳�� ���� �ε�) 
	// configPath: ��������
	// CST_PLATFORM: - test, service ���� ���� lgdacom.conf�� test_url(test) �Ǵ� url(srvice) ���
	//				- test, service ���� ���� �׽�Ʈ�� �Ǵ� ���񽺿� ���̵� ����
	$xpay = &new XPayClient($configPath, $CST_PLATFORM);

	// (3) Init_TX: �޸𸮿� mall.conf, lgdacom.conf �Ҵ� �� Ʈ������� ������ Ű TXID ����
    $xpay->Init_TX($LGD_MID);
    $xpay->Set("LGD_TXNAME", "Cancel");
    $xpay->Set("LGD_TID", $LGD_TID);
    
    /*
     * 1. ������� ��û ���ó��
     *
     * ��Ұ�� ���� �Ķ���ʹ� �����޴����� �����Ͻñ� �ٶ��ϴ�.
     */
	// (4) TX: lgdacom.conf�� ������ URL�� ���� ����Ͽ� ���� ������û, ��������� true, false ����
    if ($xpay->TX()) {
		// (5) ������ҿ�û ��� ó��
        //1)������Ұ�� ȭ��ó��(����,���� ��� ó���� �Ͻñ� �ٶ��ϴ�.)
        echo "���� ��ҿ�û�� �Ϸ�Ǿ����ϴ�.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
    }else {
        //2)API ��û ���� ȭ��ó��
        echo "���� ��ҿ�û�� �����Ͽ����ϴ�.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
    }
?>
