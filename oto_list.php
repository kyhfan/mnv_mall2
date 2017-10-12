<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="oto-list">
			<div class="content">
				<div class="pg-title">
					<h3>1:1 문의</h3>
				</div>
				<div class="sorting">
					<select name="q-cate" class="q-cate">
						<option value="all">모두보기</option>
						<option value="product">상품문의</option>
						<option value="pay">결제문의</option>
						<option value="cancel">주문취소 신청</option>
						<option value="saveNcoupon">적립금/쿠폰문의</option>
						<option value="shipping">배송문의</option>
						<option value="site">사이트이용</option>
						<option value="other">기타</option>
					</select>
				</div>
				<div class="board-list">
					<table>
						<thead>
							<tr>
								<th>답변</th>
								<th>제목</th>
								<th>날짜</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>대기중</td>
								<td>
									배송문의드립니다.
								</td>
								<td>17-09-25</td>
							</tr>
							<tr>
								<td>답변완료</td>
								<td>
									결제관련 문의
								</td>
								<td>17-09-28</td>
							</tr>
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
					<div class="button">
						<a href="javascript:void(0)">
							<span>글쓰기</span>
						</a>
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
			$('.gnb').on('click', function() {
				$('#menu-layer').slideDown('normal');
				$app.hasClass('menu-opened') ? $app.removeClass('menu-opened') : $app.addClass('menu-opened');
			});
			$('#menu-layer .close-btn a').on('click', function() {
				$app.removeClass('menu-opened');
				$('#menu-layer').slideUp('normal');
			});
		});


	</script>
</body>
</html>
