<?
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once $_mnv_PC_dir."header.php";
?>
<html>
<head>
    <title>LG유플러스 전자결제 결제취소 샘플 페이지</title>
</head>
<body>
    <form method="post" id="LGD_PAYINFO" action="Cancel.php">
    <div>
        <!-- 주문 취소시 해당 주문에 대한 상품 정보, 결제 정보 SELECT -->
        <table>
            <tr>
                <td>상점아이디(t를 제외한 아이디) </td>
                <td><input type="text" name="CST_MID" id="CST_MID" value="miniver"/></td>
            </tr>
            <tr>
                <td>서비스,테스트 </td>
                <td><input type="text" name="CST_PLATFORM" id="CST_PLATFORM" value="test"/></td>
            </tr>
            <tr>
                <td>LG유플러스 거래번호 </td>
                <td><input type="text" name="LGD_TID" id="LGD_TID" value=""/></td>
            </tr>

            <tr>
                <td>
                <input type="button" id="pay_cancel" value="결제 취소"/><br/>
                </td>
            </tr>
        </table>
    </div>
    </form>
</body>
</html>
