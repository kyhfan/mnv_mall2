<?
	include_once "./header.php";

	if ($_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

	$v_email	= $_REQUEST["v_email"];

	verify_member($v_email);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="complete join-complete">
			<div class="content">
				<div class="wrapper">
					<div class="comp-icon">
						<div class="line"></div>
						<div class="line"></div>
					</div>
					<div class="msg">
						<h5 class="nft">THANK YOU</h5>
						<span>
							촌의감각의 가족이 되어주셔서 감사합니다!<br>
							회원가입이 완료되었습니다
						</span>
					</div>
					<div class="buttons">
						<a href="index.php">
							<span>촌의 감각 만나기</span>
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
