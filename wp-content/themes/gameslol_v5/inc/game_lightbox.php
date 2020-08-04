<div id="gameLightbox" class="lightbox" style="display: none;">
	<div class="lightbox_icon">
		<img class="game_icon <?php echo $lb_images_flipped; ?>" src="<?php echo $lightboxicon; ?>"><br/>
		Run the game installer
	</div>
	<div class="lightbox_exit" onclick="this.parentNode.style.display = 'none'"><span class="fa fa-close"></span></div>
	<div id="gameArrow" class="lightbox_arrow bounce">
		<div class="arrow_up">
			<div class="arrow_head"></div>
			<!--<div class="arrow_text">
				&nbsp;
			</div>-->
		</div>
		<?php if($arrowlogo<>"") { ?>
		<div class="arrow_logo">
			<img class="gameimg  <?php echo $lb_images_flipped; ?>"
					src="<?php echo $arrowlogo; ?>">
		</div>
		<?php } ?>
		<div class="arrow_down">
			<!--<div class="arrow_text">
				&nbsp;
			</div>-->
			<div class="arrow_head"></div>
		</div>
	</div>
</div>