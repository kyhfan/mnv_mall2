<?php

require_once ( __DIR__."/unirest-php-master/src/Unirest.php");
		/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
add_theme_support( 'post-thumbnails' );

function solomon_scripts() {
	wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.css', array(), null );
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/css/swiper.min.css', array(), null );
	wp_enqueue_style( 'solomon_style', get_stylesheet_uri(), array(), null );
	wp_enqueue_style( 'jquery-ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', array(), null );
	wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), null );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/js/swiper.min.js', array(), null);
	wp_enqueue_script( 'swiper-jquery', get_template_directory_uri().'/js/swiper.jquery.min.js', array(), null);
	wp_enqueue_script( 'mainjs', get_template_directory_uri().'/js/main.js', array(), null);
	// info
	if ( is_page_template( 'template-process.php' ) ||
		is_page_template( 'template-quickmessage.php' ) ||
		is_page_template( 'template-location.php' ) ) {
		wp_enqueue_style( 'info',  get_template_directory_uri().'/css/info.css', array(), null );
	}
	// soloname board...
	if ( is_page_template( 'template-soloname-baby.php' ) ||
		is_page_template( 'template-soloname-company.php' ) ||
		is_page_template( 'template-review.php' ) ||
		is_page_template( 'template-review-write.php' ) ||
		is_archive( 'soloname') ||
		is_singular( 'solonames' ) ||
		is_singular( 'name_review' ) ||
		is_singular( 'soloname' )) {
		// wp_enqueue_style( 'datepicker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css', array(), null );

		// wp_enqueue_style( 'datepicker', get_template_directory_uri().'/css/bootstrap-datepicker.css', array(), null );
		wp_enqueue_style( 'datepicker-timepicker', '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css', array(), null );
		wp_enqueue_style( 'solonames', get_template_directory_uri().'/css/solonames.css', array(), null );
		// echo is_singular( 'soloname' );
		// die();

		// wp_enqueue_script( 'datetime-pecker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js', array(), null );

		// wp_enqueue_script( 'datepicker', get_template_directory_uri().'/js/bootstrap-datepicker.js', array(), null);		
		// wp_enqueue_script( 'timepicker', '//cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js', null);		
		wp_enqueue_script( 'timepicker-addon', '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js', null);	
		wp_enqueue_script( 'timepicker-i18n', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-ko.js', array(), null);		
		wp_enqueue_script( 'validation', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js', array(), null );
		wp_enqueue_script( 'solonames', get_template_directory_uri().'/js/solonames.js', array(), null );
		// wp_enqueue_script( 'timepicker-i18n', '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.js', array(), null);		
		// wp_enqueue_script( 'timepicker-addon', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.js', array(), null);		
	}
}

add_action( 'wp_enqueue_scripts', 'solomon_scripts' );

function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'solomon-menu' => __( '솔로몬작명소' ),
			'solomon-story' => __( '솔로몬이야기' ),
			'info-menu' => __( '이용안내' ),
			'soloname-write' => __( '작명신청글쓰기' ),
			'soloname-board' => __( '작명신청게시판' ),
		)
	);
}
add_action( 'init', 'register_my_menus' );


function my_acf_save_post($post_id)
{
	// print_r( $_POST );
	// die();
	// exit();
}
add_action('acf/save_post', 'my_acf_save_post', 1);

function my_acf_validate_save_post() {
	// print_r('die');
	// die();
	// exit();
}
add_action('acf/validate_save_post', 'my_acf_validate_save_post', 10, 0);

function my_project_updated_send_email( $post_id ) {

/*	global $post;
	echo $post->post_type;

	echo '<h1>Hello</h1>';
	die();
	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;

	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	$subject = 'A post has been updated';

	$message = "A post has been updated on your website:\n\n";
	$message .= $post_title . ": " . $post_url;

	// Send email to admin.
	wp_mail( 'admin@example.com', $subject, $message );*/
}
add_action( 'save_post', 'my_project_updated_send_email' );

add_filter( 'query_vars', 'add_query_vars_filter' );
function add_query_vars_filter( $query_vars ){
	$query_vars[] = 'paged';
	$query_vars[] = 'search-type';
	$query_vars[] = 'search-text';
	return $query_vars;
}

/**
* Filter the single_template with our custom function
*/
add_filter('single_template', 'my_single_template');

/**
* Single template function which will choose our template
*/
function my_single_template($single) {
	global $wp_query, $post, $wpdb;

	/**
	* Checks for single template by category
	* Check by category slug and ID
	*/
	if( $post->post_type == 'soloname' ):
		$term = $wpdb->get_row( $wpdb->prepare(
			"SELECT * 
			FROM $wpdb->term_relationships
			WHERE object_id = %d",
			$post->ID
		));
		if($term->term_taxonomy_id == 10) :
			return TEMPLATEPATH.'/single-soloname-company.php';
		endif;
	endif;

	return $single;
}

add_filter( 'cancel_comment_reply_link', '__return_false' );
add_filter( 'comment_reply_link', '__return_false' );

function change_up($fields) { 
	$fields['comment_notes_before'] = ''; 
	return $fields; 
} 

add_filter('comment_form_defaults','change_up');

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says"></span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
function save_soloname_post( $post_id ) {

    /*
     * In production code, $slug should be set only once in the plugin,
     * preferably as a class property, rather than in each function that needs it.
     */
    $post_type = get_post_type($post_id);

    // If this isn't a 'book' post, don't update it.
    if ( "soloname" != $post_type ) return;
	
	naverCTS_script();
	daumCTS_script();
	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	$subject = 'A post has been updated';

	$subject = '[작명신청]'.$post_title;

	$message = "신청서가 접수되었습니다:\n\n";
	$message .= $post_title . ": " . $post_url;

	$admin_email = get_option( 'admin_email' );
	// Send email to admin.
	wp_mail( $admin_email, $subject, $message );
}
add_action( 'save_post', 'save_soloname_post', 10, 3 );

// add_action( 'init', 'smart_forms_before_sending_email_function' );
add_action( 'sf_before_saving_form', 'smart_forms_before_sending_email_function');
function smart_forms_before_sending_email_function( $params = "" )
{
	naverCTS_script();
	daumCTS_script();
	
	$form = $params->FormEntryData;
	$name = $form['rnField1']['value'];
	$phone = str_replace( "-", "", $form['rnField2']['value'] );
	$msg_body = "질문자 : ".$name."\n\r전화번호:".$phone;

	$httpmethod = "POST";
	$url = "http://api.openapi.io/ppurio/2/message/sms/ydyang48";
	$clientKey = "NTM4Ni0xNDgwMzA0NDYwMjAwLWQwN2YxZTVjLWFhYjktNDBiOC1iZjFlLTVjYWFiOTUwYjg5Ng==";
	$contentType = "Content-Type: application/x-www-form-urlencoded";

	$headerValue = $clientKey;
	$headers = array("x-waple-authorization:" . $headerValue);

	$params = array(
		'send_time' => '',
		'send_phone' => '0221578285',
		//'dest_phone' => $phone,
		'dest_phone' => '01030033965',
		'send_name' => '',
		'dest_name' => '',
		'subject' => 'title',
		'msg_body' => $msg_body
	);

	//curl initialization
	$curl = curl_init();

	//create request url
	//$url = $url."?".$parameters;

	curl_setopt ($curl, CURLOPT_URL , $url);
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt ($curl, CURLINFO_HEADER_OUT, true);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);

	$response = curl_exec($curl);

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$responseHeaders = curl_getinfo($curl, CURLINFO_HEADER_OUT);


	curl_close($curl);

	$json_data = json_decode($response, true);

/*
	$userid = "ydyang48";
	$api_key = "NTM4Ni0xNDgwMzA0NDYwMjAwLWQwN2YxZTVjLWFhYjktNDBiOC1iZjFlLTVjYWFiOTUwYjg5Ng==";
	//$url = "http://api.openapi.io/ppurio/2.3/message/sms/".$userid;
	$url = "http://api.openapi.io/ppurio/2/message/sms/".$userid;
	//$dest_phone = "01073677758";
	$dest_phone = "01030033965";
	$send_phone = "0221578285";

	$headers = array('x-waple-authorization' => $api_key);
	$query = array(
		'send_time' => date("YmdHis"),
		'dest_phone' => $dest_phone,
		'dest_name' => '',
		'send_phone' => $send_phone,
		//'send_name' => 'sender',
		'subject' => 'title',
		'msg_body' => $msg_body
		//'apiVersion' => '1',
		//'id' => $userid,
		);

	$response = Unirest\Request::post($url, $headers, $query);
*/
}

add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {

	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	$slug = explode( '/' , $url );
	if ( count($slug) > 2 && $slug[1] == "soloname" ) :
        $classes[] = 'single-soloname-'.$slug[2];		
	endif;
    
    return $classes;     
}
function naverCTS_script(){
	?>
	<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"></script> 
	<script type="text/javascript"> 
		var _nasa={};
		_nasa["cnv"] = wcs.cnv("4","10"); 
	
		if (!wcs_add) var wcs_add={};
		wcs_add["wa"] = "s_436ffb68bae7";
		if (!_nasa) var _nasa={};
		wcs.inflow();
		wcs_do(_nasa);

	</script>
	<?php
	sleep(2);
}

function daumCTS_script()
{
	?>
	<SCRIPT LANGUAGE='JavaScript'>
		//<![CDATA[ 
		var DaumConversionDctSv="type=W,orderID=,amount="; 
		var DaumConversionAccountID="9WuXdF3vYzw-htFYZ9cXew00"; 
		if(typeof DaumConversionScriptLoaded=="undefined"&&location.protocol!="file:"){ 
		var DaumConversionScriptLoaded=true; 
		document.write(unescape("%3Cscript%20type%3D%22text/javas"+"cript%22%20src%3D%22"+(location.protocol=="https:"?"https":"http")+"%3A//t1.daumcdn.net/cssjs/common/cts/vr200/dcts.js%22%3E%3C/script%3E")); 
		} 
		//]]>
	</SCRIPT>
	
	
	<?php
	sleep(2);
}
