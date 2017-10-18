<?
	include_once "./header.php";

	if (!$_SESSION['ss_chon_email'])
		echo "<script>location.href='index.php';</script>";

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
					<select name="q-cate" class="q-cate" onchange="oto_sort(this.value)">
						<option value="">모두보기</option>
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
						<tbody id="sort_oto_list">
<?
    $oto_query		= "SELECT * FROM ".$_gl['board_oto_table']." WHERE oto_email='".$_SESSION['ss_chon_email']."' AND oto_showYN='Y'";
    $oto_result		= mysqli_query($my_db, $oto_query);
    while ($oto_data = mysqli_fetch_array($oto_result))
    {
		$oto_date	= substr($oto_data["oto_regdate"],2,8);

		$oto_query2			= "SELECT * FROM ".$_gl['board_oto_table']." WHERE group_id='".$oto_data['idx']."'";
		$oto_result2		= mysqli_query($my_db, $oto_query2);
		$oto_count			= mysqli_num_rows($oto_result2);

		if ($oto_count > 0)
			$status_txt	= "답변완료";
		else
			$status_txt	= "대기중";
?>
							<tr>
								<td><?=$status_txt?></td>
								<td>
									<a href="oto_read.php?idx=<?=$oto_data["idx"]?>"><?=$oto_data["oto_title"]?>
								</td>
								<td><?=$oto_date?></td>
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
					<div class="button">
						<a href="oto_write.php">
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
