<?
	include_once "./header.php";

	if ($_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="join">
			<div class="pg-title">
				<h3>
					JOIN
				</h3>
			</div>
			<div class="wrapper">
				<div class="inner">
					<div class="area input">
						<div class="input-group">
							<div class="input-box">
								<input type="text" placeholder="이메일" id="mb_email">
							</div>
						</div>
						<div class="input-group">
							<div class="input-box">
								<input type="password" placeholder="비밀번호 (8-16자리 영문, 숫자조합)" id="mb_password">
							</div>
						</div>
						<div class="input-group">
							<div class="input-box">
								<input type="password" placeholder="비밀번호 확인" id="mb_re_password">
							</div>
						</div>
						<div class="input-group">
							<div class="input-box">
								<input type="text" placeholder="이름" id="mb_name">
							</div>
						</div>
						<div class="input-group">
							<div class="input-box">
								<input type="text" placeholder="휴대전화 번호" id="mb_phone">
							</div>
						</div>
						<div class="input-group birth n3">
							<div class="row clearfix">
								<div class="col">
									<select name="birthY" id="birthY">
										<option value="">년도</option>
<?
	for ($i=2010; $i>1950; $i--)
	{
?>
										<option value="<?=$i?>"><?=$i?></option>
<?
	}
?>
									</select>
								</div>
								<div class="col">
									<select name="birthM" id="birthM">
										<option value="">월</option>
<?
	for ($j=1; $j<13; $j++)
	{
?>
										<option value="<?=$j?>"><?=$j?></option>
<?
	}
?>
									</select>
								</div>
								<div class="col">
									<select name="birthD" id="birthD">
										<option value="">일</option>
<?
	for ($k=1; $k<32; $k++)
	{
?>
										<option value="<?=$k?>"><?=$k?></option>
<?
	}
?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="area text">
						<span>만 14세 이상 가입 가능합니다.</span>
						<a href="javascript:void(0)" onclick="open_pop('protect_div')">
							<span>내용보기</span>
						</a>
					</div>
					<div class="area check-zone marketing">
						<div class="title">
							<span>마케팅 정보 수신 (선택)</span>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>할인쿠폰, 특가상품, 이벤트 소식 동의</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="event_chk">
								</div>
							</div>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>이메일</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="email_chk">
								</div>
							</div>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>SMS</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="sms_chk">
								</div>
							</div>
						</div>
					</div>
					<div class="area text">
						<div class="row clearfix">
							<span>1.</span>
							<span>마케팅 정보 수신 등의 상태는 회원정보 수정 메뉴에서 별도로 변경할 수 있습니다.</span>
						</div>
						<div class="row clearfix">
							<span>2.</span>
							<span>상품 구매 정보는 수신 등의 여부와 관계없이 발송됩니다.</span>
						</div>
					</div>
					<div class="area check-zone finish">
						<div class="input-group check">
							<div class="wrap-line">
								<span>전체동의</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="all_chk">
								</div>
							</div>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>이용약관에 동의합니다.</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="use_chk">
								</div>
								<a href="javascript:void(0)" onclick="open_pop('terms_div')">
									<span>내용보기</span>
								</a>
							</div>
						</div>
						<div class="input-group check last">
							<div class="wrap-line">
								<span>개인정보 수집 및 이용에 동의합니다.</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="privacy_chk">
								</div>
								<a href="javascript:void(0)" onclick="open_pop('privacy_div')">
									<span>내용보기</span>
								</a>
							</div>
						</div>
						<div class="btn join join_member">
							<a href="javascript:void(0)">
								<span>회원가입</span>
							</a>
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

		$(document).ready(function() {
			$('.gnb').on('click', function() {
				$('#menu-layer').slideDown('slow');
				$app.hasClass('menu-opened') ? $app.removeClass('menu-opened') : $app.addClass('menu-opened');
			});
			$('#menu-layer .close-btn a').on('click', function() {
				$app.removeClass('menu-opened');
				$('#menu-layer').slideUp('slow');
			});

			$("#cboxTopLeft").hide();
			$("#cboxTopRight").hide();
			$("#cboxBottomLeft").hide();
			$("#cboxBottomRight").hide();
			$("#cboxMiddleLeft").hide();
			$("#cboxMiddleRight").hide();
			$("#cboxTopCenter").hide();
			$("#cboxBottomCenter").hide();
		});
	</script>
</body>
</html>
