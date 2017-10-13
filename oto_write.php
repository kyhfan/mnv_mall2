<?
	include_once "./header.php";

	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="oto-write">
			<div class="content">
				<div class="pg-title">
					<h3>1:1 문의</h3>
				</div>
				<div class="board-frame">
					<div class="head">
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>질문구분</span>
								</div>
							</div>
							<div class="col">
								<div class="sorting" id="question_type">
									<select name="q-cate" class="q-cate">
										<option value="">선택하세요</option>
										<option value="product">상품문의</option>
										<option value="pay">결제문의</option>
										<option value="cancel">주문취소 신청</option>
										<option value="saveNcoupon">적립금/쿠폰문의</option>
										<option value="shipping">배송문의</option>
										<option value="site">사이트이용</option>
										<option value="other">기타</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>제목</span>
								</div>
							</div>
							<div class="col">
								<span>추석배송해주나요?</span>
							</div>
						</div>
					</div>
					<div class="body">
						<div class="content">
							<textarea name="name"></textarea>
						</div>
					</div>
					<div class="foot">
						<div class="row img-upload">
							<label for="imgUp">사진첨부</label>
							<input type="file" name="imgUp" id="imgUp" value="사진첨부">
						</div>
						<div class="row buttons">
							<div class="wrapper">
								<a href="javascript:void(0)">
									<span>취소</span>
								</a>
								<a href="javascript:void(0)">
									<span>작성하기</span>
								</a>
							</div>
						</div>
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
