<?
	include_once "./header.php";
?>
<body>
	<div id="chon-app">
<?
	include_once "./head_area.php";
?>
		<div id="container" class="magazine-detail">
			<div class="content">
				<div class="main-img">
					<img src="./images/promotion_main.jpg">
				</div>
				<div class="title-block">
					<h4>
						지금 필요한 그릇
					</h4>
					<span>2017 | 09 | 11 ~ 2017 | 09 | 30</span>
				</div>
				<div class="intro-block">
					<img src="./images/promotion_detail_intro.jpg">
				</div>
				<div class="pr-list">
					<!-- <div class="title">
						<h3>
							SALE ITEM
						</h3>
					</div> -->
					<div class="grid">
						<ul class="list-row n2 clearfix">
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_01.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_02.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_03.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_04.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_01.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
							<li class="col">
								<figure class="pr-item">
									<a href="#">
										<img src="./images/product_list_img_02.jpg">
										<figcaption>
											<span class="name">고즈넉한 밤이야기</span>
											<span class="price">20,000</span>
											<span class="percent">50%</span>
											<span class="saleP">10,000</span>
										</figcaption>
									</a>
								</figure>
							</li>
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
