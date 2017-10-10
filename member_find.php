<?
	include_once "./header.php";
?>
<body>
<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="login find">
			<div class="pg-title">
				<h3>
					FIND
				</h3>
			</div>
			<div class="swap-block clearfix">
				<div class="block">
					<a href="javascript:void(0)" onclick="swapBlock('fid', this);" class="active fid">
						<span>아이디찾기</span>
					</a>
				</div>
				<div class="block">
					<a href="javascript:void(0)" onclick="swapBlock('fpw', this);" class="fpw">
						<span>비밀번호찾기</span>
					</a>
				</div>
			</div>
			<div class="wrapper">
				<div class="input-group fid">
					<div class="input-box">
						<input type="text" placeholder="이름" id="mb_name">
					</div>
					<div class="input-box">
						<input type="password" placeholder="비밀번호" id="mb_password">
					</div>
				</div>
				<div class="input-group fpw">
					<div class="input-box">
						<input type="text" placeholder="아이디" id="mb_email">
					</div>
				</div>
			</div>
			<div class="btn login find" id="find_member">
				<a href="javascript:void(0)">
					<span>찾기</span>
				</a>
			</div>
			<div class="link-block clearfix">
				<a href="member_login.php">
					<span>로그인</span>
				</a>
				<a href="member_join.php">
					<span>회원가입</span>
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

		var submitTarget = "fid";
		function swapBlock(type, elem) {
			var $_this = $(elem);
			var type = type || "fid";
			$('.swap-block a').not($_this).removeClass('active');
			$_this.addClass('active');
			$('.input-group').not('.'+type).hide();
			$('.input-group.'+type).show();
			submitTarget = type;
		}
		// $('.btn.find').on('click', function() {
		// 	alert(submitTarget);
		// });

	</script>
</body>
</html>
