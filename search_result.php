<?
	include_once "./header.php";

	$keyword = $_REQUEST['keyword'];
	// $code_list = $_REQUEST["code_list"];
	// $code_list = array_map('strval', explode(',', $code_list));
	// $code_list = implode("','", $code_list);

?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="product-list search-result">
			<div class="pg-title">
				<h3>
					검색결과
				</h3>
			</div>
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
	// 상품 리스트
	$goods_query = "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_name LIKE '%".$keyword."%' OR m_goods_big_desc LIKE '%".$keyword."%'";
	$goods_result = mysqli_query($my_db, $goods_query);
	$goods_count = mysqli_num_rows($goods_result);
	if($goods_count > 0) {
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
									<span class="price">20,000</span>
									<span class="percent">50%</span>
<?
			}
?>
									<span class="saleP">10,000</span>
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
	}else{
?>
			<p class="empty">
				<span>검색 결과가 없습니다.</span>
			</p>
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
