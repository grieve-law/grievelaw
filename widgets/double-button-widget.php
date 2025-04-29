<?php 
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Elementor Double Button Widget
 * 
 * This widget is a button with a line of text that hides when hovered to reveal a second line of text 
 * @since 1.0.4
 * @author Nate Northway
 * */
class Elementor_Double_Button_Widget extends \Elementor\Widget_Base {
	public function get_name() {return 'Double Button';}
	public function get_title() { return esc_html__('Double Button', 'gl');}
	public function get_icon() { return 'eicon-code';}
	public function get_categories() { return ['grieve-law'];}
	public function get_keywords() {
		return ['button', 'double button', 'hidden text', 'hidden'];
	}
	public function get_style_depends() {
		return ['doubleButtonWidgetStyle'];
	}
	public function register_controls() {
		$this->start_controls_section(
			'first_content',
			[
				'label' => esc_html__('Initial Content', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		/**
		 * @since 4/14/25
		 * @author Nate Northway
		 * for v1.2: adding icon & offset
		 * until line 55
		 * */
		$this->add_control(
			'first_icon',
			[
				'label' => esc_html__('Initial Icon', 'gl'),
				'type' => \Elementor\Controls_Manager::ICONS
			]
		);
		$this->add_control(
			'first_icon_offset',
			[
				'label' => esc_html__('Initial Icon Offset', 'gl'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .first-text .icon-wrapper svg' => 'margin-top: {{VALUE}}px'
				]
			]
		);
		$this->add_control(
			'first_text',
			[
				'label' => esc_html__('Initial Text', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		$this->add_control(
			'first_text_background',
			[
				'label' => esc_html__('Initial Text Background', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .first-text' => 'background-color: {{VALUE}}'
				]
			]
		);
		/**
		 * @since 4/14/25
		 * @author Nate Northway
		 * for v1.2: adding icon selector to selectors arr
		 * line 85, 86
		 * */
		$this->add_control(
			'first_text_color',
			[
				'label' => esc_html__('Initial Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .first-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} a.gl-double-button .first-text .icon-wrapper svg' => 'fill: {{VALUE}}'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'first_content_typography',
				'selector' => '{{WRAPPER}} a.gl-double-button span.first-text'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'second_content',
			[
				'label' => esc_html__('Secondary Content', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		/**
		 * @since 4/14/25
		 * @author Nate Northway
		 * for v1.2: adding icon
		 * until line 129
		 * 
		 * for v1.2.1: removing icon default
		 * */
		$this->add_control(
			'second_icon',
			[
				'label' => esc_html__('Secondary Icon', 'gl'),
				'type' => \Elementor\Controls_Manager::ICONS
			]
		);
		$this->add_control(
			'second_icon_offset',
			[
				'label' => esc_html__('Secondary Icon Offset', 'gl'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .second-text .icon-wrapper svg' => 'margin-top: {{VALUE}}px'
				]
			]
		);
		$this->add_control(
			'second_text',
			[
				'label' => esc_html__('Hidden Text', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		$this->add_control(
			'second_text_background',
			[
				'label' => esc_html__('Hidden Text Background', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .second-text' => 'background-color: {{VALUE}}'
				]
			]
		);
		/**
		 * @since 4/14/25
		 * @author Nate Northway
		 * for v1.2: adding icon selector to selectors arr
		 * lines 161:162
		 * */
		$this->add_control(
			'second_text_color',
			[
				'label' => esc_html__('Hidden Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .second-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} a.gl-double-button .second-text .icon-wrapper svg' => 'fill: {{VALUE}}'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hidden_content_typography',
				'selector' => '{{WRAPPER}} a.gl-double-button span.second-text'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'button_props',
			[
				'label' => esc_html__('Button Properties', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'gl'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'label_block' => true,
			]
		);
		$this->add_control(
			'up_or_down',
			[
				'label' => esc_html__('Hidden text slides up to top or down to bottom:', 'gl'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'top' => esc_html__('Top', 'gl'),
					'bottom' => esc_html('Bottom', 'gl')
				]
			]
		);
		/**
		 * @since 4/14/25
		 * @author Nate Northway
		 * for v1.2: init of border radius props
		 * until line 226
		 * */
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'gl'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'default' => [
					'top' => 4,
					'right' => 4, 
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				]
			]
		);
		$this->end_controls_section();

	}

	/**
	 * @since 4/14/25
	 * @author Nate Northway
	 * for v1.2: reconfiguring the way text is displayed to add in the conditional rendering of elements.
	 * lines 237:271
	 * */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$class = $settings['up_or_down'];
		?>
		<a class='gl-double-button<?php if ($class === "bottom"):echo " bottom"; endif; ?>' href='<?php echo $settings['link']['url']; ?>'>
			<?php if ($class === "bottom") : ?>
				<span class='second-text'>
					<?php if (isset($settings['second_icon'])) : ?>
						<div class='icon-wrapper'><?php \Elementor\Icons_Manager::render_icon($settings['second_icon'], ['aria-hidden' => 'true']); ?></div>
					<?php endif; ?>
					<?= $settings['second_text']; ?>
				</span>
				<span class='first-text'>
					<?php if (isset($settings['first_icon'])) : ?>
						<div class='icon-wrapper'><?php \Elementor\Icons_Manager::render_icon($settings['first_icon'], ['aria-hidden' => 'true']); ?></div>
					<?php endif; ?>
					<?= $settings['first_text']; ?>
				</span>
			<?php else : ?>
				<span class='first-text'>
					<?php if (isset($settings['first_icon'])) : ?>
						<div class='icon-wrapper'><?php \Elementor\Icons_Manager::render_icon($settings['first_icon'], ['aria-hidden' => 'true']); ?></div>
					<?php endif; ?>
					<?= $settings['first_text']; ?>
				</span>
				<span class='second-text'>
					<?php if (isset($settings['second_icon'])) : ?>
						<div class='icon-wrapper'><?php \Elementor\Icons_Manager::render_icon($settings['second_icon'], ['aria-hidden' => 'true']); ?></div>
					<?php endif; ?>
					<?= $settings['second_text']; ?>
				</span>
			<?php endif; ?>
		</a>
		<?php 
	}
}