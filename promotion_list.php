<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="promotion-list">
			<div class="pg-title">
				<h3>
					PROMOTION
				</h3>
			</div>
			<div class="list-wrapper">
<?
	$promotion_query		= "SELECT * FROM ".$_gl['promotion_info_table']." WHERE 1 AND promotion_showYN='Y' ORDER BY idx DESC";
	$promotion_result		= mysqli_query($my_db, $promotion_query);

	while ($promotion_data = mysqli_fetch_array($promotion_result))
	{
		$promotion_img1 	= str_replace("../../../","./",$promotion_data['promotion_img_url1']);
		$start_date_arr		= explode("-",$promotion_data["promotion_startdate"]);
		$end_date_arr		= explode("-",$promotion_data["promotion_enddate"]);
?>
				<div class="block">
					<a href="promotion_detail.php?idx=<?=$promotion_data['idx']?>">
						<div class="img">
							<img src="<?=$promotion_img1?>">
						</div>
						<div class="desc clearfix">
							<div class="category">
								<span><?=$promotion_data["promotion_category"]?></span>
							</div>
							<div class="txt">
								<div class="title">
									<h5>
										<?=$promotion_data["promotion_name"]?>
									</h5>
								</div>
								<div class="date">
									<span><?=$start_date_arr[0]?> | <?=$start_date_arr[1]?> | <?=$start_date_arr[2]?> - <?=$end_date_arr[0]?> | <?=$end_date_arr[1]?> | <?=$end_date_arr[2]?></span>
								</div>
							</div>
							<div class="btn-more"></div>
						</div>
					</a>
				</div>
<?
	}
?>
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
