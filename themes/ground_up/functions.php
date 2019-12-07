<?php 


//Set Up
add_theme_support('menus');

//Hooks
#styles & scripts
add_action('wp_enqueue_scripts','pwn_enqueue');
#menu (do not forget to put in wp_nav_menu() where you want it)
add_action('after_setup_theme','pwn_setup_menu');
#widgets (sidebar is at sidebar.php, and display_sidebar('pwn_sidebar_1') is in index.php)
add_action('widgets_init','pwn_widgets');
//Shortcodes

//Functions

#scripts & scripts
function pwn_enqueue()
{

	#css styles
	wp_register_style('pwn_bootstrap_css',get_template_directory_uri().'/assets/css/bootstrap.min.css');
	wp_enqueue_style('pwn_bootstrap_css');
	wp_register_style('pwn_jquery_ui_css',get_template_directory_uri().'/assets/css/jquery-ui-1.10.3.custom.min.css');
	wp_enqueue_style('pwn_jquery_ui_css');
	#css styles
	wp_register_style('pwn_style_css',get_template_directory_uri().'/style.css');
	wp_enqueue_style('pwn_style_css');
	if(is_page('tv'))
	{
		wp_register_style('pwn_plyr_css',get_template_directory_uri().'/assets/css/plyr.css');
		wp_enqueue_style('pwn_plyr_css');
	}



	#scripts
	wp_register_script('pwn_jquery_script',get_template_directory_uri().'/assets/js/jquery-3.1.1.min.js');
	wp_enqueue_script('pwn_jquery_script');
	wp_register_script('pwn_bootstrap_script',get_template_directory_uri().'/assets/js/bootstrap.min.js');
	wp_enqueue_script('pwn_bootstrap_script');
	wp_register_script('pwn_jquery_ui_script',get_template_directory_uri().'/assets/js/jquery-ui-1.10.3.custom.min.js');
	wp_enqueue_script('pwn_jquery_ui_script');
	#done for the touch part of music player
	wp_register_script('pwn_touch_script',get_template_directory_uri().'/assets/js/jquery.ui.touch-punch.min.js');
	wp_enqueue_script('pwn_touch_script');
	#done for the touch part of music player
	wp_register_script('pwn_audio_player_script',get_template_directory_uri().'/assets/js/audio_player.js');
	wp_enqueue_script('pwn_audio_player_script');
	if(is_page('tv'))
	{
		wp_register_script('pwn_plyr_js',get_template_directory_uri().'/assets/js/plyr.js');
		wp_enqueue_script('pwn_plyr_js');
	}



	
	

	

}

#menu
function pwn_setup_menu()
{
	register_nav_menu('primary_menu',__('Primary Menu','pwn_domain'));
}

#menu walker (The only reason for this is to make the menu corners round by adding class "img-rounded")
class MenuWalker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0) 
	{
		$url = $item->url;
		 $output .= sprintf( "\n<li class='menu_item'><a class='img-rounded' href='%s'%s><span>%s</span></a></li>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            strtoupper($item->title)
        );
	}
}

#widgets
function pwn_widgets()
{
	register_sidebar( array(
		'name' => __( 'Pwn Sidebar One', 'pwn_domain' ),
		'id' => 'pwn_sidebar_1',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
		// 'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 'after_widget'  => '</li>',
		// 'before_title'  => '<h2 class="widgettitle">',
		// 'after_title'   => '</h2>',
		) 
	);
}

#functions not a hook
function get_video_id_with_link($link)
{
	preg_match('/(?<=\=).*$/',$link,$matches);
	if(isset($matches[0]))
	{
		return $matches[0];
	}
	return '';
}


?>

