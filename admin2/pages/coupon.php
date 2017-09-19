<?
	include_once "header.php";
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
          <h1 class="page-header">쿠폰 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_coupon_btn">쿠폰 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_coupon_btn">쿠폰 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_coupon" style="display:none;">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>* 쿠폰 명</td>
                  <td colspan="2">
                    <input class="form-control" id="coupon_name" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>* 쿠폰타입</td>
                  <td>
                    <select class="form-control" id="coupon_type">
                      <option value="">선택하세요</option>
                      <option value="percent">상품 퍼센트 할인</option>
                      <option value="price">상품 금액 할인</option>
                      <option value="delivery">배송비 무료</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>* 쿠폰 값</td>
                  <td>
                    <input class="form-control" id="coupon_value" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>쿠폰 설명</td>
                  <td>
                    <textarea class="form-control" id="coupon_desc" rows="3" style="width:100%"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>* 쿠폰 사용기간</td>
                  <td>
                    <input type="radio" name="coupon_period" value="default" checked>
                    <input type="text" id="prev_date"> ~ <input type="text" id="next_date"><br />
                    <input type="radio" name="coupon_period" value="manual">
                    쿠폰 발급일로 부터 <input type="text" id="end_date"> 일까지 사용가능
                  </td>
                </tr>
                <tr>
                  <td>쿠폰 이미지</td>
                  <td>
                    <form action="../../lib/filer/php/upload.php" id="img_frm" method="post" enctype="multipart/form-data">
                      <input type="file" name="files[]" id="filer_input" multiple="multiple">
                      <!-- <input type="submit" value="Submit"> -->
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn20">쿠폰 정보 입력</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_coupon">
            <table width="100%" class="table table-striped table-bordered table-hover" id="coupon_list">
            </table>
          </div>
          <!-- /.table-responsive -->
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
	<!-- DataTables JavaScript -->
	<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script src="../bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

	<script src="../../lib/filer/js/jquery.filer.min.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	$(document).ready(function() {
		// 카테고리 리스트
		show_coupon_list("coupon_list");

		// 테이블 api 세팅 
		var table	= $('#coupon_list').DataTable({
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
			"ordering":false,
			"searching": true
		});
	});

	$('#filer_input').filer({
		showThumbs: true,
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
										<span class="jFiler-item-others">{{fi-size2}}</span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left"></ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			itemAppendToEnd: false,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				remove: '.jFiler-item-trash-action'
			}
		},
		addMore: true
	});
	</script>

</body>

</html>
