<?

	$search_query = "SELECT showYN, salesYN, goods_code, goods_name, m_goods_big_desc FROM ".$_gl['goods_info_table']."";
	$search_result = mysqli_query($my_db, $search_query);
	$keyword_storage = array();


	while ($row = mysqli_fetch_array($search_result)) {
		array_push($keyword_storage, array('goods_code' => $row['goods_code'],
											'goods_name' => $row['goods_name'],
											'goods_desc' => $row['m_goods_big_desc']) );
	}
?>
