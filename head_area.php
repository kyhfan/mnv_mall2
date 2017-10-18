		<div id="header">
			<div class="bg"></div>
			<div class="wrapper">
				<h1 class="logo">
					<a href="./index.php">
						<img src="./images/logo.png" alt="촌의 감각">
					</a>
				</h1>
				<div class="gnb">
					<div class="closed wrapper">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</div>
				</div>
			</div>
		</div>
		<div id="menu-layer">
			<div class="menu-inner">
				<div class="close-btn">
					<a href="#">

					</a>
				</div>
				<div class="top-block">
					<div class="wrapper">
<?
	if (!$_SESSION['ss_chon_email'])
	{
?>						
						<a href="member_login.php?ref_url=<?=$_SERVER['REQUEST_URI']?>">
							<span>LOG IN</span>
						</a>
						<a href="javascript:void(0)">
							<span>JOIN</span>
						</a>
<?
	}else{
?>		
						<a href="logout.php">
							<span>LOG OUT</span>
						</a>
<?
	}
?>					
					</div>
				</div>
				<div class="bot-block">
					<div class="wrapper">
						<div class="child">
							<div class="list cate">
								<ul>
<?
    $query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_mobileYN='Y'";
    $result		= mysqli_query($my_db, $query);

    while ($data = mysqli_fetch_array($result))
    {
?>                                
									<li>
										<a href="product_list.php?cate=<?=$data["cate_1"]?>">
											<span><?=$data['cate_name']?></span>
										</a>
									</li>
<?
    }
?>
								</ul>
							</div>
							<div class="list theme">
								<ul>
									<li>
										<a href="special.php">
											<span>SPECIAL</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span>BEST ITEM</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span>SALE</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="banner-block">
						<a href="#">
							<img src="./images/menu_banner.png">
						</a>
					</div>
				</div>
			</div>
		</div>
