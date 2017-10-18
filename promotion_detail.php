<?
	include_once "./header.php";

	$idx	= $_REQUEST["idx"];
	// 해당 idx 의 프로모션 정보 불러오기
	$promotion_info 	= select_promotion_info($idx);

	// 이미지 경로 변경
	$promotion_img2 	= str_replace("../../../","./",$promotion_info['promotion_img_url2']);
	$promotion_img3 	= str_replace("../../../","./",$promotion_info['promotion_img_url3']);

	// 날짜 형식에 맞춰 배열화
	$start_date_arr		= explode("-",$promotion_info["promotion_startdate"]);
	$end_date_arr		= explode("-",$promotion_info["promotion_enddate"]);

	// 연관상품 배열화
	$promotion_goods_arr	= explode(";",$promotion_info["promotion_goods"]);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="promotion-detail">
			<div class="content">
				<div class="main-img">
					<img src="<?=$promotion_img2?>">
				</div>
				<div class="title-block">
					<h4>
						<?=$promotion_info["promotion_name"]?>
					</h4>
					<span><?=$start_date_arr[0]?> | <?=$start_date_arr[1]?> | <?=$start_date_arr[2]?> ~ <?=$end_date_arr[0]?> | <?=$end_date_arr[1]?> | <?=$end_date_arr[2]?></span>
				</div>
				<div class="intro-block">
					<img src="<?=$promotion_img3?>">
				</div>
				<div class="pr-list">
					<div class="title">
						<h3>
							SALE ITEM
						</h3>
					</div>
					<div class="grid">
						<ul class="list-row n2 clearfix">
<?
    foreach($promotion_goods_arr as $key => $val)
    {
		$goods_info 		= select_goods_info($val);
		$goods_thumb_img 	= str_replace("../../../","./",$goods_info['goods_thumb_img_url']);
		// 할인율 계산
		$discount_percent 			= ($goods_info['sales_price'] - $goods_info['discount_price']) / $goods_info['sales_price'] * 100;
?>
							<li class="col">
								<figure class="pr-item">
									<a href="product_detail.php?goodscode=<?=$goods_info['goods_code']?>">
										<img src="<?=$goods_thumb_img?>">
										<figcaption>
											<span class="name"><?=$goods_info["goods_name"]?></span>
											<span class="price"><?=number_format($goods_info["sales_price"])?></span>
											<span class="percent"><?=ceil($discount_percent)?>%</span>
											<span class="saleP"><?=number_format($goods_info["discount_price"])?></span>
										</figcaption>
									</a>
								</figure>
							</li>
<?
    }
?>
						</ul>
					</div>
				</div>
				<div class="share-block">
					<a href="javascript:void(0)" class="kt">
						<span class="blind">카카오톡으로 공유하기</span>
					</a>
					<a href="javascript:void(0)" class="fb">
						<span class="blind">페이스북으로 공유하기</span>
					</a>
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
	</script>
</body>
</html>
