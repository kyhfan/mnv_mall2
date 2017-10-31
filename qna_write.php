<?
	include_once "./header.php";

	$goodscode			= $_REQUEST["goodscode"];
	$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='$goodscode'";
	$goods_result		= mysqli_query($my_db, $goods_query);
	$goods_data 		= mysqli_fetch_array($goods_result);

	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='member_login.php?ref_url=review_write.php?goodscode=".$goodscode."';</script>";

?>
<body>
	<input type="hidden" id="qna_goodscode" value="<?=$goodscode?>">
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="oto-write">
			<div class="content">
				<div class="pg-title">
					<h3>Q&A 문의</h3>
				</div>
				<div class="board-frame">
					<div class="head">
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>상품명</span>
								</div>
							</div>
							<div class="col">
								<div class="guide">
									<span><?=$goods_data["goods_name"]?></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="guide">
									<span>질문구분</span>
								</div>
							</div>
							<div class="col">
								<div class="sorting">
									<select name="q-cate" class="q-cate" id="qna_question_type">
										<option value="">선택하세요</option>
										<option value="product">상품문의</option>
										<option value="cancel">반품/취소</option>
										<option value="exchange">교환문의</option>
										<option value="shipping">배송문의</option>
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
								<div class="input">
									<input type="text" placeholder="입력하세요" id="qna_title">
								</div>
							</div>
						</div>
					</div>
					<div class="body">
						<div class="content">
							<textarea name="name" id="qna_contents" placeholder="내용을 입력하세요"></textarea>
						</div>
					</div>
					<div class="foot">
						<div class="row img-upload">
							<label for="imgUp" id="file_txt">사진첨부</label>
							<form id="qna_image_frm" method="post" enctype="multipart/form-data">
								<input type="file" name="imgUp" id="imgUp" value="사진첨부" onchange="change_file()">
							</form>
						</div>
						<div class="row buttons">
							<div class="wrapper">
								<a href="product_detail.php?goodscode=<?=$goodscode?>">
									<span>취소</span>
								</a>
								<a href="javascript:void(0)" id="write_qna">
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
	<script src="./js/jquery.form.js"></script>

	<script type="text/javascript">
		var $header = $('#header');
		var $app = $('#chon-app');
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
		function change_file()
		{
			var fileValue = $("#imgUp").val().split("\\");
			var fileName = fileValue[fileValue.length-1]; // 파일명
			$("#file_txt").html(fileName);
		}
	</script>
</body>
</html>
