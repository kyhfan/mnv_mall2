<?
	include_once "./header.php";

	$wish_info 	= select_wish_info();
	$wish_num	= count($wish_info);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="cart wish">
			<div class="content">
				<div class="pg-title">
					<h3 class="nft">WISH</h3>
				</div>
<?
	if ($wish_num < 1)
	{
?>
				<!-- 관심상품 비어있을 경우 -->
				<p class="empty">등록된 관심 상품이 없습니다.</p>
				<!-- 관심상품 비어있을 경우 -->
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
								<span>전체선택 (<span id="chk_goods">0</span>/<?=$wish_num?>)</span>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_chk_wish()">
									<span>선택삭제</span>
								</a>
							</div>
						</div>
					</div>
<?
		foreach ($wish_info as $key => $val)
		{
			$goods_info 			= select_goods_info($val["goods_code"]);
			$wish_price				= $goods_info["discount_price"] * $val["goods_cnt"];
			$goods_thumb_img 		= str_replace("../../../","./",$goods_info['goods_thumb_img_url']);
			// $total_cnt				+= $val["goods_cnt"];
			// $total_goods_price		+= $cart_price;
			// $total_save_price		+= $cart_price * $_gl['save_percent'];
?>
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_this" id="chk_<?=$val['idx']?>">
								</div>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_wish('<?=$val['idx']?>')">
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
							</div>
							<div class="thum">
								<img src="<?=$goods_thumb_img?>" width="115">
							</div>
						</div>
					</div>
<?
		}
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

		var chk_all_flag 	= 0;
		$("#chk_all").click(function() {
			if (chk_all_flag == 0)
			{
				$("input[name=chk_this]:checkbox").prop("checked", true);
				$("#chk_goods").html($("#wish_num").val());
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
