<?php
	include_once "./config.php";

    $ig     = $_REQUEST["ig"];
    $idx    = $_REQUEST["idx"];

    $uploaddir = './'.$ig.'/'.$idx.'/';

    $uploadfile = $uploaddir . basename($_FILES['imgUp']['name']);

    if (!is_dir($uploaddir)) { 
        mkdir($uploaddir,0775); 
    }

    if (move_uploaded_file($_FILES['imgUp']['tmp_name'], $uploadfile)) {
        if ($ig == "board_oto")
        {
			// 1대1 문의 이미지 정보 업데이트
			$oto_query		    = "UPDATE ".$_gl['board_oto_table']." SET oto_file_url='".$uploadfile."' WHERE idx='".$idx."'";
			$oto_result		    = mysqli_query($my_db, $oto_query);
        }else if ($ig == "board_review"){
			// 리뷰작성 이미지 정보 업데이트
			$review_query		= "UPDATE ".$_gl['board_review_table']." SET review_file_url='".$uploadfile."' WHERE idx='".$idx."'";
			$review_result		= mysqli_query($my_db, $review_query);
        }else if ($ig == "board_qna"){
			// QNA작성 이미지 정보 업데이트
			$qna_query		    = "UPDATE ".$_gl['board_qna_table']." SET qna_file_url='".$uploadfile."' WHERE idx='".$idx."'";
			$qna_result		    = mysqli_query($my_db, $qna_query);
        }
    } else {
        // print "파일 업로드 공격의 가능성이 있습니다!\n";
    }

    // echo '자세한 디버깅 정보입니다:';
    // print_r($_FILES);

    // print "</pre>";

?>