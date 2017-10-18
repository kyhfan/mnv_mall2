<?php
	session_start();
    /*
     * [���� ������û ������(STEP2-1)]
     *
     * ���������������� �⺻ �Ķ���͸� ���õǾ� ������, ������ �ʿ��Ͻ� �Ķ���ʹ� �����޴����� �����Ͻþ� �߰� �Ͻñ� �ٶ��ϴ�.     
     */

    /*
     * 1. �⺻���� ������û ���� ����
     * 
     * �⺻������ �����Ͽ� �ֽñ� �ٶ��ϴ�.(�Ķ���� ���޽� POST�� ����ϼ���)
     */
    $CST_PLATFORM               = $_POST["CST_PLATFORM"];				//LG���÷��� ���� ���� ����(test:�׽�Ʈ, service:����)
    $CST_MID                    = $_POST["CST_MID"];					//�������̵�(LG���÷������� ���� �߱޹����� �������̵� �Է��ϼ���)
                                                                        //�׽�Ʈ ���̵�� 't'�� �ݵ�� �����ϰ� �Է��ϼ���.
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;  //�������̵�(�ڵ�����)
    $LGD_OID                    = $_POST["LGD_OID"];					//�ֹ���ȣ(�������� ����ũ�� �ֹ���ȣ�� �Է��ϼ���)
    $LGD_AMOUNT                 = $_POST["LGD_AMOUNT"];					//�����ݾ�("," �� ������ �����ݾ��� �Է��ϼ���)
    $LGD_BUYER                  = $_POST["LGD_BUYER"];					//�����ڸ�
    $LGD_PRODUCTINFO            = $_POST["LGD_PRODUCTINFO"];			//��ǰ��
    $LGD_BUYEREMAIL             = $_POST["LGD_BUYEREMAIL"];				//������ �̸���
    $LGD_CUSTOM_FIRSTPAY        = $_POST["LGD_CUSTOM_FIRSTPAY"];		//�������� �ʱ��������
    $LGD_TIMESTAMP              = date(YmdHis);                         //Ÿ�ӽ�����
    $LGD_PCVIEWYN				= $_POST["LGD_PCVIEWYN"];				//�޴�����ȣ �Է� ȭ�� ��� ����(����Ĩ�� ���� �ܸ��⿡�� �Է�-->����Ĩ�� �ִ� �޴������� ���� ����)
	$LGD_CUSTOM_SKIN            = "SMART_XPAY2";                        //�������� ����â ��Ų
    
	$configPath 				= "./lgdacom"; 						//LG���÷������� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����. 	    
    
    /*
     * �������(������) ���� ������ �Ͻô� ��� �Ʒ� LGD_CASNOTEURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. 
     */    
    $LGD_CASNOTEURL				= "http://www.store-chon.com/dev/cas_noteurl.php";    

    /*
     * LGD_RETURNURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. �ݵ�� ���� �������� ������ ����Ʈ�� ��  ȣ��Ʈ�̾�� �մϴ�. �Ʒ� �κ��� �ݵ�� �����Ͻʽÿ�.
     */    
    $LGD_RETURNURL				= "http://www.store-chon.com/dev/returnurl.php";  
	
	/*
	* ISP ī����� ������ ���� �Ķ����(�ʼ�)
	*/
	$LGD_KVPMISPWAPURL		= "";
	$LGD_KVPMISPCANCELURL   = "";
	
	$LGD_MPILOTTEAPPCARDWAPURL = ""; //iOS ������ �ʼ�
	   
	/*
	* ������ü ������ ���� �Ķ����(�ʼ�)
	*/
	$LGD_MTRANSFERWAPURL 		= "";
	$LGD_MTRANSFERCANCELURL 	= "";   
	   
    
    /*
     *************************************************
     * 2. MD5 �ؽ���ȣȭ (�������� ������) - BEGIN
     * 
     * MD5 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�. 
     *************************************************
     *
     * �ؽ� ��ȣȭ ����( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
     * LGD_MID          : �������̵�
     * LGD_OID          : �ֹ���ȣ
     * LGD_AMOUNT       : �ݾ�
     * LGD_TIMESTAMP    : Ÿ�ӽ�����
     * LGD_MERTKEY      : ����MertKey (mertkey�� ���������� -> ������� -> ���������������� Ȯ���ϽǼ� �ֽ��ϴ�)
     *
     * MD5 �ؽ������� ��ȣȭ ������ ����
     * LG���÷������� �߱��� ����Ű(MertKey)�� ȯ�漳�� ����(lgdacom/conf/mall.conf)�� �ݵ�� �Է��Ͽ� �ֽñ� �ٶ��ϴ�.
     */
    require_once("./lgdacom/XPayClient.php");
    $xpay = new XPayClient($configPath, $LGD_PLATFORM);
   	if (!$xpay->Init_TX($LGD_MID)) {
        echo "LG���÷������� ������ ȯ�������� ���������� ��ġ �Ǿ����� Ȯ���Ͻñ� �ٶ��ϴ�.<br/>";
        echo "mall.conf���� Mert Id = Mert Key �� �ݵ�� ��ϵǾ� �־�� �մϴ�.<br/><br/>";
        echo "������ȭ LG���÷��� 1544-7772<br/>";
        exit; 
    }
    $LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);
    $LGD_CUSTOM_PROCESSTYPE = "TWOTR";
    /*
     *************************************************
     * 2. MD5 �ؽ���ȣȭ (�������� ������) - END
     *************************************************
     */
    $CST_WINDOW_TYPE = "submit";										// �����Ұ�
    $payReqMap['CST_PLATFORM']           = $CST_PLATFORM;				// �׽�Ʈ, ���� ����
    $payReqMap['CST_WINDOW_TYPE']        = $CST_WINDOW_TYPE;			// �����Ұ�
    $payReqMap['CST_MID']                = $CST_MID;					// �������̵�
    $payReqMap['LGD_MID']                = $LGD_MID;					// �������̵�
    $payReqMap['LGD_OID']                = $LGD_OID;					// �ֹ���ȣ
    $payReqMap['LGD_BUYER']              = $LGD_BUYER;            		// ������
    $payReqMap['LGD_PRODUCTINFO']        = $LGD_PRODUCTINFO;     		// ��ǰ����
    $payReqMap['LGD_AMOUNT']             = $LGD_AMOUNT;					// �����ݾ�
    $payReqMap['LGD_BUYEREMAIL']         = $LGD_BUYEREMAIL;				// ������ �̸���
    $payReqMap['LGD_CUSTOM_SKIN']        = $LGD_CUSTOM_SKIN;			// ����â SKIN
    $payReqMap['LGD_CUSTOM_PROCESSTYPE'] = $LGD_CUSTOM_PROCESSTYPE;		// Ʈ����� ó�����
    $payReqMap['LGD_TIMESTAMP']          = $LGD_TIMESTAMP;				// Ÿ�ӽ�����
    $payReqMap['LGD_HASHDATA']           = $LGD_HASHDATA;				// MD5 �ؽ���ȣ��
    $payReqMap['LGD_RETURNURL']   		 = $LGD_RETURNURL;      		// �������������
    $payReqMap['LGD_VERSION']         	 = "PHP_Non-ActiveX_SmartXPay";	// �������� (�������� ������)
    $payReqMap['LGD_CUSTOM_FIRSTPAY']  	 = $LGD_CUSTOM_FIRSTPAY;		// ����Ʈ ��������
	$payReqMap['LGD_PCVIEWYN']			 = $LGD_PCVIEWYN;				// �޴�����ȣ �Է� ȭ�� ��� ����(����Ĩ�� ���� �ܸ��⿡�� �Է�-->����Ĩ�� �ִ� �޴������� ���� ����)
	$payReqMap['LGD_CUSTOM_SWITCHINGTYPE']  = "SUBMIT";					// �ſ�ī�� ī��� ���� ������ ���� ���
	
	
	//iOS ������ �ʼ�
	$payReqMap['LGD_MPILOTTEAPPCARDWAPURL'] = $LGD_MPILOTTEAPPCARDWAPURL;
  
	/*
	****************************************************
	* �ſ�ī�� ISP(����/BC)�������� ���� - BEGIN 
	****************************************************
	*/
	$payReqMap['LGD_KVPMISPWAPURL']		 	= $LGD_KVPMISPWAPURL;	
	$payReqMap['LGD_KVPMISPCANCELURL']  	= $LGD_KVPMISPCANCELURL;
	
	/*
	****************************************************
	* �ſ�ī�� ISP(����/BC)�������� ����  - END
	****************************************************
	*/
		
	/*
	****************************************************
	* ������ü �������� ���� - BEGIN 
	****************************************************
	*/
	$payReqMap['LGD_MTRANSFERWAPURL']		= $LGD_MTRANSFERWAPURL;	
	$payReqMap['LGD_MTRANSFERCANCELURL']  	= $LGD_MTRANSFERCANCELURL;
	
	/*
	****************************************************
	* ������ü �������� ����  - END
	****************************************************
	*/
	
	
	/*
	****************************************************
	* ����� OS�� ISP(����/��), ������ü ���� ���� ��
	****************************************************
	- �ȵ���̵�: A (����Ʈ)
	- iOS: N
	- iOS�� ���, �ݵ�� N���� ���� ����
	*/
	$payReqMap['LGD_KVPMISPAUTOAPPYN']	= "A";		// �ſ�ī�� ���� 
	$payReqMap['LGD_MTRANSFERAUTOAPPYN']= "A";		// ������ü ����

    // �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG ���÷����� �����ؾ� �մϴ� .
    $payReqMap['LGD_CASNOTEURL'] = $LGD_CASNOTEURL;               // ������� NOTEURL

    //Return URL���� ���� ��� ���� �� ���õ� �Ķ���� �Դϴ�.*/
    $payReqMap['LGD_RESPCODE']           = "";
    $payReqMap['LGD_RESPMSG']            = "";
    $payReqMap['LGD_PAYKEY']             = "";

    $_SESSION['PAYREQ_MAP'] = $payReqMap;
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>LG ���÷��� eCredit���� �����׽�Ʈ</title>
<script language="javascript" src="http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js" type="text/javascript"></script>
<script type="text/javascript">


	var LGD_window_type = '<?= $CST_WINDOW_TYPE ?>'; 
/*
* �����Ұ�
*/
function launchCrossPlatform(){
      lgdwin = open_paymentwindow(document.getElementById('LGD_PAYINFO'), '<?= $CST_PLATFORM ?>', LGD_window_type);
}
/*
* FORM ��  ���� ����
*/
function getFormObject() {
        return document.getElementById("LGD_PAYINFO");
}

</script>
</head>
<body>
<form method="post" name="LGD_PAYINFO" id="LGD_PAYINFO" action="">
<table>
    <tr>
        <td>������ �̸� </td>
        <td><?= $LGD_BUYER ?></td>
    </tr>
    <tr>
        <td>��ǰ���� </td>
        <td><?= $LGD_PRODUCTINFO ?></td>
    </tr>
    <tr>
        <td>�����ݾ� </td>
        <td><?= $LGD_AMOUNT ?></td>
    </tr>
    <tr>
        <td>������ �̸��� </td>
        <td><?= $LGD_BUYEREMAIL ?></td>
    </tr>
    <tr>
        <td>�ֹ���ȣ </td>
        <td><?= $LGD_OID ?></td>
    </tr>
    <tr>
        <td colspan="2">* �߰� �� ������û �Ķ���ʹ� �޴����� �����Ͻñ� �ٶ��ϴ�.</td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>    
    <tr>
        <td colspan="2">
		<input type="button" value="������û" onclick="launchCrossPlatform();"/>         
        </td>
    </tr>    
</table>
<?php
  foreach ($payReqMap as $key => $value) {
    echo "<input type='hidden' name='$key' id='$key' value='$value'>";
  }
  var_dump($_SESSION);
?>
</form>
</body>
</html>

