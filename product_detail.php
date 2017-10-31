<?
	include_once "./header.php";

	$goods_code 		= $_REQUEST["goodscode"];
	$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='$goods_code'";
	$goods_result		= mysqli_query($my_db, $goods_query);
	$goods_data 		= mysqli_fetch_array($goods_result);

	// 롤링 이미지를 위해 배열 생성 및 빈 배열값 제거
	$goods_img_url 		= array_filter(array($goods_data["goods_img_url1"],$goods_data["goods_img_url2"],$goods_data["goods_img_url3"],$goods_data["goods_img_url4"],$goods_data["goods_img_url5"]));

	// 상품 상세 설명 P태그 class 자동 삽입
	$goods_data["m_goods_big_desc"] 	= str_replace('<p>','<p class="txt-template ft-18 cl-333 lh-32" style="padding-bottom: 68px;">',$goods_data["m_goods_big_desc"]);

	$wish_flag 	= check_wish_goods($goods_code);
	if ($_SESSION['ss_chon_email'])
		$mb_flag	= "Y";
	else
		$mb_flag	= "N";

	// 리뷰 쿼리
	$review_query		= "SELECT * FROM ".$_gl['board_review_table']." WHERE review_goodscode='$goods_code' AND review_showYN='Y'";
	$review_result		= mysqli_query($my_db, $review_query);
	$review_count 		= mysqli_num_rows($review_result);
		
	// QNA 쿼리
	$qna_query			= "SELECT * FROM ".$_gl['board_qna_table']." WHERE qna_goodscode='$goods_code' AND qna_showYN='Y'";
	$qna_result			= mysqli_query($my_db, $qna_query);
	$qna_count 			= mysqli_num_rows($qna_result);
		
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-detail">
			<div class="product-slide swiper-container">
				<div class="swiper-wrapper">
<?
	foreach ($goods_img_url as $key => $val)
    {
		$goods_img 	= str_replace("../../../","./",$val);
?>
					<div class="swiper-slide">
						<img src="<?=$goods_img?>">
					</div>
<?
    }
?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
			<div class="product-info">
				<div class="wrapper top">
					<div class="name">
						<h4><?=$goods_data["goods_name"]?></h4>
						<div class="wrap-icon">
<?
	// 신상품 노출 여부
	if ($goods_data["goods_regdate"] > date("Y-m-d", strtotime("-30days")))
	{
?>
							<span class="new">NEW</span>
<?
	}

	// 판매가와 할인가가 동일할 경우 판매가 숨기기
	if ($goods_data["sales_price"] != $goods_data["discount_price"])
	{
		// 할인율 계산
		$discount_percent 			= ($goods_data['sales_price'] - $goods_data['discount_price']) / $goods_data['sales_price'] * 100;
?>
							<span class="percent"><?=ceil($discount_percent)?>%</span>
<?
	}
?>
						</div>
					</div>
					<div class="sub">
						<p><?=$goods_data["goods_small_desc"]?></p>
					</div>
					<div class="price discount">
<?
	// 판매가와 할인가가 동일할 경우 판매가 숨기기
	if ($goods_data["sales_price"] != $goods_data["discount_price"])
	{
?>

						<span class="normal">
							<?=number_format($goods_data["sales_price"])?>
						</span>
<?
	}
?>
						<span class="sale">
							<?=number_format($goods_data["discount_price"])?>
						</span>
					</div>
				</div>
				<div class="divide-line"></div>
				<div class="wrapper middle">
					<div class="details">
						<div class="row">
							<span>품목명 및 제품명</span>
							<span><?=$goods_data["goods_sub_name"]?></span>
						</div>
						<div class="row">
							<span>제조자</span>
							<span><?=$goods_data["goods_brand"]?></span>
						</div>
						<div class="row">
							<span>사이즈</span>
							<span><?=$goods_data["goods_size"]?></span>
						</div>
						<div class="row">
							<span>색상 / 무늬</span>
							<span><?=$goods_data["goods_color"]?></span>
						</div>
					</div>
				</div>
				<div class="divide-line"></div>
				<div class="wrapper editor">
					<?=$goods_data["m_goods_big_desc"]?>
				</div>
			</div>
			<div class="etc-block">
				<div class="list board">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>REVIEW</h4>
							<span>(<?=$review_count?>)</span>
						</div>
					</a>
					<div class="group-switch">
						<ul>
<?
	while($review_data = mysqli_fetch_array($review_result))
	{
		// 작성일자
		$review_arr1 	= explode(" ",$review_data["review_regdate"]);
		$review_arr2 	= explode("-",$review_arr1[0]);
		$review_date 	= $review_arr2[0].".".$review_arr2[1].".".$review_arr2[2];

		$email_arr		= explode("@",$review_data['review_email']);
		$email_arr[0] 	= substr_replace($email_arr[0], "***", -3);
		$mask_email 	= $email_arr[0]."@".$email_arr[1];		
?>							
							<li class="row">
								<a href="javascript:void(0)" onclick="toggle_review('<?=$review_data['idx']?>')">
									<div class="head">
										<div class="tt">
											<p><?=$review_data["review_title"]?></p>
										</div>
										<div class="other">
											<span><?=$review_date?></span>
											<span><?=$mask_email?></span>
										</div>
									</div>
								</a>
								<div class="content clearfix" id="review_detail<?=$review_data['idx']?>">
									<div class="img">
										<img src="<?=$review_data["review_file_url"]?>" style="width:100%">
									</div>
									<div class="txt">
										<p>
										<?=$review_data["review_contents"]?>
										</p>
									</div>
								</div>
							</li>
<?
	}
?>							
						</ul>
						<div class="action-group clearfix">
							<!-- <div class="pagination">
								<div class="wrapper">
									<a href="javascript:void(0)">
										<span>1</span>
									</a>
									<a href="javascript:void(0)">
										<span>2</span>
									</a>
									<a href="javascript:void(0)">
										<span>></span>
									</a>
								</div>
							</div> -->
							<div class="button">
								<a href="review_write.php?goodscode=<?=$goods_code?>">
									<span>후기작성</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="list board">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>Q&A</h4>
							<span>(<?=$qna_count?>)</span>
						</div>
					</a>
					<div class="group-switch">
						<ul>
<?
	while($qna_data = mysqli_fetch_array($qna_result))
	{
		// 작성일자
		$qna_arr1 	= explode(" ",$qna_data["qna_regdate"]);
		$qna_arr2 	= explode("-",$qna_arr1[0]);
		$qna_date 	= $qna_arr2[0].".".$qna_arr2[1].".".$qna_arr2[2];

		$email_arr		= explode("@",$qna_data['qna_email']);
		$email_arr[0] 	= substr_replace($email_arr[0], "***", -3);
		$mask_email 	= $email_arr[0]."@".$email_arr[1];		
?>							
							<li class="row">
								<a href="javascript:void(0)" onclick="toggle_qna('<?=$qna_data['idx']?>')">
									<div class="head">
										<div class="tt">
											<p><?=$qna_data["qna_title"]?></p>
											<!-- 비밀글 자물쇠 아이콘 추가 -->
										</div>
										<div class="other">
											<span><?=$qna_date?></span>
											<span><?=$mask_email?></span>
										</div>
									</div>
								</a>
								<div class="content clearfix" id="qna_detail<?=$qna_data['idx']?>">
									<div class="img">
										<img src="<?=$qna_data["qna_file_url"]?>" style="width:100%">
									</div>
									<div class="txt">
										<p>
										<?=$qna_data["qna_contents"]?>
										</p>
									</div>
								</div>
							</li>
<?
	}
?>							
						</ul>
						<div class="action-group clearfix">
							<!-- <div class="pagination">
								<div class="wrapper">
									<a href="javascript:void(0)">
										<span>1</span>
									</a>
									<a href="javascript:void(0)">
										<span>2</span>
									</a>
									<a href="javascript:void(0)">
										<span>></span>
									</a>
								</div>
							</div> -->
							<div class="button">
								<a href="qna_write.php?goodscode=<?=$goods_code?>">
									<span>문의작성</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="list guide">
					<a href="javascript:void(0)" class="toggle">
						<div>
							<h4>배송정보 / 교환안내</h4>
						</div>
					</a>
					<div class="group-switch">
						<ul>
							<li class="row">
								<p>1. 교환의 경우 제품을 받으신 후 3일 이내에 연락 주시기 바랍니다.</p>
							</li>
							<li class="row">
								<p>2. 제품이 파손시 교환이 어려울 수도 있습니다.</p>
							</li>
							<li class="row">
								<p>3. 제품이 잘못 갔을 시 배송비 전액을 부담해 드립니다.</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="buy-layer">
				<div class="inner">
					<div class="love-it empty">
						<!--  data-goodscode="<?=$goods_code?>" data-login="<?=$mb_flag?>" -->
						<a href="javascript:void(0)" data-goods="<?=$goods_code?>">
							<span class="blind">관심상품등록</span>
						</a>
					</div>
					<div class="buy">
						<a href="javascript:void(0)" onclick="optionToggle(this)">
							<!-- order.php?t=goods&goodscode=<?=$goods_code?>&buycnt=1 -->
							<h5>구매하기</h5>
						</a>
					</div>
				</div>
			</div>
			<div class="spread">
				<div class="bg"></div>
				<div class="wrapper">
					<div class="inner">
						<a class="toggle" href="javascript:void(0)" onclick="optionToggle()">
							<span class="blind">접기</span>
						</a>
						<div class="control-block clearfix">
							<div class="button" class="minus" onclick="amountControl('m')">
								<button>-</button>
							</div>
							<div class="input">
								<input type="tel" value="1" id="amount">
							</div>
							<div class="button" class="plus" onclick="amountControl('p')">
								<button>+</button>
							</div>
						</div>
						<div class="wrap-component clearfix">
							<div class="love-it empty">
								<a href="javascript:void(0)" data-goods="<?=$goods_code?>">
									<span class="blind">관심상품등록</span>
								</a>
							</div>
							<div class="buttons">
								<a href="javascript:void(0)" onclick="add_cart('<?=$goods_code?>','<?=$mb_flag?>');">
									<span>장바구니</span>
								</a>
								<a href="javascript:void(0)" onclick="go_order('<?=$goods_code?>');">
									<span>바로구매</span>
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
			$("#cboxTopLeft").hide();
			$("#cboxTopRight").hide();
			$("#cboxBottomLeft").hide();
			$("#cboxBottomRight").hide();
			$("#cboxMiddleLeft").hide();
			$("#cboxMiddleRight").hide();
			$("#cboxTopCenter").hide();
			$("#cboxBottomCenter").hide();
			
			$('.gnb').on('click', function() {
				$('#menu-layer').slideDown('slow');
				$app.hasClass('menu-opened') ? $app.removeClass('menu-opened') : $app.addClass('menu-opened');
			});
			$('#menu-layer .close-btn a').on('click', function() {
				$app.removeClass('menu-opened');
				$('#menu-layer').slideUp('slow');
			});

			$('.etc-block .toggle').on('click', function() {
				$(this).parent().toggleClass("active");
			});
<?
	if ($wish_flag == "Y")
	{
?>	
			$(".inner > .love-it > a").css("background","url(./images/loveit_fill.png) center center / cover no-repeat");
			$(".wrap-component > .love-it > a").css("background","url(./images/loveit_fill2.png) center center / cover no-repeat");
<?
	}
?>		
		});
		// 구매하기 누를 시 옵션 레이어
		var spread_tl;
		function optionToggle(el) {
			var data = $(el).data() || "";
			if($('.spread').hasClass('on')) {
				spread_tl.reverse();
				$('.spread').removeClass('on');
			}else{
				spread_tl = new TimelineMax();
				spread_tl.to($('.spread'), 0.1, {autoAlpha: 1});
				spread_tl.to($('.spread .wrapper'), 0.4, {bottom: 0});
				spread_tl.to($('.spread .bg'), 0.25, {autoAlpha: 1});
				$('.spread').addClass('on');
			}
		}
		// 옵션 레이어 내부 수량 컨트롤
		function amountControl(type) {
			var amount = $('#amount').val();
			if(type == 'p') {
				amount++;
			}else{
				amount--;
			}
			$('#amount').val(amount);
		}
	</script>
</body>
</html>
