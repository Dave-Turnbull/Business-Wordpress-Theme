<?php
   /*
   Plugin Name: Staff and Downloads Plugin
   description: A plugin to add Staff & Downloads to a wordpress theme
   Version: 1.0
   Author: Turnbull Creative
   Author URI: https://turnbullcreative.com
   */

//* Create 'Staff' Custom Post Type
add_action( 'init', 'add_custom_post_type' );
function add_custom_post_type() {

	register_post_type( 'staff',
		array(
			'labels' => array(
				'name'          => __( 'Our Staff'),
				'singular_name' => __( 'Employee'),
			),
			'has_archive'  => true,
            'menu_icon'    => 'dashicons-admin-users',
			'public'       => true,
			'rewrite'      => array( 'slug' => 'staff'),
			'supports'     => array( 'title', 'thumbnail', 'excerpt'),
			'taxonomies'   => array( 'staff-type' ),
            'menu_position' => 2,

		));
	
}

?>

<?php
/**
 * Add the download post type
 */
add_action( 'init', 'tarp_create_download_post_type' );

function tarp_create_download_post_type() {

   register_post_type( 'item_download', array(
      'description'         => 'The latest downloads',
      'has_archive'         => 'downloads', // The archive slug
      'rewrite'             => array( 'slug' => 'download' ), // The individual download slug
      'supports'            => array( 'title', 'excerpt', 'thumbnail', 'custom-fields' ),
      'public'              => true,
      'show_ui'             => true,
      'exclude_from_search' => true,
      'labels' => array(
         'name'               => 'Downloads',
         'add_new'            => 'Add New',
         'add_new_item'       => 'Add New Download',
         'edit'               => 'Edit',
         'edit_item'          => 'Edit Download',
         'new_item'           => 'New Download',
         'view'               => 'View Download',
         'view_item'          => 'View Download',
         'search_items'       => 'Search Downloads',
         'not_found'          => 'No downloads found',
         'not_found_in_trash' => 'No downloads found in Trash',
      )
   ));

/**
 * Custom "Download Categories" taxonomy
 */
register_taxonomy( 'download-categories', array( 'item_download' ),
  array(
	'public' => true,
	'labels' => array( 'name' => 'Download Categories', 'singular_name' => 'Download Category' ),
	'hierarchical' => false
  )
);

/**
 * Adds the download meta box for the download post type
 */
function tarp_meta_box_download() {
    add_meta_box( 'tarp-meta-box-download', 'Download Settings', 'tarp_meta_box_download_display', 'item_download', 'normal', 'high' );
  }
  
  add_action( 'add_meta_boxes', 'tarp_meta_box_download' );

}

/**
 * Displays the download meta box
 */
function tarp_meta_box_download_display( $object, $box ) {

    // Setup some default values
    $defaults = array( 
     'file'    => ''
     // Add more!
    );
 
    // Get the post meta
   $download = get_post_meta( $object->ID, 'download', true );
 
   // Merge them
   $download = wp_parse_args( $download, $defaults );

?>

<input type="hidden" name="tarp-meta-box-download" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />

<br />

<table class="form-table">

   <thead><tr><th><span class="description">Upload the file you'd like to add:</span></th></tr></thead>

   <tr>
      <th><label for="download-file">File</label></th>
      <td>
         <input type="text" id="download-file" size="60" name="download-file" value="<?php echo esc_url( $download['file'] ); ?>" />
         <input type="button" id="upload-file-button"  class="button" value="Upload file" />
         <label for="download-file"><span class="description">Upload or link to download file</span></label>
      </td>
   </tr>

</table>

<?php }

/**
 * Save the download information
 */
function tarp_meta_box_download_save( $post_id, $post ) {

   /* Verify that the post type supports the meta box and the nonce before preceding. */
   if ( ! isset( $_POST['tarp-meta-box-download'] ) || ! wp_verify_nonce( $_POST['tarp-meta-box-download'], basename( __FILE__ ) ) )
	return $post_id;

   /* Don't save them if... */
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return;
   if ( defined( 'DOING_CRON' ) && DOING_CRON ) return;

   /* Get the post type object. */
   $post_type = get_post_type_object( $post->post_type );

   /* Check if the current user has permission to edit the post. */
   if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
	return $post_id;

/**
 * Add the download meta
 */
   update_post_meta( $post_id, 'download', array( 
	'file'    => esc_url_raw( $_POST['download-file'] )
	// Add your own if you've added fields
   ) ); 
}

add_action( 'save_post', 'tarp_meta_box_download_save', 10, 2 );

/**
 * Adds the script needed for the file upload 
 */
function item_download_metabox_script() {

    $screen = get_current_screen(); 
 
    // Make sure we are on the Download screen
    if ( isset( $screen->post_type ) && $screen->post_type == 'item_download' ) : ?>
 
     <script type="text/javascript">
     jQuery(document).ready(function($){

        $('#upload-file-button').click(function(e) {
            e.preventDefault();
            var documentFile = wp.media({ 
                title: 'Upload File',
                // mutiple: true if you want to upload multiple files at once
                multiple: false
            }).open()
            .on('select', function(e){
                // This will return the selected documentFile from the Media Uploader, the result is an object
                var uploaded_documentFile = documentFile.state().get('selection').first();
                // We convert uploaded_documentFile to a JSON object to make accessing it easier
                // Output to the console uploaded_documentFile
                console.log(uploaded_documentFile);
                var documentFile_url = uploaded_documentFile.toJSON().url;
                // Let's assign the url value to the input field
                $('#download-file').val(documentFile_url);
            });
        });
     });
         </script>
 
     <?php
     endif;
 }

//Change the Excerpt description

add_filter('gettext', 'Excerptrenamefordownloads', 10, 2);
function Excerptrenamefordownloads($translation, $original)
{
    if (get_post_type( ) == 'item_download') {
        if ('Excerpt' == $original) {
            return '(Optional) Add a description';
        } else {
            $pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');
            if ($pos !== false) {
                return  'This will show on the computer when you hover your mouse over the download button.';
            }
        }
    }
    return $translation;
}
 
 add_action( 'admin_footer', 'item_download_metabox_script' );


 /**
 * Download archive pages
 */
function item_download_cpt_archives( $query ) {
 
    /* Download categories archive page. */
    if ( is_tax( 'download-categories' ) && $query->is_main_query() ) {
       $query->set( 'post_type', 'item_download' );
    }
 
    return $query;
 }
 
 add_action( 'pre_get_posts', 'item_download_cpt_archives' );