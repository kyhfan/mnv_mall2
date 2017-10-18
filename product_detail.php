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

	// $wish_flag 	= check_wish_goods($goods_code);
	if ($_SESSION['ss_chon_email'])
		$mb_flag	= "Y";
	else
		$mb_flag	= "N";
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
<?
	// 신상품 노출 여부
	if ($goods_data["goods_regdate"] > date("Y-m-d", strtotime("-30days")))
	{		
?>									
							<span class="new">NEW</span>
<?
	}
	
	// 판매가와 할인가가 동일할 경우 판매가 숨기기
	if ($goods_data["sales_price"] != $goods_data["discount_price"])
	{		
		// 할인율 계산
		$discount_percent 			= ($goods_data['sales_price'] - $goods_data['discount_price']) / $goods_data['sales_price'] * 100;
?>									
							<span class="percent"><?=ceil($discount_percent)?>%</span>
<?
	}
?>						
						</div>
					</div>
					<div class="sub">
						<p><?=$goods_data["goods_small_desc"]?></p>
					</div>
					<div class="price discount">
<?
	// 판매가와 할인가가 동일할 경우 판매가 숨기기
	if ($goods_data["sales_price"] != $goods_data["discount_price"])
	{		
?>									
						
						<span class="normal">
							<?=number_format($goods_data["sales_price"])?>
						</span>
<?
	}
?>						
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
					<?=$goods_data["m_goods_big_desc"]?>
				</div>
			</div>
			<div class="etc-block">
				<div class="list board">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>REVIEW</h4>
							<span>(0)</span>
						</div>
					</a>
					<div class="group-switch">
						<ul>
							<li class="row">
								<a href="javascript:void(0)">
									<div class="head">
										<div class="tt">
											<p>빠른 배송으로 딱 필요할때 사용할수 있어 더욱 만족스럽네요^^</p>
										</div>
										<div class="other">
											<span>2017.08.22</span>
											<span>*duv9**</span>
										</div>
									</div>
								</a>
								<div class="content clearfix">
									<div class="img">
										<img src="./images/review_img.png">
									</div>
									<div class="txt">
										<p>
											계란후라이를 넣었더니 이렇게 예쁠수가!! 너무 맘에 듭니다~~
										</p>
									</div>
								</div>
							</li>
							<li class="row">
								<a href="javascript:void(0)">
									<div class="head">
										<div class="tt">
											<p>제품이 아주 예쁘고 맘에 꼭 들어용~~!!!</p>
											<!-- 이미지 업로드 했을 시 아이콘 추가 -->
										</div>
										<div class="other">
											<span>2017.08.22</span>
											<span>*suwq**</span>
										</div>
									</div>
								</a>
								<div class="content clearfix">
									<div class="img">
										<img src="./images/review_img.png">
									</div>
									<div class="txt">
										<p>
											계란후라이를 넣었더니 이렇게 예쁠수가!! 너무 맘에 듭니다~~
										</p>
									</div>
								</div>
							</li>
						</ul>
						<div class="action-group clearfix">
							<div class="pagination">
								<div class="wrapper">
									<a href="javascript:void(0)">
										<span>1</span>
									</a>
									<a href="javascript:void(0)">
										<span>2</span>
									</a>
									<a href="javascript:void(0)">
										<span>></span>
									</a>
								</div>
							</div>
							<div class="button">
								<a href="javascript:void(0)">
									<span>후기작성</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="list board">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>Q&A</h4>
							<span>(0)</span>
						</div>
					</a>
					<div class="group-switch">
						<ul>
							<li class="row">
								<a href="javascript:void(0)">
									<div class="head">
										<div class="tt">
											<p>배송문의</p>
											<!-- 비밀글 자물쇠 아이콘 추가 -->
										</div>
										<div class="other">
											<span>2017.08.22</span>
											<span>*suwq**</span>
										</div>
									</div>
								</a>
								<div class="content"></div>
							</li>
							<li class="row">
								<a href="javascript:void(0)">
									<div class="head">
										<div class="tt">
											<p>상품문의</p>
											<!-- 비밀글 자물쇠 아이콘 추가 -->
										</div>
										<div class="other">
											<span>2017.08.22</span>
											<span>*suwq**</span>
										</div>
									</div>
								</a>
								<div class="content"></div>
							</li>
						</ul>
						<div class="action-group clearfix">
							<div class="pagination">
								<div class="wrapper">
									<a href="javascript:void(0)">
										<span>1</span>
									</a>
									<a href="javascript:void(0)">
										<span>2</span>
									</a>
									<a href="javascript:void(0)">
										<span>></span>
									</a>
								</div>
							</div>
							<div class="button">
								<a href="javascript:void(0)">
									<span>문의작성</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="list guide">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>배송정보 / 교환안내</h4>
						</div>
					</a>
					<div class="group-switch">
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
			</div>
			<div class="buy-layer">
				<div class="inner">
					<div class="put-in" data-goodscode="<?=$goods_code?>" data-login="<?=$mb_flag?>">
						<a href="javascript:void(0)">
							<img src="./images/put_in_cart.png" alt="장바구니에 넣기">
						</a>
					</div>
					<div class="buy">
						<a href="order.php?t=goods&goodscode=<?=$goods_code?>&buycnt=1">
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
