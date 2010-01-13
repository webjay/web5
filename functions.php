<?php

if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => 'Clean',
	    'before_widget' => '<div id="%1$s" class="%2$s cleanbox clear">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="title-1 block">',
	    'after_title' => '</h3>'
	));    

    register_sidebar(array(
		'name' => 'Yellow',
        'before_widget' => '<div id="%1$s" class="%2$s stdbox yellow">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title-1 block">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
		'name' => 'Green',
        'before_widget' => '<div id="%1$s" class="%2$s stdbox green">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title-1 block">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
		'name' => 'Pink',
        'before_widget' => '<div id="%1$s" class="%2$s stdbox pink">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title-1 block">',
        'after_title' => '</h3>'
    ));    
    
}

$shortname = get_option('template');
$themename = ucfirst($shortname);
$options = array(
    array(  "name" => "Main color",
            "id" => $shortname."_main_color",
            "type" => "select",
            "std" => "#FE0059",
            "options" => array("Pink" => "#FE0059", "Green" => "#92CE0C", "Yellow" => "#FEB400", 'Grey' => '#666')
        ),
    array(  "name" => "Second color (used for rollovers)",
            "id" => $shortname."_second_color",
            "type" => "select",
            "std" => "#92CE0C",
            "options" => array("Pink" => "#FE0059", "Yellow" => "#FEB400", "Green" => "#92CE0C", 'Grey' => '#666')
        ),
    array(  "name" => "Background",
            "id" => $shortname."_background",
            "type" => "select",
            "std" => "bg.gif",
            "options" => array(
				"Neutral (plain)" => "bg-neutral-plain.gif", "Neutral (pattern 1)" => "bg.gif", "Neutral (pattern 2)" => "bg-neutral-pattern2.gif",
	        	"Neutral (pattern 3)" => "bg-neutral-pattern3.gif", "Neutral (pattern 4)" => "bg-neutral-pattern4.gif",
	        	"Pink (plain)" => "bg-pink-plain.gif", "Pink (pattern 1)" => "bg-pink.gif", "Pink Bright (pattern 1)" => "bg-pink-bright.gif", "Pink (pattern 2)" => "bg-pink-pattern2.gif",
	        	"Pink (pattern 3)" => "bg-pink-pattern3.gif", "Pink (pattern 4)" => "bg-pink-pattern4.gif",
	        	"Yellow (plain)" => "bg-yellow-plain.gif", "Yellow (pattern 1)" => "bg-yellow.gif", "Yellow Bright (pattern 1)" => "bg-yellow-bright.gif",
	        	"Yellow (pattern 2)" => "bg-yellow-pattern2.gif", "Yellow (pattern 3)" => "bg-yellow-pattern3.gif", "Yellow (pattern 4)" => "bg-yellow-pattern4.gif",
	        	"Green (plain)" => "bg-green-plain.gif", "Green (pattern 1)" => "bg-green.gif", "Green Bright (pattern 1)" => "bg-green-bright.gif", "Green (pattern 2)" => "bg-green-pattern2.gif",
	        	"Green (pattern 3)" => "bg-green-pattern3.gif", "Green (pattern 4)" => "bg-green-pattern4.gif"
			)
        ),
    array(  "name" => "Font size",
            "id" => $shortname."_font_size",
            "type" => "select",
            "std" => "13px",
            "options" => array("Smaller" => "13px", "Bigger" => "15px")
        ),
	array(  "name" => "Header image source",
			"id" => $shortname."_header_image_src",
			"type" => "url"
        ),
	array(  "name" => "Header image link",
			"id" => $shortname."_header_image_link",
			"type" => "url"
        ),
	array(  "name" => "Flickr RSS link",
			"id" => $shortname."_flickrss_link",
			"type" => "url"
		),
    array(  "name" => "Clean box background color",
            "id" => $shortname."_cleanbox_bgcolor",
            "type" => "select",
            "std" => "#92CE0C",
            "options" => array("Pink" => "#FE0059", "Yellow" => "#FEB400", "Green" => "#92CE0C", 'Grey' => '#E0E0E0', 'Blue' => '#A8E0FA', 'White' => '#fff')
        )
);

$mainColor = myOption('main_color');
if ($mainColor == '#FE0059') {
	$bubbles = 'bubbles.gif';
	$feed_image = 'feed.gif';
	$scissors = 'scissors.gif';
	$sep = 'sep-red.gif';
} elseif ($mainColor == '#FEB400')	{
	$bubbles = 'bubbles-yellow.gif';
	$feed_image = 'feed-yellow.gif';
	$scissors = 'scissors-yellow.gif';
	$sep = 'sep-yellow.gif';
} else {
	$bubbles = 'bubbles-green.gif';
	$feed_image = 'feed-green.gif';
	$scissors = 'scissors-green.gif';
	$sep = 'sep-green.gif';
}

function mytheme_add_admin () {
    global $themename, $shortname, $options;
    if ($_GET['page'] == basename(__FILE__)) {
        if ('save' == $_REQUEST['action']) {
                foreach ($options as $value) {
                    update_option($value['id'], $_REQUEST[$value['id']]); 
				}
                foreach ($options as $value) {
                    if (isset($_REQUEST[$value['id']])) { 
						update_option($value['id'], $_REQUEST[$value['id']]); 
					} else { 
						delete_option($value['id']); 
					} 
				}
                wp_redirect('themes.php?page=functions.php&saved=true');
                die;
        } else if ('reset' == $_REQUEST['action']) {
            foreach ($options as $value) {
                delete_option($value['id']); 
			}
            wp_redirect('themes.php?page=functions.php&reset=true');
            die;
        }
    }
    add_theme_page($themename.' Options', $themename.' Theme Options', 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin () {
    global $themename, $shortname, $options;
    if ($_REQUEST['saved'])
		echo('<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>');
    if ($_REQUEST['reset'])
		echo('<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>');
	?>
	<div class="wrap">
		<h2><?php echo($themename); ?> settings</h2>
		<form method="post">
			<table class="optiontable">
			<?php foreach ($options as $value) : 
				if ($value['type'] == "select") : ?>
				    <tr valign="top"> 
				        <th scope="row"><?php echo($value['name']); ?>:</th>
				        <td>
				            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				                <?php foreach ($value['options'] as $key => $val) : ?>
				                	<option value="<?php echo $val; ?>"<?php if (get_option ( $value['id'] )) {if ( get_option( $value['id'] ) == $val) { echo ' selected="selected"'; }} elseif ($val == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $key; ?></option>
				                <?php endforeach; ?>
				            </select>
				        </td>
				    </tr>
				<?php else : ?>
					<tr valign="top"> 
					    <th scope="row"><?php echo $value['name']; ?>:</th>
					    <td>
					        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
					    </td>
					</tr>
				<?php 
				endif;
			endforeach;
			?>
			</table>
			<p class="submit">
				<input name="save" type="submit" value="Save changes" />
				<input type="hidden" name="action" value="save" />
			</p>
		</form>
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />
				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
	</div>
	<?php
}
add_action('admin_menu', 'mytheme_add_admin'); 


function search () {
	?>
	<div id="search">
		<form action="<?php bloginfo('home'); ?>/" method="get">
			<input type="search" results="10" autosave="web5.search" placeholder="Search" value="<?php the_search_query(); ?>" id="s" name="s">
		</form>
	</div>
	<?php
}
register_sidebar_widget('Search', 'search');


function myOption ($option, $default = false) {
	return get_option(get_option('template').'_'.$option, $default);
}

function myFooter () {
	echo('<script src="http://www.google.com/jsapi"></script>');
	echo('<script src="'.get_bloginfo('template_directory').'/js/custom.js" async=""></script>');
}
add_action('wp_footer', 'myFooter');

?>