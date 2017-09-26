<?
	include_once "./header.php";

	$ref_url	= $_REQUEST["ref_url"];

	if ($_SESSION['ss_chon_email'])
		echo "<script>location.href='$ref_url';</script>";

	// 네이버 로그인 접근토큰 요청
	$client_id = "mebia0Wrk4RP6CBvbnwx";
	$redirectURI = urlencode("http://www.store-chon.com/dev/member_login.php?ref_url=$ref_url");
	$state = "RAMDOM_STATE";
	$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

	// 
	// 네이버 로그인 콜백
	if ($_GET["code"])
	{
		// $client_id = "mebia0Wrk4RP6CBvbnwx";
		$client_secret = "oc4ov9gvgn";
		$code = $_GET["code"];
		$state = $_GET["state"];
		$redirectURI = urlencode("http://www.store-chon.com/dev/member_login.php?ref_url=$ref_url");
		$url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$response = curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// echo "status_code:".$status_code."";
		curl_close ($ch);
		if($status_code == 200) {
			$json_data = json_decode($response, true);
			$token = $json_data["access_token"];
			$header = "Bearer ".$token; // Bearer 다음에 공백 추가
			$url = "https://openapi.naver.com/v1/nid/me";
			$is_post = false;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, $is_post);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$headers = array();
			$headers[] = "Authorization: ".$header;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$response = curl_exec ($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			echo "status_code:".$status_code."<br>";
			curl_close ($ch);
			if($status_code == 200) {
				$json_data = json_decode($response, true);

				print_r($json_data);
				$str	= "main_exec.php";
				$str	.= "?exec=member_naver_login";
				$str	.= "&nickname=".$json_data['nickname'];
				$str	.= "&login_way=naver";
				$str	.= "&enc_id=".$json_data['enc_id'];
				$str	.= "&profile_image=".$json_data['profile_image'];
				$str	.= "&age=".$json_data['age'];
				$str	.= "&gender=".$json_data['gender'];
				$str	.= "&id=".$json_data['id'];
				$str	.= "&name=".$json_data['name'];
				$str	.= "&email=".$json_data['email'];
				$str	.= "&birthday=".$json_data['birthday'];
				echo "<script>location.href='".$str."';</script>";
			} else {
			  	echo "Error 내용:".$response;
			}			
		} else {
			echo "Error 내용:".$response;
		}
	}	
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
				<a href="<?=$apiURL?>" class="nv">
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
