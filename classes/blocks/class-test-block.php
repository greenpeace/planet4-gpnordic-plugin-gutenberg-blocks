<?php

namespace P4GPNGBKS\Blocks;

if ( ! class_exists( 'Test_Block' ) ) {
	class Test_Block extends Base_Block {
		/**
		 * Outputs an error message
		 *
		 * @param $message
		 */
		public function render_error_message( $message ) {
			// ensure only editors see the error, not visitors to the website
			if ( current_user_can( 'edit_posts' ) ) {
				\Timber::render( P4GPNGBKS_BASE_PATH . 'templates/block-error-message.twig', array(
					'category' => __('Error', 'planet4_gpn_blocks'),
					'message' => $message,
				) );
			}
		}

		/**
		 * Required by the `Base_Block` class.
		 *
		 * @param array $fields Unused, required by the abstract function.
		 */
		public function prepare_data( $fields ): array {
			return [];
		}
	}
}
