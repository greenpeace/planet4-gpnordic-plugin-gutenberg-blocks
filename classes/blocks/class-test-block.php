<?php
/**
 * Test ACF Block Class Doc Comment.
 * Php Version: 7.0
 *
 * @category Wordpress-plugin
 * @package  P4GPNGBKS
 * @author   Greenpeace Nordic <svilena.koleva@greenpeace.org>
 * @license  MIT Licence https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks/blob/master/LICENCE
 * @link     https://github.com/greenpeace/planet4-gpnordic-plugin-gutenberg-blocks
 */

namespace P4GPNGBKS\Blocks;

if (! class_exists('Test_Block') ) {
    class Test_Block extends Base_Block {
		/**
		 * @var string Template file path
		 */
		protected $template_file = P4GPNGBKS_BASE_PATH . 'templates/blocks/testimonial.twig';

        public function __construct() {
            $this->register_acf_field_group();

            add_action('acf/init', array( $this, 'register_acf_block' ));
		}

		/**
		 * Registers a field group with Advanced Custom Fields
		 */
		protected function register_acf_field_group() {
			if( function_exists('acf_add_local_field_group') ):
				acf_add_local_field_group(array(
					'key' => 'group_p4_gpn_blocks_testimonial',
					'title' => 'Testimonial',
					'fields' => array(
						array(
							'key' => 'field_group_p4_gpn_blocks_testimonial_group',
							'label' => 'Testimonial group',
							'name' => 'testimonial-elements',
							'type' => 'group',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => 'field_p4_gpn_blocks_testimonial_testimonial',
							'min' => 0,
							'max' => 0,
							'layout' => 'block',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_p4_gpn_blocks_testimonial_author',
									'label' => 'Author',
									'name' => 'author',
									'type' => 'text',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => 'author',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => 'Jane Doe',
									'prepend' => '',
									'append' => '',
									'maxlength' => 100,
								),
								array(
									'key' => 'field_p4_gpn_blocks_testimonial_testimonial',
									'label' => 'Testimonial',
									'name' => 'testimonial',
									'type' => 'wysiwyg',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => 'testimonial',
										'id' => '',
									),
									'default_value' => 'Everything will be OK in the end. If it\'s not okay - it\'s not the end.',
									'tabs' => 'all',
									'toolbar' => 'full',
									'media_upload' => 0,
									'delay' => 0,
								),
								array(
									'key' => 'field_p4_gpn_blocks_testimonial_background_color',
									'label' => 'Background Color',
									'name' => 'background_color',
									'type' => 'color_picker',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => 'bgr-color',
										'id' => '',
									),
									'default_value' => '#fff',
								),
								array(
									'key' => 'field_p4_gpn_blocks_testimonial_text_color',
									'label' => 'Text color',
									'name' => 'text_color',
									'type' => 'color_picker',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => 'txt-color',
										'id' => '',
									),
									'default_value' => '#000',
								),
							),
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'block',
								'operator' => '==',
								'value' => 'acf/p4-gpn-block-testimonial',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				));
			endif;
		}

        public function register_acf_block() {
            // check function exists
            if(function_exists('acf_register_block') ) {
                // register a testimonial block
                acf_register_block(
                    array(
                    'name'               => 'p4-gpn-block-testimonial',
                    'title'              => __('Testimonial', 'planet4-gpn-blocks'),
                    'description'        => __('A custom testimonial block.', 'planet4-gpn-blocks'),
                    'render_callback'    => array( $this, 'render_block'),
                    'category'           => 'gpn',
                    'icon'               => 'admin-comments',
                    'keywords'           => array( 'testimonial', 'quote' ),
                    )
                );
            }
		}

		/**
		 * Callback function to render the content block
		 *
		 * @param $block
		 */
		public function render_block( $block ) {
			$fields = get_fields();

			// Prepare parameters for template
			$params = array(
				'elements'   => $fields['testimonial-elements'],
			);

			// Output template
			\Timber::render( $this->template_file, $params );
		}

        /**
         * Outputs an error message
         *
         * @param $message
         */
        public function render_error_message( $message )
        {
            // ensure only editors see the error, not visitors to the website
            if (current_user_can('edit_posts') ) {
                \Timber::render(
                    P4GPNGBKS_BASE_PATH . 'templates/block-error-message.twig', array(
                    'category' => __('Error', 'planet4_gpn_blocks'),
                    'message' => $message,
                    )
                );
            }
        }

        /**
         * Required by the `Base_Block` class.
         *
         * @param array $fields Unused, required by the abstract function.
         */
        public function prepare_data( $fields ): array
        {
            return [];
        }
    }
}
