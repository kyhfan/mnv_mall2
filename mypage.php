<?
	include_once "./header.php";

	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='member_login.php?ref_url=mypage.php';</script>";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="mypage">
			<div class="pg-title">
				<h3>
					MY PAGE
				</h3>
			</div>
			<div class="order-status">
				<div class="title">
					<p>
						나의 주문 처리 현황 (최근 3개월 기준)
					</p>
				</div>
				<div class="stat-list">
					<ul class="clearfix">
						<li>
							<div class="txt">
								<span>주문 내역</span>
							</div>
							<div class="count">
								<span>0</span>
							</div>
						</li>
						<li>
							<div class="txt">
								<span>배송준비중</span>
							</div>
							<div class="count">
								<span>0</span>
							</div>
						</li>
						<li>
							<div class="txt">
								<span>배송중</span>
							</div>
							<div class="count">
								<span>0</span>
							</div>
						</li>
						<li>
							<div class="txt">
								<span>배송완료</span>
							</div>
							<div class="count">
								<span>0</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="list-hub">
				<ul>
					<li>
						<a href="order_list.php">
							<span>주문/배송조회</span>
						</a>
					</li>
					<li>
						<a href="cart.php">
							<span>장바구니</span>
						</a>
					</li>
					<li>
						<a href="wish.php">
							<span>관심상품</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<span>쿠폰</span>
						</a>
					</li>
					<li>
						<a href="mypoint.php">
							<span>적립금</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<span>반품/환불</span>
						</a>
					</li>
					<li>
						<a href="oto_list.php">
							<span>1대1 문의</span>
						</a>
					</li>
<?
	if ($_SESSION['ss_chon_way'] == "chon")
	{
?>
					<li>
						<a href="member_modify.php">
							<span>회원정보 수정</span>
						</a>
					</li>
<?
	}
?>
				</ul>
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
