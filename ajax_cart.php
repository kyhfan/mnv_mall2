<?
	include_once "./config.php";    

    $cart_idx		= $_REQUEST['cart_idx'];
    $goods_cnt		= $_REQUEST['goods_cnt'];
    $mb_email		= $_SESSION['ss_chon_email'];

    $cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt='".$goods_cnt."' WHERE idx='".$cart_idx."' AND mb_email='".$mb_email."'";
    $cart_result 		= mysqli_query($my_db, $cart_query);
    
	$cart_info 	= select_cart_info();
	$cart_num	= count($cart_info);
?>
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_all" id="chk_all">
								</div>
								<span>전체선택 (<span id="chk_goods">0</span>/<?=$cart_num?>)</span>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_chk_cart()">
									<span>선택삭제</span>
								</a>
							</div>
						</div>
					</div>
<?
	$total_cnt 				= 0;
	$total_goods_price		= 0;
	$total_save_price		= 0;
	$total_delivery_price	= 0;
	foreach ($cart_info as $key => $val)
	{
		$goods_info 			= select_goods_info($val["goods_code"]);
		$cart_price				= $goods_info["discount_price"] * $val["goods_cnt"];
		$goods_thumb_img 		= str_replace("../../../","./",$goods_info['goods_thumb_img_url']);
		$total_cnt				+= $val["goods_cnt"];
		$total_goods_price		+= $cart_price;
		$total_save_price		+= $cart_price * $_gl['save_percent'];
?>					
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_this" id="chk_<?=$val['idx']?>">
								</div>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_cart('<?=$val['idx']?>')">
									<span>삭제</span>
								</a>
							</div>
						</div>
						<div class="product-info clearfix">
							<div class="info">
								<div class="row">
									<span class="name">
										<?=$goods_info["goods_name"]?>
									</span>
									<!-- <span class="option">
										(9옵션 중 택 1)
									</span> -->
								</div>
								<div class="row">
									<span class="amount">수량 :</span>
									<input type="tel" id="cart_num_<?=$val['idx']?>" value="<?=$val["goods_cnt"]?>" onblur="change_cart('<?=$val['idx']?>');">
									<span class="price"><?=number_format($cart_price)?></span>
								</div>
							</div>
							<div class="thum">
								<img src="<?=$goods_thumb_img?>" width="115">
								<!-- <img src="./images/ordered_01.png"> -->
							</div>
						</div>
					</div>
<?
	}

	if ($total_goods_price < $_gl['delivery_max_price'])
		$total_delivery_price = $_gl['delivery_price']; 

	$total_price			= $total_goods_price + $total_delivery_price;
		
?>					
					<div class="block total">
						<span>50,000원 이상 구매 시 배송비 무료</span>
						<div class="row clearfix">
							<span>주문 상품 수</span>
							<span><?=$total_cnt?></span>
						</div>
						<div class="row clearfix">
							<span>총 상품금액</span>
							<span><?=number_format($total_goods_price)?></span>
						</div>
						<div class="row clearfix">
							<span>적립금</span>
							<span><?=number_format($total_save_price)?></span>
						</div>
						<div class="row clearfix">
							<span>총 배송비</span>
							<span><?=number_format($total_delivery_price)?></span>
						</div>
						<div class="row clearfix">
							<span>총 결제 금액</span>
							<span><?=number_format($total_price)?></span>
						</div>
					</div>
					<div class="finish-btn">
						<a href="order.php?t=cart">
							<span>구매하기</span>
						</a>
					</div>