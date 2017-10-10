/*
*
*	MOBILE전용 JS 파일
*
*/
Kakao.init('dee0f864fcd7296e4dc9d6196634d56a');

// 상품 리스트 소팅 클릭
$(document).on("click", ".sorting-area > a", function(){
	if ($(this).hasClass("current") === false)
	{
		$(".sorting-area > a").removeClass("current");
		$(this).addClass("current");

		if ($(this).attr("data-sort") == "best")
			$(".brand-banner").show();
		else
			$(".brand-banner").hide();
	}

});

// 상품 하트(위시리스트 추가) 클릭
$(document).on("click", ".loveit > a", function(){
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"				: "add_wishlist",
			"goods_code"		: $(this).attr("data-goods")
		},
		success: function(response){
			if (response.match("Y") == "Y")
			{
				alert('관심상품에 등록 되었습니다. 마이페이지에서 확인하실 수 있습니다.');
				$(".loveit > a > img").attr("src","./images/heart_fill.png");
			}else if (response.match("D") == "D"){
				alert('이미 관심상품에 추가하신 상품입니다.');
			}else if (response.match("N") == "N"){
				alert('로그인 후 관심상품에 등록해 주세요!');
				location.href='member_login.php';
			}else{
				alert('시스템 에러');
				location.reload();
			}
		}
	});
});

// 회원가입 전체동의 체크 선택
$(document).on("click", "#all_chk", function(){
	if ($("#all_chk").prop("checked") == false)
	{
		$("#use_chk").prop("checked", false);
		$("#privacy_chk").prop("checked", false);
	}else{
		$("#use_chk").prop("checked", true);
		$("#privacy_chk").prop("checked", true);
	}
		
});

// 회원 가입
$(document).on("click", ".btn.join", function(){
	var mb_email		= $("#mb_email").val();
	var mb_password		= $("#mb_password").val();
	var mb_password_re	= $("#mb_re_password").val();
	var mb_name			= $("#mb_name").val();
	var mb_phone		= $("#mb_phone").val();
	var birthY			= $("#birthY").val();
	var birthM			= $("#birthM").val();
	var birthD			= $("#birthD").val();
	var event_chk		= $("#event_chk").is(":checked");
	var email_chk		= $("#email_chk").is(":checked");
	var sms_chk			= $("#sms_chk").is(":checked");
	var birthday		= birthY + "-" + birthM + "-" + birthD;

	if (mb_email == "")
	{
		alert("이메일 주소를 입력해 주세요.");
		$("#mb_email").focus();
		return false;
	}

	if (mb_password == "")
	{
		alert("비밀번호를 입력해 주세요.");
		$("#mb_password").focus();
		return false;
	}

	if (mb_password_re == "")
	{
		alert("비밀번호 확인을 입력해 주세요.");
		$("#mb_re_password").focus();
		return false;
	}

	if (mb_name == "")
	{
		alert("이름을 입력해 주세요.");
		$("#mb_name").focus();
		return false;
	}

	if (mb_phone == "")
	{
		alert("전화번호를 입력해 주세요.");
		$("#mb_phone").focus();
		return false;
	}

	if (mb_password != mb_password_re)
	{
		alert("비밀번호가 일치하지 않습니다. 다시 확인해 주세요.");
		return false;
	}

	if (birthY == "" || birthM == "" || birthD == "")
	{
		alert("생년월일을 입력해주세요.");
		return false;
	}

	if ($("#use_chk").prop("checked") == false)
	{
		alert("이용약관 동의에 체크해 주세요.");
		return false;
	}

	if ($("#privacy_chk").prop("checked") == false)
	{
		alert("개인정보 수집 및 이용 동의에 체크해주세요.");
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"			: "member_join",
			"mb_email"		: mb_email,
			"mb_password"	: mb_password,
			"mb_name"		: mb_name,
			"mb_phone"		: mb_phone,
			"birthday"		: birthday,
			"event_chk"		: event_chk,
			"email_chk"		: email_chk,
			"sms_chk"		: sms_chk
		},
		success: function(response){
			console.log(response);
			return false;
			if (response.match("Y") == "Y")
			{
				alert('고객님이 입력하신 메일주소로 인증메일이 발송 되었습니다.\r\n메일의 확인버튼을 눌러 주시면 회원가입이 완료 됩니다.');
				location.href = "index.php";
			}else if (response.match("D") == "D"){
				alert('이미 회원 가입 되어 있습니다.');
				location.href = "index.php";
			}else{
				alert('다시 시도해 주세요.');
				location.reload();
			}
		}
	});
});

// 회원 로그인
$(document).on("click", "#find_member", function(){
	var mb_name 		= $("#mb_name").val();
	var mb_password		= $("#mb_password").val();
	var mb_email		= $("#mb_email").val();
alert(submitTarget);
	if (submitTarget == "fid")
	{
		if (mb_name == "")
		{
			alert("이름을 입력해 주세요.");
			$("#mb_name").focus();
			return false;
		}
	
		if (mb_password == "")
		{
			alert("비밀번호를 입력해 주세요.");
			$("#mb_password").focus();
			return false;
		}
	}else{
		if (mb_email == "")
		{
			alert("이메일 주소를 입력해 주세요.");
			$("#mb_email").focus();
			return false;
		}
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"			: "member_find",
			"submitTarget"	: submitTarget,
			"mb_name"		: mb_name,
			"mb_email"		: mb_email,
			"mb_password"	: mb_password
		},
		success: function(response){
			console.log(response);
			if (response.match("Y") == "Y")
			{
				location.href = ref_url;
			}else{
				alert('다시 시도해 주세요.');
				location.reload();
			}
		}
	});

});

// 회원 로그인
$(document).on("click", "#mb_login", function(){
	var mb_email		= $("#mb_email").val();
	var mb_password		= $("#mb_password").val();
	var ref_url 		= $("#ref_url").val();
	if (mb_email == "")
	{
		alert("이메일 주소를 입력해 주세요.");
		$("#mb_email").focus();
		return false;
	}

	if (mb_password == "")
	{
		alert("비밀번호를 입력해 주세요.");
		$("#mb_password").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"			: "member_login",
			"mb_email"		: mb_email,
			"mb_password"	: mb_password
		},
		success: function(response){
			if (response.match("Y") == "Y")
			{
				alert(response);
			}else{
				alert('다시 시도해 주세요.');
				location.reload();
			}
		}
	});

});

// 카카오 로그인
function loginWithKakao(refURL)
{
	// 로그인 창을 띄웁니다.
	Kakao.Auth.login({
	success: function(authObj) {
        // 로그인 성공시, API를 호출합니다.
        Kakao.API.request({
			url: '/v1/user/me',
			success: function(res) {
				console.log(JSON.stringify(res));
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				: "member_kakao_login",
						"login_way"			: "kakao",
						"mb_email"			: res.kaccount_email,
						"mb_email_verified"	: res.kaccount_email_verified,
						"mb_way_id"			: res.id,
						"mb_profile_img"	: res.properties.profile_image,
						"mb_name"			: res.properties.nickname,
						"mb_thumbnail_img"	: res.properties.thumbnail_image						
					},
					success: function(response){
						if (response.match("Y") == "Y")
						{
							location.href	= refURL;
						}else{
							alert("다시 시도해 주세요!");
							location.reload();
						}
						
					}
				});
			},
			fail: function(error) {
			  alert(JSON.stringify(error));
			}
		});
	},
	fail: function(err) {
		alert(JSON.stringify(err));
	}
	});
}

// 네이버 로그인
function loginWithNaver(refURL, nickname, login_way, enc_id, profile_image, age, gender, id, name, email, birthday)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"				: "member_naver_login",
			"login_way"			: login_way,
			"enc_id"			: enc_id,
			"profile_image"		: profile_image,
			"age"				: age,
			"gender"			: gender,
			"id"				: id,
			"mb_name"			: name,						
			"nickname"			: nickname,						
			"email"				: email,						
			"birthday"			: birthday						
		},
		success: function(response){
			if (response.match("Y") == "Y")
			{
				location.href	= refURL;
			}else{
				alert("다시 시도해 주세요!");
				location.reload();
			}
			
		}
	});
}