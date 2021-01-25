<?php
/**
 * Base block class.
 *
 * @package GP4GPNGBKS
 */


namespace P4GPNGBKS\Blocks;
/**
 * Class Base_Block
 *
 * @package P4GPNGBKS\Blocks
 */

if (! class_exists('Base_Block') ) {
    abstract class Base_Block
    {

        /**
         * Get all the data that will be needed to render the block correctly.
         *
         * @param array $fields This is the array of fields of this block.
         *
         * @return array The data to be passed in the View.
         */
        abstract public function prepare_data( $fields ): array;

        /**
         * @param array $attributes Block attributes.
         *
         * @return mixed
         */
        public function render( $attributes )
        {

            $data = $this->prepare_data($attributes);

            \Timber::$locations = P4GPNGBKS_PLUGIN_DIR . '/templates/blocks';

            $block_output = \Timber::compile(static::BLOCK_NAME . '.twig', $data);

        // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
            $empty_message = defined('static::EMPTY_MESSAGE') ? __(static::EMPTY_MESSAGE, 'planet4-gpn-blocks') : "Block content is empty. Check the block's settings or remove it.";

            // Return empty string if rendered output contains only whitespace or new lines.
            // If it is a rest request from editor/admin area, return a message that block has no content.
            $empty_content = $this->is_rest_request() ? '<div class="EmptyMessage">' . $empty_message . '</div>' : '';

            return ctype_space($block_output) ? $empty_content : $block_output;
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
    }
}
