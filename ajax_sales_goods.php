<?
	include_once "./config.php";    

    $sales_pg           = $_REQUEST["sales_pg"];
    $total_goods_num    = $_REQUEST["total_goods_num"];
    $total_page         = $_REQUEST["total_page"];
?>    
			<div class="grid">
				<ul class="list-row n2 clearfix">
<?
    $view_pg            = 10;
    $query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE discount_price < sales_price LIMIT ".$sales_pg.", $view_pg";
	$result		= mysqli_query($my_db, $query);
	while ($val = @mysqli_fetch_array($result))
	{
		$sale_goods_thumb_img 	= str_replace("../../../","./",$val['goods_thumb_img_url']);
		// 할인율 계산
		$discount_percent 			= ($val['sales_price'] - $val['discount_price']) / $val['sales_price'] * 100;
?>					
					<li class="col">
						<figure class="pr-item">
							<a href="product_detail.php?goodscode=<?=$val['goods_code']?>">
								<img src="<?=$sale_goods_thumb_img?>">
								<figcaption>
									<span class="name"><?=$val["goods_name"]?></span>
									<span class="price"><?=number_format($val["sales_price"])?></span>
									<span class="percent"><?=ceil($discount_percent)?>%</span>
									<span class="saleP"><?=number_format($val["discount_price"])?></span>
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
    $sales_pg = $sales_pg + 1;
    if ($total_page > $sales_pg)
	{
?>
			<div class="more-btn">
				<a href="javascript:void(0)" onclick="more_sales_goods('<?=$total_goods_num?>','<?=$total_page?>')">
					<span>더 보기</span>
				</a>
			</div>
<?
	}
?>			
