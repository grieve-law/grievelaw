<?php 
if (!defined('ABSPATH')) {
	exit; //exit if accessed directly
}

/**
 * Elementor Bubble Button Widget
 * 
 * This widget is a button with an icon and a cool bubble feature
 * @since 1.0.0
 * @author Nate Northway
 * */
class Elementor_Bubble_Button_Widget extends \Elementor\Widget_Base {
	public function get_name() { return 'Bubble Button';}
	public function get_title() { return esc_html__('Bubble Button', 'gl');}
	public function get_icon() { return 'eicon-code';}
	public function get_categories() { return ['grieve-law'];}
	public function get_keywords() {
		return ['button', 'bubble button'];
	}
	public function get_style_depends() {	
		return ['bubbleButtonWidgetStyle'];
	}
	public function register_controls() {
		//icon 
		$this->start_controls_section(
			'content', 
			[
				'label' => esc_html__('Content', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'gl'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-building-columns',
					'library' => 'fa-solid'
				]
			]
		);
		$this->add_control(
			'text',
			[
				'label' => esc_html__('Button Text', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
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
		$this->end_controls_section();
		$this->start_controls_section(
			'styles',
			[
				'label' => esc_html__('Styles', 'gl'),
				'tab' => \Elementor\Controls_manager::TAB_STYLE
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__('Background Color' ,'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-bubble-button' => 'background: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'accent_color',
			[
				'label' => esc_html__('Accent Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-bubble-button .icon' => 'background: {{VALUE}}',
					'{{WRAPPER}} a.gl-bubble-button .icon:before' => 'background: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-bubble-button .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} a.gl-bubble-button .icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} a.gl-bubble-button span' => 'color: {{VALUE}}',
					'{{WRAPPER}} a.gl-bubble-button span:after' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<a class='gl-bubble-button' href='<?php echo $settings['link']['url']; ?>'>
			<div class='icon'>
				<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
			</div>
			<span><?php echo $settings['text']; ?></span>
		</a>
		<?php 
	}
}