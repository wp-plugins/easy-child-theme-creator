<?php
$dir = get_theme_root ();

$files = scandir ( $dir, 1 );

foreach ( $files as $file ) 

{
	preg_match_all ( '/^.*child.*$/im', $file, $matches, PREG_PATTERN_ORDER );
	
	if ($file != 'index.php' && $file != '.' && $file != '..' && $matches [0] [0] == '') {
		
		$opts .= '<option value="' . $file . '">' . $file . '</option>';
	}
}

/* Submit Actions */
$ect_parent = "ect_parenttheme";

if (isset ( $_POST ["submit"] )) {
	$ect_show = $_POST [$ect_parent];
	$ect_title = $_POST['ect_childtheme'] != '' ?  $_POST['ect_childtheme'] : $ect_show.' Child';
	$ect_url = $_POST['ect_themeurl'] != '' ?  $_POST['ect_themeurl'] : 'http://ashokg.in';
	$ect_author = $_POST['ect_author'] !='' ? $_POST['ect_author'] : 'wpashokg' ;
	$ect_author_url = $_POST['ect_authurl'] !='' ? $_POST['ect_authurl'] : 'http://ashokg.in';
	
	
	$dir_name = $dir . "/" . $ect_show . "-child";
	if (file_exists ( $dir_name )) {
		echo '<div id="message" class="error fade"><p>Child Theme ' . $dir_name . ' Already Exists.</p></div>';
	} else {
		//update_option ( $ect_parent, $ect_show );
		mkdir ( $dir_name, 0755 );
		$content = '/*' . PHP_EOL;
		$content .= 'Theme Name: ' . $ect_title . PHP_EOL;
		$content .= 'Theme Uri:  http://ashokg.in' . PHP_EOL;
		$content .= 'Author:     '.$ect_author . PHP_EOL;
		$content .= 'Author Uri: '.$ect_author_url. PHP_EOL;
		$content .= 'Template:   ' . $ect_show . PHP_EOL;
		$content .= 'Version:    1.0' . PHP_EOL;
		$content .= 'License:    GNU General Public License v2 or later' . PHP_EOL;
		$content .= 'Version:    1.0' . PHP_EOL;
		$content .= '*/';
		
		$php_content = "<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}";
		ect_screenshot ( $ect_show . '-child|||by Easy Child Theme Creator||Version 1.0||Ashok G||http://ashokg.in', $dir_name );
		$fp = fopen ( $dir_name . '/style.css', 'wb' );
		fwrite ( $fp, $content );
		fclose ( $fp );
		
		$create_functions = fopen ( $dir_name . '/functions.php', 'wb' );
		fwrite ( $create_functions, $php_content );
		fclose ( $create_functions );
		
		echo '<div id="message" class="updated fade"><p>Child Theme Created Successfully</p></div>';
	}
} else {
	$ect_show = get_option ( $ect_parent );
}

/* Submit Actions */
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Welcome To Easy Child Theme Creator</h2>
</div>
<?php if(isset($_GET['action'])) { $menu = $_GET['action']; } else { $menu = ''; } ?>
<h2 class="nav-tab-wrapper">
	<a href="?page=easy-ctc&action=create"
		class="nav-tab <?php if($menu=='create') { echo 'nav-tab-active'; } ?>">Create
		Child Theme</a> <a href="?page=easy-ctc&action=overview"
		class="nav-tab <?php if($menu=='overview' || $menu == '') { echo 'nav-tab-active'; } ?>">Overview</a>
</h2>
<?php if($menu=='create') { ?>
<fieldset>
	<legend>Select A Parent Theme</legend>
	<form method="post" action="">
		<p>
			<label for="ect_ptheme" class="ect_label">Parent Theme</label>: <select
				id="ect_ptheme" name="ect_parenttheme"><option value="">Select A
					Parent Theme</option><?php echo $opts; ?></select>
		</p>
		<p>
			<label for="ect_ctheme" class="ect_label">Title</label>: <input
				type="text" name="ect_childtheme" id="ect_ctheme">
		</p>
		<p>
			<label for="ect_themeurl" class="ect_label">Theme Uri</label>: <input
				type="text" name="ect_themeurl" id="ect_themeurl" value="http://ashokg.in">
		</p>
		<p>
			<label for="ect_author" class="ect_label">Author</label>: <input
				type="text" name="ect_author" id="ect_author" value="wpashokg">
		</p>
		<p>
			<label for="ect_authurl" class="ect_label">Author Url</label>: <input
				type="text" name="ect_authurl" id="ect_authurl"
				value="http://ashokg.in">
		</p>

		<p>
			<input type="submit" value="Create" class="button button-primary"
				name="submit" />
		</p>
	</form>
</fieldset>
<?php   }  ?>

<?php if($menu=='overview' || $menu=='') { ?>
<fieldset>
	<h2>OverView</h2>
	<p>Welcome to Easy Child Theme Creator!</p>
	<p>This is a simple effort to create a child theme easily so that it
		would be in the proper standards.</p>
	<p>
	
	
	<h3>Future Updates.</h3>
	<ul>
		<li>Template Cration</li>
		<li>Configurations etc.,</li>
	</ul>
	</p>
</fieldset>
<?php   }  ?>