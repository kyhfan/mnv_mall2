<?
include_once "./header.php";

print_r($_REQUEST);

if ($_REQUEST["LGD_RESPCODE"] != "0000")
{
	echo "<script>alert('주문이 취소되었습니다.');location.href='index.php';</script>";
}else{
	$pay_query		= "INSERT INTO ".$_gl['payment_info_table']."(LGD_RESPCODE, LGD_RESPMSG, LGD_MID, LGD_OID, LGD_AMOUNT, LGD_TID, LGD_PAYTYPE, LGD_PAYDATE, LGD_HASHDATA, LGD_TIMESTAMP, LGD_BUYER, LGD_PRODUCTINFO, LGD_BUYERID, LGD_BUYERADDRESS, LGD_BUYERPHONE, LGD_BUYEREMAIL, LGD_PRODUCTCODE, LGD_RECEIVER, LGD_RECEIVERPHONE, LGD_DELIVERYINFO, LGD_FINANCECODE, LGD_FINANCENAME, LGD_FINANCEAUTHNUM, LGD_ESCROWYN, LGD_CASHRECEIPTNUM, LGD_CASHRECEIPTSELFYN, LGD_CASHRECEIPTKIND, LGD_CARDNUM, LGD_CARDINSTALLMONTH, LGD_CARDNOINTYN, LGD_AFFILIATECODE, LGD_CARDGUBUN1, LGD_CARDGUBUN2, LGD_CARDACQUIRER, LGD_PCANCELFLAG, LGD_PCANCELSTR, LGD_TRANSAMOUNT, LGD_EXCHANGERATE, LGD_DISCOUNTUSEYN, LGD_DISCOUNTUSEAMOUNT, LGD_ACCOUNTNUM, LGD_ACCOUNTOWNER, LGD_PAYER, LGD_CASTAMOUNT, LGD_CASCAMOUNT, LGD_CASFLAG, LGD_CASSEQNO, LGD_SAOWNER, LGD_TELNO, LGD_OCBAMOUNT, LGD_OCBSAVEPOINT, LGD_OCBTOTALPOINT, LGD_OCBUSABLEPOINT, LGD_OCBTID) values('".$xpay->Response_Code()."','".iconv("EUC-KR","UTF-8",$xpay->Response_Msg())."','".$xpay->Response("LGD_MID",0)."','".$xpay->Response("LGD_OID",0)."','".$xpay->Response("LGD_AMOUNT",0)."','".$xpay->Response("LGD_TID",0)."','".$xpay->Response("LGD_PAYTYPE",0)."','".$xpay->Response("LGD_PAYDATE",0)."','".$xpay->Response("LGD_HASHDATA",0)."','".$xpay->Response("LGD_TIMESTAMP",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYER",0))."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_PRODUCTINFO",0))."','".$xpay->Response("LGD_BUYERID",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_BUYERADDRESS",0))."','".$xpay->Response("LGD_BUYERPHONE",0)."','".$xpay->Response("LGD_BUYEREMAIL",0)."','".$xpay->Response("LGD_PRODUCTCODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_RECEIVER",0))."','".$xpay->Response("LGD_RECEIVERPHONE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_DELIVERYINFO",0))."','".$xpay->Response("LGD_FINANCECODE",0)."','".iconv("EUC-KR","UTF-8",$xpay->Response("LGD_FINANCENAME",0))."','".$xpay->Response("LGD_FINANCEAUTHNUM",0)."','".$xpay->Response("LGD_ESCROWYN",0)."','".$xpay->Response("LGD_CASHRECEIPTNUM",0)."','".$xpay->Response("LGD_CASHRECEIPTSELFYN",0)."','".$xpay->Response("LGD_CASHRECEIPTKIND",0)."','".$xpay->Response("LGD_CARDNUM",0)."','".$xpay->Response("LGD_CARDINSTALLMONTH",0)."','".$xpay->Response("LGD_CARDNOINTYN",0)."','".$xpay->Response("LGD_AFFILIATECODE",0)."','".$xpay->Response("LGD_CARDGUBUN1",0)."','".$xpay->Response("LGD_CARDGUBUN2",0)."','".$xpay->Response("LGD_CARDACQUIRER",0)."','".$xpay->Response("LGD_PCANCELFLAG",0)."','".$xpay->Response("LGD_PCANCELSTR",0)."','".$xpay->Response("LGD_TRANSAMOUNT",0)."','".$xpay->Response("LGD_EXCHANGERATE",0)."','".$xpay->Response("LGD_DISCOUNTUSEYN",0)."','".$xpay->Response("LGD_DISCOUNTUSEAMOUNT",0)."','".$xpay->Response("LGD_ACCOUNTNUM",0)."','".$xpay->Response("LGD_ACCOUNTOWNER",0)."','".$xpay->Response("LGD_PAYER",0)."','".$xpay->Response("LGD_CASTAMOUNT",0)."','".$xpay->Response("LGD_CASCAMOUNT",0)."','".$xpay->Response("LGD_CASFLAG",0)."','".$xpay->Response("LGD_CASSEQNO",0)."','".$xpay->Response("LGD_SAOWNER",0)."','".$xpay->Response("LGD_TELNO",0)."','".$xpay->Response("LGD_OCBAMOUNT",0)."','".$xpay->Response("LGD_OCBSAVEPOINT",0)."','".$xpay->Response("LGD_OCBTOTALPOINT",0)."','".$xpay->Response("LGD_OCBUSABLEPOINT",0)."','".$xpay->Response("LGD_OCBTID",0)."')";
	$pay_result 		= mysqli_query($my_db, $pay_query);

	if ($pay_result)
	{
		//상점내 DB에 어떠한 이유로 처리를 하지 못한경우 false로 변경해 주세요.
		$isDBOK = true; 
	}else{
		$error_query		= "UPDATE ".$_gl['order_info_table']." SET order_status='pay_error' WHERE order_oid='".$_REQUEST["LGD_OID"]."'";
		$error_result 		= mysqli_query($my_db, $error_query);
	}

}
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order-complete complete">
			<div class="content">
				<div class="wrapper">
					<div class="comp-icon">
						<div class="line"></div>
						<div class="line"></div>
					</div>
					<div class="msg">
						<h5 class="nft">THANK YOU</h5>
						<span>감사합니다. 주문이 완료되었습니다.</span>
					</div>
					<div class="buttons">
						<a href="index.php">
							<span>쇼핑 계속하기</span>
						</a>
						<a href="order_detail.php?oid=<?=$_REQUEST["LGD_OID"]?>">
							<span>주문내역상세</span>
						</a>
					</div>
				</div>
			</div>
		</div>
<?
	include_once "./footer.php";
?>
	</div>
	<script type="text/javascript">
		var $header = $('#header');
		var $app = $('#chon-app');

		// scrolling header action
		$(window).on('scroll', function() {
			var currentScroll = $(this).scrollTop();
			if(currentScroll > $header.height() && !$app.hasClass('menu-opened')) {
				$app.addClass('scrolled');
			} else {
				$app.removeClass('scrolled');
			}

			if(currentScroll > ($app.height()/3)) {
				$('.go-top').css({
					opacity: 1
				});
			} else {
				$('.go-top').css({
					opacity: 0
				});
			}
			// (currentScroll > $header.height()) ? $headerBg.addClass('scrolled') : $headerBg.remove
		});
		$(document).ready(function() {
			$('.gnb').on('click', function() {
				$('#menu-layer').slideDown('slow');
				$app.hasClass('menu-opened') ? $app.removeClass('menu-opened') : $app.addClass('menu-opened');
			});
			$('#menu-layer .close-btn a').on('click', function() {
				$app.removeClass('menu-opened');
				$('#menu-layer').slideUp('slow');
			});
		});


	</script>
</body>
</html>
