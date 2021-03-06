<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://blu.com
 * @since      1.0.0
 *
 * @package    Woo_Partner
 * @subpackage Woo_Partner/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Partner
 * @subpackage Woo_Partner/public
 * @author     Your Name <email@example.com>
 */
class Woo_Partner_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $woo_Partner    The ID of this plugin.
	 */
	private $woo_Partner;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $woo_Partner       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $woo_Partner, $version ) {

		$this->woo_Partner = $woo_Partner;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Partner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Partner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->woo_Partner, plugin_dir_url( __FILE__ ) . 'css/woo-Partner-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Partner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Partner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->woo_Partner, plugin_dir_url( __FILE__ ) . 'js/woo-Partner-public.js', array( 'jquery' ), $this->version, false );

	}
	
	// public function woo_Partner_add_shortcode() {

	// 	add_shortcode('woo_partner_ref_access', 'woo_Partner_shortcode_generator');

	// }

	public function woo_Partner_shortcode_generator() {
		
		include_once "partials/woo-Partner-public-display.php";

	}
	
	public function get_referral_link_by_user_id($id)
	{
		global $wpdb;

		$table_name = $wpdb->prefix . 'referral_info';
		$ref_info = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE user_id = " . $id);

		return $ref_info;
		
	}

	public function woo_Partner_user_form_handler()
	{
		add_action( 'admin_post_nopriv_custom_user_form_action', '_handle_user_form_action' );
		add_action( 'admin_post_custom_user_form_action', '_handle_user_form_action' );

		function _handle_user_form_action() {

			global $wpdb;

			if (isset($_POST["remove-ref"]) && $_POST["remove-ref"] + 0 > -1) {
							
				$sql = $wpdb->prepare( "DELETE FROM "  . $wpdb->prefix . "referral_info WHERE id = " . $_POST["remove-ref"] );
				// die($sql);
				$wpdb->query($sql);

			}
			
			wp_redirect( get_site_url($_POST['current-url']) );
			exit;
		}
	}
}
