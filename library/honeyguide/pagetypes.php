<?php 

return new honeyguide_pagetypes();

class honeyguide_pagetypes {

	var $allfields = [[
		type => 'text',
		description => 'Linkedin profile page', 
		fieldname => 'field_slug'
		], [
		type => 'text',
		description => 'Facebook profile page', 
		fieldname => 'field_slug'
		], [
		type => 'text',
		description => 'Twitter profile page', 
		fieldname => 'field_slug'
	]];

	public function __construct() {
		add_action( 'init', array($this, 'page_types') );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_filter('rwmb_meta_boxes', array($this, 'honeyguide_register_meta_boxes'));
	}

	public function honeyguide_register_meta_boxes( $mb ) {

		if ( ! class_exists( 'Spyc' ) )
			require_once (dirname(__FILE__).'/vendor/spyc/Spyc.php');
//			require_once (get_home_path().'wp-content/plugins/meta-box-template/lib/Spyc.php');

		$mb = Spyc::YAMLLoad(dirname(dirname(dirname(__FILE__))).'/views/fields.yaml');

/*
		foreach (glob(dirname(dirname(dirname(__FILE__))).'/views/pagetypes/*.json') as $filename) {
			if(is_readable($filename)) {
				$mb = json_decode(file_get_contents($filename), true);
			}
		}
*/
		return $mb;
	}

	public function page_types() {
		$labels = array(
			'name'               => _x( 'Team', 'post type general name', 'beeswax' ),
			'singular_name'      => _x( 'Team Member', 'post type singular name', 'beeswax' ),
			'menu_name'          => _x( 'Team', 'admin menu', 'beeswax' ),
			'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'beeswax' ),
			'add_new'            => _x( 'Add New', 'book', 'beeswax' ),
			'add_new_item'       => __( 'Add New Member', 'beeswax' ),
			'new_item'           => __( 'New Member', 'beeswax' ),
			'edit_item'          => __( 'Edit Member', 'beeswax' ),
			'view_item'          => __( 'View Member', 'beeswax' ),
			'all_items'          => __( 'All Members', 'beeswax' ),
			'search_items'       => __( 'Search Team Member', 'beeswax' ),
			'parent_item_colon'  => __( 'Parent Team Member:', 'beeswax' ),
			'not_found'          => __( 'No team member found.', 'beeswax' ),
			'not_found_in_trash' => __( 'No team members found in Trash.', 'beeswax' )
			);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'teammembers' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array( 'title', 'editor', 'thumbnail')
			);
		register_post_type( 'teammembers', $args );

		register_taxonomy('skills', 'teammembers', array(
			'hierarchical'          => false,
			'labels'                => array(
				'name'							=> _x( 'Skills', 'taxonomy general name' ),
				'singular_name'					=> _x( 'Skill', 'taxonomy singular name' ),
				'search_items'					=> __( 'Search Skills' ),
				'all_items'						=> __( 'All Skills' ),
				'parent_item'					=> null,
				'parent_item_colon'				=> null,
				'edit_item'						=> __( 'Edit Skill' ),
				'update_item'					=> __( 'Update Skill' ),
				'add_new_item'					=> __( 'Add New Skill' ),
				'new_item_name'					=> __( 'New Skill Name' ),
				'separate_items_with_commas'	=> __( 'Separate skills with commas' ),
				'add_or_remove_items'			=> __( 'Add or remove skills' ),
				'choose_from_most_used'			=> __( 'Choose from the most used skills' ),
				'not_found'						=> __( 'No skills found.' ),
				'menu_name'         			=> __( 'Skill' )
			),
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'skill' ),
		));

		$labels = array(
			'name'               => _x( 'Services', 'post type general name', 'beeswax' ),
			'singular_name'      => _x( 'Service', 'post type singular name', 'beeswax' ),
			'menu_name'          => _x( 'Services', 'admin menu', 'beeswax' ),
			'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'beeswax' ),
			'add_new'            => _x( 'Add New', 'book', 'beeswax' ),
			'add_new_item'       => __( 'Add New Service', 'beeswax' ),
			'new_item'           => __( 'New Service', 'beeswax' ),
			'edit_item'          => __( 'Edit Service', 'beeswax' ),
			'view_item'          => __( 'View Service', 'beeswax' ),
			'all_items'          => __( 'All Services', 'beeswax' ),
			'search_items'       => __( 'Search Service', 'beeswax' ),
			'parent_item_colon'  => __( 'Parent Service:', 'beeswax' ),
			'not_found'          => __( 'No service found.', 'beeswax' ),
			'not_found_in_trash' => __( 'No services found in Trash.', 'beeswax' )
			);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'services' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
			);
		register_post_type( 'services', $args );
	}

	public function add_meta_box( $post_type ) {
		$post_types = array('team'); 

		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'honeyguide_team' ,__( 'Social Media Links', 'beeswax' ), 
				array( $this, 'render_meta_box_content' ), $post_type, 'advanced', 'high' );
		}

		$post_types = array('service'); 

		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'honeyguide_service' ,__( 'Service details', 'beeswax' ), 
				array( $this, 'render_meta_box_content' ), $post_type, 'advanced', 'high' );
		}

	}

	public function save( $post_id ) {
		foreach ($this->allfields as $fld) {

		if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['honeyguide_team_meta_box_nonce'], 'honeyguide_team_meta_box' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		if ( ! isset( $_POST['honeyguide_team_new_field'] ) ) {
			return;
		}
		$my_data = sanitize_text_field( $_POST['honeyguide_team_'.$fld['fieldname']] );
		update_post_meta( $post_id, '_my_meta_value_key', $my_data );
	}
	}

	public function render_meta_box_content( $post ) {

		wp_nonce_field( 'honeyguide_team_inner_custom_box', 'honeyguide_team_inner_custom_box_nonce' );

		$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		foreach ($this->allfields as $fld) {
			echo '<label for="honeyguide_team_' . $fld['fieldname'] . '">';
			_e( $fld['description'], 'beeswax' );
			echo '</label> ';
			echo '<input type="text" id="honeyguide_team_' . $fld['fieldname'] . '" name="honeyguide_team_' . $fld['fieldname'] . '"';
			echo ' value="' . esc_attr( $value ) . '" size="25" /><br />';
		}
	}
}
