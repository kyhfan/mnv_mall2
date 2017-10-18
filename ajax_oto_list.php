<?
	include_once "./config.php";    

    $sort_val   = $_REQUEST["sort_val"];

    if ($sort_val == "")
        $sort_query     = "";
    else
        $sort_query     = " AND oto_question_type='$sort_val'";
    
    $oto_query		= "SELECT * FROM ".$_gl['board_oto_table']." WHERE oto_email='".$_SESSION['ss_chon_email']."' AND oto_showYN='Y'".$sort_query;
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
