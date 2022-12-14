<?php
/**
 * Plugin Name: Messages
 */

/**
 * Plugin Name:       Messages
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ariel Rocca
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       messages-plugin
 * Domain Path:       /languages
 */

/*
* Constants Definitions
*/
define('WPM_MESSAGES', "messages");
define('WPM_MESSAGES_VERSION', "1.0.0");
define('WPM_PREFFIX', "wpm_");


if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Register the "message" custom post type
 */
function WPM_setup_post_type() {
	$labels = [
		'name' => __('Messages','messages-plugin'),
		'singular_name' => __('Message','messages-plugin'),
		'menu_name' => __('Messages','messages-plugin'),
		'name_admin_bar' => __('Message','messages-plugin'),
		'add_new' => __('Add New','messages-plugin'),
		'add_new_item' => __('Add New Message','messages-plugin'),
		'new_item' => __('New Message','messages-plugin'),
		'edit_item' => __('Edit Message','messages-plugin'),
		'view_item' => __('View Message','messages-plugin'),
		'all_items' => __('All Messages','messages-plugin'),
		'search_items' => __('Search Messages','messages-plugin'),
		'parent_item_colon' => __('Parent Messages:','messages-plugin'),
		'not_found' => __('No messages found.','messages-plugin'),
		'not_found_in_trash' => __('No messages found in Trash.','messages-plugin'),
		'featured_image' => __('Message Cover Image','messages-plugin'),
		'set_featured_image' => __('Set cover image','messages-plugin'),
		'remove_featured_image' => __('Remove cover image','messages-plugin'),
		'use_featured_image' => __('Use as cover image','messages-plugin'),
		'archives' => __('Message archives','messages-plugin'),
		'insert_into_item' => __('Insert into messages','messages-plugin'),
		'uploaded_to_this_item' => __('Uploaded to this message','messages-plugin'),
		'filter_items_list' => __('Filter messages list','messages-plugin'),
		'items_list_navigation' => __('Messages list navigation','messages-plugin'),
		'items_list' => __('Messages list','messages-plugin'),
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => [ 'slug' => 'message' ],
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => ['title', 'editor', 'author' ],
		'menu_icon' => 'dashicons-format-chat'
	];

	register_post_type( 'message', $args ); 
}
add_action( 'init', 'WPM_setup_post_type' );

/**
 * Activate the plugin.
 */
function WPM_activate() { 
	WPM_setup_post_type();
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'WPM_activate' );

/**
 * Deactivation hook.
 */
function WPM_deactivate() {
	unregister_post_type( 'messages' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'WPM_deactivate' );

/**
 * It Register the Plugin Setting.
 */
function wpm_register_wpm_settings() {
	register_setting( 'wpm_settings', 'key', 'intval' );
	register_setting( 'wpm_settings', 'secret', 'intval' );
	register_setting( 'wpm_settings', 'phonenumber', 'intval' ); 

	// register a new section
	add_settings_section(
		'wpm_settings_section',
		'WPM Settings Section', 
		'wpm_settings_section_callback',
		'wpm_settings'
	);

	// register a new field in the section
	add_settings_field(
		'wpm_settings_field',
		'WPM Setting', 
		'wpm_settings_field_callback',
		'wpm_settings',
		'wpm_settings_section'
	);
}

// section content cb
function wpm_settings_section_callback() {
	echo '<p>WPOrg Section Introduction.</p>';
}

// field content cb
function wpm_settings_field_callback() {
	$setting = get_option('wporg_setting_name');
	?>
	<input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

/**
 * Messages SubMenu fn.
 */
function wpm_setup_page_html() {
	
	loadCssJSScript();
    $messagesList = [];
	$contacts = [];

	?>
    <div class="wrap wpm-options">
      	<h1 class="wp-heading-inline"><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<h2 class="nav-tab-wrapper" id="wp-tabs">
			<a class="nav-tab nav-tab-active" id="messages-sending-tab" href="#messages-sending">Envío de Mensajes</a>
			<a class="nav-tab" id="messages-tab" href="#messages">Mensajes</a>
			<a class="nav-tab" id="contacts-tab" href="#contacts">Contactos</a>
			<a class="nav-tab" id="contacts-lists-tab" href="#contacts-lists">Listas de Contactos</a>
			<a class="nav-tab" id="scheduling-tab" href="#scheduling">Programar Envíos</a>
			<a class="nav-tab" id="setup-tab" href="#setup">Configuración</a>
		</h2>
		<div id="messages-sending-tab" class="wp-tab wp-tab-visible">
			<div class="wp-tab-title">
				Messages Sending
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th>Seleccionar Mensaje:</th>
						<td>
							<div class="alignleft actions">
								<label for="message-action-selector" class="screen-reader-text">Selecciona Mensaje</label>
								<select name="action" id="message-action-selector">
									<option value="-1">Selecciona Mensaje</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th>Seleccionar Lista:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="contact-list-action-selector" class="screen-reader-text">Selecciona Lista de Contactos</label>
								<select name="action" id="contact-list-action-selector">
									<option value="-1">Selecciona Lista de Contactos</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th>Contactos de la lista:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="contact-action-selector" class="screen-reader-text">Selecciona Contacto</label>
								<select name="action" id="contact-action-selector">
									<option value="-1">Selecciona Contacto</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Enviar Mensaje', 'primary', 'messages-sending-action');?></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="messages-tab" class="wp-tab">
			<div class="wp-tab-title">
				Messages
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th>Seleccionar Mensaje:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="message-action-selector" class="screen-reader-text">Selecciona Mensaje</label>
								<select name="action" id="message-action-selector">
									<option value="-1">Selecciona Mensaje</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Guardar Mensaje', 'primary', 'messages-action' );?></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="contacts-tab" class="wp-tab">
			<div class="wp-tab-title">
				Contacts
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
							<th>Contactos de la lista:</th>
							<td>
								<div class="alignleft actions bulkactions">
									<label for="contacts-action-selector" class="screen-reader-text">Selecciona Contacto</label>
									<select name="action" id="contacts-action-selector">
										<option value="-1">Selecciona Contacto</option>
									</select>
								</div>
							</td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Modificar Contacto', 'primary', 'contacts-action' );?></td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Borrar Contacto', 'primary', 'contacts-action' );?></td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Añadir Contacto', 'primary', 'contacts-action' );?></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="contacts-lists-tab" class="wp-tab">
			<div class="wp-tab-title">
				Contacts lists
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th>Lista:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="contact-list-action-selector" class="screen-reader-text">Selecciona Lista de Contactos</label>
								<select name="action" id="contact-list-action-selector">
									<option value="-1">Selecciona Lista de Contactos</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th>Contactos de la lista:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="contacts-action-selector" class="screen-reader-text">Selecciona Contacto</label>
								<select name="action" id="contacts-action-selector">
									<option value="-1">Selecciona Contacto</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Añadir Contacto', 'primary', 'contacts-lists-action' );?></td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Quitar Contacto', 'primary', 'contacts-lists-action' );?></td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Guardar Lista', 'primary', 'contacts-lists-action' );?></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="scheduling-tab" class="wp-tab">
			<div class="wp-tab-title">
				Scheduling
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Seleccionar fecha:</th>
						<td>
							<div class="date-selector">
								<input type="text" 
									name="sending_date" 
									value="<?php echo esc_attr( get_option('key') ); ?>" 
								/>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th>Seleccionar Mensaje:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="message-action-selector" class="screen-reader-text">Selecciona Mensaje</label>
								<select name="action" id="message-action-selector">
									<option value="-1">Selecciona Mensaje</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th>Seleccionar Lista de Contactos:</th>
						<td>
							<div class="alignleft actions bulkactions">
								<label for="contact-list-action-selector" class="screen-reader-text">Selecciona Lista de Contactos</label>
								<select name="action" id="contact-list-action-selector">
									<option value="-1">Selecciona Lista de Contactos</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<td class="submit"><?php submit_button( 'Programar Envío', 'primary', 'scheduling-action' );?></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="setup-tab" class="wp-tab">
			<div class="wp-tab-title">
				Configuración
			</div>
			<form action="<?php menu_page_url( 'wpm_submenu' ) ?>" method="post">
				<?php
				settings_fields( 'wpm_options' );
				do_settings_sections( 'wpm' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Key:</th>
						<td><input type="text" name="key" value="<?php echo esc_attr( get_option('key') ); ?>" /></td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Secret:</th>
						<td><input type="text" name="secret" value="<?php echo esc_attr( get_option('secret') ); ?>" /></td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Phonenumber:</th>
						<td><input type="text" name="phonenumber" value="<?php echo esc_attr( get_option('phonenumber') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<td><?php submit_button( 'Guardar Configuración', 'primary', 'setup-action');?></td>
					</tr>
				</table>
			</form>
		</div>
    </div>
    <?php
}

/**
 * Plugin Menu Registering.
 */
if ( is_admin() ) add_action( 'admin_menu', 'wpm_options_page' );
function wpm_options_page() {
	$hookname = add_submenu_page(
		'edit.php?post_type=message',
		'WPM Setup',
		'WPM Setup',
		'manage_options',
		'wpm-setup',
		'wpm_setup_page_html'
	);

	add_action( 'load-' . $hookname, 'wpm_submenu_options_page_submit' );
	
	if ( is_admin() ) add_action( 'admin_init', 'wpm_register_wpm_settings' );
}

/**
 * It handles the submenu options page form submit.
 */
function wpm_submenu_options_page_submit() {
	/*
	echo '<pre>';
	var_dump($_POST);
	exit();
	*/
	$option_page = checkNotEmpty($_POST["option_page"]);
	$action = checkNotEmpty($_POST["action"]);
	$wpnonce = checkNotEmpty($_POST["_wpnonce"]);
	$key = sanitize_text_field( checkNotEmpty($_POST["key"]) );
	$secret = sanitize_text_field( checkNotEmpty($_POST["secret"]) );
	$phonenumber = sanitize_text_field( checkNotEmpty($_POST["phonenumber"]) );

	$deprecated = null;
	$autoload = 'no';

	$form = [
		'WPM_key' => $key,
		'WPM_secret' => $secret,
		'WPM_phonenumber' => $phonenumber,
	];

	foreach ($form as $item => $value) {
		if ( get_option( $item ) !== false ) {
			update_option( $item, $value );
		} else {
			add_option( $item, $value, $deprecated, $autoload );
		}		
	}
}

/**
 * It Enqueues the Css and JS scripts.
 */
function loadCssJSScript(){
	wp_enqueue_style('main-style', 
		plugins_url( '/assets/css/main.css', __FILE__ ), 
		[],
		'all'
	);
	wp_enqueue_style( 'jquery-ui',
		plugins_url( '/assets/css/jquery-ui.css', __FILE__ ), 
		[],
		'all'
	);
	wp_enqueue_style( 'jquery-ui-theme',
		plugins_url( '/assets/css/jquery-ui.theme.css', __FILE__ ), 
		[],
		'all'
	);
	wp_register_script(
		'main-script',
		plugins_url( '/assets/js/main.js', __FILE__ ),
		[ 'jquery', 'jquery-ui-datepicker'],
		'1.0.,0',
		true
	);

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.value
	wp_localize_script( 'main-script', 'ajax_object',
		[ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] 
	);

	wp_enqueue_script( 'main-script' );
}


/**
 * Ajax Request Handlers Functions
 */

/**
 * Ajax
 * GET
 * 
 * Get All Messages
 * 
 */
add_action( 'wp_ajax_messages', 'my_ajax_messages_handler' );
function my_ajax_messages_handler() {
	$id = checkNotEmpty(wp_unslash($_POST['id']));
	$messages = getMessages($id);
echo '<pre>';var_dump($messages);exit();
	wp_send_json($messages, 200);
}

/**
 * Ajax
 * GET
 * 
 * Get All Contact Lists
 * 
 * @param
 * @return
 * 
 */
add_action( 'wp_ajax_contact_lists', 'my_ajax_contact_lists_handler' );
function my_ajax_contact_lists_handler() {
	$id = checkNotEmpty(wp_unslash($_POST['id']));
	$lists = getContactLists($id);

	wp_send_json($lists, 200);
}

/**
 * Ajax
 * GET
 * 
 * Get All Contacts
 * 
 */
add_action( 'wp_ajax_contacts', 'my_ajax_contacts_handler' );
function my_ajax_contacts_handler() {
	$id = checkNotEmpty(wp_unslash($_POST['id']));
	$listId = checkNotEmpty(wp_unslash($_POST['listId']));

	if($listId) $contacts = getContactsByList($listId);
	else $contacts = getContacts($id);

	wp_send_json($contacts, 200);
}

/**
 * Data Query Functions
 */

function getMessages($id = false){
	global $wpdb;

	$query = "SELECT * FROM $wpdb->messages";

	$params = [];
	if ($id) {
		$params['id'] = $id;
		$query .= " WHERE ID = $id";
	}

	$query .= " LIMIT 0, 10";

	$results = $wpdb->get_results( $query, OBJECT );

	return $results;
}

function getContacts($id = false){
	global $wpdb;

	$query = "SELECT * FROM {$wpdb->contacts}";

	$params = [];
	if ($id) { 
		$params['id'] = $id;
		$query .= " WHERE ID = $id";
	}

	$query .= " LIMIT 0, 10";

	$results = $wpdb->get_results( $query, OBJECT );

	return $results;
}

function getContactLists($id = false){
	global $wpdb;

	$query = "SELECT * FROM {$wpdb->prefix}$wpdb->contact_lists";

	$params = [];
	if ($id) {
		$params['id'] = $id;
		$query .= " WHERE ID = $id";
	}

	$query .= " LIMIT 0, 10";

	$results = $wpdb->get_results( $query, OBJECT );

	return $results;
}

function getContactsByList($id = false){
	global $wpdb;

	$query = "SELECT * FROM {$wpdb->prefix}$wpdb->contact_lists as CL";

	$params = [];
	if ($id) {
		$params['id'] = $id;
		$query .= " JOIN {$wpdb->prefix}$wpdb->contacts as C
		ON CL.ID = C.ID
		WHERE ID = $id";
	}

	$query .= " LIMIT 0, 10";

	$results = $wpdb->get_results( $query, OBJECT );

	return $results;
}

/**
 * Validation & Sanitization Functions
 */

function checkNotEmpty($value){
	return ( isset($value) && !empty($value) ) ? $value : false;
}

function checkValidLength($length, $value){
	return strlen($value) >= $length;
}

?>