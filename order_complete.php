<?
include_once "./header.php";

print_r($_REQUEST);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order-complete complete">
			<div class="content">
				<div class="wrapper">
					<div class="comp-icon">
						<div class="line"></div>
						<div class="line"></div>
					</div>
					<div class="msg">
						<h5 class="nft">THANK YOU</h5>
						<span>감사합니다. 주문이 완료되었습니다.</span>
					</div>
					<div class="buttons">
						<a href="index.php">
							<span>쇼핑 계속하기</span>
						</a>
						<a href="order_detail.php?oid=<?=$_REQUEST["LGD_OID"]?>">
							<span>주문내역상세</span>
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
