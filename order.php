<?
	include_once "./header.php";

	$error_level = error_reporting();
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	// dompdf code
	error_reporting($error_level);

	$order_type				= $_REQUEST["t"];
	$total_delivery_price	= 0;
	if ($order_type == "cart")
	{
		$order_info 		= select_order_cart_info();
		$total_buycnt		= $order_info[0]["total_order_cnt"];
		// $buycnt			= count($order_info);
		$total_order_price	= $order_info[0]["total_order_price"];
	}else{
		$buycnt				= $_REQUEST["buycnt"];
		$total_buycnt		= $_REQUEST["buycnt"];
		$goodscode			= $_REQUEST["goodscode"];
		$order_info 		= select_order_goods_info($goodscode);
		$total_order_price	= $order_info[0]["discount_price"] * $buycnt;
		$goods_order_price	= $total_order_price;
		
	}

	$total_payment_price 		= $total_order_price;
	if ($total_order_price < 50000)
	{
		$total_payment_price 		= $total_order_price + 2500;
		$total_delivery_price 	= $_gl['delivery_price']; 
	}
	$total_save_price		+= $total_order_price * $_gl['save_percent'];
	$total_coupon_price		= 0;
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
												주문 리스트 <span>( 총 <?=$total_buycnt?>개 / <?=number_format($total_order_price)?> )</span>
											</h5>
										</div>
									</div>
									<div class="body">
<?
	$order_goods	= "";
	foreach($order_info as $key => $val)
	{
		$goods_thumb_img 	= str_replace("../../../","./",$val['goods_thumb_img_url']);
		if ($order_type = "cart")
		{
			$buycnt				= $val["goods_cnt"];
			$goods_order_price	= $val["discount_price"] * $buycnt;
		}			
		$order_goods	.= ",".$val["goods_code"]."||".$buycnt;
		$show_goods_name	= $val['goods_name']." 외 ".$total_buycnt."건";
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
															수량 : <?=$buycnt?>개
														</span>
													</div>
													<div class="price">
														<span class="nft"><?=number_format($goods_order_price)?></span>
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
														<input type="text" name="" id="order_name" value="<?=$member_info["mb_name"]?>">
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
														<input type="text" name="" id="order_email" value="<?=$member_info["mb_email"]?>">
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
														<input type="tel" name="" id="order_phone" value="<?=$member_info["mb_phone"]?>" readonly>
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
																<input type="tel" readonly>
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
														<input type="text" id="delivery_name">
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
																<input type="tel" id="delivery_zipcode" readonly>
															</div>
															<a href="javascript:void(0)" onclick="sample2_execDaumPostcode();">
																<span>우편번호</span>
															</a>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text" id="delivery_addr1">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<div class="input">
																<input type="text" id="delivery_addr2">
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
														<input type="tel" id="delivery_phone">
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
														<textarea name="name" id="delivery_message"></textarea>
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
														<input type="tel" value="0">
													</div>
													<span class="point">Point (보유 : 0P)</span>
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
														<span><em class="nft"><?=number_format($total_order_price)?></em>원</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>배송비</span>
													</div>
													<div class="col info">
														<span><em class="nft"><?=number_format($total_delivery_price)?></em>원</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>쿠폰</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft">0</em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>적립금</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft"><?=number_format($total_save_price)?></em>원
														</span>
													</div>
												</li>
												<li class="row clearfix">
													<div class="col guide">
														<span>총결제금액</span>
													</div>
													<div class="col info">
														<span>
															<em class="nft"><?=number_format($total_payment_price)?></em>원
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
											<div class="buttons" id="pay_type">
												<!-- 선택시 addClass active -->
												<a href="javascript:void(0)" class="active" data-value="card_pay">
													<span>신용카드</span>
												</a>
												<a href="javascript:void(0)" data-value="phone_pay">
													<span>휴대폰</span>
												</a>
												<a href="javascript:void(0)" data-value="account_pay">
													<span>무통장입금</span>
												</a>
											</div>
										</div>
										<div class="wrap-group">
											<div class="check">
												<div class="checkbox">
													<input type="checkbox" name="chk1" id="order_chk">
												</div>
												<span>위 주문의 상품, 가격, 할인, 배송정보에 동의합니다.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="finish-btn">
								<input type="hidden" id="order_goods" value="<?=$order_goods?>">
								<input type="hidden" id="total_order_price" value="<?=$total_order_price?>">
								<input type="hidden" id="total_delivery_price" value="<?=$total_delivery_price?>">
								<input type="hidden" id="total_save_price" value="<?=$total_save_price?>">
								<input type="hidden" id="total_payment_price" value="<?=$total_payment_price?>">
								<input type="hidden" id="total_coupon_price" value="<?=$total_coupon_price?>">
								<input type="hidden" id="show_goods_name" value="<?=$show_goods_name?>">
								<a href="javascript:void(0)" id="order_start">
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
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:9999;-webkit-overflow-scrolling:touch;">
	<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="width:7%;cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>

	</div>
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
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
		});

		// 우편번호 찾기 화면을 넣을 element
		var element_layer = document.getElementById('layer');

		function closeDaumPostcode() {
			// iframe을 넣은 element를 안보이게 한다.
			element_layer.style.display = 'none';
		}

		function sample2_execDaumPostcode() {
			new daum.Postcode({
				oncomplete: function(data) {
					// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

					// 각 주소의 노출 규칙에 따라 주소를 조합한다.
					// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
					var fullAddr = data.address; // 최종 주소 변수
					var extraAddr = ''; // 조합형 주소 변수

					// 기본 주소가 도로명 타입일때 조합한다.
					if(data.addressType === 'R'){
						//법정동명이 있을 경우 추가한다.
						if(data.bname !== ''){
							extraAddr += data.bname;
						}
						// 건물명이 있을 경우 추가한다.
						if(data.buildingName !== ''){
							extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
						}
						// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
						fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
					}

					zipcode	= data.zonecode;
					addr1		= fullAddr;
					document.getElementById('delivery_zipcode').value = zipcode; //5자리 새우편번호 사용
					document.getElementById('delivery_addr1').value = addr1;

					// iframe을 넣은 element를 안보이게 한다.
					// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
					element_layer.style.display = 'none';
				},
				width : '100%',
				height : '100%'
			}).embed(element_layer);

			// iframe을 넣은 element를 보이게 한다.
			element_layer.style.display = 'block';

			// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
			initLayerPosition();
		}

		// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
		// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
		// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
		function initLayerPosition(){
			// var width = 300; //우편번호서비스가 들어갈 element의 width
			var width = $(window).width()*0.94; //우편번호서비스가 들어갈 element의 width
			var height = 360; //우편번호서비스가 들어갈 element의 height
			var borderWidth = 5; //샘플에서 사용하는 border의 두께

			// 위에서 선언한 값들을 실제 element에 넣는다.
			element_layer.style.width = width + 'px';
			element_layer.style.height = height + 'px';
			element_layer.style.border = borderWidth + 'px solid';
			// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
			element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2) + 'px';
			element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
		}
			
	</script>
</body>
</html>
