<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order-list">
			<div class="pg-title">
				<h3>
					ORDER
				</h3>
			</div>
			<div class="orderList">
				<ul>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
				</ul>
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
