<?
	include_once "./popup_div.php";	
?>
		<div id="footer">
			<div class="nav">
				<ul class="clearfix">
					<li>
						<a href="about_chon.php">
							<span>촌의감각</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>개인정보취급방침</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>이용약관</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="social">
				<a class="icon kt" href="#"></a><a class="icon insta" href="#"></a>
			</div>
			<div class="mall-info">
				<div>
					<p>상호 : 촌의 감각 (미니버타이징 주식회사)</p>
				</div>
				<div>
					<p>대표자(성명) : 양선혜</p>
				</div>
				<div>
					<p>개인정보관리책임자 : 김영훈 yh.kim@minivertising.kr</p>
				</div>
				<div>
					<p>사업자등록번호 : 114-87-11622 <a href="http://www.ftc.go.kr/info/bizinfo/communicationView.jsp?apv_perm_no=2016321015330201907&area1=&area2=&currpage=1&searchKey=04&searchVal=1148711622&stdate=&enddate=" target="_blank">[사업자 정보확인]</a></p>
				</div>
				<div>
					<p>통신판매업 : 제 2017-</p>
				</div>
				<div>
					<p>주소 : 서울특별시 서초구</p>
				</div>
				<div>
					<p>고객센터 : 02-532-2475</p>
				</div>
				<div>
					<p>Mon-Fri 10:30 ~ 17:30 / Off time : 12:00 ~ 14:00</p>
				</div>
				<div>
					<p>팩스 : 02-532-2493</p>
				</div>
				<div>
					<p>@chon Right Reserved.</p>
				</div>
			</div>
			<div class="go-top">
				<a href="#">
					<span>TOP</span>
				</a>
			</div>
			<div class="gnb-foot">
				<ul>
					<li class="home">
						<a href="index.php">
							<span>
								<img src="./images/gnb_home.png" alt="홈으로 가기">
							</span>
						</a>
					</li>
					<li class="search">
						<a href="javascript:void(0)">
							<span>
								<img src="./images/gnb_search.png" alt="검색">
							</span>
						</a>
					</li>
					<li class="mypage">
						<a href="mypage.php">
							<span>
								<img src="./images/gnb_mypage.png" alt="마이페이지">
							</span>
						</a>
					</li>
					<li class="mycart">
						<a href="cart.php">
							<span>
								<img src="./images/gnb_cart.png" alt="메뉴">
								<?
	$cart_info 	= select_cart_info();
	$cart_num	= count($cart_info);

	if ($cart_num > 0)
	{
?>									
								<div class="icon">
									<span><?=$cart_num?></span>
								</div>
<?
	}
?>								
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
