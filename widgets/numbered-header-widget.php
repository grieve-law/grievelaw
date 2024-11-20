<?php 
if (!defined('ABSPATH')) {
	exit; //exit if access directly
}
/**
 * Elementor Numbered Header Widget
 * 
 * This widget lets you prefix a number to a header
 * @since 1.0.0
 * @author Nate Northway
 * */
class Elementor_Numbered_Header_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'Numbered Header';
	}
	public function get_title() {
		return esc_html__('Numbered Header', 'gl');
	}
	public function get_icon() {
		return 'eicon-code';
	}
	public function get_categories() {
		return ['grieve-law'];
	}
	public function get_keywords() {
		return ['numbered header', 'header', 'numbered', 'numbers', 'heading', 'numbered heading'];
	}
	public function get_style_depends() {
		return ['numberedHeaderWidgetStyle'];
	}
	public function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__('Content', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__('Number Prefix', 'gl'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'input_type' => 'number',
				'placeholder' => esc_html__('1', 'gl')
			]
		);
		$this->add_control(
			'heading',
			[
				'label' => esc_html__('Heading Text', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => esc_html__('Heading Text', 'gl')
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__('Styles', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Number Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.gl-numbered-header span' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'number_background',
			[
				'label' => esc_html__('Number Background Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.gl-numbered-header span' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'header_color',
			[
				'label' => esc_html__('Header Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.gl-numbered-header' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} h3.gl-numbered-header, {{WRAPPER}} h3.gl-numbered-header span'
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		if (empty($settings['number']) || empty($settings['heading'])) {
			return;
		}
		?>
		<h3 class='gl-numbered-header'><span><?php echo $settings['number']; ?></span><?php echo $settings['heading']; ?></h3>
		<?php 
	}
}