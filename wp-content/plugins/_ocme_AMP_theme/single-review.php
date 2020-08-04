<?php amp_header(); 
$info = get_the_review_info(get_the_id());
		$relatedgame = array();
		if($info['gameID'] <> "" ){ 
			$relatedgame = get_the_game_info($info['gameID']);?>
		<?php
		}
?>
<div id="pageheader">
	<h1>Review for: <?php echo get_the_title($info['gameID']); ?></h1>
</div>
<div id="pagecontent" class="container">
	<div class="feat_img">
	
	<?php
		
		if ( $relatedgame['banner'] <> '' ) {
			?>
			<amp-img src="<?php echo $relatedgame['banner']; ?>"
			alt="<?php the_title(); ?> Featured Image"
			width="1000" height="350" layout="responsive">
			<noscript><img
			src="<?php echo $relatedgame['banner']; ?>"
			alt="<?php the_title(); ?> Featured Image"></noscript></amp-img>
			<?php
			} 
		?>
	</div>
	<div class="content">
		<h2><?php amp_title(); ?></h2>
		<?php amp_content(); ?>
	</div>
	
	<br/>
	<?php if($info['gameID'] <> "") { ?>
	
	<div class="cta" align="center">
		<a class="downloadbtn" href="<?php echo get_the_permalink($info['gameID']); ?>amp">
			<span class="btn_text">Play <span class="notranslate"><?php echo get_the_title($info['gameID']);?></span> </span></a>
	</div>
	
		<?php } ?>
	<br/>
	<?php if( $info['source'] <> '' ){ ?>
				<hr/>
			<p class="meta" align="center">Source: <a href="<?php echo $info['source']; ?>" target="_blank"><?php the_title(); ?></a></p>
	<?php } ?>
</div>
<?php amp_footer(); ?>