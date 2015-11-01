<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <main id="main">

 *

 * @package metro-creativex

 */

 global $wp_customize;

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<title><?php wp_title('|', true, 'right'); ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="profile" href="http://gmpg.org/xfn/11">

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">



		<?php wp_head(); ?>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {

	// var
	var $markers = $el.find('.marker');


	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};


	// create map
	var map = new google.maps.Map( $el[0], args);


	// add a markers reference
	map.markers = [];


	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});


	// center map
	center_map( map );


	// return
	return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>
	</head>

	<body <?php body_class(); ?>>

		

	<header class="header">

			<?php if(get_header_image()): ?>

			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

			<?php endif; ?>

			<div id="logo">

				

				

				<?php

					$metro_logo = get_theme_mod('metro-creativex_logo');

					if(!empty($metro_logo)):



						echo '<div class="site-logo">';



							echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';

													 

								echo '<img src="'.esc_url($metro_logo).'" alt="'.get_bloginfo( 'name', 'display' ).'">';

													 

							echo '</a>';

													 

						echo '</div>';

												 					 

						echo '<div class="header-logo-wrap metro_creativex_only_customizer">';



							echo "<h1 class='site-title'><a href='".esc_url( home_url( '/' ) )."' title='".esc_attr( get_bloginfo( 'name', 'display' ) )."' rel='home'>".get_bloginfo( 'name' )."</a></h1>";



							echo "<h2 class='site-description'>".get_bloginfo( 'description' )."</h2>";



						echo '</div>';	



					else:



						if( isset( $wp_customize ) ):

													 

							echo '<div class="site-logo metro_creativex_only_customizer">';

													 

								echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';

														 

									echo '<img src="'.esc_url($metro_logo).'" alt="'.get_bloginfo( 'name', 'display' ).'">';

														 

								echo '</a>';

														 

							echo '</div>';



						endif;



						echo '<div class="header-logo-wrap">';



							echo "<h1 class='site-title'><a href='".esc_url( home_url( '/' ) )."' title='".esc_attr( get_bloginfo( 'name', 'display' ) )."' rel='home'>".get_bloginfo( 'name' )."</a></h1>";



							echo "<h2 class='site-description'>".get_bloginfo( 'description' )."</h2>";



						echo '</div>';	

														 

					endif;

				

				

				

				?>

			</div><!-- /logo -->

			<div class="openmenuresp"><?php _e('Menu','metro-creativex'); ?></div>

			<?php

				do_action('metro-creaivex_on_mobile');

			?>

			<div class="navrespgradient"></div>

			<?php

				do_action('metro-creativex_sidebar');

			?>

	</header>

		<div id="topside">

			<div class="pages">

				<?php wp_nav_menu( array(

				'theme_location' => 'secound'  ) ); ?>

			</div><!--/pages-->



			<div id="searchform">

				<?php get_search_form(); ?>

			</div><!--/searchform-->



			<div class="clearfix"></div>

