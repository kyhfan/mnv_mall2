/*
*
*	MOBILE전용 JS 파일
*
*/

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