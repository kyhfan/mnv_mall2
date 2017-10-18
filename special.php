<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="special-list">
			<div class="pg-title">
				<h3>
					SPECIAL
				</h3>
			</div>
			<div class="list-wrapper">
<?
	$special_query		= "SELECT * FROM ".$_gl['special_info_table']." WHERE 1 ORDER BY idx ASC";
	$special_result		= mysqli_query($my_db, $special_query);
	$i = 1;
	while ($special_data = mysqli_fetch_array($special_result))
	{
		$special_img 	= str_replace("../../../","./",$special_data['special_img_url']);
?>
				<div class="block">
					<a href="#">
						<div class="img">
							<img src="<?=$special_img?>">
						</div>
						<div class="txt">
							<div class="number">
								<span>
									VOL <?=$i?>
								</span>
							</div>
							<div class="title">
								<h4>
									<?=$special_data["special_name"]?>
								</h4>
							</div>
							<div class="desc">
								<p>
									<?=$special_data["special_desc"]?>
								</p>
							</div>
						</div>
					</a>
				</div>
<?
		$i++;
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
