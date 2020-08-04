<?php amp_header();
$info = get_the_article_info(get_the_id());
?>
<div id="pageheader">
	<?php amp_title(); ?>
</div>
<div id="pagecontent" class="container">
	<div class="feat_img">
	<?php amp_featured_image();?>
	</div>
	<?php if($info['video_id']<>''){ ?>
	<div class="video">
		<amp-youtube
				data-videoid="<?php echo $info['video_id']; ?>"
				layout="responsive"
				width="853" height="505"></amp-youtube>
	</div>
	<?php } ?>
	
	<div class="content">
	<?php amp_content(); ?>
	</div>
	
	<br/>
	<?php
		if($info['gameID'] <> "" ){ 
				$relatedgame = get_the_game_info($info['gameID']);?>
				
	<div class="cta" align="center">
		<a class="downloadbtn" href="<?php echo get_the_permalink($info['gameID']); ?>amp">
			<span class="btn_text">Play <span class="notranslate"><?php echo get_the_title($info['gameID']);?></span> </span></a>
	</div>
	
		<?php } ?>
	<br/>
	<hr/>
	<p class="meta" align="center">Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
</div>
<?php amp_footer()?>