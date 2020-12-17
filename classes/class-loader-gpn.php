<?php
/**
 * Base Block Class Doc Comment.
 * Php Version: 7.0
 *
 * @category Wordpress-plugin
 * @package  P4GPNGBKS
 * @author   Greenpeace Nordic <svilena.koleva@greenpeace.org>
 * @license  MIT Licence https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks/blob/master/LICENCE
 * @link     https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks
 */

namespace P4GPNGBKS;

use P4GPNGBKS\Blocks;

/**
 * Base Block Class Comment
 *
 * @package P4GPNGBKS\Blocks
 * @var     P4_GPN_GBKS
 */
if (! class_exists('P4_GPN_GBKS') ) {
    class P4_GPN_GBKS
    {
		/**
		 * Creating a singleton instance.
		 *
		 * @var P4_GPN_GBKS
		 */
		private static $instance;

        /**
		 * Base block class instances.
		 *
		 * @var $blocks
		 */
		private $blocks;

		/**
		 * Returns the instance.
		 *
		 * @return P4_GPN_GBKS
		 */
		public static function get_instance() : P4_GPN_GBKS {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {

		// $this->load_files();
		// $this->check_plugin_dependencies();
		// Check dependencies
		add_action( 'plugins_loaded', array( $this, 'check_plugin_dependencies' ) );

		// Scripts & Styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Register a block category
		add_filter( 'block_categories', array( $this, 'register_block_category' ), 10, 2 );

		// Load Blocks
		$this->blocks = [
			new Blocks\Test_Block(),
		];
		}

		/**
		 * Loads all shortcake blocks registered from within this plugin.
		 *
		 * @param array  $services The Controller services to inject.
		 * @param string $view_class The View class name.
		 */
		public function load_services( $services, $view_class ) {
			$this->services = $services;
			$this->view     = new $view_class();

			if ( $this->services ) {
				foreach ( $this->services as $service ) {
					( new $service( $this->view ) )->load();
				}
			}
		}
		/**
		 * Check for dependencies and output an error message if needed
		 */
		public function check_plugin_dependencies() {
			// Output an error message in case ACF isn't installed.
			if ( ! class_exists( 'ACF' ) ) {
				add_action( 'admin_notices', array( $this, 'error_message_no_acf' ) );
			}
			// Output an error message in case Timber isn't installed.
			if ( ! class_exists( 'Timber' ) ) {
				add_action( 'admin_notices', array( $this, 'error_message_no_timber' ) );
			}
		}

		/**
		 * Registers a new categories for our blocks
		 *
		 * @param $categories
		 * @param $post
		 *
		 * @return array
		 */
		public function register_block_category( $categories, $post ) {
			return array_merge(
				$categories,
				array(
					array(
						'slug'  => 'gpn',
						'title' => __( 'Planet 4 GPN', 'planet4-gpn-blocks' ),
					),
				)
			);
		}

		/**
		 * Outputs an error message in Wordpress admin about ACF not being installed
		 */
		public function error_message_no_acf() {
			?>
            <div class="error notice">
                <p><?php _e( 'Planet4 GPN Blocks: Advanced Custom Fields must be installed and activated for this plugin to work.', 'planet4-gpn-blocks' ); ?></p>
            </div>
			<?php
		}

		/**
		 * Outputs an error message in Wordpress admin about Timber not being installed
		 */
		public function error_message_no_timber() {
			?>
            <div class="error notice">
                <p><?php _e( 'Planet4 GPN Blocks: Timber must be installed and activated for this plugin to work.', 'planet4-gpn-blocks' ); ?></p>
            </div>
			<?php
		}

		/**
		 * Disable the cloning of this class.
		 *
		 * @return void
		 */
		final public function __clone() {
			throw new Exception('Class cloning disabled.');
		}

		/**
		 * Disable the wakeup of this class.
		 *
		 * @return void
		 */
		final public function __wakeup() {
			// We don't want this object to be serialisable because you could unserialise it multiple times to result in multiple instances of the class.
			throw new Exception('Feature disabled.');
		}

		/**
		 * Enqueue the scripts
		 */
		public function enqueue_scripts() {
			$file = 'assets/css/style.css';

			wp_enqueue_style( 'planet4-gpn-blocks-style',
			P4GPNGBKS_BASE_URL . $file,
				null,
				filemtime( P4GPNGBKS_BASE_PATH . $file )
			);

			$js = 'assets/js/blocks.js';

			wp_enqueue_script( 'planet4-gpn-blocks-js',
			P4GPNGBKS_BASE_URL . $js,
				array( 'jquery' ),
				filemtime( P4GPNGBKS_BASE_PATH . $js ),
				true );

			// Make the assets URL availabel in JS
			$script = 'var gpnBlocksAssetsURL = "' . P4GPNGBKS_BASE_URL . 'assets/"';

			wp_add_inline_script('planet4-gpn-blocks-js', $script, 'before');
		}


    }
}
