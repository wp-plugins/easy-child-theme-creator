<?php
function ect_plugin_admin_styles() {
	/*
	 * It will be called only on your plugin admin page, enqueue our stylesheet here
	 */
	wp_enqueue_style ( 'ect-admin-style', plugins_url ( 'custom_style.css', __FILE__ ) );
}
function ect_screenshot($ect, $path) {
	$font = plugin_dir_path ( __FILE__ ) . "Roboto-Black.ttf";
	$font_size = 28;
	if ($ect != '') {
		$text = $ect;
	} else {
		$text = 'Easy Child Theme Creator||Version 1.0';
	}
	$image = imagecreatetruecolor ( 1024, 1024 );
	$color = imagecolorallocate ( $image, 103, 207, 246 );
	$font_color = imagecolorallocate ( $image, 220, 210, 60 );
	
	imagefill ( $image, 0, 0, $color );
	$lines = explode ( '|', $text );
	$y = 350;
	foreach ( $lines as $line ) {
		imagettftext ( $image, $font_size, 0, 50, $y, $font_color, $font, $line );
		$y += 23;
	}
	imagepng ( $image, $path . '/screenshot.png' );
}