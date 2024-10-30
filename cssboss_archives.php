<?php
/*
Plugin Name: CSSBoss Archives
Plugin URI: http://CSSBoss.com
Description: A streamlined archive of all your categories, tags and posts. 
Version:  1.1
Author: Kaser
Author URI: http://CSSBoss.com
License: GPL2
*/


/*  Copyright 2012  ANDREW KASER  (email : Kaser@CSSBoss.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once('includes/shortcodes.php');
add_action ( 'wp_ajax_nopriv_load-content', 'my_load_ajax_content' );
add_action ( 'wp_ajax_nopriv_load-posts', 'my_load_ajax_posts' );
add_action ( 'wp_ajax_load-content', 'my_load_ajax_content' );
add_action ( 'wp_ajax_load-posts', 'my_load_ajax_posts' );
add_action('admin_menu', 'cssboss_archive_menu');
require_once('includes/settings.php');

function my_load_ajax_content () 
{
	$post_id = $_POST[ 'post_id' ];        
	$post = get_post( $post_id, OBJECT);
	$response =  $post->post_content;
	$content = apply_filters('the_content', $response);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo "<h1>". $post->post_title ."</h1>";
	echo do_shortcode($content);
	die(1);
}
    
function my_load_ajax_posts () 
{
	$cat_name = $_POST[ 'cat_name' ];
	$tag_name = $_POST['tag_name'];
	if ( $cat_name != '' ) 
	{   
		$posts = get_posts( 'category_name='.$cat_name );
	} else 
	{
		$posts = get_posts( 'tag='.$tag_name);
	}
	//echo $cat_name;
	
	global $post;
	$tmp_post = $post;
	
		foreach ( $posts as $post ) 
		{
		 	setup_postdata($post); 
			echo '<li id="'.$post->ID.'"><a href="#" class="ajax-click">'.get_the_title();
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( array(140,140) );
			} 
			echo '</a></li>';
		}	
	$post = $tmp_post; 
	die(1);
}

function cssboss_get_categories( $args = '' ) 
{
	$defaults = array( 'taxonomy' => 'category' );
	$args = wp_parse_args( $args, $defaults );

	$taxonomy = apply_filters( 'get_categories_taxonomy', $args['taxonomy'], $args );

	// Back compat
	if ( isset($args['type']) && 'link' == $args['type'] ) 
	{
		_deprecated_argument( __FUNCTION__, '3.0', '' );
		$taxonomy = $args['taxonomy'] = 'link_category';
	}

	$categories = (array) get_terms( $taxonomy, $args );

	foreach ( array_keys( $categories ) as $k )
	{
		_make_cat_compat( $categories[$k] );
	}
	
	foreach ( $categories as $cat ) 
	{
		echo "<li id=\"".$cat->term_id."\"><a href=\"#\" class=\"cat_click\">".$cat->name."</a></li>";
	}
}

function cssboss_archives_tag_list() 
{ 
	$tag_list = get_tags();
	echo '<ul>';
	foreach ( $tag_list as $boss_tag) 
	{
		echo '<li id="'.$boss_tag->term_id.'"><a href="#" class="tag_click">'.$boss_tag->name.'</a></li>';
	}
	echo '</ul>';
}
?>