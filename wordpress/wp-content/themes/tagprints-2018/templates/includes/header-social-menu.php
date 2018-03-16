      <?php
      	$facebook_show = getSetting('facebook_show');
      	$twitter_show = getSetting('twitter_show');
      	$instagram_show = getSetting('instagram_show');
      	$phone_show = getSetting('phone_show');
      ?>

      <ul class="nav navbar-nav navbar-right social-icons">
      	<?php if(isset($facebook_show) && $facebook_show == 'on'): ?>
        	<li><a href="<?php echo getSetting('facebook_url'); ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
      	<?php endif; ?>
      	<?php if(isset($twitter_show) && $twitter_show == 'on'): ?>
        	<li><a href="<?php echo getSetting('twitter_url'); ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
      	<?php endif; ?>
      	<?php if(isset($instagram_show) && $instagram_show == 'on' ): ?>
        	<li><a href="<?php echo getSetting('instagram_url'); ?>" target="_blank"><span class="fa fa-instagram"></span></a></li>
      	<?php endif; ?>
      	<?php if(isset($phone_show) && $phone_show == 'on' ): ?>
	        <li class="separator"></li>
	        <li><a href="tel:<?php echo str_replace('-','',getSetting('phone_number')); ?>"><span class="fa fa-phone"></span></a></li> 
	        <li class="number"><a href="tel:<?php echo str_replace('-','',getSetting('phone_number')); ?>"><?php echo getSetting('phone_number'); ?></a></li>
      	<?php endif; ?>
      </ul>
