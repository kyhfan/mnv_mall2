<?
	include_once "header.php";

  $goodscode     = $_REQUEST['goodscode'];

	// 상품 정보 SELECT
	$goods_info	= select_goods_info($goodscode);
  
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<body>

<div id="wrapper">
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">쇼핑몰 관리자</a>
    </div>
  <!-- /.navbar-header -->

<?
	include_once "top_navi.php";
	include_once "side_navi.php";
?>
</div>
<!-- /.navbar-static-side -->
  </nav>

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">재고 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <!-- <button type="button" class="btn btn-outline btn-primary btn-lg" id="edit_stock_info_btn">재고정보 수정</button> -->
      <a href="stock_list.php"><button type="button" class="btn btn-outline btn-success btn-lg">재고정보 목록</button></a>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="edit_stock_info">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>상품코드 선택</td>
                  <td colspan="2">
                    <?=$goodscode?>
                  </td>
                </tr>
                <tr>
                  <td>상품명</td>
                  <td>
                    <input class="form-control" id="stock_name" style="width:100%" value="<?=$goods_info['goods_name']?>" readonly>
                  </td>
                </tr>
                <tr>
                  <td>매입수량</td>
                  <td>
                    현재 <?=$goods_info['goods_stock']?> 개에
                    <input class="form-control" id="stock_cnt" value="0" >
                    <button type="button" class="btn btn-primary btn-xs" id="stock_plus_btn">+</button>
                    <button type="button" class="btn btn-danger btn-xs" id="stock_minus_btn">-</button> 개 추가
                  </td>
                </tr>
                <tr>
                  <td>매입금액</td>
                  <td>
                    현재 <?=number_format($goods_info['supply_price'])?> 원을
                    <input class="form-control" id="stock_price"> 원으로 변경
                  </td>
                </tr>
                <tr>
                  <td>판매수량</td>
                  <td>
                    현재 <?=$goods_info['goods_sales_cnt']?> 개를
                    <input class="form-control" id="sales_cnt" value="0"> 개로 변경
                  </td>
                </tr>
                <tr>
                  <td>판매금액</td>
                  <td>
                    현재 <?=number_format($goods_info['sales_price'])?> 원을
                    <input class="form-control" id="sales_price"> 원으로 변경
                  </td>
                </tr>
                <tr>
                  <td>재고정보 수정 사유</td>
                  <td>
                    <textarea class="form-control" id="stock_edit_desc" rows="3" style="width:100%"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn11">재고정보 수정</button>
          </div>
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?
	include_once "lib.php";
?>
</body>

</html>
