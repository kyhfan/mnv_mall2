<?
	include_once "./header.php";

	// 회원정보 불러오기
	$member_info 	= select_member_info();
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="oto-list point">
			<div class="content">
				<div class="pg-title">
					<h3>POINT</h3>
				</div>
				<div class="point-block">
					<div class="bg">
						<div class="inner">
							<div class="txt">
								<p>
									<span><?=$_SESSION['ss_chon_name']?></span>님의 사용가능 포인트
								</p>
							</div>
							<div class="current">
								<span><?=$member_info["mb_point"]?></span>P
							</div>
						</div>
					</div>
					<div class="guide">
						<span>* 3만원 이상 구매 시 현금처럼 사용하실 수 있습니다.</span>
						<span>* 포인트는 부여된 해로부터 5년 이내 사용가능합니다.</span>
						<span>* 상품 구매 포인트는 상품 출고 후 적립 및 사용이 가능합니다.</span>
					</div>
				</div>
				<div class="board-list">
					<table>
						<thead>
							<tr>
								<th>날짜</th>
								<th>내용</th>
								<th>적립/사용</th>
							</tr>
						</thead>
						<tbody>
<?
	$point_query		= "SELECT * FROM ".$_gl['point_info_table']." WHERE point_email='".$_SESSION['ss_chon_email']."' ORDER BY idx DESC";
	$point_result		= mysqli_query($my_db, $point_query);

	while ($point_data = mysqli_fetch_array($point_result))
	{
		$date_arr 		= explode("-",$point_data["point_regdate"]);
		$pointdate		= substr($date_arr, 2, 8);
?>							
							<tr>
								<td><?=$pointdate?></td>
								<td>
									<?=$_gl['point'][$point_data["point_text"]]?>
								</td>
								<td><?=$point_data["point_value"]?> P</td>
							</tr>
<?
	}
?>							
						</tbody>
					</table>
				</div>
				<div class="action-group clearfix">
					<div class="pagination">
						<div class="wrapper">
							<a href="javascript:void(0)">
								<span>
									1
								</span>
							</a>
							<a href="javascript:void(0)">
								<span>
									2
								</span>
							</a>
							<a href="javascript:void(0)">
								<span>
									3
								</span>
							</a>
							<a href="javascript:void(0)">
								<span>
									4
								</span>
							</a>
							<a href="javascript:void(0)">
								<span>
									5
								</span>
							</a>
							<a href="javascript:void(0)">
								<span>
									>
								</span>
							</a>
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
			// swiper initialize
			var chonSwiper = new Swiper ('.swiper-container', {
				// Optional parameters
				direction: 'horizontal',
				effect: 'fade',
				speed: 2000,
				loop: true,
				autoplay: 4000,
				autoplayDisableOnInteraction: false,
				pagination: '.swiper-pagination',
				paginationClickable: true,
				paginationBulletRender: function(swiper, index, className) {
					return '<span class="' + className +'">' + '</span>';
				}
				// If we need pagination
				// pagination: '.swiper-pagination'
			});

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
