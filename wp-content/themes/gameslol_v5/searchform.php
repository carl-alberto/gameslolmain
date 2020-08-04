<form id="searchform" class="mega-search" action="<?php echo site_url(); ?>/">
	<input type="text" name="s" placeholder="Type here..." required value="<?php echo get_query_var('s'); ?>">
	<input type="submit" class="submit" name="submit" value="Search">
</form>