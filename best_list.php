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
					BEST
				</h3>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	$view_pg            = 10;

	// 전체 상품 갯수
	$query				= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY goods_sales_cnt DESC";
	$result				= mysqli_query($my_db, $query);
	$total_goods_num	= mysqli_num_rows($result);
 	$total_page			= ceil($total_goods_num / $view_pg);

	$best_goods_info 	= select_best_list_goods_info(0, $view_pg);
	foreach ($best_goods_info as $key => $val)
	{
		$best_goods_thumb_img 	= str_replace("../../../","./",$val['goods_thumb_img_url']);
		// 할인율 계산
		$discount_percent 			= ($val['sales_price'] - $val['discount_price']) / $val['sales_price'] * 100;
?>					
					<li class="col">
						<figure class="pr-item">
							<a href="product_detail.php?goodscode=<?=$val['goods_code']?>">
								<img src="<?=$best_goods_thumb_img?>">
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
				<a href="javascript:void(0)" onclick="more_best_goods('<?=$total_goods_num?>','<?=$total_page?>')">
					<span>더 보기</span>
				</a>
			</div>
<?
	}
?>			
		</div>
		<div id="footer">
			<div class="nav">
				<ul class="clearfix">
					<li>
						<a href="#">
							<span>촌의감각</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>개인정보취급방침</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>이용약관</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="social">
				<a class="icon kt" href="#"></a><a class="icon insta" href="#"></a>
			</div>
			<div class="mall-info">
				<div>
					<p>상호 : 촌의 감각 (미니버타이징 주식회사)</p>
				</div>
				<div>
					<p>대표자(성명) : 양선혜</p>
				</div>
				<div>
					<p>개인정보관리책임자 : 김영훈 yh.kim@minivertising.kr</p>
				</div>
				<div>
					<p>사업자등록번호 : 114-87-11622 <a href="#">[사업자 정보확인]</a></p>
				</div>
				<div>
					<p>통신판매업 : 제 2017-</p>
				</div>
				<div>
					<p>주소 : 서울특별시 서초구</p>
				</div>
				<div>
					<p>고객센터 : 02-532-2475</p>
				</div>
				<div>
					<p>Mon-Fri 10:30 ~ 5:30 / Off time : 12:00 ~ 2:00</p>
				</div>
				<div>
					<p>팩스 : 02-532-2493</p>
				</div>
				<div>
					<p>@chon Right Reserved.</p>
				</div>
			</div>
			<div class="go-top">
				<a href="#">
					<span>TOP</span>
				</a>
			</div>
			<div class="gnb-foot">
				<ul>
					<li class="home">
						<a href="javascript:void(0)">
							<img src="./images/gnb_home.png" alt="홈으로 가기">
						</a>
					</li>
					<li class="search">
						<a href="javascript:void(0)">
							<img src="./images/gnb_search.png" alt="검색">
						</a>
					</li>
					<li class="mypage">
						<a href="javascript:void(0)">
							<img src="./images/gnb_mypage.png" alt="마이페이지">
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0)">
							<img src="./images/gnb_cart.png" alt="장바구니">
						</a>
					</li>
				</ul>
			</div>
		</div>
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
