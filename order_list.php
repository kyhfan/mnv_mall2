<?
	include_once "./header.php";

	$order_info = select_order_list_info();
	print_r($order_info);
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="order-list">
			<div class="pg-title">
				<h3>
					ORDER
				</h3>
			</div>
			<div class="orderList">
				<ul>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
					<li>
						<div class="inner clearfix">
							<div class="area order">
								<div class="sub">
									<span class="date">2017.07.16</span>
									<span class="num"><i>|</i>주문번호 1350256401</span>
								</div>
								<div class="main">
									<span class="name">소창행주 외 5건</span>
								</div>
								<a class="click-area" href="javascript:void(0)"></a>
							</div>
							<div class="area shipping">
								<span class="status">배송중</span>
								<a class="button" href="javascript:void(0)">
									<span>배송조회</span>
								</a>
							</div>
						</div>
					</li>
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
