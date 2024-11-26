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
		$this->add_control(
			'first_text_color',
			[
				'label' => esc_html__('Initial Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .first-text' => 'color: {{VALUE}}'
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
		$this->add_control(
			'second_text_color',
			[
				'label' => esc_html__('Hidden Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.gl-double-button .second-text' => 'color: {{VALUE}}'
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
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$class = $settings['up_or_down'];
		?>
		<a class='gl-double-button<?php if ($class === "bottom"):echo " bottom"; endif; ?>' href='<?php echo $settings['link']['url']; ?>'>
			<?php if ($class === "bottom") : ?>
				<span class='second-text'><?= $settings['second_text']; ?></span>
				<span class='first-text'><?= $settings['first_text']; ?></span>
			<?php else : ?>
				<span class='first-text'><?= $settings['first_text']; ?></span>
				<span class='second-text'><?= $settings['second_text']; ?></span>
			<?php endif; ?>
		</a>
		<?php 
	}
}