<?
	include_once "./header.php";

	$idx	= $_REQUEST["idx"];
	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

	$oto_info 	= select_oto_info($idx);

	if ($oto_info["group_id"] == "null")
		$status_txt	= "대기중";
	else
		$status_txt	= "답변완료";

?>
<body>
	<input type="hidden" id="oto_idx" value="<?=$oto_info["idx"]?>">
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
									<span>제목</span>
								</div>
							</div>
							<div class="col">
								<span><?=$oto_info["oto_title"]?></span>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>질문구분</span>
								</div>
							</div>
							<div class="col">
								<span><?=$_gl['oto'][$oto_info["oto_question_type"]]?></span>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>답변</span>
								</div>
							</div>
							<div class="col">
								<span><?=$status_txt?></span>
							</div>
						</div>
					</div>
					<div class="body">
						<div class="content">
							<textarea name="name" readonly><?=$oto_info["oto_contents"]?></textarea>
						</div>
					</div>
					<div class="foot">
						<div class="row buttons">
							<div class="wrapper">
								<!-- <a href="javascript:void(0)" id="del_oto">
									<span>삭제</span>
								</a> -->
								<a href="oto_list.php">
									<span>목록</span>
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
