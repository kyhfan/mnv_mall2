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
