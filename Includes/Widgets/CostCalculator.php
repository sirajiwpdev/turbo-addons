<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Group_Control_Image_Size,
	Plugin,
	Controls_Manager,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class CostCalculator extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'dm-cost-calculator';
	}


	public function get_title() {
		return __( 'DM Calculator', 'akijcement-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-number-field';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

//	public function get_script_depends() {
//		return [
//			'isotope',
//			'imagesloaded',
//			'packery',
//		];
//	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Cost Calculator', 'akijcement-core' ),
			]
		);



		$this->end_controls_section();





	}

	protected function render() {
		$settings   = $this->get_settings_for_display();

        ?>
		<div class="bg-light-grey p-5 pr-0 costingscrn1">
			<div class="icon-and-heading">
				<h3 class="ml-3">Location and Area</h3>
			</div>
			<div class="form-group mt-5">
				<select name="state" id="state" onchange="onStateChange(this.value)" class="form-control bg-white"><option disabled="disabled" selected="selected" value="">Select State</option> <option value="Haryana">Haryana</option> <option value="Madhya Pradesh">Madhya Pradesh</option> <option value="Punjab">Punjab</option> <option value="Rajasthan">Rajasthan</option> <option value="Uttar Pradesh">Uttar Pradesh</option> <option value="Himachal Pradesh">Himachal Pradesh</option> <option value="J &amp; K">J &amp; K</option> <option value="Bihar">Bihar</option> <option value="Jharkhand">Jharkhand</option> <option value="West Bengal">West Bengal</option> <option value="Chattisgarh">Chattisgarh</option> <option value="Odisha">Odisha</option> <option value="Maharashtra">Maharashtra</option> <option value="Gujarat">Gujarat</option> <option value="Andhra Pradesh">Andhra Pradesh</option> <option value="Telangana">Telangana</option> <option value="Tamil Nadu">Tamil Nadu</option> <option value="Kerala">Kerala</option> <option value="Karnataka">Karnataka</option> <option value="Andaman &amp; Nicobar Islands *">Andaman &amp; Nicobar Islands *</option> <option value="Arunachal Pradesh">Arunachal Pradesh</option> <option value="Assam">Assam</option> <option value="Chandigarh *">Chandigarh *</option> <option value="Dadra &amp; Nagar Haveli *">Dadra &amp; Nagar Haveli *</option> <option value="Daman &amp; Diu *">Daman &amp; Diu *</option> <option value="Delhi *">Delhi *</option> <option value="Goa">Goa</option> <option value="Lakshadweep *">Lakshadweep *</option> <option value="Manipur">Manipur</option> <option value="Meghalaya">Meghalaya</option> <option value="Mizoram">Mizoram</option> <option value="Nagaland">Nagaland</option> <option value="Pondicherry *">Pondicherry *</option> <option value="Sikkim">Sikkim</option> <option value="Tripura">Tripura</option> <option value="Uttaranchal">Uttaranchal</option></select>
			</div>

			<div class="form-group pt-3">
				Area of Construction:
				<div class="custom-control custom-radio custom-control-inline d-block d-md-inline-block">
					<input type="radio" checked="checked" id="sqfeet" value="sqfeet" name="units"
					       class="custom-control-input">
					<label for="sqfeet" class="custom-control-label">Sq. Feet</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline d-block d-md-inline-block">
					<input type="radio" value="sqmeter" id="sqmeter" name="units" class="custom-control-input">
					<label for="sqmeter" class="custom-control-label">Sq. Meter</label>
				</div>
				<div class="row mt-3">
					<div class="col-md-4 d-flex align-items-center">
						<div class="info-circle mr-2 mb-2">
							<a href="javascript:;" data-container="body" data-toggle="popover" data-placement="bottom"
							   data-content=" This indicates the total area of construction including the floors, parking and outdoor spaces"
							   data-original-title="" title="">
								<i class="fa fa-s fa-info-circle"></i>
							</a>
							<div class="wrap-infoP">
								<p class="info_circle_p">This indicates the total area of construction including the floors,
									parking and outdoor
									spaces
								</p>
							</div>
						</div>
						<div class="form-group">
							<input type="number" name="total_area" id="area" placeholder=" Total Area" class="form-control">
						</div>
					</div>
				</div>
				<div class="next-block mt-5">
					<a href="javascript:;" disabled="disabled" id="nextBtn" class="btn btn-block btn-dark ultra-submitbtn">
						<span>Next</span>
					</a>
				</div>
			</div>
		</div>

		<?php

	}
}