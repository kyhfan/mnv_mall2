<?
	include_once "header.php";
	// 카테고리 정보 SELECT
	$idx = $_REQUEST['idx'];
	$query = "SELECT * FROM ".$_gl['banner_info_table']." WHERE 1 AND idx = '".$idx."'";
	$result = mysqli_query($my_db, $query);
	$banner_data = mysqli_fetch_array($result);
	$banner_img_replace = str_replace("../../../","../../",$banner_data['banner_img_url']);
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<body>
  <input type="hidden" id="banner_idx" value="<?=$idx?>">
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
          <h1 class="page-header">배너 수정</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_banner">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>배너명</td>
                  <td colspan="2">
                    <input type="text" id="banner_name" style="width:100%" value="<?=$banner_data['banner_name']?>">
                  </td>
                </tr>
                <tr>
                  <td>배너 종류</td>
                  <td>
                    <select id="banner_type" onchange="change_banner_detail_device_type(this.value)">
                      <option value="">선택하세요</option>
                      <option value="main_rolling_banner" <?if($banner_data['banner_type'] == 'main_rolling_banner') echo 'selected'?>>메인 롤링 배너</option>
                      <option value="main_top_banner" <?if($banner_data['banner_type'] == 'main_top_banner') echo 'selected'?>>메인 상단 배너</option>
                      <option value="main_middle_banner" <?if($banner_data['banner_type'] == 'main_middle_banner') echo 'selected'?>>메인 중단 배너</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>디바이스 구분</td>
                  <td id="main_rolling_banner_device_type" class="device_type_class">
                    <select id="device_type">
                      <option value="">선택하세요</option>
                      <option value="PC" <?if($banner_data['device_type'] == 'PC') echo 'selected'?>>PC</option>
                      <option value="MOBILE" <?if($banner_data['device_type'] == 'MOBILE') echo 'selected'?>>MOBILE</option>
                    </select>
                    <p style="padding-top:20px;">PC : 가로 1180px / 세로 380px</p>
                    <p>MOBILE : 가로 320px / 세로 160px</p>
                  </td>
                  <td id="main_top_banner_device_type" class="device_type_class" style="display:none;">
                    <select id="device_type">
                      <option value="">선택하세요</option>
                      <option value="PC" <?if($banner_data['device_type'] == 'PC') echo 'selected'?>>PC</option>
                      <option value="MOBILE" <?if($banner_data['device_type'] == 'MOBILE') echo 'selected'?>>MOBILE</option>
                    </select>
                    <p style="padding-top:20px;">PC : 가로 1180px / 세로 380px</p>
                    <p>MOBILE : 가로 320px / 세로 160px</p>
                  </td>
                  <td id="main_middle_banner_device_type" class="device_type_class" style="display:none;">
                    <select id="device_type">
                      <option value="">선택하세요</option>
                      <option value="PC" <?if($banner_data['device_type'] == 'PC') echo 'selected'?>>PC</option>
                      <option value="MOBILE" <?if($banner_data['device_type'] == 'MOBILE') echo 'selected'?>>MOBILE</option>
                    </select>
                    <p style="padding-top:20px;">PC : 가로 1180px / 세로 380px</p>
                    <p>MOBILE : 가로 320px / 세로 160px</p>
                  </td>
                </tr>
                <tr class="banner_detail">
                  <td>이미지 및 링크설정</td>
                  <td>
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width:30%">이미지 첨부</th>
                          <th>연결링크</th>
                        </tr>
                      </thead>
                      <tbody id="banner_detail_tr">
                        <tr>
                          <td>
                            <form action="../../lib/filer/php/upload.php" id="main_image_frm" method="post" enctype="multipart/form-data">
                              <input type="file" name="files[]" id="filer_input" multiple="multiple">
                            </form>
                          </td>
                          <td>
                            <input class="form-control" id="banner_value" value="<?=$banner_data['banner_img_link']?>">
                            <p>예시) http://store-chon.com/event/event_list1.php</p>
                          </td>
                        </tr>
                        <tr>
                          <td style="border-top:0;">
                            <span style="margin-right:5px;font-weight:bold;">현재 이미지</span>
                            <img src="<?=$banner_img_replace?>" width="200">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>배너 노출 위치</td>
                  <td colspan="2">
                    <input type="text" id="banner_show_order" style="width:100%" value="<?=$banner_data['banner_show_order']?>"> * 메인 롤링 배너 선택시 노출 순서, 메인 이미지 배너 선택시 표시되는 위치
                  </td>
                </tr>
                <tr>
                  <td>배너 노출 여부</td>
                  <td>
                    <select id="banner_showYN">
                      <option value="Y" <?if($banner_data['banner_showYN'] == 'Y') echo 'selected'?>>노출</option>
                      <option value="N" <?if($banner_data['banner_showYN'] == 'N') echo 'selected'?>>비노출</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>배너 TARGET 설정</td>
                  <td>
                    <select id="banner_link_target">
                      <option value="_blank" <?if($banner_data['banner_link_target'] == '_blank') echo 'selected'?>>새로운 창</option>
                      <option value="_self" <?if($banner_data['banner_link_target'] == '_self') echo 'selected'?>>현재의 창</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn19">수 정</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_category" style="display:none;">
            <table width="100%" class="table table-striped table-bordered table-hover" id="category_list">
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
	var banner_num	= 1;
	$(document).ready(function() {
		// 배너 리스트
		// 작업해야함
		show_banner_list("banner_list");

		// 테이블 api 세팅
		/*
		var table	= $('#banner_list').DataTable({
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
			"ordering":false,
			"searching": true
		});
		*/
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
		addMore: false
	});

</script>

</body>

</html>
