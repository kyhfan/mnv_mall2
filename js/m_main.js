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
				alert('찜추가');
			}else if (response.match("D") == "D"){
				alert('이미 찜 추가된 상품');
			}else if (response.match("N") == "N"){
				alert('로그인 안되어 있음');
			}else{
				alert('시스템 에러');
			}
		}
	});
});

// 카카오 로그인
function loginWithKakao()
{
	// 로그인 창을 띄웁니다.
	Kakao.Auth.login({
	success: function(authObj) {
        // 로그인 성공시, API를 호출합니다.
        Kakao.API.request({
			url: '/v1/user/me',
			success: function(res) {
				console.log(JSON.stringify(res));
				/*
				{
					"kaccount_email":"kyhfan@naver.com",
					"kaccount_email_verified":true,
					"id":525303385,
					"properties":{
						"profile_image":"http://k.kakaocdn.net/dn/JhByL/btqhoSzSNZI/zCKT28lwpKPwPWOXWniRP1/profile_640x640s.jpg",
						"nickname":"김영훈",
						"thumbnail_image":"http://k.kakaocdn.net/dn/JhByL/btqhoSzSNZI/zCKT28lwpKPwPWOXWniRP1/profile_110x110c.jpg"
					}
				}
				*/
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
							alert('찜추가');
						}else if (response.match("D") == "D"){
							alert('이미 찜 추가된 상품');
						}else if (response.match("N") == "N"){
							alert('로그인 안되어 있음');
						}else{
							alert('시스템 에러');
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