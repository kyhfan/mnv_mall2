<?
	include_once "./header.php";

	$order_type		= $_REQUEST["t"];

	if ($order_type == "cart")
	{
		$order_info 		= select_cart_info();
		$buycnt				= count($order_info);
	}else{
		$buycnt				= $_REQUEST["buycnt"];
		$goodscode			= $_REQUEST["goodscode"];
		$order_info 		= select_order_goods_info($goodscode);
		$total_order_price	= $order_info[0]["discount_price"] * $buycnt;
	}

	if ($total_order_price < 50000)
		$total_order_price = $total_order_price + 2500;

	$member_info 	= select_member_info();
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order">
			<div class="content">
				<div class="pg-title">
					<h3>주문결제</h3>
				</div>
				<div class="wrapper">
					<div class="inner">
						<div class="wrap-blocks">
							<div class="block o-list">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												주문 리스트 <span>( 총 <?=$buycnt?>개 / <?=$total_order_price?> )</span>
											</h5>
										</div>
									</div>
									<div class="body">
<?
	foreach($order_info as $key => $val)
	{
		$goods_thumb_img 	= str_replace("../../../","./",$val['goods_thumb_img_url']);
		
?>										
										<div class="wrap-group">
											<div class="row clearfix">
												<div class="col">
													<img src="<?=$goods_thumb_img?>">
												</div>
												<div class="col">
													<div class="name">
														<span><?=$val["goods_name"]?></span>
													</div>
													<div class="num">
														<span>
															주문번호<em>|</em>1350256401
														</span>
													</div>
													<div class="price">
														<span class="nft"><?=$total_order_price?></span>
													</div>
												</div>
											</div>
										</div>
<?
	}
?>										
									</div>
								</div>
							</div>
							<div class="block o-info">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												주문고객 정보
											</h5>
										</div>
									</div>
									<div class="body">
										<div class="wrap-group already">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>주문자</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="text" name="" value="<?=$member_info["mb_name"]?>" readonly>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>이메일</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="text" name="" value="<?=$member_info["mb_email"]?>" readonly>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>휴대전화</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="tel" name="" value="<?=$member_info["mb_phone"]?>" readonly>
													</div>
												</div>
											</div>
										</div>
										<!-- <div class="wrap-group addr">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>주소</span>
													</div>
												</div>
												<div class="col">
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text" readonly>
															</div>
															<a href="javascript:void(0)">
																<span>우편번호</span>
															</a>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
							<div class="block">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												배송지 정보
											</h5>
										</div>
									</div>
									<div class="body">
										<div class="wrap-group radio-group">
											<div class="row clearfix">
												<div class="col">
													<div class="radiobox">
														<input type="radio" class="radio" id="s_info" name="chk_info">
														<label for="s_info">최근배송지</label>
													</div>
												</div>
												<div class="col">
													<div class="radiobox">
														<input type="radio" class="radio" id="n_info" name="chk_info" checked>
														<label for="n_info">신규배송지</label>
													</div>
												</div>
											</div>
										</div>
										<div class="wrap-group">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>이름</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="text" id="order_name">
													</div>
												</div>
											</div>
										</div>
										<div class="wrap-group addr">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>주소</span>
													</div>
												</div>
												<div class="col">
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="tel" id="order_zipcode" readonly>
															</div>
															<a href="javascript:void(0)">
																<span>우편번호</span>
															</a>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text" id="order_addr1" readonly>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text" id="order_addr2">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="wrap-group">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>휴대전화</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="tel" id="order_phone">
													</div>
												</div>
											</div>
										</div>
										<div class="wrap-group msg">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>배송메세지</span>
													</div>
												</div>
												<div class="col">
													<div class="textbox">
														<textarea name="name" id="order_message"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="block discount">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												할인 정보
											</h5>
										</div>
									</div>
									<div class="body">
										<div class="wrap-group">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>쿠폰</span>
													</div>
												</div>
												<div class="col">
													<div class="input select">
														<select name="" id="">
															<option value="">선택하세요</option>
														</select>
													</div>
													<span class="guide">* 상품쿠폰은 중복사용이 불가능 합니다.</span>
												</div>
											</div>
										</div>
										<div class="wrap-group">
											<div class="row clearfix">
												<div class="col">
													<div class="guide">
														<span>적립금</span>
													</div>
												</div>
												<div class="col">
													<div class="input">
														<input type="tel">
													</div>
													<span class="point">원 (보유 : 0원)</span>
													<span class="guide">* 적립금은 상품금액 3만원 이상 결제시 사용 가능합니다.</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="block total">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												최종 결제금액
											</h5>
										</div>
									</div>
									<div class="body">
										<div class="wrap-group">
											<ul>
												<li class="row clearfix">
													<div class="col guide">
														<span>상품금액</span>
													</div>
													<div class="col info">
														<span><em class="nft">79,010</em>원</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>상품합계</span>
													</div>
													<div class="col info">
														<span><em class="nft">80,000</em>원</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>배송비합계</span>
													</div>
													<div class="col info">
														<span><em class="nft">0</em>원</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>할인금액</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">-990</em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>상품/주문할인</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">-990</em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>배송비할인</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">0</em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>환불정산액/포인트 결제액</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">0</em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>포인트</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">0</em>원
														</span>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="block pay">
								<div class="inner">
									<div class="head">
										<div class="title">
											<h5>
												결제 수단
											</h5>
										</div>
									</div>
									<div class="body">
										<div class="wrap-group">
											<div class="buttons">
												<!-- 선택시 addClass active -->
												<a href="javascript:void(0)" class="active">
													<span>신용카드</span>
												</a>
												<a href="javascript:void(0)">
													<span>휴대폰</span>
												</a>
											</div>
										</div>
										<div class="wrap-group">
											<div class="check">
												<div class="checkbox">
													<input type="checkbox" name="chk1">
												</div>
												<span>위 주문의 상품, 가격, 할인, 배송정보에 동의합니다.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="finish-btn">
								<a href="javascript:void(0)">
									<span>결제하기</span>
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
