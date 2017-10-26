<?
	include_once "./config.php";    

    $wish_idx		= $_REQUEST['wish_idx'];
    $goods_cnt		= $_REQUEST['goods_cnt'];
    $mb_email		= $_SESSION['ss_chon_email'];

    $wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET goods_cnt='".$goods_cnt."' WHERE idx='".$wish_idx."' AND mb_id='".$mb_email."'";
    $wish_result 		= mysqli_query($my_db, $wish_query);
    
	$wish_info 	= select_wish_info();
	$wish_num	= count($wish_info);
?>
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_all" id="chk_all">
								</div>
								<span>전체선택 (<span id="chk_goods">0</span>/<?=$wish_num?>)</span>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_chk_wish()">
									<span>선택삭제</span>
								</a>
							</div>
						</div>
					</div>
<?
	foreach ($wish_info as $key => $val)
	{
		$goods_info 			= select_goods_info($val["goods_code"]);
		$cart_price				= $goods_info["discount_price"] * $val["goods_cnt"];
		$goods_thumb_img 		= str_replace("../../../","./",$goods_info['goods_thumb_img_url']);
?>					
					<div class="block">
						<div class="wrap-control clearfix">
							<div class="check">
								<div class="checkbox">
									<input type="checkbox" name="chk_this" id="chk_<?=$val['idx']?>">
								</div>
							</div>
							<div class="delete">
								<a href="javascript:void(0)" onclick="del_wish('<?=$val['idx']?>')">
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
									<input type="tel" id="wish_num_<?=$val['idx']?>" value="<?=$val["goods_cnt"]?>" onblur="change_wish('<?=$val['idx']?>');">
									<span class="price"><?=number_format($wish_price)?></span>
								</div>
							</div>
							<div class="thum">
								<img src="<?=$goods_thumb_img?>" width="115">
							</div>
						</div>
					</div>
<?
	}
?>