<?
	include_once "./header.php";

	$oid	= $_REQUEST["oid"];
	$order_info = select_order_info($oid);
	print_r($order_info);

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
									<span>양건영</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>연락처</span>
								</div>
								<div class="col info">
									<span>010-2515-4373</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송지</span>
								</div>
								<div class="col info">
									<span>서울특별시 서초구 방배중앙로 58 (방배동) 2층</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송메모</span>
								</div>
								<div class="col info">
									<span>
										없을 시 1층 경비실에 보관해 주세요
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
							<span>신용카드 현대 (4025-96**_****_****) -  일시불</span>
						</div>
						<ul>
							<li class="row clearfix">
								<div class="col guide">
									<span>상품금액</span>
								</div>
								<div class="col info">
									<span>79,010원</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>상품합계</span>
								</div>
								<div class="col info">
									<span>80,000원</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송비합계</span>
								</div>
								<div class="col info">
									<span>0원</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>할인금액</span>
								</div>
								<div class="col info">
									<span>
										-990원
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>상품/주문할인</span>
								</div>
								<div class="col info">
									<span>
										-990원
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>배송비할인</span>
								</div>
								<div class="col info">
									<span>
										0원
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>환불정산액/포인트 결제액</span>
								</div>
								<div class="col info">
									<span>
										0원
									</span>
								</div>
							</li>
							<li class="row clearfix">
								<div class="col guide">
									<span>포인트</span>
								</div>
								<div class="col info">
									<span>
										0원
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
