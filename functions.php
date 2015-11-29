<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

// handy if you write status posts and send them to Twitter

//Mobile detect
require_once('library/mobile_detect.php');
$detect = new Mobile_Detect();


// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once('library/custom-post-type.php'); // you can disable this if you like


/*********************
OTHER INCLUDES
Other less important libraries
*********************/

/************* APP STORE SHORTCODE *****************/
require_once('library/appstore.php');

/************* METABOX *****************/
require_once('library/options/tasc_options.php');
/*
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/library/metabox' ) );
define( 'RWMB_DIR', trailingslashit( STYLESHEETPATH . '/library/metabox' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
// Include the meta box definition (the file where you define meta boxes, see `demo/demo.php`)
include RWMB_DIR . 'metabox_config.php';*/

//SHORTCODES AND CUSTOMIZED CONTENT
require_once('library/shortcodes.php');

//TASC POWER: meausring author algorithm and top authors
require_once('library/tasc_power.php');

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once('library/admin.php'); // this comes turned off by default
show_admin_bar(false);



/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {
  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );

  // launching this stuff after theme setup
  bones_theme_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning empty paragraphs
  add_filter( 'the_content', 'remove_empty_paragraph' );
  
  // cleaning up excerpt
  //add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );

/************* SET CONTENT WIDTH *****************/
if ( ! isset( $content_width ) ) {
	$content_width = 700;
}


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
//add_image_size( 'post-thumb', 470, 470, true );
//add_image_size( 'thumb-rect', 470, 320, true );
//add_image_size( 'thumb-main', 700, 478, true );

//Ricordarsi che sono le thumbnail retina! Vanno divise per due
add_image_size( 'thumb-big', 1280, 845, true ); //Appare 515x340, vecchio 1030x680
add_image_size( 'thumb-normal', 550, 370, true ); //Appare 275x185

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* CHANGE AUTHOR SLUG ********************/

//Utile: http://wordpress.stackexchange.com/questions/5742/change-the-author-slug-from-username-to-nickname
/*add_filter( 'request', 'wpse5742_request' );
function wpse5742_request( $query_vars )
{
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
           
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}

add_filter( 'author_link', 'wpse5742_author_link', 10, 3 );
function wpse5742_author_link( $link, $author_id, $author_nicename )
{
    $author_nickname = get_user_meta( $author_id, 'nickname', true );
    $author_nickname = str_replace(' ', '', $author_nickname);
    if ( $author_nickname ) {
        $link = str_replace( $author_nicename, $author_nickname, $link );
    }
    return $link;
}*/


/***** AMAZON AFFILIATE LINK with skimbu-08 ****/
add_filter('the_content','filter_amazon_associate_filter'); add_filter('comment_text','filter_amazon_associate_filter'); function filter_amazon_associate_filter($content) { $affiliate_code="skimbu08-21"; $content=preg_replace( '/http:\/\/[^>]*?amazon.([^\/]*)\/([^>]*?ASIN|gp\/product|exec\/obidos\/tg\/detail\/-|[^>]*?dp)\/([0-9a-zA-Z]{10})[a-zA-Z0-9#\/\*\-\?\&\%\=\,\._;]*/i', 'http://www.amazon.$1/exec/obidos/ASIN/$3/'.$affiliate_code, $content ); return $content; }



/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input class="iconfont" type="submit" id="searchsubmit" value="e" />
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Cerca su Tasc...','bonestheme').'" />
    </form>';
    return $form;
} // don't remove this bracket!



/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ ?>
			    <!-- custom gravatar call -->
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!


/*********************
TINYMCE EDITOR EDITS
To add the chart count, the buttons etc.
*********************/


/************* TinyMCE *****************/
function akv3_editor_char_count() {
?>
<script type="text/javascript">
(function($) {
	wpCharCount = function(txt) {
		$('.char-count').html("" + txt.length);
	};
	$(document).ready(function() {
		$('#wp-word-count').append('<br />Char count: <span class="char-count">0</span>');
	}).bind( 'wpcountwords', function(e, txt) {
		wpCharCount(txt);
	});
	$('#content').bind('keyup', function() {
		wpCharCount($('#content').val());
	});
}(jQuery));
</script>
<?php
}
add_action('dbx_post_sidebar', 'akv3_editor_char_count');



/*********************
OTHER FUNCTIONS IMPROVEMENTS
Various...
*********************/

//IMAGE DEFAULT LINK
update_option('image_default_link_type','none');


//IS OLD POST??? Funzione che controlla quanto è vecchio un post. Dopo usi es. if ( is_old_post(10) ) {...
function is_old_post($days = 5) {
	$days = (int) $days;
	$offset = $days*60*60*24;
	if ( get_post_time() < date('U') - $offset )
		return true;
	return false;
}


//LIMIT CONTENT es. echo content(43);
function strip_only($str, $tags) {
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) $str = preg_replace('#</?'.$tag.'[^>]*>#is', '', $str);
    return $str;
}


function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = preg_replace('/<img[^>]+./','', $content);
  $content = strip_only($content, '<strong>');
  return $content;
}



//POST IN REVISION
add_action( 'transition_post_status', 'pending_post_status', 10, 3 );

function pending_post_status( $new_status, $old_status, $post ) {
	$editors = get_users('role=tasc_manager');
	$editors2 = get_users('role=editor');
	foreach ($editors as $editor) {
		$editors_emails[] = $editor->user_email;
	}
	foreach ($editors2 as $editor) {
		$editors_emails[] = $editor->user_email;
	}
	$headers[] = 'From: Cast <cast@tasc.it>';
	
	$permalink = get_permalink( $post->ID );
	$title = get_the_title( $post->ID );
	$author = get_the_author_meta( 'display_name' , $post->post_author );
	
    if ( $new_status === "pending" and $old_status != "pending") {
    	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	    wp_mail($editors_emails,$title . ' in attesa di revisione',$title . ' di '. $author . ' è in attesa di revisione. <a href="http://www.tasc.it/wp-admin/post.php?post='. $post->ID .'&action=edit">Revisionalo il prima possibile.</a><br /><p>Se ricevi questa email è perché hai il privilegio di essere Tasc Manager o editore, assicurati che l\'articolo o l\'opinione siano revisionati il prima possibile, se non puoi farlo, senti il tuo team di editori. Ricordati che gli snack e le opinioni vanno pubblicati immediatamente una volta revisionati, mentre gli articoli possono essere programmati per evitare giorni di vuoto.</p><br /><br /> <strong>Go Cast Go Fast. Tasc Power.</strong>',$headers);
    }

}

//GET SHARED COUNT
function getsocialcount($url) {

 // Cache time
 $cache = 600; // seconds
 $tempurl = get_template_directory(); 
 $cacheFile = $tempurl .'/library/cache/counts/' . md5($url) . '.txt';

   if (file_exists($cacheFile) && (time() - $cache < filemtime($cacheFile))) {
   $result = file_get_contents("$cacheFile");
   return $result;

   } else {
	$apikey = "343314987ce3c5e0a1c569c0617a27feeb4921f1";
	$json = file_get_contents("http://free.sharedcount.com/?url=" . rawurlencode($url) . "&apikey=" . $apikey);
	$counts = json_decode($json, true);
    $result = $counts['Twitter'] + $counts['Facebook']['total_count'] + $counts['GooglePlusOne'];

    $fp = fopen($cacheFile, 'w');
    fwrite($fp, $result);
    fclose($fp);
    return $result;

   }
}



//INVIO MAIL UNA VOLTA CHE IL POST È PUBBLICATO
function authorNotification($post_id) {
   $post = get_post($post_id);
   $author = get_userdata($post->post_author);

   $message = "
      Hey ".$author->display_name.",
      Il tuo grande articolo/snack/opinione, ".$post->post_title." è stato revisionato e pubblicato: ".get_permalink( $post_id ).". Grazie!!";
   wp_mail($author->user_email, "Il tuo grande lavoro su Tasc è online", $message);
}
add_action('publish_post', 'authorNotification');
add_action('publish_opinion', 'authorNotification');

//CUSTOM POST TYPES

function my_custom_post_video() {
  $labels = array(
    'name'               => _x( 'Video', 'post type general name' ),
    'singular_name'      => _x( 'Video', 'post type singular name' ),
    'add_new'            => _x( 'Aggiungi Nuovo', 'book' ),
    'add_new_item'       => __( 'Aggiungi Nuovo Video' ),
    'edit_item'          => __( 'Modifica Video' ),
    'new_item'           => __( 'Nuovo Video' ),
    'all_items'          => __( 'Tutti i Video' ),
    'view_item'          => __( 'Guarda Video' ),
    'search_items'       => __( 'Cerca Video' ),
    'not_found'          => __( 'Video non trovato' ),
    'not_found_in_trash' => __( 'Video non trovato nel cestino' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Video'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Raccolta dei video selezionati con cura dal CAST',
    'public'        => true,
    'menu_icon' => 'dashicons-video-alt3',
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'video', $args ); 
}
add_action( 'init', 'my_custom_post_video' );

function my_custom_post_product() {
  $labels = array(
    'name'               => _x( 'Prodotti', 'post type general name' ),
    'singular_name'      => _x( 'Prodotto', 'post type singular name' ),
    'add_new'            => _x( 'Aggiungi Nuovo', 'book' ),
    'add_new_item'       => __( 'Aggiungi Nuovo Prodotto' ),
    'edit_item'          => __( 'Modifica Prodotto' ),
    'new_item'           => __( 'Nuovo Prodotto' ),
    'all_items'          => __( 'Tutti i Prodotti' ),
    'view_item'          => __( 'Guarda i Prodotti' ),
    'search_items'       => __( 'Cerca Prodotti' ),
    'not_found'          => __( 'Prodotto non trovato' ),
    'not_found_in_trash' => __( 'Prodotto non trovato nel cestino' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Prodotti'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Raccolta dei prodotti selezionati con cura dal CAST',
    'public'        => true,
    'menu_icon' => 'dashicons-cart',
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'product', $args ); 
}
add_action( 'init', 'my_custom_post_product' );

function my_custom_post_column() {
  $labels = array(
    'name'               => _x( 'Rubriche', 'post type general name' ),
    'singular_name'      => _x( 'Rubrica', 'post type singular name' ),
    'add_new'            => _x( 'Aggiungi Nuova', 'book' ),
    'add_new_item'       => __( 'Aggiungi Nuova Rubrica' ),
    'edit_item'          => __( 'Modifica Rubrica' ),
    'new_item'           => __( 'Nuova Rubrica' ),
    'all_items'          => __( 'Tutte le Rubriche' ),
    'view_item'          => __( 'Guarda le Rubriche' ),
    'search_items'       => __( 'Cerca Rubriche' ),
    'not_found'          => __( 'Rubrica non trovato' ),
    'not_found_in_trash' => __( 'Rubrica non trovato nel cestino' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Rubriche'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Raccolta delle rubriche gestite dal CAST',
    'public'        => true,
    'menu_icon' => 'dashicons-feedback',
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'column', $args ); 
}
add_action( 'init', 'my_custom_post_column' );

//CUSTOM TAXONOMIES

function my_taxonomies_video() {
  $labels = array(
    'name'              => _x( 'Categorie Video', 'taxonomy general name' ),
    'singular_name'     => _x( 'Categoria Video', 'taxonomy singular name' ),
    'search_items'      => __( 'Cerca Categorie Video' ),
    'all_items'         => __( 'Tutte le Categorie Video' ),
    'parent_item'       => __( 'Genitore Categoria Video' ),
    'parent_item_colon' => __( 'Genitore Categoria Video:' ),
    'edit_item'         => __( 'Modifica Categoria Video' ), 
    'update_item'       => __( 'Aggiorna Categoria Video' ),
    'add_new_item'      => __( 'Aggiungi Nuova Categoria Video' ),
    'new_item_name'     => __( 'Nuova Categoria Video' ),
    'menu_name'         => __( 'Categorie Video' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'video_category', 'video', $args );
}
add_action( 'init', 'my_taxonomies_video', 0 );

function my_taxonomies_product() {
  $labels = array(
    'name'              => _x( 'Categorie Prodotti', 'taxonomy general name' ),
    'singular_name'     => _x( 'Categoria Prodotto', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Product Categories' ),
    'all_items'         => __( 'Tutte le Categorie Prodotto' ),
    'parent_item'       => __( 'Genitore Categoria Prodotto' ),
    'parent_item_colon' => __( 'Genitore Categoria Prodotto:' ),
    'edit_item'         => __( 'Modifica Categoria Prodotto' ), 
    'update_item'       => __( 'Aggiorna Categoria Prodotto' ),
    'add_new_item'      => __( 'Aggiungi Nuova Categoria Prodotto' ),
    'new_item_name'     => __( 'Nuova Categoria Prodotto' ),
    'menu_name'         => __( 'Categorie Prodotti' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'product_category', 'product', $args );
}
add_action( 'init', 'my_taxonomies_product', 0 );

function my_taxonomies_column() {
  $labels = array(
    'name'              => _x( 'Categorie Rubriche', 'taxonomy general name' ),
    'singular_name'     => _x( 'Categoria Rubrica', 'taxonomy singular name' ),
    'search_items'      => __( 'Cerca Categorie Rubriche' ),
    'all_items'         => __( 'Tutte le Categorie Rubriche' ),
    'parent_item'       => __( 'Genitore Categoria Rubrica' ),
    'parent_item_colon' => __( 'Genitore Categoria Rubrica:' ),
    'edit_item'         => __( 'Modifica Categoria Rubrica' ), 
    'update_item'       => __( 'Aggiorna Categoria Rubrica' ),
    'add_new_item'      => __( 'Aggiungi Nuova Categoria Rubrica' ),
    'new_item_name'     => __( 'Nuova Categoria Rubrica' ),
    'menu_name'         => __( 'Categorie Rubriche' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'column_category', 'column', $args );
}
add_action( 'init', 'my_taxonomies_column', 0 );


//SHOP METABOX

define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('MY_THEME_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));
 
add_action('admin_init','my_meta_init');
 
function my_meta_init()
{
    // review the function reference for parameter details
    // http://codex.wordpress.org/Function_Reference/wp_enqueue_script
    // http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 
    //wp_enqueue_script('my_meta_js', MY_THEME_PATH . '/custom/meta.js', array('jquery'));
    wp_enqueue_style('my_meta_css', MY_THEME_PATH . '/custom/shop-meta.css');
 
    // review the function reference for parameter details
    // http://codex.wordpress.org/Function_Reference/add_meta_box
 
    // add a meta box for each of the wordpress page types: posts and pages
    foreach (array('product') as $type) 
    {
        add_meta_box('my_all_meta', 'Prezzo e Descrizione Prodotto', 'my_meta_setup', $type, 'normal', 'high');
    }
     
    // add a callback function to save any data a user enters in
    add_action('save_post','my_meta_save');
}
 
function my_meta_setup()
{
    global $post;
  
    // using an underscore, prevents the meta variable
    // from showing up in the custom fields section
    $meta = get_post_meta($post->ID,'_my_meta',TRUE);
  
    // instead of writing HTML here, lets do an include
    include(MY_THEME_FOLDER . '/custom/shop-meta.php');
  
    // create a custom nonce for submit verification later
    echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
  
function my_meta_save($post_id) 
{
    // authentication checks
 
    // make sure data came from our meta box
    if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;
 
    // check user permissions
    if ($_POST['post_type'] == 'product') 
    {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    }
    else
    {
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }
 
    // authentication passed, save data
 
    // var types
    // single: _my_meta[var]
    // array: _my_meta[var][]
    // grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
    $current_data = get_post_meta($post_id, '_my_meta', TRUE);  
  
    $new_data = $_POST['_my_meta'];
 
    my_meta_clean($new_data);
     
    if ($current_data) 
    {
        if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
        else update_post_meta($post_id,'_my_meta',$new_data);
    }
    elseif (!is_null($new_data))
    {
        add_post_meta($post_id,'_my_meta',$new_data,TRUE);
    }
 
    return $post_id;
}
 
function my_meta_clean(&$arr)
{
    if (is_array($arr))
    {
        foreach ($arr as $i => $v)
        {
            if (is_array($arr[$i])) 
            {
                my_meta_clean($arr[$i]);
 
                if (!count($arr[$i])) 
                {
                    unset($arr[$i]);
                }
            }
            else
            {
                if (trim($arr[$i]) == '') 
                {
                    unset($arr[$i]);
                }
            }
        }
 
        if (!count($arr)) 
        {
            $arr = NULL;
        }
    }
}

?>