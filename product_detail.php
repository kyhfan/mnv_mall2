<?
	include_once "./header.php";

	$goods_code 		= $_REQUEST["goodscode"];
	$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='$goods_code'";
	$goods_result		= mysqli_query($my_db, $goods_query);
	$goods_data 		= mysqli_fetch_array($goods_result);

	// 롤링 이미지를 위해 배열 생성 및 빈 배열값 제거
	$goods_img_url 		= array_filter(array($goods_data["goods_img_url1"],$goods_data["goods_img_url2"],$goods_data["goods_img_url3"],$goods_data["goods_img_url4"],$goods_data["goods_img_url5"]));

	// 상품 상세 설명 P태그 class 자동 삽입
	$goods_data["m_goods_big_desc"] 	= str_replace('<p>','<p class="txt-template ft-18 cl-333 lh-32" style="padding-bottom: 68px;">',$goods_data["m_goods_big_desc"]);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-detail">
			<div class="product-slide swiper-container">
				<div class="swiper-wrapper">
<?
	foreach ($goods_img_url as $key => $val)
    {
		$goods_img 	= str_replace("../../../","./",$val);
?>
					<div class="swiper-slide">
						<img src="<?=$goods_img?>">
					</div>
<?
    }
?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
			<div class="product-info">
				<div class="wrapper top">
					<div class="name">
						<h4><?=$goods_data["goods_name"]?></h4>
						<div class="wrap-icon">
							<span class="new">NEW</span>
							<span class="percent">10%</span>
						</div>
					</div>
					<div class="sub">
						<p><?=$goods_data["goods_small_desc"]?></p>
					</div>
					<div class="price discount">
						<span class="normal">
							<?=number_format($goods_data["sales_price"])?>
						</span>
						<span class="sale">
							<?=number_format($goods_data["discount_price"])?>
						</span>
					</div>
				</div>
				<div class="divide-line"></div>
				<div class="wrapper middle">
					<div class="details">
						<div class="row">
							<span>품목명 및 제품명</span>
							<span><?=$goods_data["goods_sub_name"]?></span>
						</div>
						<div class="row">
							<span>제조자</span>
							<span><?=$goods_data["goods_brand"]?></span>
						</div>
						<div class="row">
							<span>사이즈</span>
							<span><?=$goods_data["goods_size"]?></span>
						</div>
						<div class="row">
							<span>색상 / 무늬</span>
							<span><?=$goods_data["goods_color"]?></span>
						</div>
					</div>
				</div>
				<div class="divide-line"></div>
				<div class="wrapper editor">
					<!-- <p class="txt-template ft-18 cl-333 lh-32" style="padding-bottom: 68px;">
						몰리해치의 `Heritage`컬렉션 디자인은 18세기 유럽의 오래된 찻잔에서<br>
						영감을 얻었습니다. 이 라인은 전통적인 느낌을 풍기지만 현대 라이프 스타일에도<br>
						어울릴 수 있도록 디자인 되었습니다. 그녀만의 독특한 디자인으로 제품의 모든<br>
						부분과 접시 뒷면, 머그 밑바닥까지 데코레이션이 새겨져있습니다.
					</p>
					<img src="./images/product_detail_img_01.png" style="padding-bottom:49px;">
					<img src="./images/product_detail_img_02.png" style="padding-bottom:49px;">
					<img src="./images/product_detail_img_03.png" style="padding-bottom:49px;"> -->
					<?=$goods_data["m_goods_big_desc"]?>
				</div>
			</div>
			<div class="etc-block">
				<div class="list review">
					<a href="javascript:void(0)" class="toggle">
						<h4>REVIEW</h4>
					</a>
					<ul>
						<li class="row">
							<div class="head">
								<div class="tt">
									<p>빠른 배송으로 딱 필요할때 사용할수 있어 더욱 만족스럽네요^^</p>
								</div>
								<div class="other">
									<span>2017.08.22</span>
									<span>*duv9**</span>
								</div>
							</div>
							<div class="content"></div>
						</li>
						<li class="row">
							<div class="head">
								<div class="tt">
									<p>제품이 아주 예쁘고 맘에 꼭 들어용~~!!!</p>
								</div>
								<div class="other">
									<span>2017.08.22</span>
									<span>*suwq**</span>
								</div>
							</div>
							<div class="content"></div>
						</li>
					</ul>
				</div>
				<div class="list faq">
					<a href="javascript:void(0)" class="toggle">
						<h4>FAQ</h4>
					</a>
					<ul>
						<li class="row">
							<p>
								<span>Q.</span>
								<span>교환하고 싶어요</span>
							</p>
						</li>
						<li class="row">
							<p>
								<span>A.</span>
								<span>3일이내에 연락주세요</span>
							</p>
						</li>
					</ul>
				</div>
				<div class="list guide">
					<a href="javascript:void(0)" class="toggle">
						<h4>배송정보 / 교환안내</h4>
					</a>
					<ul>
						<li class="row">
							<p>1. 교환의 경우 제품을 받으신 후 3일 이내에 연락 주시기 바랍니다.</p>
						</li>
						<li class="row">
							<p>2. 제품이 파손시 교환이 어려울 수도 있습니다.</p>
						</li>
						<li class="row">
							<p>3. 제품이 잘못 갔을 시 배송비 전액을 부담해 드립니다.</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="buy-layer">
				<div class="inner">
					<div class="loveit">
						<a href="javascript:void(0)" data-goods="<?=$goods_code?>">
							<img src="./images/heart.png" alt="찜 하기">
						</a>
					</div>
					<div class="buy">
						<a href="javascript:void(0)">
							<h5>구매하기</h5>
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

			$('.etc-block .toggle').on('click', function() {
				$(this).siblings('ul').toggle();
			});
		});


	</script>
</body>
</html>
