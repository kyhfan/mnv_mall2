/*
*
*	MOBILE전용 JS 파일
*
*/
Kakao.init('dee0f864fcd7296e4dc9d6196634d56a');

// window scrolling
$(window).on('scroll', function() {
	var currentScroll = $(this).scrollTop();
	if(currentScroll > $header.height() && !$app.hasClass('menu-opened')) {
		$app.addClass('scrolled');
		TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 1});
	} else {
		$app.removeClass('scrolled');
		TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 0});
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

function open_pop(param)
{
	$.colorbox({
		innerWidth:"100%",
		innerHeight: $("#"+param).height(),
		initialWidth:"95%",
		initialHeight: $("#"+param).height(),
		inline:true,
		opacity:"0.9",
		scrolling:true,
		reposition: false,
		closeButton:false,
		preloading:true,
		overlayClose: false,
		open:true,
		speed:300,
		transition: "fade",
		fadeOut: 300,
		href:"#"+param,
		onComplete: function(){
			$("#cboxContent").css("background","none");
			$("#cboxContent").css("z-index","4000");
			$('#cboxWrapper').css('backgroundColor', "");
			$('#cboxWrapper').css("z-index","4000");
			$('.popup_wrap').css("z-index","4000");
			$("#colorbox").css("z-index","4000");
			$('#cboxLoadedContent').css('backgroundColor', "");
			$('#cboxLoadedContent').css("z-index","4000");
			$("#colorbox").width($("body").width());
			$("#cboxWrapper").width($("body").width());
			$("#colorbox").css("opacity", 1);
		},
		onOpen: function(){
			$("#colorbox").css("opacity", 0);
		},
		onClosed: function(){
			$("#cboxContent").css("background","#fff");
		}
	});
}

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
				// alert('관심상품에 등록 되었습니다. 마이페이지에서 확인하실 수 있습니다.');
				$(".loveit > a > img").attr("src","./images/heart_fill.png");
			}else if (response.match("D") == "D"){
				// alert('관심상품에서 삭제 되었습니다.');
				$(".loveit > a > img").attr("src","./images/heart.png");
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

// 프로모션 더보기 클릭
$(document).on("click", ".btn-more", function(){
	location.href = "promotion_detail.php?idx=" + $(this).attr("data-idx");
});

// 1대1 문의 글쓰기 입력
$(document).on("click", "#write_oto", function(){
	var oto_question_type		= $("#oto_question_type").val();
	var oto_title				= $("#oto_title").val();
	var oto_contents			= $("#oto_contents").val();

	if (oto_question_type == "")
	{
		alert("질문 구분을 선택해주세요.");
		return false;
	}

	if (oto_title == "")
	{
		alert("제목을 입력해주세요.");
		$("#oto_title").focus();
		return false;
	}

	if (oto_contents == "")
	{
		alert("내용을 입력해주세요.");
		$("#oto_contents").focus();
		return false;
	}


	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"					: "insert_oto_info",
			"oto_question_type"		: oto_question_type,
			"oto_title"				: oto_title,
			"oto_contents"			: oto_contents
		},
		success: function(response){
			location.href = "oto_list.php";
		}
	});
});

// 1대1 문의 글쓰기 삭제
$(document).on("click", "#del_oto", function(){
	var oto_idx 	= $("#oto_idx").val();

	if (confirm("이 문의를 삭제하시겠습니까?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "./main_exec.php",
			data:{
				"exec"					: "delete_oto_info",
				"oto_idx"				: oto_idx
			},
			success: function(response){
				if (response.match("Y") == "Y")
				{
					alert('해당 글이 삭제되었습니다.');
					location.href='oto_list.php';
				}else{
					alert('시스템 에러');
					location.reload();
				}
			}
		});
	}
});

// 1대1 문의 리스트 소팅
function oto_sort(val)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./ajax_oto_list.php",
		data:{
			"sort_val"				: val
		},
		success: function(response){
			$("#sort_oto_list").html(response);
			// if (response.match("Y") == "Y")
			// {
			// 	alert('해당 글이 삭제되었습니다.');
			// 	location.href='oto_list.php';
			// }else{
			// 	alert('시스템 에러');
			// 	location.reload();
			// }
		}
	});
}

// 장바구니 담기
$(document).on("click", ".put-in > a", function(){
	var goods_code 	= $(".put-in").attr("data-goodscode");
	var loginYN 	= $(".put-in").attr("data-login");

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"					: "add_mycart",
			"goods_code"			: goods_code,
			"loginYN"				: loginYN
		},
		success: function(response){
			if (response.match("Y") == "Y")
			{
				alert("장바구니에 상품이 담겼습니다!");
				// location.href='oto_list.php';
			}else{
				alert('다시 시도해 주세요');
				location.reload();
			}
		}
	});
});

function del_chk_cart()
{
	var chk_idx	= "";
	$("input[name=chk_this]:checked").each(function() {
		var chk_id	= $(this).attr("id");
		var chk_arr	= chk_id.split("_");
		chk_idx		+= ","+chk_arr[1];
	});

	alert(chk_idx);

	if (chk_idx == "")
	{
		alert("선택하신 상품이 없습니다.");
		return false;
	}else{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "./main_exec.php",
			data:{
				"exec"				: "delete_chk_cart",
				"chk_idx"			: chk_idx
			},
			success: function(response){
				location.reload();
			}
		});
	}
}

function del_cart(idx)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"				: "delete_one_cart",
			"cart_idx"			: idx
		},
		success: function(response){
			// alert(response);
			location.reload();
		}
	});

}

function change_cart(idx)
{
	var goods_cnt = $("#cart_num_"+idx).val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./ajax_cart.php",
		data:{
			"cart_idx"			: idx,
			"goods_cnt"			: goods_cnt
		},
		success: function(response){
			$(".cart-block").html(response);
			// location.reload();
		}
	});
}

// 주문하기 > 결제방법 선택
$(document).on("click", "#pay_type > a", function(){
	$("#pay_type > a").removeClass("active");
	$(this).addClass("active");
});


// 주문하기
$(document).on("click", "#order_start", function(){
	var order_goods				= $("#order_goods").val();
	var order_name				= $("#order_name").val();
	var order_email				= $("#order_email").val();
	var order_phone				= $("#order_phone").val();
	var delivery_name			= $("#delivery_name").val();
	var delivery_zipcode		= $("#delivery_zipcode").val();
	var delivery_addr1			= $("#delivery_addr1").val();
	var delivery_addr2			= $("#delivery_addr2").val();
	var delivery_phone			= $("#delivery_phone").val();
	var delivery_message		= $("#delivery_message").val();
	var total_order_price		= $("#total_order_price").val();
	var total_delivery_price	= $("#total_delivery_price").val();
	var total_save_price		= $("#total_save_price").val();
	var total_payment_price		= $("#total_payment_price").val();
	var total_coupon_price		= $("#total_coupon_price").val();
	var show_goods_name			= $("#show_goods_name").val();
	var pay_type				= $("#pay_type > .active").attr("data-value");
	
	if (delivery_name == "")
	{
		alert("배송받으실 분 이름을 입력해 주세요.");
		$("#delivery_name").focus();
		return false;
	}

	if (delivery_zipcode == "" || delivery_addr1 == "" || delivery_addr2 == "")
	{
		alert("배송받으실 분 주소를 입력해 주세요.");
		$("#delivery_addr2").focus();
		return false;
	}

	if (delivery_phone == "")
	{
		alert("배송받으실 분 휴대전화 번호를 입력해 주세요.");
		$("#delivery_phone").focus();
		return false;
	}

	if ($("#order_chk").prop("checked") == false)
	{
		alert("주문의 상품, 가격, 할인, 배송정보에 동의해주셔야만 결제가 진행 됩니다..");
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"						: "insert_order_info",
			"order_goods"				: order_goods,
			"order_name"				: order_name,
			"order_email"				: order_email,
			"order_phone"				: order_phone,
			"delivery_name"				: delivery_name,
			"delivery_zipcode"			: delivery_zipcode,
			"delivery_addr1"			: delivery_addr1,
			"delivery_addr2"			: delivery_addr2,
			"delivery_phone"			: delivery_phone,
			"delivery_message"			: delivery_message,
			"total_order_price"			: total_order_price,
			"total_delivery_price"		: total_delivery_price,
			"total_save_price"			: total_save_price,
			"total_payment_price"		: total_payment_price,
			"total_coupon_price"		: total_coupon_price,
			"pay_type"					: pay_type,
			"show_goods_name"			: show_goods_name
		},
		success: function(response){
			console.log(response);
			// $(window).on('load', function(){
			// 	launchCrossPlatform();
			// });
			$(".pay_area").html(response);
			var contentImages = $(".pay_area img");
			var totalImages = contentImages.length;
			var loadedImages = 0;
			contentImages.each(function(){
				$(this).on('load', function(){
					loadedImages++;
					if(loadedImages == totalImages)
					{
						alert("1111");
						launchCrossPlatform();
					}
				});
			});
			
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
			if (response.match("Y") == "Y")
			{
				alert('고객님이 입력하신 메일주소로 인증메일이 발송 되었습니다.\r\n메일의 확인버튼을 눌러 주시면 회원가입이 완료 됩니다.');
				location.href = "index.php";
			}else if (response.match("E") == "E"){
				alert('만 14세 이상만 가입 가능합니다.');
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

// 회원 정보 수정
$(document).on("click", "#modify_member", function(){
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

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"			: "member_modify",
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
			if (response.match("Y") == "Y")
			{
				alert('고객님이 회원 정보가 수정되었습니다.');
				location.href = "mypage.php";
			}else if (response.match("E") == "E"){
				alert('만 14세 이상만 가입 가능합니다.');
				location.reload();
			}else{
				alert('다시 시도해 주세요.');
				location.reload();
			}
		}
	});
});

// 이메일 주소 변경
$(document).on("click", ".btn-verify > a", function(){
	var change_email	= $("#change_email").val();
	var mb_email		= $("#mb_email").val();
	var mb_name			= $("#mb_name").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "./main_exec.php",
		data:{
			"exec"			: "email_change",
			"change_email"	: change_email,
			"mb_name"		: mb_name,
			"mb_email"		: mb_email
		},
		success: function(response){
			console.log(response);
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
			console.log(response);
			if (response.match("Y") == "Y")
			{
				location.href	= ref_url;
			}else{
				alert('가입되지 않은 이메일 혹은 틀린 비밀번호 입니다. 확인 후 다시 로그인해 주세요.');
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
