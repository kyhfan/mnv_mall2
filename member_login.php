<?
	include_once "./header.php";

	$ref_url	= $_REQUEST["ref_url"];

	if ($_SESSION['ss_chon_email'])
		echo "<script>location.href='$ref_url';</script>";
?>						
	
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="login">
			<div class="pg-title">
				<h3>
					LOGIN
				</h3>
			</div>
			<div class="input-group">
				<div class="input-box">
					<input type="text" placeholder="아이디">
				</div>
				<div class="input-box">
					<input type="text" placeholder="패스워드">
				</div>
			</div>
			<div class="btn login">
				<a href="javascript:void(0)">
					<span>로그인</span>
				</a>
			</div>
			<div class="other-login">
				<a href="javascript:loginWithKakao('<?=$ref_url?>')" class="kt">
					<span class="blind">카카오계정 로그인</span>
				</a>
				<a href="javascript:void(0)" class="fb">
					<span class="blind">페이스북 로그인</span>
				</a>
				<a href="javascript:loginWithNaver('<?=$ref_url?>')" class="nv">
					<span class="blind">네이버 로그인</span>
				</a>
			</div>
			<div class="manage-id">
				<a href="javascript:void(0)">
					<span>아이디 · 비밀번호 찾기</span>
				</a>
				<a href="javascript:void(0)">
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
