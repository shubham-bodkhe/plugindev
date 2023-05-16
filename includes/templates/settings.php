<?php
/**
 * The Template File.
 *
 * @package category
 */

?>
<div class='wrap'>
	<div class='leftcol'>
		<h1>News Setting</h1>


		<form action="<?php echo 'edit.php?post_type=news&page=news-setting'; ?> " method="post">

			<?php wp_nonce_field( 'news_settings_save', 'news_setting_nonce' ); ?>

			<table class='form-table'>
				<tbody>

					<tr>
						<th><label for="news_related">Related News</label></th>
						<td><input id='news_related' type='text' name="news_related_title"
								value="<?php echo get_option( 'news_related_title', 'Related NEws' ); ?>"></td>
					</tr>
					<tr>
						<th><label for="show_news_related">Show Related News</label></th>
						<td><input name='show_related' id='show_related' type='checkbox' value=1
								<?php checked( get_option( 'show_related_news', true ) ); ?>></td>
					</tr>
					<tr>
						<th><label for="show_news_related">Related Email</label></label></th>
						<td><input name='related_mail' id='related_mail' type='email'
								value="<?php get_option( 'show_related_mail', '' ); ?>" required></td>
					</tr>
					<tr>
						<th><label for='related_number_post'>Number of Related Post</label></th>
						<td><select id="related_numbre_post" name='related_number_post'>
								<?php for ( $i = 1;$i <= 10;$i++ ) : ?>
								<option value="<?php echo $i; ?>"
									<?php selected( get_option( 'related_number', 3 ), $i ); ?>>
									<?php echo $i; ?>
								</option>

								<?php endfor ?>

							</select></td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
					value="Save Changes"></p>
		</form>




	</div>
	<div class='rightcol'>

		<a href="3">Get the pro Version</a>
	</div>
</div>
