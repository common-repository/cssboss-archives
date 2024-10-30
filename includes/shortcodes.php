<?php
	// v1.1
	// place the shortcode [cssboss_archive] onto a full width page template
	function cssboss_archive_page()
	{
		global $wpdb;
		wp_register_style('cssboss_archive_style', plugins_url('../css/cssboss_archive_style.css', __FILE__) );
		wp_enqueue_style('cssboss_archive_style');
		
		 	echo '<p>'.get_option('cssboss_archives_intro').'</p>
		 	<div id="cssboss_archives_containter">
			 	<div id="cssboss_archives_categories">	
			 		<p class="cssboss_archives_tooltip" id="cssboss_archives_step_one_tooltip">Step One </p>
		 			<h4>Select A Category</h4>
	 				<ul id="cssboss_archive_cat_list">';
	 					cssboss_get_categories();
	 				echo '</ul>
	 				<br />
	 				<h4>Select A Tag</h4> ';
			 		cssboss_archives_tag_list();
			 	echo '</div>
			 	<div id="cssboss_archives_posts">	
			 		<p class="cssboss_archives_tooltip" id="cssboss_archives_step_two_tooltip">Step Two </p>
			 		<h4>Select A Post</h4>
			 		<ul id="cssboss_posts_ajax">';
			 			
						 	$the_query = new WP_Query( 'category_name=wordpress-tutorials' );
							// The Loop
							while ( $the_query->have_posts() ) : $the_query->the_post();
								echo '<li id="'.get_the_ID().'"><a href="#" class="ajax-click">'.get_the_title().'<br />';
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( array(140,76) );
								} 
								echo '</a></li>';
							endwhile;
			 		echo '
			 		</ul>
			 	</div>
			 	<div id="cssboss_archives_post_content"></div>
			 	<div style="clear:both;"></div>
			 	';
			 	
			 	if ( get_option('cssboss_archives_backlink') != 'no' )
			 	{
			 		echo '<div id="powered_by" style="text-align:center;">Powered By: <a href="http://CSSBoss.com">CSSBoss Archives</a></span></div></div>';
		 		}
		 		
		 wp_enqueue_script( 'my-ajax-request', plugin_dir_url('cssboss_archives/js/').'js/cssboss_archives.js'  , array( 'jquery' ) );
		 wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); 
	}
	add_shortcode( 'cssboss_archive', 'cssboss_archive_page' );
?>