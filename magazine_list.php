<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="magazine-list">
			<div class="pg-title">
				<h3>
					MAGAZINE
				</h3>
			</div>
			<div class="list-wrapper">
				<div class="block">
					<a href="#">
						<div class="img">
							<img src="./images/promotion_list_img_01.png">
						</div>
						<div class="desc clearfix">
							<div class="number">
								<span>VOL 1</span>
							</div>
							<div class="txt">
								<div class="title">
									<h5>
										이제 행주도 따져보면서 사야한다 친환경 안전한 행주
									</h5>
								</div>
								<div class="sub">
									<span>그릇에 물기를 제거할 때 나오는 먼지, 음식과 함께 먹고 있다는 것 알고 계셨나요? 소박한 디자인이지만 최상급 소재를 사용한 안전한 행주 ‘촌의감각’에서 소개합니다</span>
								</div>
							</div>
							<div class="btn-more"></div>
						</div>
					</a>
				</div>
				<div class="block">
					<a href="#">
						<div class="img">
							<img src="./images/promotion_list_img_02.png">
						</div>
						<div class="desc clearfix">
							<div class="number">
								<span>VOL 2</span>
							</div>
							<div class="txt">
								<div class="title">
									<h5>
										이제 행주도 따져보면서 사야한다 친환경 안전한 행주
									</h5>
								</div>
								<div class="sub">
									<span>그릇에 물기를 제거할 때 나오는 먼지, 음식과 함께 먹고 있다는 것 알고 계셨나요? 소박한 디자인이지만 최상급 소재를 사용한 안전한 행주 ‘촌의감각’에서 소개합니다</span>
								</div>
							</div>
							<div class="btn-more"></div>
						</div>
					</a>
				</div>
				<div class="block">
					<a href="#">
						<div class="img">
							<img src="./images/promotion_list_img_03.png">
						</div>
						<div class="desc clearfix">
							<div class="number">
								<span>VOL 3</span>
							</div>
							<div class="txt">
								<div class="title">
									<h5>
										제주도의 그릇
									</h5>
								</div>
								<div class="sub">
									<span>그릇에 물기를 제거할 때 나오는 먼지, 음식과 함께 먹고 있다는 것 알고 계셨나요? 소박한 디자인이지만 최상급 소재를 사용한 안전한 행주 ‘촌의감각’에서 소개합니다</span>
								</div>
							</div>
							<div class="btn-more"></div>
						</div>
					</a>
				</div>
				<div class="block">
					<a href="#">
						<div class="img">
							<img src="./images/promotion_list_img_04.png">
						</div>
						<div class="desc clearfix">
							<div class="number">
								<span>VOL 4</span>
							</div>
							<div class="txt">
								<div class="title">
									<h5>
										이제 행주도 따져보면서 사야한다 친환경 안전한 행주
									</h5>
								</div>
								<div class="sub">
									<span>그릇에 물기를 제거할 때 나오는 먼지, 음식과 함께 먹고 있다는 것 알고 계셨나요? 소박한 디자인이지만 최상급 소재를 사용한 안전한 행주 ‘촌의감각’에서 소개합니다</span>
								</div>
							</div>
							<div class="btn-more"></div>
						</div>
					</a>
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
