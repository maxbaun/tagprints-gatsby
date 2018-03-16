<?php
/**
 * Example Widget Class
 */

class array13_form_widget extends gravity_forms_widget {
	/** constructor -- name this the same as the class above */
	function __construct() {
		parent::__construct(false, 'Array13 Form Widget');
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {

		extract( $args );
		$title 		= do_shortcode($instance['title']);
		$formId   = $instance['form'];

		?>
			  <div id="modal-array13" class="modal fade modal-array13" tabindex="-1" role="dialog">
				  <div class="modal-dialog modal-lg">
					  <div class="modal-content">
						  <?php if($title): ?>
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <h4 class="modal-title"><?php echo $title; ?></h4>
						  </div>
						  <?php endif; ?>
						  <div class="modal-body">
							<?php echo $before_widget; ?>
							  <?php gravity_form( $formId, false, false, false, true, true, true ); ?>
							<?php echo $after_widget; ?>
						  </div>
					  </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
		<?php
	}
} // end class example_widget
add_action('widgets_init', function () {
	register_widget("array13_form_widget");
});
