<?php
/**
 * Example Widget Class
 */

class gravity_forms_widget extends WP_Widget {
    /** constructor -- name this the same as the class above */
    function __construct($bool = false, $name = 'Gravity Forms Widget') {
        parent::__construct($bool, $name);
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {

        extract( $args );
        $title 		= do_shortcode($instance['title']);
        $formId   = $instance['form'];

        ?>
              <div id="modal-free-quote" class="modal fade modal-free-quote" tabindex="-1" role="dialog">
				  <div class="modal__scroll" style="max-height: 100%; overflow-y: auto; overflow-x: hidden;">
	                  <div class="modal-dialog modal-lg">
	                      <div class="modal-content brick">
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
				  </div>
              </div><!-- /.modal -->
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		    $instance = $old_instance;
		    $instance['title'] = strip_tags($new_instance['title']);
		    $instance['form'] = strip_tags($new_instance['form']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $title 		= (isset($instance['title']) ? esc_attr($instance['title']) : '');
        $form	    = (isset($instance['form']) ? esc_attr($instance['form']) : '');

        $forms = GFAPI::get_forms();

        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		    <p>
          <label for="<?php echo $this->get_field_id('form'); ?>"><?php _e('Form'); ?></label>
          <select class="widefat" id="<?php echo $this->get_field_id('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>" value="<?php echo $form; ?>" >
              <?php foreach($forms as $f): ?>
                <option value="<?php echo $f['id']; ?>" <?php if($form == $f['id']):?> selected <?php endif; ?>><?php echo $f['title']; ?></option>
              <?php endforeach; ?>
          </select>
        </p>

        <?php
    }


} // end class example_widget
add_action('widgets_init', function () {
    return register_widget("gravity_forms_widget");
});
?>
