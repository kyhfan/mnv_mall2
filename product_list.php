<?
	include_once "./header.php";

	$cate 	= $_REQUEST["cate"];

	$cate_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='$cate'";
	$cate_result		= mysqli_query($my_db, $cate_query);
	$cate_data 		= mysqli_fetch_array($cate_result);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-list">
			<div class="pg-title">
				<h3>
					<?=$cate_data["cate_name"]?>
				</h3>
			</div>
			<div class="sorting-area">
				<a href="javascript:void(0)" data-sort="best" class="current" >베스트</a>
				<a href="javascript:void(0)" data-sort="row">가격낮은순</a>
			</div>
			<div class="brand-banner">
				<div class="block">
					<a href="javascript:void(0)">
						<img src="./images/product_brand_banner_01.png">
					</a>
				</div>
				<div class="block">
					<a href="javascript:void(0)">
						<img src="./images/product_brand_banner_02.png">
					</a>
				</div>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	// 상품 리스트
    $goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE cate_1 = '$cate' ORDER BY discount_price ASC";
    $goods_result		= mysqli_query($my_db, $goods_query);
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
									<span class="price"><?=number_format($goods_data["sales_price"])?></span>
									<span class="percent"><?=ceil($percent)?>%</span>
<?
	}
?>									
									<span class="saleP"><?=number_format($goods_data["discount_price"])?></span>
								</figcaption>
							</a>
						</figure>
					</li>
<?
    }
?>
			</div>
			<div class="more-btn">
				<a href="javascript:void(0)">
					<span>더 보기</span>
				</a>
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
			// swiper initialize
			var chonSwiper = new Swiper ('.swiper-container', {
				// Optional parameters
				direction: 'horizontal',
				effect: 'fade',
				speed: 2000,
				loop: true,
				autoplay: 4000,
				autoplayDisableOnInteraction: false,
				pagination: '.swiper-pagination',
				paginationClickable: true,
				paginationBulletRender: function(swiper, index, className) {
					return '<span class="' + className +'">' + '</span>';
				}
				// If we need pagination
				// pagination: '.swiper-pagination'
			});

			$('.gnb').on('click', function() {
				$('#menu-layer').slideDown('normal');
				$app.hasClass('menu-opened') ? $app.removeClass('menu-opened') : $app.addClass('menu-opened');
			});
			$('#menu-layer .close-btn a').on('click', function() {
				$app.removeClass('menu-opened');
				$('#menu-layer').slideUp('normal');
			});
		});


	</script>
</body>
</html>
