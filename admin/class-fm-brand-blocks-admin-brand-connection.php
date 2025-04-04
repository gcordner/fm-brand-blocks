<?php
/**
 * Admin-side brand <-> block connection logic
 *
 * @package Former_Model_Brand_Blocks
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class FM_Brand_Blocks_Admin_Brand_Connection
 *
 * @package Former_Model_Brand_Blocks
 */
class FM_Brand_Blocks_Admin_Brand_Connection {

	/**
	 * Add the dropdown to the brand edit screen
	 *
	 * @param WP_Term $term The term object for the brand being edited.
	 * @return void
	 */
	public function edit_brand_form_field( $term ) {
		$selected = get_term_meta( $term->term_id, 'associated_brand_block_id', true );
		$blocks   = get_posts(
			array(
				'post_type'      => 'brand_block',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
		?>
		<tr class="form-field">
			<th scope="row">
				<label for="associated_brand_block_id">Associated Brand Block</label>
			</th>
			<td>
				<select name="associated_brand_block_id" id="associated_brand_block_id">
					<option value="">None</option>
					<?php foreach ( $blocks as $block ) : ?>
						<option value="<?php echo esc_attr( $block->ID ); ?>" <?php selected( $selected, $block->ID ); ?>>
							<?php echo esc_html( $block->post_title ); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<p class="description">Select a Brand Block to display on this brand's archive page.</p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save the selected Brand Block ID when the term is edited
	 *
	 * @param int $term_id The ID of the term being edited.
	 * @return void
	 */
	public function save_brand_block_connection( $term_id ) {
		if ( isset( $_POST['associated_brand_block_id'] ) ) {
			update_term_meta( $term_id, 'associated_brand_block_id', intval( $_POST['associated_brand_block_id'] ) );
		}
	}
}
