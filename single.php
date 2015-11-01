<?php

/**

 * The Template for displaying all single posts.

 *

 * @package metro-creativex

 */

get_header(); ?>



	<?php  while ( have_posts() ) : the_post(); ?>

			<?php

				do_action('single_header');

			?>

		</div><!--/topside-->

		<?php

			do_action('metro_customizr_single_header');

		?>

		<div id="content">

			<div <?php post_class(); ?>>

				<?php

					$metro_creativex_posttitle = get_the_title();

					$metro_creativex_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

					if(isset($metro_creativex_feat_image[0])):

						echo '<div class="post_img"><img src='.$metro_creativex_feat_image[0].' alt="'.$metro_creativex_posttitle.'"></div>';

					endif;



					the_content();


					$fields = get_field_objects();

					if( $fields['address'] ): ?>

					<div class="acf">
					<h2>ข้อมูลทั่วไปสำหรับการเดินทาง</h2>
					<div class="clearfix"></div>

					<?php
					// var_dump( $fields );
					// $address = get_field_object('address');
					// $open = get_field_object('open');
					// $contact = get_field_object('contact');
					// $traveling = get_field_object('traveling');
					// $gps = get_field_object('gps');
					echo '<h3>'.$fields['address']['label'].'</h3><p>'.$fields['address']['value'].'</p>';
					echo '<h3>'.$fields['open']['label'].'</h3><p>'.$fields['open']['value'].'</p>';
					echo '<h3>'.$fields['traveling']['label'].'</h3><p>'.$fields['traveling']['value'].'</p>';
					echo '<h3>'.$fields['gps']['label'].'</h3><p>'.$fields['gps']['value'].'</p>';
					echo '<h3>'.$fields['maps']['label'].'</h3>
						<div class="acf-map">
							<div class="marker" data-lat="'. $fields['maps']['value']['lat'].'" data-lng="'.$fields['maps']['value']['lng'].'"></div>
						</div>
					</div>';
					endif;

					wp_link_pages();

					edit_post_link( __('Edit post', 'metro-creativex'));

				?>

				<div class="clearfix"></div>

				<?php

					if(has_tag()):

						echo '<div class="tags">';

						the_tags();

						echo '</div>';

					endif;

				?>

			</div><!--/post-->

			<?php metro_creativex_pagination(); ?>

			<?php comments_template(); ?>

		</div><!-- /content -->

	<?php endwhile; ?>

	<?php do_action('metro_customizr_right_sidebar');?>

<?php get_footer(); ?>