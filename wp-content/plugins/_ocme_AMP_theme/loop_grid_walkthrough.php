
<?php 
	$game_info = get_the_game_info(get_the_ID());
	$is_available = ( get_the_walkthrough_page( get_the_ID() )  
					 && get_the_walkthrough_count(get_the_ID()) > 0 ) ? true : false;
	$permalink = get_the_permalink( get_the_walkthrough_page( get_the_ID() ) );
	$ampurl = $permalink."amp";
		
if($is_available){ ?>

<div class="item">
	<a class="preview" href="<?php echo $ampurl; ?>">
		<amp-img src="<?php echo $game_info['icon']; ?>"
			alt="<?php echo $game_info['icon_alt']; ?>"
			width="200" height="200" layout="responsive">
			<noscript><img
			src="<?php echo $game_info['icon']; ?>"
			alt="<?php echo $game_info['icon_alt']; ?>"></noscript></amp-img>
	</a>
	<div class="details">
		<?php amp_loop_title(); ?>
	</div>
</div>

<?php } ?>