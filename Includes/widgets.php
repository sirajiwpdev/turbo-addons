<?php
//namespace DesignMonks\AkijCement;
//About Company
class DM_About_Company extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_About_Company', /* Name */esc_html__('DM About Company','akijcement-core'), array( 'description' => esc_html__('Show the About Company', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo wp_kses_post($before_widget);?>
        
        <!-- Footer Widget -->
		<?php if($instance['widget_bg_img']){ ?><img class="footer__logo" src="<?php echo esc_url($instance['widget_bg_img']); ?>" alt="<?php esc_attr_e('Awesome Image','akijcement-core'); ?>"><?php } ?>
        <p class="footer-description"><?php echo wp_kses_post($instance['content']); ?></p>
        <p class="footer-contact-info"><?php echo wp_kses_post($instance['email']); ?></p>
        <p class="footer-contact-info"><?php echo wp_kses_post($instance['phone']); ?></p>

        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['widget_bg_img'] = strip_tags($new_instance['widget_bg_img']);
		$instance['content'] = $new_instance['content'];
		$instance['email'] = $new_instance['email'];
		$instance['phone'] = $new_instance['phone'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$widget_bg_img = ($instance) ? esc_attr($instance['widget_bg_img']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$email = ($instance) ? esc_attr($instance['email']) : '';
		$phone = ($instance) ? esc_attr($instance['phone']) : ''; ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_bg_img')); ?>"><?php esc_html_e('Logo Image Url:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Image Url', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_bg_img')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_bg_img')); ?>" type="text" value="<?php echo esc_attr($widget_bg_img); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>             
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('emall')); ?>"><?php esc_html_e('Email:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('email', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('phone', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
        </p>
             
		<?php 
	}	
}

//Contact Us
class DM_Contact_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Contact_Us', /* Name */esc_html__('DM Contact Us','akijcement-core'), array( 'description' => esc_html__('Show the Contact Us', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
        
        <div class="footer__widget-3">
        	<?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <ul class="footer__contact">
                <li><?php echo wp_kses_post($instance['widget_address']); ?></li>
                <li><a class="phone" href="tel:<?php echo esc_attr($instance['widget_phone']); ?>"><?php echo wp_kses_post($instance['widget_phone']); ?> </a></li>
                <li><a href="mailto:<?php echo esc_attr($instance['widget_email']); ?>"><?php echo wp_kses_post($instance['widget_email']); ?></a></li>
            </ul>
        </div>
                           
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['widget_address'] = $new_instance['widget_address'];
		$instance['widget_phone'] = $new_instance['widget_phone'];
		$instance['widget_email'] = $new_instance['widget_email'];
		
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Contact Us', 'akijcement-core');
		$widget_address = ($instance) ? esc_attr($instance['widget_address']) : '';
		$widget_phone = ($instance) ? esc_attr($instance['widget_phone']) : '';
		$widget_email = ($instance) ? esc_attr($instance['widget_email']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_address')); ?>"><?php esc_html_e('Address:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_address')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_address')); ?>" ><?php echo wp_kses_post($widget_address); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_phone')); ?>"><?php esc_html_e('Phone Number:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('+123-1122-1234', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_phone')); ?>" type="text" value="<?php echo esc_attr($widget_phone); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_email')); ?>"><?php esc_html_e('Email Address:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('info@example.com', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_email')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_email')); ?>" type="text" value="<?php echo esc_attr($widget_email); ?>" />
        </p>     
                
		<?php 
	}	
}

//Have a Projects
class DM_have_a_projects extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_have_a_projects', /* Name */esc_html__('DM Have a Projects','akijcement-core'), array( 'description' => esc_html__('Show the Have a Projects', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );		
		echo wp_kses_post($before_widget);?>
        
        <div class="footer__widget-4">
            <h2 class="project-title"><?php echo wp_kses_post($instance['widget_title']); ?></h2>
            <?php if($instance['widget_btn_title']){ ?>
            <div id="btn_wrapper">
                <a href="<?php echo esc_url($instance['widget_btn_link']); ?>" class="wc-btn-primary btn-hover btn-item"><span></span> <?php echo wp_kses_post($instance['widget_btn_title']); ?> <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <?php } ?>
            <h3 class="contact-time"><?php echo wp_kses_post($instance['widget_working_time']); ?></h3>
            <h4 class="contact-day"><?php echo wp_kses_post($instance['widget_working_days']); ?></h4>
        </div>
                           
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['widget_title'] = strip_tags($new_instance['widget_title']);
		$instance['widget_btn_title'] = $new_instance['widget_btn_title'];
		$instance['widget_btn_link'] = $new_instance['widget_btn_link'];
		$instance['widget_working_time'] = $new_instance['widget_working_time'];
		$instance['widget_working_days'] = $new_instance['widget_working_days'];
		
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$widget_title = ( $instance ) ? esc_attr($instance['widget_title']) : esc_html__('Have a project in your mind?', 'akijcement-core');
		$widget_btn_title = ($instance) ? esc_attr($instance['widget_btn_title']) : '';
		$widget_btn_link = ($instance) ? esc_attr($instance['widget_btn_link']) : '';
		$widget_working_time = ($instance) ? esc_attr($instance['widget_working_time']) : '';
		$widget_working_days = ($instance) ? esc_attr($instance['widget_working_days']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_title')); ?>"><?php esc_html_e('Widget Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_title')); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_btn_title')); ?>"><?php esc_html_e('Button Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Contact Us', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_btn_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_btn_title')); ?>" type="text" value="<?php echo esc_attr($widget_btn_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_btn_link')); ?>"><?php esc_html_e('Button Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_btn_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_btn_link')); ?>" type="text" value="<?php echo esc_attr($widget_btn_link); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_working_time')); ?>"><?php esc_html_e('Working Time:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('09 : 00 AM - 10 : 30 PM', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_working_time')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_working_time')); ?>" type="text" value="<?php echo esc_attr($widget_working_time); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_working_days')); ?>"><?php esc_html_e('Working Days:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Saturday - Thursday', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_working_days')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_working_days')); ?>" type="text" value="<?php echo esc_attr($widget_working_days); ?>" />
        </p>     
                
		<?php 
	}	
}

///----footer Two widgets---
//About Company V2
class DM_About_Company_V2 extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_About_Company_V2', /* Name */esc_html__('DM About Company V2','akijcement-core'), array( 'description' => esc_html__('Show the About Company V2', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo wp_kses_post($before_widget);?>
        
        <!-- Footer Widget -->
		<?php if($instance['widget_logo_light_img']){ ?><img class="footer__logo logo-light" src="<?php echo esc_url($instance['widget_logo_light_img']); ?>" alt="<?php esc_attr_e('Awesome Image','akijcement-core'); ?>"><?php } ?>
        <?php if($instance['widget_logo_dark_img']){ ?><img class="footer__logo logo-dark" src="<?php echo esc_url($instance['widget_logo_dark_img']); ?>" alt="<?php esc_attr_e('Awesome Image','akijcement-core'); ?>"><?php } ?>
        <p><?php echo wp_kses_post($instance['content']); ?></p>
        
        <?php if( $instance['show_v2'] ): ?>
        <?php echo wp_kses_post(axtra_get_social_icon()); ?>
        <?php endif; ?>
              	 
            
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['widget_logo_light_img'] = strip_tags($new_instance['widget_logo_light_img']);
		$instance['widget_logo_dark_img'] = strip_tags($new_instance['widget_logo_dark_img']);
		$instance['content'] = $new_instance['content'];
		$instance['show_v2'] = $new_instance['show_v2'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$widget_logo_light_img = ($instance) ? esc_attr($instance['widget_logo_light_img']) : '';
		$widget_logo_dark_img = ($instance) ? esc_attr($instance['widget_logo_dark_img']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$show_v2 = ($instance) ? esc_attr($instance['show_v2']) : ''; ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_logo_light_img')); ?>"><?php esc_html_e('Light Logo Image Url:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Light Logo Image Url', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_logo_light_img')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_logo_light_img')); ?>" type="text" value="<?php echo esc_attr($widget_logo_light_img); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_logo_dark_img')); ?>"><?php esc_html_e('Dark Logo Image Url:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Dark Logo Image Url', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_logo_dark_img')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_logo_dark_img')); ?>" type="text" value="<?php echo esc_attr($widget_logo_dark_img); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>             
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_v2')); ?>"><?php esc_html_e('Show Social Icons:', 'akijcement-core'); ?></label>
			<?php $selected = ( $show_v2 ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_v2')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show_v2')); ?>" type="checkbox" value="true" />
        </p>
             
		<?php 
	}	
}

//Contact Us
class DM_Contact_Us_V2 extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Contact_Us_V2', /* Name */esc_html__('DM Contact Us V2','akijcement-core'), array( 'description' => esc_html__('Show the Contact Us V2', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
        
        <!-- Footer Widget -->
        <?php echo wp_kses_post($before_title.$title.$after_title); ?>
        <ul class="footer__info-6">
            <li><?php echo wp_kses_post($instance['widget_address_v2']); ?></li>
            <li><a class="phone" href="tel:<?php echo esc_attr($instance['widget_phone_v2']); ?>"><?php echo wp_kses_post($instance['widget_phone_v2']); ?> </a></li>
            <li><a href="mailto:<?php echo esc_attr($instance['widget_email_v2']); ?>"><?php echo wp_kses_post($instance['widget_email_v2']); ?></a></li>
        </ul>
                           
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['widget_address_v2'] = $new_instance['widget_address_v2'];
		$instance['widget_phone_v2'] = $new_instance['widget_phone_v2'];
		$instance['widget_email_v2'] = $new_instance['widget_email_v2'];
		
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Contact Us', 'akijcement-core');
		$widget_address_v2 = ($instance) ? esc_attr($instance['widget_address_v2']) : '';
		$widget_phone_v2 = ($instance) ? esc_attr($instance['widget_phone_v2']) : '';
		$widget_email_v2 = ($instance) ? esc_attr($instance['widget_email_v2']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_address_v2')); ?>"><?php esc_html_e('Address:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_address_v2')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_address_v2')); ?>" ><?php echo wp_kses_post($widget_address_v2); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_phone_v2')); ?>"><?php esc_html_e('Phone Number:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('+123-1122-1234', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_phone_v2')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_phone_v2')); ?>" type="text" value="<?php echo esc_attr($widget_phone_v2); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_email_v2')); ?>"><?php esc_html_e('Email Address:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('info@example.com', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_email_v2')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_email_v2')); ?>" type="text" value="<?php echo esc_attr($widget_email_v2); ?>" />
        </p>     
                
		<?php 
	}	
}

//Newsletter
class DM_Newsletter extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Newsletter', /* Name */esc_html__('DM Newsletter','akijcement-core'), array( 'description' => esc_html__('Show the Newsletter', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
        
        <!-- Footer Widget -->
        <?php echo wp_kses_post($before_title.$title.$after_title); ?>
        
		<?php if($instance['mailchimp_form_url3']){ ?>
        <div class="footer__newsletter-6">
        	<?php echo do_shortcode($instance['mailchimp_form_url3']); ?>
        </div>
        <?php } ?>
        
        <p><?php echo wp_kses_post($instance['content']); ?></p>
                                  
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['mailchimp_form_url3'] = $new_instance['mailchimp_form_url3'];
		$instance['content'] = $new_instance['content'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Newsletter', 'akijcement-core');
		$mailchimp_form_url3 = ($instance) ? esc_attr($instance['mailchimp_form_url3']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('mailchimp_form_url3')); ?>"><?php esc_html_e('MailChimp Form Url:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('mailchimp_form_url3')); ?>" name="<?php echo esc_attr($this->get_field_name('mailchimp_form_url3')); ?>" ><?php echo wp_kses_post($mailchimp_form_url3); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Description:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>     
                
		<?php 
	}	
}


///----footer Three widgets---
//Follow Us
class DM_Follow_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Follow_Us', /* Name */esc_html__('DM Follow Us','akijcement-core'), array( 'description' => esc_html__('Show the Follow Us', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo wp_kses_post($before_widget);?>

        <!-- Footer Widget -->
        <?php echo wp_kses_post($before_title.$title.$after_title); ?>
        <ul class="footer_social_links">
            <?php if($instance['widget_facebook_link']){ ?><li><a href="<?php echo esc_url($instance['widget_facebook_link']); ?>"><i class="fa-brands fa-facebook-f"></i><?php echo wp_kses($instance['widget_facebook_title'], true); ?></a></li><?php } ?>
            <?php if($instance['widget_twitter_link']){ ?><li><a href="<?php echo esc_url($instance['widget_twitter_link']); ?>"><i class="fa-brands fa-twitter"></i><?php echo wp_kses($instance['widget_twitter_title'], true); ?></a></li><?php } ?>
            <?php if($instance['widget_linkedin_link']){ ?><li><a href="<?php echo esc_url($instance['widget_linkedin_link']); ?>"><i class="fa-brands fa-linkedin-in"></i><?php echo wp_kses($instance['widget_linkedin_title'], true); ?></a></li><?php } ?>
            <?php if($instance['widget_instagram_link']){ ?><li><a href="<?php echo esc_url($instance['widget_instagram_link']); ?>"><i class="fa-brands fa-instagram"></i><?php echo wp_kses($instance['widget_instagram_title'], true); ?></a></li><?php } ?>
            <?php if($instance['widget_whatsapp_link']){ ?><li><a href="<?php echo esc_url($instance['widget_whatsapp_link']); ?>"><i class="fa-brands fa-whatsapp"></i><?php echo wp_kses($instance['widget_whatsapp_title'], true); ?></a></li><?php } ?>
        </ul>
                           
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['widget_facebook_title'] = $new_instance['widget_facebook_title'];
		$instance['widget_facebook_link'] = $new_instance['widget_facebook_link'];
		$instance['widget_twitter_title'] = $new_instance['widget_twitter_title'];
		$instance['widget_twitter_link'] = $new_instance['widget_twitter_link'];
		$instance['widget_linkedin_title'] = $new_instance['widget_linkedin_title'];
		$instance['widget_linkedin_link'] = $new_instance['widget_linkedin_link'];
		$instance['widget_instagram_title'] = $new_instance['widget_instagram_title'];
		$instance['widget_instagram_link'] = $new_instance['widget_instagram_link'];
        $instance['widget_whatsapp_title'] = $new_instance['widget_whatsapp_title'];
		$instance['widget_whatsapp_link'] = $new_instance['widget_whatsapp_link'];
		
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Follow Us', 'akijcement-core');
		$widget_facebook_title = ($instance) ? esc_attr($instance['widget_facebook_title']) : '';
		$widget_facebook_link = ($instance) ? esc_attr($instance['widget_facebook_link']) : '';
		
		$widget_twitter_title = ($instance) ? esc_attr($instance['widget_twitter_title']) : '';
		$widget_twitter_link = ($instance) ? esc_attr($instance['widget_twitter_link']) : '';
		
		$widget_linkedin_title = ($instance) ? esc_attr($instance['widget_linkedin_title']) : '';
		$widget_linkedin_link = ($instance) ? esc_attr($instance['widget_linkedin_link']) : '';
		
		$widget_instagram_title = ($instance) ? esc_attr($instance['widget_instagram_title']) : '';
		$widget_instagram_link = ($instance) ? esc_attr($instance['widget_instagram_link']) : '';

        $widget_whatsapp_title = ($instance) ? esc_attr($instance['widget_whatsapp_title']) : '';
		$widget_whatsapp_link = ($instance) ? esc_attr($instance['widget_whatsapp_link']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p> 
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_facebook_title')); ?>"><?php esc_html_e('FaceBook Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Facebook', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_facebook_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_facebook_title')); ?>" type="text" value="<?php echo esc_attr($widget_facebook_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_facebook_link')); ?>"><?php esc_html_e('Facebook Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_facebook_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_facebook_link')); ?>" type="text" value="<?php echo esc_attr($widget_facebook_link); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_twitter_title')); ?>"><?php esc_html_e('Twitter Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Twitter', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_twitter_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_twitter_title')); ?>" type="text" value="<?php echo esc_attr($widget_twitter_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_twitter_link')); ?>"><?php esc_html_e('Twitter Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_twitter_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_twitter_link')); ?>" type="text" value="<?php echo esc_attr($widget_twitter_link); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_linkedin_title')); ?>"><?php esc_html_e('Linkedin Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Linkedin', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_linkedin_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_linkedin_title')); ?>" type="text" value="<?php echo esc_attr($widget_linkedin_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_linkedin_link')); ?>"><?php esc_html_e('Linkedin Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_linkedin_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_linkedin_link')); ?>" type="text" value="<?php echo esc_attr($widget_linkedin_link); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_instagram_title')); ?>"><?php esc_html_e('Instagram Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Instagram', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_instagram_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_instagram_title')); ?>" type="text" value="<?php echo esc_attr($widget_instagram_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_instagram_link')); ?>"><?php esc_html_e('Instagram Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_instagram_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_instagram_link')); ?>" type="text" value="<?php echo esc_attr($widget_instagram_link); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_whatsapp_title')); ?>"><?php esc_html_e('Whatsapp Title:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('Instagram', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_whatsapp_title')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_whatsapp_title')); ?>" type="text" value="<?php echo esc_attr($widget_whatsapp_title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_whatsapp_link')); ?>"><?php esc_html_e('Whatsapp Link:', 'akijcement-core'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'akijcement-core');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_whatsapp_link')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_whatsapp_link')); ?>" type="text" value="<?php echo esc_attr($widget_whatsapp_link); ?>" />
        </p>

		<?php 
	}	
}

//Newsletter V2
class DM_Newsletter_V2 extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Newsletter_V2', /* Name */esc_html__('DM Newsletter V2','akijcement-core'), array( 'description' => esc_html__('Show the Newsletter V2', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
        
        <!-- Footer Widget -->
        <div class="l_item">
        	<?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <div class="footer__subscribe-2">
                <?php echo do_shortcode($instance['widget_mailchimp_form_url3']); ?>
            </div>
        </div>
                                
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['widget_mailchimp_form_url3'] = $new_instance['widget_mailchimp_form_url3'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Newsletter', 'akijcement-core');
		$widget_mailchimp_form_url3 = ($instance) ? esc_attr($instance['widget_mailchimp_form_url3']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_mailchimp_form_url3')); ?>"><?php esc_html_e('MailChimp Form Url:', 'akijcement-core'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_mailchimp_form_url3')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_mailchimp_form_url3')); ?>" ><?php echo wp_kses_post($widget_mailchimp_form_url3); ?></textarea>
        </p>    
                
		<?php 
	}	
}


///----Blog widgets---
//Recent Posts
class DM_Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'DM_Recent_Posts', /* Name */esc_html__('DM Recent Posts','akijcement-core'), array( 'description' => esc_html__('Show the Recent Posts', 'akijcement-core' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo wp_kses_post($before_widget); ?>
        <div class="widget__recent-posts" data-wow-delay="0.3s">
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <div class="widget__rposts">
            	<?php $query_string = array('showposts'=>$instance['number']);
				if ($instance['cat']) {
					$query_string['tax_query'] = array(array('taxonomy' => 'category','field' => 'id','terms' => (array)$instance['cat']));
				}
				$this->posts($query_string); ?>
            </div>
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/* @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/* @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Posts', 'akijcement-core');
		$number = ( $instance ) ? esc_attr($instance['number']) : 5;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'akijcement-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'akijcement-core'); ?></label>
            <?php wp_dropdown_categories(array('show_option_all'=>esc_html__('All Categories', 'akijcement-core'), 'taxonomy' => 'category', 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat'))); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
			<?php 
				global $post;
				while ( $query->have_posts() ) : $query->the_post(); 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			?>
            <div class="widget__rpost">
                <a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>">
                    <article>
                    	<div class="rp-thumb"><?php the_post_thumbnail('axtra_80x80'); ?></div>
                        <div class="rp-right">
                        	<h3 class="rp-title"><?php echo wp_trim_words( get_the_title(), 5, '...' );?></h3>
                        	<p class="rp-date"><?php echo get_the_date();?></p>
                        </div>
                    </article>
                </a>
            </div>
            <?php endwhile; ?>
            
        <?php endif;
		wp_reset_postdata();
    }
}

