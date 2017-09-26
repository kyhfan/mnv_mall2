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
/*
				$str	= "main_exec.php";
				$str	.= "?exec=member_naver_login";
				$str	.= "&nickname=".$json_data['response']['nickname'];
				$str	.= "&login_way=naver";
				$str	.= "&enc_id=".$json_data['response']['enc_id'];
				$str	.= "&profile_image=".$json_data['response']['profile_image'];
				$str	.= "&age=".$json_data['response']['age'];
				$str	.= "&gender=".$json_data['response']['gender'];
				$str	.= "&id=".$json_data['response']['id'];
				$str	.= "&mb_name=".$json_data['response']['name'];
				$str	.= "&email=".$json_data['response']['email'];
				$str	.= "&birthday=".$json_data['response']['birthday'];
				// print_r($str);
				echo "<script>location.href='".$str."';</script>";
*/				
				echo "<script>loginWithNaver('".$ref_url."','".$json_data['response']['nickname']."','naver','".$json_data['response']['enc_id']."','".$json_data['response']['profile_image']."','".$json_data['response']['age']."','".$json_data['response']['gender']."','".$json_data['response']['id']."','".$json_data['response']['name']."','".$json_data['response']['email']."','".$json_data['response']['birthday']."');</script>";
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
				<a href="javascript:void(0)" class="fb"  id="loginBtn">
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


		function getUserData() {
			/* FB.api('/me', function(response) {
				document.getElementById('response').innerHTML = 'Hello ' + response.name;
				console.log(response);
			}); */
			FB.api('/me', {fields: 'name,email,gender,birthday'}, function(response) {
				console.log(JSON.stringify(response));
				$("#name").text("이름 : "+response.name);
				$("#email").text("이메일 : "+response.email);
				$("#gender").text("성별 : "+response.gender);
				$("#birthday").text("생년월일 : "+response.birthday);
				$("#id").text("아이디 : "+response.id);
			});
		}
		  
		window.fbAsyncInit = function() {
			//SDK loaded, initialize it
			FB.init({
				appId      : '1467962459907448',
				cookie     : true,  // enable cookies to allow the server to access
						// the session
				xfbml      : true,  // parse social plugins on this page
				version    : 'v2.8' // use graph api version 2.8
			});
		  
			//check user session and refresh it
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					//user is authorized
					//document.getElementById('loginBtn').style.display = 'none';
					getUserData();
				} else {
					//user is not authorized
				}
			});
		};
		  
		//load the JavaScript SDK
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.com/ko_KR/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		  
		//add event listener to login button
		document.getElementById('loginBtn').addEventListener('click', function() {
			//do the login
			FB.login(function(response) {
				if (response.authResponse) {
					access_token = response.authResponse.accessToken; //get access token
					user_id = response.authResponse.userID; //get FB UID
					console.log('access_token = '+access_token);
					console.log('user_id = '+user_id);
					$("#access_token").text("접근 토큰 : "+access_token);
					$("#user_id").text("FB UID : "+user_id);
					//user just authorized your app
					//document.getElementById('loginBtn').style.display = 'none';
					getUserData();
				}
			}, {scope: 'email,public_profile,user_birthday',
				return_scopes: true});
		}, false);
</script>	
</body>
</html>
