<?php
// v1.1
function cssboss_archive_menu() {
	add_options_page('CSSBoss Archives Options', 'CSSBoss Archives', 'manage_options', 'cssboss_archives.php', 'cssboss_archives_settings');
}

function register_cssboss_archive_settings() {
	register_setting( 'cssboss_archives_settings_group', 'cssboss_archives_intro', '' ); 
	register_setting( 'cssboss_archives_settings_group', 'cssboss_archives_backlink', '' ); 
} 
add_action( 'admin_init', 'register_cssboss_archive_settings' );

function cssboss_archives_settings() {

?>
	<div class="wrap">
		<h2>CSSBoss Archives Settings!</h2>
		<p> Set the introductory paragraph to be displayed above your archives</p>
		<form method="post" action="options.php">
		<?php settings_fields( 'cssboss_archives_settings_group' ); 
			do_settings_sections( 'cssboss_archives_settings_group' );
		?>
		<p>Intro Paragraph Displayed Above Archive Page</p>
		<textarea rows="7" cols="40" name="cssboss_archives_intro" ><?php echo get_option('cssboss_archives_intro'); ?></textarea>
		<p>Please Show Support To CSSBoss, If you would like to disable the link, type no <input type="text" value="<?php echo get_option('cssboss_archives_backlink'); ?>"  name="cssboss_archives_backlink" /></p>
		<?php	submit_button(); ?>
		</form>
	</div>
<?php
}

?>