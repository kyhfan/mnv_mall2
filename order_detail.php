<?
	include_once "./header.php";

	$oid	= $_REQUEST["oid"];
	// 주문정보 가져오기
	$order_info = select_order_info($oid);
	// print_r($order_info);

	// 결제 정보 가져오기
	$payment_info = select_payment_info($oid);

	// 카드 할부 정보
	if ($payment_info["LGD_CARDINSTALLMONTH"] == "00")
		$payment_info["LGD_CARDINSTALLMONTH"] = "일시불";
	else
		$payment_info["LGD_CARDINSTALLMONTH"] = $payment_info["LGD_CARDINSTALLMONTH"]."개월";
	

	// 주문일자
	$orderdate_arr1 	= explode(" ",$order_info["order_regdate"]);
	$orderdate_arr2 	= explode("-",$orderdate_arr1[0]);

	$orderdate 		= $orderdate_arr2[0].".".$orderdate_arr2[1].".".$orderdate_arr2[2];
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order-detail">
			<div class="content inner">
				<div class="info-block _product">
					<div class="title">
						<h5>주문내역상세</h5>
						<div class="date">
							<span><?=$orderdate?></span>
						</div>
					</div>
					<div class="inner">
						<ul>
<?
	// print_r(count($order_info["order_goods"]));
	foreach($order_info["order_goods"] as $key => $val)
	{
		// print_r($val);
		$order_price	= $val["discount_price"] * $val["order_cnt"];
?>							
							<li class="row clearfix">
								<div class="col">
									<a href="javascript:void(0)">
										<img src="./images/ordered_01.png">
									</a>
								</div>
								<div class="col">
									<div class="details">
										<span><?=$val['goods_name']?></span>
										<span><?=$val['order_cnt']?>개</span>
										<span><?=number_format($order_price)?>원</span>
										<!-- <span>옵션 : 빨간 스티치</span> -->
									</div>
									<div class="num">
										<span>주문번호</span>
										<span><?=$order_info['order_oid']?></span>
									</div>
								</div>
							</li>
<?
	}
?>							
						</ul>
						<div class="total">
							<span><?=$order_info["show_goods_name"]?></span>
							<span>총 <?=number_format($order_info["total_payment_price"])?>원</span>
						</div>
					</div>
				</div>
				<div class="info-block">
					<div class="title">
						<h5>배송지정보</h5>
					</div>
					<div class="inner">
						<ul>
							<li class="row clearfix">
								<div class="col guide">
									<span>받는사람</span>
								</div>
								<div class="col info">
									<span><?=$order_info["delivery_name"]?></span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>연락처</span>
								</div>
								<div class="col info">
									<span><?=$order_info["delivery_phone"]?></span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송지</span>
								</div>
								<div class="col info">
									<span><?=$order_info["delivery_addr1"]." ".$order_info["delivery_addr2"]?></span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송메모</span>
								</div>
								<div class="col info">
									<span>
										<?=$order_info["delivery_message"]?>
									</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="info-block payment">
					<div class="title">
						<h5>결제금액정보</h5>
					</div>
					<div class="inner">
						<div class="p-type">
							<span><?=$_gl['PAYTYPE'][$payment_info["LGD_PAYTYPE"]]?> <?=$payment_info["LGD_FINANCENAME"]?> (<?=$payment_info["LGD_CARDNUM"]?>) -  <?=$payment_info["LGD_CARDINSTALLMONTH"]?></span>
						</div>
						<ul>
							<li class="row clearfix">
								<div class="col guide">
									<span>상품금액</span>
								</div>
								<div class="col info">
									<span><em class="nft"><?=number_format($order_info["total_order_price"])?></em>원</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송비</span>
								</div>
								<div class="col info">
									<span><em class="nft"><?=number_format($order_info["total_delivery_price"])?></em>원</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>쿠폰</span>
								</div>
								<div class="col info">
									<span>
										<em class="nft">0</em>원 <!-- 쿠폰 작업 해야 함 -->
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>적립금</span>
								</div>
								<div class="col info">
									<span>
										<em class="nft">0</em>원 <!-- 적립금 작업 해야 함 -->
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>총결제금액</span>
								</div>
								<div class="col info">
									<span>
										<em class="nft"><?=number_format($order_info["total_payment_price"])?></em>원
									</span>
								</div>
							</li>
						</ul>
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
