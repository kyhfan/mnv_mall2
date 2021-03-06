<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_PC_url."index.php';</script>";
	}

?>
<body>
      <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
        <div id="wrap_content">
          <div class="contents l2 clearfix">
            <div class="section main">
              <div class="area_main_top nopadd">
                <div class="block_title">
                  <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_join.png" alt="회원가입"></p>
                </div>
              </div>
              <div class="area_main_middle nopadd noborder">
                <form id="join_form">
                  <div class="block_bg">
                    <div class="block_copy">
                      <div class="block_line clearfix">
                        <span class="input_guide">아이디<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" id="user_id" name="user_id" onblur="dupli_chk(this.value);return false;">
                          <span>(영문소문자/숫자 6 - 12자)</span>
                          <span id="check_alert1" style="color:#b88b5b;letter-spacing:-1px;"></span>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">비밀번호<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="password" class="inputT" id="password" name="password">
                          <span>(영문대소문자/숫자/특수문자 6 - 12자)</span>
                        </div>
                      </div>
                      <div class="block_line clearfix pb20">
                        <span class="input_guide">비밀번호확인<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="password" class="inputT" id="passchk" onblur="pass_chk(this.value);return false;">
                          <span id="check_alert2" style="color:#b88b5b;letter-spacing:-1px;"></span>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">이름<span class="fontColor">*</span></span>
                        <div class="input_block"><input type="text" class="inputT" id="username" name="username" style="ime-mode:active"></div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">휴대전화<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="4" id="phone1" name="phone1">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="phone2" name="phone2">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="phone3" name="phone3">
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">일반전화</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="4" id="tel1" name="tel1">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="tel2" name="tel2">
                          <span class="mrl1">-</span>
                          <input type="text" class="inputT" size="4" id="tel3" name="tel3">
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">주소</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="7" name="zipcode" id="zipcode" placeholder="우편번호" readonly="true">
                          <input type="button" class="board_btn" value="우편번호" id="find_addr" value="주소검색">
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide blind">주소2</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="70" name="addr1" id="addr1" placeholder="기본주소" readonly="true"><span>기본주소</span>
                        </div>
                      </div>
                      <div class="block_line clearfix pb20 addr">
                        <span class="input_guide blind">주소3</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="70" name="addr2" id="addr2" placeholder="나머지주소"><span>나머지주소(직접입력)</span>
                          <p>미리 입력해두면 주문/배송시 더 간편해집니다.</p>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">이메일<span class="fontColor">*</span></span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="15" id="email1" name="email1">
                          <span class="fontColor mrl1" style="font-size:15px;">@</span>
                          <input type="text" class="inputT" size="15" id="email2" name="email2">
                          <div class="selectbox email">
                            <label for="email3">직접입력</label>
                            <select id="email3" name="email3">
                              <option value="direct" selected>직접입력</option>
                              <option value="naver.com">naver.com</option>
                              <option value="daum.net">daum.net</option>
                              <option value="nate.com">nate.com</option>
                              <option value="hotmail.com">hotmail.com</option>
                              <option value="yahoo.com">yahoo.com</option>
                              <option value="empas.com">empas.com</option>
                              <option value="korea.com">korea.com</option>
                              <option value="dreamwiz.com">dreamwiz.com</option>
                              <option value="gmail.com">gmail.com</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="block_line clearfix" style="height:42px;">
                        <span class="input_guide" style="line-height:normal;">이메일<br>수신여부<span class="fontColor">*</span></span>
                        <div class="input_block" style="line-height:normal;">
                          <span class="rd_txt">수신함</span><input type="radio" name="emailYN" value="Y" checked><span class="rd_txt">수신안함</span><input type="radio" name="emailYN" value="N">
                          <p>쇼핑몰에서 제공하는 제품 및 이벤트 소식을 이메일로 받으실 수 있어요.</p>
                        </div>
                      </div>
                      <div class="block_line clearfix" style="height:42px;">
                        <span class="input_guide" style="line-height:normal;">문자<br>수신여부<span class="fontColor">*</span></span>
                        <div class="input_block" style="line-height:normal;">
                          <span class="rd_txt">수신함</span><input type="radio" name="smsYN" value="Y" checked><span class="rd_txt">수신안함</span><input type="radio" name="smsYN" value="N">
                          <p>임시 텍스트영역</p>
                        </div>
                      </div>
                      <div class="block_line clearfix">
                        <span class="input_guide">생년월일</span>
                        <div class="input_block">
                          <input type="text" class="inputT" size="7" name="birthY" id="birthY" placeholder="년">
                          <input type="text" class="inputT" size="7" name="birthM" id="birthM" placeholder="월">
                          <input type="text" class="inputT" size="7" name="birthD" id="birthD" placeholder="일">
                          <p>생일에 특별한 쿠폰을 드립니다</p>
                        </div>
                      </div>
                      <span class="line_full"></span>
                      <div class="block_line notice">
                        <p class="notice_title">이용약관동의</p>
                        <div class="whiteBox">
                          <div class="inner">
                            <p class="notice_cnt">
                              제1조(목적)
                              이 약관은 미니버타이징(주) (전자상거래 사업자)가 운영하는 사이버 몰(이하 "몰"이라 한다)에서 제공하는 인터넷 관련 서비스(이하 "서비스"라 한다)를 이용함에 있어 사이버 몰과 이용자의 권리의무 및 책임사항을 규정함을 목적으로 합니다.
                              「PC통신, 무선 등을 이용하는 전자상거래에 대해서도 그 성질에 반하지 않는 한 이 약관을 준용합니다」

                              제2조(정의)
                              ①"몰" 이란 회사가 재화 또는 용역(이하 "재화 등"이라 함)을 이용자에게 제공하기 위하여 컴퓨터 등 정보통신설비를 이용하여 재화 등을 거래할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이버몰을 운영하는 사업자의 의미로도 사용합니다.
                              ②"이용자"란 "몰"에 접속하여 이 약관에 따라 "몰"이 제공하는 서비스를 받는 회원 및 비회원을 말합니다.
                              ③"회원"이라 함은 “몰”에 회원등록을 한 자로서, 계속적으로 “몰”이 제공하는 서비스를 이용할 수 있는 자를 말합니다.
                              ④"비회원"이라 함은 회원에 가입하지 않고 "몰"이 제공하는 서비스를 이용하는 자를 말합니다.

                              제3조 (약관 등의 명시와 설명 및 개정)
                              ①"몰"은 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를 포함), 전화번호•모사전송번호•전자우편주소, 사업자등록번호, 통신판매업신고번호, 개인정보관리책임자 등을 이용자가 쉽게 알 수 있도록 사이버몰의 초기 서비스화면(전면)에 게시합니다. 다만, 약관의 내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.
                              ②"몰"은 이용자가 약관에 동의하기에 앞서 약관에 정하여져 있는 내용 중 청약철회•배송책임•환불조건 등과 같은 중요한 내용을 이용자가 이해할 수 있도록 별도의 연결화면 또는 팝업화면 등을 제공하여 이용자의 확인을 구하여야 합니다.
                              ③"몰"은 「전자상거래 등에서의 소비자보호에 관한 법률」, 「약관의 규제에 관한 법률」, 「전자문서 및 전자거래기본법」, 「전자금융거래법」, 「전자서명법」, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」, 「방문판매 등에 관한 법률」, 「소비자기본법」 등 관련 법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.
                              ④"몰"이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 몰의 초기화면에 그 적용일자 7일 이전부터 적용일자 전일까지 공지합니다. 다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 "몰"은 개정 전 내용과 개정 후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.
                              ⑤"몰"이 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간 내에 "몰"에 송신하여 "몰"의 동의를 받은 경우에는 개정약관 조항이 적용됩니다.
                              ⑥이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래 등에서의 소비자보호에 관한 법률, 약관의 규제 등에 관한 법률, 공정거래위원회가 정하는 전자상거래 등에서의 소비자 보호지침 및 관계법령 또는 상관례에 따릅니다.

                              제4조(서비스의 제공 및 변경)
                              ①"몰"은 다음과 같은 업무를 수행합니다.
                              1. 재화 또는 용역에 대한 정보 제공 및 구매계약의 체결
                              2. 구매계약이 체결된 재화 또는 용역의 배송
                              3. 기타 "몰"이 정하는 업무
                              ②"몰"은 재화 또는 용역의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화 또는 용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화 또는 용역의 내용 및 제공일자를 명시하여 현재의 재화 또는 용역의 내용을 게시한 곳에 즉시 공지합니다.
                              ③"몰"이 제공하기로 이용자와 계약을 체결한 서비스의 내용을 재화 등의 품절 또는 기술적 사양의 변경 등의 사유로 변경할 경우에는 그 사유를 이용자에게 통지 가능한 주소로 즉시 통지합니다.
                              ④전항의 경우 "몰"은 이로 인하여 이용자가 입은 손해를 배상합니다. 다만, "몰"이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.

                              제5조(서비스의 중단) 
                              ①"몰"은 컴퓨터 등 정보통신설비의 보수점검•교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.
                              ②"몰"은 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대하여 배상합니다. 단, "몰"이 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.
                              ③사업종목의 전환, 사업의 포기, 업체간의 통합 등의 이유로 서비스를 제공할 수 없게 되는 경우에는 "몰"은 제8조에 정한 방법으로 이용자에게 통지하고 당초 "몰"에서 제시한 조건에 따라 소비자에게 보상합니다. 다만, "몰"이 보상기준 등을 고지하지 아니한 경우에는 이용자들의 마일리지 또는 적립금 등을 "몰"에서 통용되는 통화가치에 상응하는 현물 또는 현금으로 이용자에게 지급합니다.

                              제6조(회원가입)
                              ①이용자는 "몰"이 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.
                              ②"몰"은 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각호에 해당하지 않는 한 회원으로 등록합니다. 1. 가입신청자가 이 약관 제7조제3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 다만 제7조제3항에 의한 회원자격 상실 후 3년이 경과한 자로서 "몰"의 회원재가입 승낙을 얻은 경우에는 예외로 한다. 2. 등록 내용에 허위, 기재누락, 오기가 있는 경우 3. 기타 회원으로 등록하는 것이 "몰"의 기술상 현저히 지장이 있다고 판단되는 경우
                              ③회원가입계약의 성립시기는 "몰"의 승낙이 회원에게 도달한 시점으로 합니다.
                              ④회원은 회원가입 시 등록한 사항에 변경이 있는 경우, 상당한 기간 이내에 “몰”에 대하여 회원정보 수정 등의 방법으로 그 변경사항을 알려야 합니다.

                              제7조(회원 탈퇴 및 자격 상실 등)
                              ①회원은 "몰"에 언제든지 탈퇴를 요청할 수 있으며 "몰"은 즉시 회원탈퇴를 처리합니다.
                              ②회원이 다음 각호의 사유에 해당하는 경우, "몰"은 회원자격을 제한 및 정지시킬 수 있습니다.
                              1. 가입 신청 시에 허위 내용을 등록한 경우
                              2. "몰"을 이용하여 구입한 재화 등의 대금, 기타 "몰"이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우
                              3. 다른 사람의 "몰" 이용을 방해하거나 그 정보를 도용하는 등 전자상거래 질서를 위협하는 경우
                              4. "몰"을 이용하여 법령 또는 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우
                              ③"몰"이 회원 자격을 제한•정지 시킨 후, 동일한 행위가 2회 이상 반복되거나 30일 이내에 그 사유가 시정되지 아니하는 경우 "몰"은 회원자격을 상실시킬 수 있습니다.
                              ④"몰"이 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하고, 회원등록 말소 전에 최소한 30일 이상의 기간을 정하여 소명할 기회를 부여합니다.

                              제8조(회원에 대한 통지)
                              ①"몰"이 회원에 대한 통지를 하는 경우, 회원이 "몰"과 미리 약정하여 지정한 전자우편 주소로 할 수 있습니다.
                              ②"몰"은 불특정다수 회원에 대한 통지의 경우 1주일이상 "몰" 게시판에 게시함으로서 개별 통지에 갈음할 수 있습니다. 다만, 회원 본인의 거래와 관련하여 중대한 영향을 미치는 사항에 대하여는 개별통지를 합니다.

                              제9조(구매신청)
                              ①"몰"이용자는 "몰"상에서 다음 또는 이와 유사한 방법에 의하여 구매를 신청하며, “몰”은 이용자가 구매신청을 함에 있어서 다음의 각 내용을 알기 쉽게 제공하여야 합니다.
                              1. 재화 등의 검색 및 선택
                              2. 받는 사람의 성명, 주소, 전화번호, 전자우편주소(또는 이동전화번호) 등의 입력
                              3. 약관내용, 청약철회권이 제한되는 서비스, 배송료․설치비 등의 비용부담과 관련한 내용에 대한 확인
                              4. 이 약관에 동의하고 위 3.호의 사항을 확인하거나 거부하는 표시(예, 마우스 클릭)
                              5. 재화 등의 구매신청 및 이에 관한 확인 또는 “몰”의 확인에 대한 동의
                              6. 결제방법의 선택
                              ②"몰"이 제3자에게 구매자 개인정보를 제공•위탁할 필요가 있는 경우 실제 구매신청 시 구매자의 동의를 받아야 하며, 회원가입 시 미리 포괄적으로 동의를 받지 않습니다. 이 때 "몰"은 제공되는 개인정보 항목, 제공받는 자, 제공받는 자의 개인정보 이용 목적 및 보유‧이용 기간 등을 구매자에게 명시하여야 합니다. 다만 「정보통신망이용촉진 및 정보보호 등에 관한 법률」 제25조 제1항에 의한 개인정보 취급위탁의 경우 등 관련 법령에 달리 정함이 있는 경우에는 그에 따릅니다.

                              제10조 (계약의 성립)
                              ①"몰"은 제9조와 같은 구매신청에 대하여 다음 각호에 해당하면 승낙하지 않을 수 있습니다. 다만, 미성년자와 계약을 체결하는 경우에는 법정대리인의 동의를 얻지 못하면 미성년자 본인 또는 법정대리인이 계약을 취소할 수 있다는 내용을 고지하여야 합니다.
                              1. 신청 내용에 허위, 기재누락, 오기가 있는 경우
                              2. 미성년자가 담배, 주류 등 청소년보호법에서 금지하는 재화 및 용역을 구매하는 경우
                              3. 기타 구매신청에 승낙하는 것이 "몰" 기술상 현저히 지장이 있다고 판단하는 경우
                              ②"몰"의 승낙이 제12조제1항의 수신확인통지형태로 이용자에게 도달한 시점에 계약이 성립한 것으로 봅니다.
                              ③"몰"의 승낙의 의사표시에는 이용자의 구매 신청에 대한 확인 및 판매가능 여부, 구매신청의 정정 취소 등에 관한 정보 등을 포함하여야 합니다.

                              제11조(지급방법) "몰"에서 구매한 재화 또는 용역에 대한 대금지급방법은 다음 각호의 방법중 가용한 방법으로 할 수 있습니다. 단, "몰"은 이용자의 지급방법에 대하여 재화 등의 대금에 어떠한 명목의 수수료도 추가하여 징수할 수 없습니다.
                              1. 폰뱅킹, 인터넷뱅킹, 메일 뱅킹 등의 각종 계좌이체
                              2. 선불카드, 직불카드, 신용카드 등의 각종 카드 결제
                              3. 온라인무통장입금
                              4. 전자화폐에 의한 결제
                              5. 수령 시 대금지급
                              6. 마일리지 등 "몰"이 지급한 포인트에 의한 결제
                              7. "몰"과 계약을 맺었거나 "몰"이 인정한 상품권에 의한 결제
                              8. 기타 전자적 지급 방법에 의한 대금 지급 등

                              제12조(수신확인통지•구매신청 변경 및 취소)
                              ①"몰"은 이용자의 구매신청이 있는 경우 이용자에게 수신확인통지를 합니다.
                              ②수신확인통지를 받은 이용자는 의사표시의 불일치 등이 있는 경우에는 수신확인통지를 받은 후 즉시 구매신청 변경 및 취소를 요청할 수 있고 "몰"은 배송 전에 이용자의 요청이 있는 경우에는 지체 없이 그 요청에 따라 처리하여야 합니다. 다만 이미 대금을 지불한 경우에는 제15조의 청약철회 등에 관한 규정에 따릅니다.

                              제13조(재화 등의 공급)
                              ①"몰"은 이용자와 재화 등의 공급시기에 관하여 별도의 약정이 없는 이상, 이용자가 청약을 한 날부터 7일 이내에 재화 등을 배송할 수 있도록 주문제작, 포장 등 기타의 필요한 조치를 취합니다. 다만, "몰"이 이미 재화 등의 대금의 전부 또는 일부를 받은 경우에는 대금의 전부 또는 일부를 받은 날부터 3영업일 이내에 조치를 취합니다. 이때 "몰"은 이용자가 재화 등의 공급 절차 및 진행 사항을 확인할 수 있도록 적절한 조치를 합니다.
                              ②"몰"은 이용자가 구매한 재화에 대해 배송수단, 수단별 배송비용 부담자, 수단별 배송기간 등을 명시합니다. 만약 "몰"이 약정 배송기간을 초과한 경우에는 그로 인한 이용자의 손해를 배상하여야 합니다. 다만 "몰"이 고의•과실이 없음을 입증한 경우에는 그러하지 아니합니다.

                              제14조(환급)
                              "몰"은 이용자가 구매신청 한 재화 등이 품절 등의 사유로 인도 또는 제공을 할 수 없을 때에는 지체 없이 그 사유를 이용자에게 통지하고 사전에 재화 등의 대금을 받은 경우에는 대금을 받은 날부터 3영업일 이내에 환급하거나 환급에 필요한 조치를 취합니다.

                              제15조(청약철회 등)
                              ①"몰"과 재화 등의 구매에 관한 계약을 체결한 이용자는 「전자상거래 등에서의 소비자보호에 관한 법률」 제13조 제2항에 따른 계약내용에 관한 서면을 받은 날(그 서면을 받은 때보다 재화 등의 공급이 늦게 이루어진 경우에는 재화 등을 공급받거나 재화 등의 공급이 시작된 날을 말합니다)부터 7일 이내에는 청약의 철회를 할 수 있습니다. 다만, 청약철회에 관하여 「전자상거래 등에서의 소비자보호에 관한 법률」에 달리 정함이 있는 경우에는 동 법 규정에 따릅니다.
                              ②이용자는 재화 등을 배송 받은 경우 다음 각호의 1에 해당하는 경우에는 반품 및 교환을 할 수 없습니다.
                              1. 이용자에게 책임 있는 사유로 재화 등이 멸실 또는 훼손된 경우(다만, 재화 등의 내용을 확인하기 위하여 포장 등을 훼손한 경우에는 청약철회를 할 수 있습니다)
                              2. 이용자의 사용 또는 일부 소비에 의하여 재화 등의 가치가 현저히 감소한 경우
                              3. 시간의 경과에 의하여 재판매가 곤란할 정도로 재화 등의 가치가 현저히 감소한 경우
                              4. 같은 성능을 지닌 재화 등으로 복제가 가능한 경우 그 원본인 재화 등의 포장을 훼손한 경우
                              ③제2항제2호 내지 제4호의 경우에 "몰"이 사전에 청약철회 등이 제한되는 사실을 소비자가 쉽게 알 수 있는 곳에 명기하거나 시용상품을 제공하는 등의 조치를 하지 않았다면 이용자의 청약철회 등이 제한되지 않습니다.
                              ④이용자는 제1항 및 제2항의 규정에 불구하고 재화 등의 내용이 표시 광고 내용과 다르거나 계약내용과 다르게 이행된 때에는 당해 재화 등을 공급받은 날부터 3월 이내, 그 사실을 안 날 또는 알 수 있었던 날부터 30일 이내에 청약철회 등을 할 수 있습니다.

                              제16조(청약철회 등의 효과)
                              ①"몰"과 재화 등의 "몰"은 이용자로부터 재화 등을 반환 받은 경우 3영업일 이내에 이미 지급받은 재화 등의 대금을 환급합니다. 이 경우 “몰”이 이용자에게 재화 등의 환급을 지연한 때에는 그 지연기간에 대하여 「전자상거래 등에서의 소비자보호에 관한 법률 시행령」제21조의2에서 정하는 지연이자율을 곱하여 산정한 지연이자를 지급합니다.
                              ②"몰"은 위 대금을 환급함에 있어서 이용자가 신용카드 또는 전자화폐 등의 결제수단으로 재화 등의 대금을 지급한 때에는 지체 없이 당해 결제수단을 제공한 사업자로 하여금 재화 등의 대금의 청구를 정지 또는 취소하도록 요청합니다.
                              ③청약철회 등의 경우 공급받은 재화 등의 반환에 필요한 비용은 이용자가 부담합니다. "몰"은 이용자에게 청약철회 등을 이유로 위약금 또는 손해배상을 청구하지 않습니다. 다만 재화 등의 내용이 표시 광고 내용과 다르거나 계약내용과 다르게 이행되어 청약철회 등을 하는 경우 재화 등의 반환에 필요한 비용은 "몰"이 부담합니다.
                              ④이용자가 재화 등을 제공받을 때 발송비를 부담한 경우에 "몰"은 청약철회 시 그 비용을 누가 부담하는지를 이용자가 알기 쉽도록 명확하게 표시합니다.

                              제17조(개인정보보호)
                              ①"몰"은 이용자의 개인정보 수집시 서비스제공을 위하여 필요한 범위에서 최소한의 개인정보를 수집합니다.
                              ②"몰"은 회원가입시 구매계약이행에 필요한 정보를 미리 수집하지 않습니다. 다만, 관련 법령상 의무이행을 위하여 구매계약 이전에 본인확인이 필요한 경우로서 최소한의 특정 개인정보를 수집하는 경우에는 그러하지 아니합니다.
                              ③"몰"은 이용자의 개인정보를 수집•이용하는 때에는 당해 이용자에게 그 목적을 고지하고 동의를 받습니다.
                              ④"몰"은 수집된 개인정보를 목적 외의 용도로 이용할 수 없으며, 새로운 이용목적이 발생한 경우 또는 제3자에게 제공하는 경우에는 이용•제공단계에서 당해 이용자에게 그 목적을 고지하고 동의를 받습니다. 다만, 관련 법령에 달리 정함이 있는 경우에는 예외로 합니다.
                              ⑤"몰"이 제3항과 제4항에 의해 이용자의 동의를 받아야 하는 경우에는 개인정보관리 책임자의 신원(소속, 성명 및 전화번호, 기타 연락처), 정보의 수집목적 및 이용목적, 제3자에 대한 정보제공 관련사항(제공받은 자, 제공목적 및 제공할 정보의 내용) 등 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 제22조제2항이 규정한 사항을 미리 명시하거나 고지해야 하며 이용자는 언제든지 이 동의를 철회할 수 있습니다.
                              ⑥이용자는 언제든지 "몰"이 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 "몰"은 이에 대해 지체 없이 필요한 조치를 취할 의무를 집니다. 이용자가 오류의 정정을 요구한 경우에는 "몰"은 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다.
                              ⑦"몰"은 개인정보 보호를 위하여 이용자의 개인정보를 취급하는 자를 최소한으로 제한하여야 하며 신용카드, 은행계좌 등을 포함한 이용자의 개인정보의 분실, 도난, 유출, 동의 없는 제3자 제공, 변조 등으로 인한 이용자의 손해에 대하여 모든 책임을 집니다.
                              ⑧"몰" 또는 그로부터 개인정보를 제공받은 제3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 당해 개인정보를 지체 없이 파기합니다.
                              ⑨"몰"은 개인정보의 수집•이용•제공에 관한 동의란을 미리 선택한 것으로 설정해두지 않습니다. 또한 개인정보의 수집•이용•제공에 관한 이용자의 동의거절시 제한되는 서비스를 구체적으로 명시하고, 필수수집항목이 아닌 개인정보의 수집•이용•제공에 관한 이용자의 동의 거절을 이유로 회원가입 등 서비스 제공을 제한하거나 거절하지 않습니다.

                              제18조("몰"의 의무)
                              ①"몰"은 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화•용역을 제공하는데 최선을 다하여야 합니다.
                              ③"몰"은 이용자가 안전하게 인터넷 서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안 시스템을 갖추어야 합니다.
                              ④"몰"이 상품이나 용역에 대하여 「표시•광고의 공정화에 관한 법률」 제3조 소정의 부당한 표시•광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다.
                              ⑤"몰"은 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.

                              제19조(회원의 ID 및 비밀번호에 대한 의무)
                              ①제17조의 경우를 제외한 ID와 비밀번호에 관한 관리책임은 회원에게 있습니다.
                              ②회원은 자신의 ID 및 비밀번호를 제3자에게 이용하게 해서는 안됩니다.
                              ③회원이 자신의 ID 및 비밀번호를 도난 당하거나 제3자가 사용하고 있음을 인지한 경우에는 바로 "몰"에 통보하고 "몰"의 안내가 있는 경우에는 그에 따라야 합니다.

                              제20조(이용자의 의무) 이용자는 다음 행위를 하여서는 안됩니다.
                              1. 신청 또는 변경시 허위 내용의 등록
                              2. 타인의 정보 도용
                              3. "몰"에 게시된 정보의 변경
                              4. "몰"이 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시
                              5. "몰" 기타 제3자의 저작권 등 지적재산권에 대한 침해
                              6. "몰" 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위
                              7. 외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 몰에 공개 또는 게시하는 행위

                              제21조(연결"몰"과 피연결"몰" 간의 관계)
                              ①상위 "몰"과 하위 "몰"이 하이퍼링크(예: 하이퍼링크의 대상에는 문자, 그림 및 동화상 등이 포함됨)방식 등으로 연결된 경우, 전자를 연결 "몰"(웹 사이트)이라고 하고 후자를 피연결 "몰"(웹사이트)이라고 합니다.
                              ②연결"몰"은 피연결 "몰"이 독자적으로 제공하는 재화 등에 의하여 이용자와 행하는 거래에 대해서 보증책임을 지지 않는다는 뜻을 연결"몰"의 초기화면 또는 연결되는 시점의 팝업화면으로 명시한 경우에는 그 거래에 대한 보증책임을 지지 않습니다.

                              제22조(저작권의 귀속 및 이용제한)
                              ①"몰"이 작성한 저작물에 대한 저작권 기타 지적재산권은 "몰"에 귀속합니다.
                              ②이용자는 "몰"을 이용함으로써 얻은 정보 중 "몰"에게 지적재산권이 귀속된 정보를 "몰"의 사전 승낙 없이 복제, 송신, 출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다.
                              ③"몰"은 약정에 따라 이용자에게 귀속된 저작권을 사용하는 경우 당해 이용자에게 통보하여야 합니다.

                              제23조(분쟁해결)
                              ①"몰"은 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 피해보상처리기구를 설치•운영합니다.
                              ②"몰"은 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 즉시 통보해 드립니다.
                              ③"몰"과 이용자간에 발생한 전자상거래 분쟁과 관련하여 이용자의 피해구제신청이 있는 경우에는 공정거래위원회 또는 시 도지사가 의뢰하는 분쟁조정기관의 조정에 따를 수 있습니다.

                              제24조(재판권 및 준거법)
                              ①"몰"과 이용자간에 발생한 전자상거래 분쟁에 관한 소송은 제소 당시의 이용자의 주소에 의하고, 주소가 없는 경우에는 거소를 관할하는 지방법원의 전속관할로 합니다. 다만, 제소 당시 이용자의 주소 또는 거소가 분명하지 않거나 외국 거주자의 경우에는 민사소송법상의 관할법원에 제기합니다.
                              ②"몰"과 이용자간에 제기된 전자상거래 소송에는 한국법을 적용합니다.

                              부 칙(시행일) 이 약관은 2016년 11월 30일부터 시행합니다.
                            </p>
                          </div>
                        </div>
                        <div class="checks">
                          <span>동의함</span>
                          <input type="checkbox" id="notice1">
                          <label for="notice1"></label>
                        </div>
                      </div>
                      <div class="block_line notice">
                        <p class="notice_title">개인정보 수집 및 이용 동의</p>
                        <div class="whiteBox">
                          <div class="inner">
                            <p class="notice_cnt">
                              제 1조 (총칙)
                              1. 개인정보란 생존하는 개인에 관한 정보로서 당해 정보에 포함되어 있는 성명, 주민등록번호, 아이디, 비밀번호, 휴대전화, 일반전화, 주소, 이메일, 생년월일 등의 사항에 의하여 당해 개인을 식별할 수 있는 정보 (당해 정보만으로는 특정 개인을 식별할 수 없더라도 다른 정보와 용이하게 결합하여 식별할 수 있는 것을 포함합니다.) 를 말합니다.
                              2. 촌의감각은 귀하의 개인정보 보호를 매우 중요시하며, ‘정보통신망 이용촉진 및 정보보호에 관한 법률’ 상의 개인정보 보호규정 및 정보통신부가 제정한 ‘개인정보 보호지침’을 준수하고 있습니다.
                              3. 촌의감각은 개인정보취급방침을 정하고 이를 귀하께서 언제나 쉽게 확인할 수 있게 공개하도록 하고 있습니다.
                              4. 촌의감각은 개인정보 처리방침의 지속적인 개선을 위하여 개정하는데 필요한 절차를 정하고 있으며, 개인정보 처리방침을 회사의 필요한 사회적 변화에 맞게 변경할 수 있습니다. 그리고 개인정보처리방침을 개정하는 경우 버전번호 등을 부여하여 개정된 사항을 귀하께서 쉽게 알아볼 수 있도록 하고 있습니다.

                              제 2조 (수집하는 개인정보 항목 및 수집방법)
                              1. 촌의감각은 별도의 회원가입 절차 없이 대부분의 컨텐츠에 자유롭게 접근할 수 있습니다. 촌의감각은 회원제 서비스를 이용하시고자 할 경우 다음의 정보를 입력해주셔야 합니다.
                              - 필수 입력항목 : 희망ID, 비밀번호, 성명, 이메일주소, 휴대전화
                              - 선택 입력항목 : 주소, 일반전화, 생년월일
                              2. 또한 서비스 이용과정이나 사업 처리 과정에서 아래와 같은 정보들이 생성되어 수집될 수 있습니다.
                              - 최근 접속일, 접속 IP 정보, 쿠키, 구매로그, 이벤트로그
                              - 회원가입 시 회원이 원하시는 경우에 한하여 추가 정보를 선택, 제공하실 수 있도록 되어있으며, 일부 재화 또는 용역 상품에 대한 주문 및 접수 시 회원이 원하는 정확한 주문 내용 파악을 통한 원활한 주문 및 결제, 배송을 위하여 추가적인 정보를 요구하고 있습니다.
                              3. 촌의감각은 다음과 같은 방법으로 개인정보를 수집합니다.
                              - 홈페이지, 서면양식, 팩스, 전화, 상담 게시판, 이메일, 이벤트 응모, 배송요청 
                              - 로그 분석 프로그램을 통한 생성정보 수집
                              4. 개인정보 수집에 대한 동의
                              - 촌의감각은 귀하께서 촌의감각의 개인정보취급방침 및 이용약관의 내용에 대해 동의여부 체크박스를 클릭할 수 있는 절차를 마련하여, 동의여부 체크박스를 체크하면 개인정보 수집에 대해 동의한 것으로 봅니다.
                              5. 비회원의 개인정보보호
                              ① 촌의감각은 비회원 주문의 경우에도 배송, 대금결제, 주문내역 조회 및 구매확인, 실명여부 확인을 위하여 필요한 개인정보만을 요청하고 있으며, 이 경우 그 정보는 대금결제 및 상품의 배송에 관련된 용도 이외에는 다른 어떠한 용도로도 사용되지 않습니다.
                              ② 촌의감각은 비회원의 개인정보도 회원과 동등한 수준으로 보호합니다.

                              제 3조 (개인정보의 수집목적 및 이용 목적)
                              촌의감각은 다음과 같은 목적을 위하여 개인정보를 수집하고 있습니다.
                              1. 성명, 아이디, 비밀번호, 휴대전화, 일반전화, 주소, 이메일, 생년월일 : 회원가입, 상담, 서비스 신청 등을 위해 해당하는 개인정보 수집
                              2. 이메일주소(뉴스레터 수신여부) : 고지사항 전달, 본인 의사 확인, 불만 처리 등 원활한 의사소통 경로의 확보, 새로운 서비스, 신상품이나 이벤트 정보 등 최신 정보의 안내
                              3. 주소, 전화번호 : 쇼핑 물품 배송에 대한 정확한 배송지의 확보
                              4. 그 외 선택항목 : 개인맞춤 서비스를 제공하기 위한 자료

                              제 4조 (개인정보의 공유 및 제공)
                              1. 촌의감각은 귀하의 개인정보를 (개인정보의 수집목적 및 이용목적) 에서 고지한 범위 내에서 사용하며, 동 범위를 초과하여 이용하거나 타인 또는 타기업/기관에 제공하지 않습니다.
                              2. 단, 다음은 예외로 합니다.
                              ① 관계법령에 의하여 수사상의 목적으로 관계기관으로부터의 요구가 있을 경우
                              ② 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우
                              ③ 이용자들이 사전에 동의한 경우
                              ④ 그러나 예외사항에서도 관계법령에 의하거나 수사기관의 요청에 의해 정보를 제공한 경우에는 이를 당사자에게 고지하는 것을 원칙으로 운영하고 있습니다. 법률상의 근거에 의해 부득이하게 고지를 하지 못할 수도 있습니다. 본래의 수집목적 및 이용목적에 반하여 무분별하게 정보가 제공되지 않도록 최대한 노력하겠습니다.

                              제 5조 (수집한 개인정보 취급 위탁)
                              - 로젠택배 : 상품배송업무
                              - 엘지유플러스 : 상품 구매에 필요한 신용카드, 현금결제 등의 결제정보 전송
                              - 포스트맨 : SMS, MMS등 문자메세지 전송
                              - 상품판매제휴업체 : 상품주문확인 및 배송 업무

                              제 6조 (개인정보의 보유, 이용기간)
                              1. 귀하의 개인정보는 회사가 신청인에게 서비스를 제공하는 기간 동안에 한하여 보유하고 이를 활용합니다. 다만 다른 법률에 특별한 규정이 있는 경우에는 관계법령에 따라 보관합니다.
                              ① 회원가입정보 : 회원가입을 탈퇴하거나 회원에 제명된 때 
                              ② 대금지급정보 : 대금의 완제일 또는 채권소명시효기간이 만료된 때
                              ③ 배송정보 : 물품 또는 서비스가 인도되거나 제공된 때 
                              ④ 설문조사, 이벤트 등 일시적 목적을 위하여 수집한 경우 : 당해 설문조사, 이벤트 등이 종료한 때
                              2. 위 개인정보 수집목적 달성시 즉시파기 원칙에도 불구하고 다음과 같이 거래 관련 권리 의무 관계의 확인 등을 이유로 일정기간 보유하여야 할 필요가 있을 경우에는 전자상거래 등에서의 소비자보호에 관한 법률 등에 근거하여 일정기간 보유합니다.
                              ① 계약 또는 청약철회 등에 관한 기록 : 5년
                              ② 대금결제 및 재화 등의 공급에 관한 기록 : 5년
                              ③ 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년
                              ④ 설문조사, 이벤트 등 일시적 목적을 위하여 수집한 경우 : 당해 설문조사, 이벤트 등의 종료 시점
                              3. 귀하의 동의를 받아 보유하고 있는 거래정보 등을 귀하께서 열람을 요구하는 경우 촌의감각은 지체없이 그 열람, 확인 할 수 있도록 조치합니다.

                              제 7조 (개인정보의 파기 절차)
                              1. 촌의감각은 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.
                              2. 파기절차: 귀하가 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(제6조 개인정보의 보유, 이용기간 참조) 일정 기간 저장된 후 파기되어집니다. 동 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.
                              3. 파기방법 : 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하고, 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.

                              제 8조 (링크사이트)
                              촌의감각은 귀하께 다른 회사의 웹사이트 또는 자료에 대한 링크를 제공할 수 있습니다. 이 경우 촌의감각 외부사이트 및 자료에 대한 아무런 통제권이 없으므로 그로부터 제공받는 서비스나 자료의 유용성에 대해 책임질 수 없으며 보증할 수 없습니다. 촌의감각이 포함하고 있는 링크를 클릭(Click)하여 타 사이트(Site)의 페이지로 옮겨갈 경우 해당 사이트의 개인정보처리방침은 촌의감각과 무관하므로 새로 방문한 사이트의 정책을 검토해 보시기 바랍니다.

                              제 9조 (게시물)
                              1. 촌의감각은 귀하의 게시물을 소중하게 생각하여 변조, 훼손, 삭제되지 않도록 최선을 다하여 보호합니다. 그러나 다음의 경우는 그렇지 아니합니다. 
                              - 스팸(spam)성 게시물 및 상업성 게시물 (예: 행운의 편지, 특정사이트 광고 등)
                              - 타인을 비방할 목적으로 허위 사실을 유포하여 타인의 명예를 훼손하는 글
                              - 동의 없는 타인의 신상공개, 제3자의 저작권 등 권리를 침해하는 내용, 기타 게시판 주제와 다른 내용의 게시물
                              2. 촌의감각은 바람직한 게시판 문화를 활성화하기 위하여 동의 없는 타인의 신상 공개 시 특정부분 이동 경로를 밝혀 오해가 없도록 하고 있습니다. 그 외의 경우 명시적 또는 개별적인 경고 후 삭제 조치할 수 있습니다.
                              3. 근본적으로 게시물에 관련된 제반 관리와 책임은 작성자 개인에게 있습니다. 또 게시물을 통해 자발적으로 공개된 정보는 보호받기 어려우므로 정보 공개 전에 심사 숙고하시기 바랍니다.

                              제 10조 (이용자의 권리와 의무)
                              1. 귀하의 개인정보를 최신의 상태로 정확하게 입력하여 불의의 사고를 예방해 주시기 바랍니다. 귀하가 입력한 부정확 한 정보로 인해 발생하는 사고의 책임은 이용자 자신에게 있으며 타인 정보의 도용 등 허위정보를 입력할 경우 회원 자격이 상실될 수 있습니다.
                              2. 귀하는 개인정보를 보호받을 권리와 함께 스스로를 보호하고 타인의 정보를 침해하지 않을 의무도 가지고 있습니다. 비밀번호를 포함한 귀하의 개인정보가 유출되지 않도록 조심 하시고 게시물을 포함한 타인의 개인정보를 훼손하지 않도록 유의해 주십시오. 만약 이 같은 책임을 다하지 못하고 타인의 정보 및 존엄성을 훼손할 시에는 ‘정보통신망이용 촉진및정보보호등에관한법률’ 등에 의해 처벌받을 수 있습니다.
                              3. 온라인상에서(게시판, E-mail, 또는 채팅 등) 귀하가 자발적으로 제공하는 개인정보는 다른 사람들이 수집하여 사용할 수 있음을 항상 유념하시기 바랍니다. 즉, 공개적으로 접속할 수 있는 온라인상에서 개인정보를 게재하는 경우, 다른 사람들로부터 원치 않는 메시지를 답장으로 받게 될 수도 있음을 의미합니다.
                              4. 공공장소에서 이용할 때에는 자신의 비밀번호가 노출되지 않도록 하고 서비스 이용을 마친 후에는 반드시 로그아웃을 해주시기 바랍니다.

                              제 11조 (이용자 및 법정 대리인의 권리와 그 행사방법)
                              1. 귀하는 언제든지 등록되어 있는 자신의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니다.
                              2. 귀하의 개인정보 조회, 수정 또는 가입해지를 위해서는 「마이페이지」버튼을 클릭하여 본인확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. 혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.
                              3. 촌의감각은 귀하의 요청에 의해 해지 또는 삭제된 개인정보는 “제 6조 개인정보의 보유, 이용기간”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.

                              제 12조 (개인정보 자동 수집 장치의 설치, 운영 및 그 거부에 관한 사항)
                              1. 쿠키(cookie)란? 
                              촌의감각은 귀하에 대한 정보를 저장하고 수시로 찾아내는 쿠키(cookie)를 사용합니다. 쿠키는 웹사이트가 귀하의 컴퓨터 브라우저(넷스케이프, 인터넷익스플로러 등)로 전송하는 소량의 정보입니다. 귀하께서 웹사이트에 접속을 하면 촌의감각의 서버는 귀하의 브라우저에 추가정보를 임시로 저장하여 접속에 따른 성명 등의 추가 입력 없이 촌의감각의 서비스를 제공할 수 있습니다. 쿠키는 귀하의 컴퓨터는 식별하지만 귀하를 개인적으로 식별하지는 않습니다. 또한 귀하는 쿠키에 대한 선택권이 있습니다.
                              2. 촌의감각의 쿠키 운용
                              촌의감각은 이용자의 편의를 위하여 쿠키를 운영합니다. 촌의감각이 쿠키를 통해 수집하는 정보는 회원ID에 한하며, 그 외의 다른 정보는 수집하지 않습니다. 촌의감각이 쿠키를 통해 수집한 회원 ID는 다음의 목적을 위해 사용됩니다.
                              ① 개인의 관심 분야에 따란 차별화된 정보를 제공 
                              ② 쇼핑한 품목들에 대한 정보와 장바구니 서비스를 제공 
                              ③ 회원과 비회원의 접속빈도 또는 머문 시간 등을 분석하여 서비스 개편 및 마케팅에 활용
                              3. 쿠키는 브라우저의 종료시나 로그아웃 시 만료됩니다.
                              4. 쿠키의 설치 및 거부
                              ① 귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다. 
                              ② 다만, 쿠키의 저장을 거부할 경우에는 로그인이 필요한 촌의감각 일부 서비스는 이용에 어려움이 있을 수 있습니다. 
                              ③ 쿠키 설치 허용 여부를 지정하는 방법 
                              - Internet Explorer의 경우 : [도구] 메뉴에서 [인터넷 옵션]을 선택 → [개인정보]를 클릭 → [고급]을 클릭 → 쿠키 허용여부를 선택
                              - Safari의 경우 :MacOS 상단 좌측 메뉴바에서 [Safari]에서 [환경설정]을 선택 → [환경설정] 창에서 [보안]으로 이동하여 쿠키 허용여부 선택

                              제 13조 (개인정보 보호문의처)
                              1. 당사는 귀하의 의견을 소중하게 생각하며, 귀하는 의문사항으로부터 언제나 성실한 답변을 받을 권리가 있습니다.
                              2. 당사는 귀하와의 원활한 의사소통을 위해 고객행복센터를 운영하고 있습니다.
                              3. 고객센터의 연락처는 다음과 같습니다.
                              [고객센터]
                              - 이메일 : support@store-chon.com
                              - 전화번호 : 070-4888-3580
                              - 팩스번호 : 02-532-2493
                              - 주소 : 서울특별시 서초구 방배동 931-9 2층
                              4. 전화상담은 월~금요일 오전 10:00 ~ 오후 05:00에만 가능합니다. (주말, 공휴일 휴무)
                              5. 전자우편이나 팩스 및 우편을 이용한 상담은 접수 후 24시간 내에 성실하게 답변 드리겠습니다. 다만 근무시간 이후 또는 주말 및 공휴일에는 익일 처리하는 것을 원칙으로 합니다.
                              6. 기타 개인정보에 관한 상담이 필요한 경우에는 개인정보침해신고센터, 대검찰청 인터넷범죄수사센터, 경찰청 사이버테러대응센터 등으로 문의하실 수 있습니다.
                              [개인정보침해신고센터]
                              118 / http://www.118.or.kr/
                              118@kisa.or.kr / 02-3480-3600 
                              [대검찰청 인터넷범죄수사센터]
                              http://icic.sppo.go.kr/ 02-392-0330 
                              [경찰청 사이버테러대응센터]
                              http://ctrc.go.kr/

                              제 14조 (개인정보보호책임자 및 담당자)
                              촌의감각은 귀하가 좋은 정보를 안전하게 이용할 수 있도록 최선을 다하고 있습니다. 개인정보를 보호하는데 있어 귀하께 고지한 사항들에 반하는 사고가 발생할 시에 개인정보관리책임자가 모든 책임을 집니다. 그러나 기술적인 보완조치를 했음에도 불구하고, 해킹 등 기본적인 네트워크상의 위험성에 의해 발생하는 예기치 못한 사고로 인한 정보의 훼손 및 방문자가 작성한 게시물에 의한 각종 분쟁에 관해서는 책임이 없습니다. 귀하의 개인정보를 취급하는 책임자 및 담당자는 다음과 같으며 개인정보 관련 문의사항에 신속하고 성실하게 답변해드리고 있습니다.

                              [개인정보 관리 책임자]
                              성명 : 김영훈
                              이메일 : yh.kim@minivertising.kr
                              전화: 070-4888-3580
                              Fax: 02-532-2493

                              제 15조 (고지의 의무)
                              개인정보처리방침은 2016년 11월 30일부터 적용됩니다. 내용의 추가, 삭제 및 수정이 있을 시에는 개정 최소 7일전부터 홈페이지의 공지사항을 통하여 고지할 것입니다. 또한 개인정보처리방침에 버전번호 및 개정일자 등을 부여하여 개정여부를 쉽게 알 수 있도록 하고 있습니다.
                              개인정보처리방침 버전번호 : v20161130
                              개인정보처리방침 변경공고일자 : 2016년 11월 30일
                              개인정보처리 시행일자 : 2016년 11월 30일
                            </p>
                          </div>
                        </div>
                        <div class="checks">
                          <span>동의함</span>
                          <input type="checkbox" id="notice2">
                          <label for="notice2"></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="block_btn mt30">
                    <input type="button" class="button_default onColor" id="submit" value="작성완료">
                  </div>
                </form>
              </div>
              <div class="area_main_bottom">

              </div>
            </div>
            <div class="section side">
              <div class="side_full_img">
                <img src="<?=$_mnv_PC_images_url?>side_full.jpg">
              </div>
            </div>
          </div>
        </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
      </div>

<script type="text/javascript">
	var val_check;
	var id_check;
	var user_id;
	var password;
	var passchk;
	var username;
	var zipcode;
	var addr1;
	var addr2;
	var email1;
	var email2;
	var tel1;
	var tel2;
	var tel3;
	var phone1;
	var phone2;
	var phone3;
	var notice1;
	var notice2;
	
	$('#find_addr').on('click', function() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;
				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if(data.userSelectedType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}

				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('addr1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('addr2').focus();
			}
		}).open();
	});

	$(document).ready(function() {
		var select = $("select#email3");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);

			$('#email2').attr('disabled', false);
			var mail = $('#email3').val();
			if(mail=="direct") {
				$('#email2').val('').focus();
			}else{
				$('#email2').val('').val(mail);
				$('#email2').attr('disabled', true);
			}
		});
	});


	$('#submit').on('click', function(){
		if(id_check == 'Y'){
			val_check = validate('join');
		}else{
			alert("아이디를 다시 입력해주세요.");
			$('#user_id').val('').focus;
			return;
		}

		if(val_check){
			$.ajax({
				method: 'POST',
				url: '../../main_exec.php',
				data: {
					exec		: "member_join",
					user_id		: user_id.value,
					password	: password.value,
					username	: username.value,
					zipcode		: zipcode.value,
					addr1		: addr1.value,
					addr2		: addr2.value,
					email1		: email1.value,
					email2		: email2.value,
					emailYN		: $(':radio[name="emailYN"]:checked').val(),
					tel1		: tel1.value,
					tel2		: tel2.value,
					tel3		: tel3.value,
					phone1		: phone1.value,
					phone2		: phone2.value,
					phone3		: phone3.value,
					smsYN		: $(':radio[name="smsYN"]:checked').val(),
					birthY		: $('#birthY').val(),
					birthM		: $('#birthM').val(),
					birthD		: $('#birthD').val()
				},
				success: function(res){
					if(res=='Y'){
						alert("환영합니다! 회원 가입되셨습니다. 로그인 후 이용해 주세요.");
						location.href='./member_login.php';
					}else{
						alert("접속자가 많아 지연되고 있습니다. 다시 시도해 주세요.");
						location.reload();
					}
				}
			});
		}
	});

	function dupli_chk(input) {
		if(input == ""){
			$('#check_alert1').text("아이디를 입력해주세요.");
			return;
		}

		$.ajax({
			method: 'POST',
			url: '../../main_exec.php',
			data: {
				exec   : "duplicate_check",
				input  : input
			},
			success: function(res){
				var regExp1 = /^[a-z]{1}[a-z0-9]{5,11}$/;
				if(res == 'Y' && regExp1.test(input) == true){
					id_check = 'Y';
					$('#check_alert1').text("사용가능한 아이디입니다.");
				}else if(res == 'Y' && regExp1.test(input) == false){
					id_check = 'N';
					$('#check_alert1').text("사용불가능한 아이디입니다.");
				}else{
					id_check = 'D';
					$('#check_alert1').text("중복된 아이디입니다.");
				}
			}
		});
	}
	
	function pass_chk(input) {
		var pass = $('#password').val();
		if(input != pass){
			$('#check_alert2').text("비밀번호가 맞지 않습니다.");
		}else if(input == ''){
			$('#check_alert2').text("비밀번호를 입력해주세요.");
		}else{
			$('#check_alert2').text('');
		}
	}
</script>
</body>
</html>

