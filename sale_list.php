<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-list">
			<div class="pg-title">
				<h3>
					SALE
				</h3>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	$view_pg            = 10;

	// 전체 상품 갯수
	$query				= "SELECT * FROM ".$_gl['goods_info_table']." WHERE discount_price < sales_price";
	$result				= mysqli_query($my_db, $query);
	$total_goods_num	= mysqli_num_rows($result);
 	$total_page			= ceil($total_goods_num / $view_pg);

	$sale_goods_info 	= select_sale_goods_info(0, $view_pg);
	foreach ($sale_goods_info as $key => $val)
	{
		$sale_goods_thumb_img 	= str_replace("../../../","./",$val['goods_thumb_img_url']);
		// 할인율 계산
		$discount_percent 			= ($val['sales_price'] - $val['discount_price']) / $val['sales_price'] * 100;
?>					
					<li class="col">
						<figure class="pr-item">
							<a href="product_detail.php?goodscode=<?=$val['goods_code']?>">
								<img src="<?=$sale_goods_thumb_img?>">
								<figcaption>
									<span class="name"><?=$val["goods_name"]?></span>
									<span class="price"><?=number_format($val["sales_price"])?></span>
									<span class="percent"><?=ceil($discount_percent)?>%</span>
									<span class="saleP"><?=number_format($val["discount_price"])?></span>
								</figcaption>
							</a>
						</figure>
					</li>
<?
	}
?>					
				</ul>
			</div>
<?
	if ($total_goods_num > $view_pg)
	{
?>
			<div class="more-btn">
				<a href="javascript:void(0)" onclick="more_sales_goods('<?=$total_goods_num?>','<?=$total_page?>')">
					<span>더 보기</span>
				</a>
			</div>
<?
	}
?>			
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
