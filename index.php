<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="main">
			<div class="section main-slider swiper-container">
				<div class="slider swiper-wrapper">
<?
    $main_rolling_query		= "SELECT * FROM ".$_gl['banner_info_table']." WHERE banner_showYN='Y' AND banner_type='main_rolling_banner' ORDER BY banner_show_order ASC";
    $main_rolling_result		= mysqli_query($my_db, $main_rolling_query);
    while ($main_rolling_data = mysqli_fetch_array($main_rolling_result))
    {
		$main_rolling_img 	= str_replace("../../../","./",$main_rolling_data['banner_img_url']);
?>
					<div class="slide swiper-slide _01" style="background: url(<?=$main_rolling_img?>) center center / cover no-repeat;">
					</div>
<?
	}
?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
			<div class="section brand">
				<div class="title">
					<h3>
						BRAND STORY
					</h3>
				</div>
				<div class="brand-slider">
					<div class="slide _01">
						<div class="main-block">
							<img src="./images/brand_main_01.jpg">
						</div>
						<div class="intro-block layout-1 clearfix">
							<figure class="product">
								<a href="#">
									<img src="./images/brand_product_01.png">
									<figcaption>
										<span class="sub">기품있는 상차림</span>
										<span class="bname">비즐</span>
									</figcaption>
								</a>
							</figure>
							<figure class="product">
								<a href="#">
									<img src="./images/brand_product_02.png">
									<figcaption>
										<span class="sub">기품있는 상차림</span>
										<span class="bname">비즐</span>
									</figcaption>
								</a>
							</figure>
							<figure class="product fullW">
								<a href="#">
									<img src="./images/brand_product_03.png">
									<figcaption>
										<span class="sub">기품있는 상차림</span>
										<span class="bname">비즐</span>
										<span class="desc">단아하게 하얀색의 도자기가 저절로 아끼는 마음을 만들어 냅니다.</span>
									</figcaption>
								</a>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<div class="section newest">
				<div class="grid">
					<ul class="list-row clearfix">
<?
    $main_goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE showYN='Y'";
    $main_goods_result		= mysqli_query($my_db, $main_goods_query);
    while ($main_goods_data = mysqli_fetch_array($main_goods_result))
    {
		$goods_thumb_img 	= str_replace("../../../","./",$main_goods_data['goods_thumb_img_url']);
?>
						<li class="col">
							<figure class="pr-item">
								<a href="product_detail.php?goodscode=<?=$main_goods_data['goods_code']?>">
									<img src="<?=$goods_thumb_img?>">
								</a>
							</figure>
						</li>
<?
    }
?>
					</ul>
				</div>
			</div>
			<div class="section magazine">
				<a href="#">
					<img src="./images/magazine_01.jpg">
				</a>
			</div>
			<div class="section sale">
				<div class="title">
					<h3>
						SALE
					</h3>
				</div>
				<div class="grid">
					<ul class="list-row clearfix">
<?
	// 할인상품은 discount_price > 0 경우
    $discount_goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE discount_price < sales_price";
    $discount_goods_result		= mysqli_query($my_db, $discount_goods_query);
    while ($discount_goods_data = mysqli_fetch_array($discount_goods_result))
    {
		$discount_goods_thumb_img 	= str_replace("../../../","./",$discount_goods_data['goods_thumb_img_url']);
		// 할인율 계산
		$discount_percent 			= ($discount_goods_data['sales_price'] - $discount_goods_data['discount_price']) / $discount_goods_data['sales_price'] * 100;
?>
						<li class="col">
							<figure class="pr-item">
								<a href="product_detail.php?goodscode=<?=$discount_goods_data['goods_code']?>">
									<img src="<?=$discount_goods_thumb_img?>">
									<figcaption>
										<span class="price"><?=number_format($discount_goods_data['sales_price'])?></span>
										<span class="percent"><?=ceil($discount_percent)?>%</span>
										<span class="saleP"><?=number_format($discount_goods_data['discount_price'])?></span>
									</figcaption>
								</a>
							</figure>
						</li>
<?
    }
?>
					</ul>
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
