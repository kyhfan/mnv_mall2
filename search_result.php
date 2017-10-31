<?
	include_once "./header.php";

	$code_list = $_REQUEST["code_list"];
	$code_list = array_map('strval', explode(',', $code_list));
	$code_list = implode("','", $code_list);

?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-list search-result">
			<div class="pg-title">
				<h3>
					검색결과 (임시)
				</h3>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	// 상품 리스트
	$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code IN ('".$code_list."') ";
	$goods_result		= mysqli_query($my_db, $goods_query);
	$goods_count 		= mysqli_num_rows($goods_result);
	while ($goods_data = mysqli_fetch_array($goods_result))
	{
		$goods_thumb_img 	= str_replace("../../../","./",$goods_data['goods_thumb_img_url']);
		// 할인율 계산
		$percent 			= ($goods_data['sales_price'] - $goods_data['discount_price']) / $goods_data['sales_price'] * 100;
?>
					<li class="col">
						<figure class="pr-item">
							<a href="product_detail.php?goodscode=<?=$goods_data['goods_code']?>">
								<img src="<?=$goods_thumb_img?>">
								<figcaption>
									<span class="name"><?=$goods_data["goods_name"]?></span>
<?
		// 판매가와 할인가가 동일할 경우 판매가 숨기기
		if ($goods_data["sales_price"] != $goods_data["discount_price"])
		{
?>
									<span class="price">20,000</span>
									<span class="percent">50%</span>
<?
		}
?>
									<span class="saleP">10,000</span>
								</figcaption>
							</a>
						</figure>
					</li>
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
