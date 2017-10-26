<?
	include_once "./header.php";

	if ($_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

	$v_email	= $_REQUEST["v_email"];
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="complete join-complete verify-mail">
			<div class="content">
				<div class="wrapper">
					<div class="comp-icon">
						<div class="rectangle">
							<div class="wrap-lines">
								<div class="line"></div>
								<div class="line"></div>
							</div>
						</div>
					</div>
					<div class="msg">
						<h5>인증메일을 확인해주세요!</h5>
						<span>
							<strong><?=$v_email?></strong> 으로 인증메일이 발송되었습니다.<br>
							24시간 이내로 이메일을 확인하여 인증버튼을 클릭하시면<br>
							촌의감각 회원가입을 완료하실 수 있습니다
						</span>
					</div>
					<!-- <div class="buttons">
						<a href="javascript:void(0)">
							<span>인증메일 확인하러 가기</span>
						</a>
					</div> -->
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
