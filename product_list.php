<?
	include_once "./header.php";

	$cate 	= $_REQUEST["cate"];

	$cate_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='$cate'";
	$cate_result		= mysqli_query($my_db, $cate_query);
	$cate_data 		= mysqli_fetch_array($cate_result);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-list">
			<div class="pg-title">
				<h3>
					<?=$cate_data["cate_name"]?>
				</h3>
			</div>
			<div class="sorting-area">
				<a href="javascript:void(0)" data-sort="best" class="current" >베스트</a>
				<a href="javascript:void(0)" data-sort="row">가격낮은순</a>
			</div>
			<div class="brand-banner">
<?
	// 베스트 배너
    $best_banner_query		= "SELECT * FROM ".$_gl['banner_info_table']." WHERE banner_type = 'category_best_banner' AND device_type='$cate' ORDER BY banner_show_order ASC";
    $best_banner_result		= mysqli_query($my_db, $best_banner_query);
    while ($best_banner_data = mysqli_fetch_array($best_banner_result))
    {
		$best_banner_img 	= str_replace("../../../","./",$best_banner_data['banner_img_url']);
?>
				<div class="block">
					<a href="<?=$best_banner_data["banner_img_link"]?>" target="<?=$best_banner_data["banner_link_target"]?>">
						<img src="<?=$best_banner_img?>">
					</a>
				</div>
<?
	}
?>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	// 상품 리스트
    $goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE cate_1 = '$cate' ORDER BY discount_price ASC";
	$goods_result		= mysqli_query($my_db, $goods_query);
	$goods_count 		= mysqli_num_rows($goods_result);
    while ($goods_data = mysqli_fetch_array($goods_result))
    {
		$goods_thumb_img 	= str_replace("../../../","./",$goods_data['goods_thumb_img_url']);
		// 할인율 계산
		$percent 			= ($goods_data['sales_price'] - $goods_data['discount_price']) / $goods_data['sales_price'] * 100;
?>
					<li class="col">
						<figure class="pr-item">
							<a href="product_detail.php?goodscode=<?=$goods_data['goods_code']?>">
								<img src="<?=$goods_thumb_img?>">
								<figcaption>
									<span class="name"><?=$goods_data["goods_name"]?></span>
<?
	// 판매가와 할인가가 동일할 경우 판매가 숨기기
	if ($goods_data["sales_price"] != $goods_data["discount_price"])
	{
?>
									<span class="price"><?=number_format($goods_data["sales_price"])?></span>
									<span class="percent"><?=ceil($percent)?>%</span>
<?
	}
?>
									<span class="saleP"><?=number_format($goods_data["discount_price"])?></span>
								</figcaption>
							</a>
						</figure>
					</li>
<?
    }
?>
				</ul>
			</div>
<?
	if ($goods_count > 6)
	{
?>
			<div class="more-btn">
				<a href="javascript:void(0)">
					<span>더 보기</span>
				</a>
			</div>
<?
	}
?>
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
