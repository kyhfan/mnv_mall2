<?php
	$word = $_REQUEST['word'];

	$search_result_array = array();
	foreach ($keyword_storage as $key => $value) {
		if(strstr($value['goods_name'], $word) || strstr($value['goods_desc'], $word))
		{
			array_push($search_result_array, array('goods_code' => $value['goods_code'],
													'goods_name' => $value['goods_name']) );
		}
	}
	if(count($search_result_array) <= 0) {
		$flag = "N";
	} else {
		$flag = $search_result_array;
	}

	echo json_encode($flag);
?>
