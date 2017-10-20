<?
	include_once "./header.php";

	$cart_info 	= select_cart_info();
	$cart_num	= count($cart_info);
?>
<body>
	<input type="hidden" id="cart_num" value="<?=$cart_num?>">
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="cart">
			<div class="content">
				<div class="pg-title">
					<h3 class="nft">CART</h3>
				</div>
<?
	if ($cart_num < 1)
	{
?>
				<!-- 장바구니 비어있을 경우 -->
				<p class="empty">장바구니에 담긴 상품이 없습니다.</p>
				<!-- 장바구니 비어있을 경우 -->
<?
	}else{
?>
				<div class="cart-block">
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_all" id="chk_all">
								</div>
								<span>전체선택 (<span id="chk_goods">0</span>/<?=$cart_num?>)</span>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_chk_cart()">
									<span>선택삭제</span>
								</a>
							</div>
						</div>
					</div>
<?
	$total_cnt 				= 0;
	$total_goods_price		= 0;
	$total_save_price		= 0;
	$total_delivery_price	= 0;
	foreach ($cart_info as $key => $val)
	{
		$goods_info 			= select_goods_info($val["goods_code"]);
		$cart_price				= $goods_info["discount_price"] * $val["goods_cnt"];
		$goods_thumb_img 		= str_replace("../../../","./",$goods_info['goods_thumb_img_url']);
		$total_cnt				+= $val["goods_cnt"];
		$total_goods_price		+= $cart_price;
		$total_save_price		+= $cart_price * $_gl['save_percent'];
?>
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_this" id="chk_<?=$val['idx']?>">
								</div>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_cart('<?=$val['idx']?>')">
									<span>삭제</span>
								</a>
							</div>
						</div>
						<div class="product-info clearfix">
							<div class="info">
								<div class="row">
									<span class="name">
										<?=$goods_info["goods_name"]?>
									</span>
									<!-- <span class="option">
										(9옵션 중 택 1)
									</span> -->
								</div>
								<div class="row">
									<span class="amount">수량 :</span>
									<input type="tel" id="cart_num_<?=$val['idx']?>" value="<?=$val["goods_cnt"]?>" onblur="change_cart('<?=$val['idx']?>');">
									<span class="price"><?=number_format($cart_price)?></span>
								</div>
							</div>
							<div class="thum">
								<img src="<?=$goods_thumb_img?>" width="115">
								<!-- <img src="./images/ordered_01.png"> -->
							</div>
						</div>
					</div>
<?
	}

	if ($total_goods_price < $_gl['delivery_max_price'])
		$total_delivery_price = $_gl['delivery_price'];

	$total_price			= $total_goods_price + $total_delivery_price;

?>
					<div class="block total">
						<span>50,000원 이상 구매 시 배송비 무료</span>
						<div class="row clearfix">
							<span>주문 상품 수</span>
							<span><?=$total_cnt?></span>
						</div>
						<div class="row clearfix">
							<span>총 상품금액</span>
							<span><?=number_format($total_goods_price)?></span>
						</div>
						<div class="row clearfix">
							<span>적립금</span>
							<span><?=number_format($total_save_price)?></span>
						</div>
						<div class="row clearfix">
							<span>총 배송비</span>
							<span><?=number_format($total_delivery_price)?></span>
						</div>
						<div class="row clearfix">
							<span>총 결제 금액</span>
							<span><?=number_format($total_price)?></span>
						</div>
					</div>
					<div class="finish-btn">
						<a href="order.php?t=cart">
							<span>구 매 하 기</span>
						</a>
					</div>
				</div>
<?
	}
?>
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

		var chk_all_flag 	= 0;
		$("#chk_all").click(function() {
			if (chk_all_flag == 0)
			{
				$("input[name=chk_this]:checkbox").prop("checked", true);
				$("#chk_goods").html($("#cart_num").val());
				chk_all_flag	= 1;
			}else{
				$("input[name=chk_this]:checkbox").prop("checked",false);
				$("#chk_goods").html("0");
				chk_all_flag	= 0;
			}
		});

		$("input[name=chk_this]").change(function(){
			var chk_count	= 0;
			$("input[name=chk_this]:checked").each(function() {
				chk_count++;
			});
			$("#chk_goods").html(chk_count);
		});
	</script>
</body>
</html>
