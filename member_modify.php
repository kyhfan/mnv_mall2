<?
	include_once "./header.php";

	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='member_login.php?ref_url=member_modify.php';</script>";

	// 회원정보 불러오기
	$member_info 	= select_member_info();

	// 생일 정보 구분자로 나누기
	$birth_arr 		= explode("-",$member_info["mb_birth"]);
	// print_r(date("Y-m-d", strtotime("-14year")));
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="join modify">
			<div class="pg-title">
				<h3>
					회원정보 수정
				</h3>
			</div>
			<div class="wrapper">
				<div class="inner">
					<div class="area input">
						<div class="input-group readonly">
							<div class="input-box">
								<input type="text" value="<?=$member_info['mb_email']?>" id="mb_email" readonly>
<?
	if ($member_info['mb_login_way'] == "chon")
	{
?>
								<div class="modify-btn">
									<a href="javascript:void(0)" onclick="modifyId(this);">
										<span>변경하기</span>
									</a>
								</div>
<?
	}
?>
							</div>
						</div>
						<div class="input-group hidden">
							<div class="input-box">
								<input type="text" placeholder="변경할 이메일 주소" id="change_email">
							</div>
							<span class="chk-text">이메일 형식을 확인해 주세요.</span>
							<div class="btn-verify">
								<a href="javascript:void(0)">
									<span>인증메일 받기</span>
								</a>
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
								<input type="text" placeholder="이름" id="mb_name" value="<?=$member_info['mb_name']?>">
							</div>
						</div>
						<div class="input-group">
							<div class="input-box">
								<input type="text" placeholder="휴대전화 번호" id="mb_phone" value="<?=$member_info['mb_phone']?>">
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
		if ($i == $birth_arr[0])
			$selected 	= "selected";
		else
			$selected 	= "";
?>
										<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
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
		if ($j == $birth_arr[1])
			$selected 	= "selected";
		else
			$selected 	= "";
?>
										<option value="<?=$j?>" <?=$selected?>><?=$j?></option>
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
		if ($k == $birth_arr[2])
			$selected 	= "selected";
		else
			$selected 	= "";
?>
										<option value="<?=$k?>" <?=$selected?>><?=$k?></option>
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
									<input type="checkbox" name="chk1" id="event_chk" <?if($member_info["mb_eventYN"] == "Y"){?>checked<?}?>>
								</div>
							</div>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>이메일</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="email_chk" <?if($member_info["mb_emailYN"] == "Y"){?>checked<?}?>>
								</div>
							</div>
						</div>
						<div class="input-group check">
							<div class="wrap-line">
								<span>SMS</span>
								<div class="checkbox">
									<input type="checkbox" name="chk1" id="sms_chk" <?if($member_info["mb_smsYN"] == "Y"){?>checked<?}?>>
								</div>
							</div>
						</div>
					</div>
					<div class="area text">
						<!--<div class="row clearfix">
							<span>1.</span>
							<span>App Push 수신 등의 상태는 앱내 설정메뉴에서 별도로 변경할 수 있습니다.</span>
						</div>-->
						<div class="row clearfix">
							<span>1.</span>
							<span>상품 구매 정보는 수신 등의 여부와 관계없이 발송됩니다.</span>
						</div>
					</div>
					<div class="area finish">
						<div class="wrap-btns clearfix">
							<a href="mypage.php">
								<span>취소</span>
							</a>
							<a href="#" id="modify_member">
								<span>저장</span>
							</a>
						</div>
					</div>
					<div class="area text drop-out">
						<span>탈퇴를 원하시면 회원탈퇴 버튼을 눌러주세요.</span>
						<a href="javascript:void(0)">
							<span>회원탈퇴</span>
						</a>
					</div>
				</div>
			</div>
		</div>
<?
	include_once "./popup_div.php";
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
		function modifyId(elem) {
			var $_this = $(elem);
			if($_this.hasClass('spread')) {
				$_this.removeClass('spread');
				$_this.children().text('변경하기');
				$('.input-group.hidden').hide();
			} else {
				$_this.addClass('spread');
				$_this.children().text('변경취소');
				$('.input-group.hidden').show();
			}
		}

	</script>
</body>
</html>
