<?php 
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Elementor Slide Up Widget
 * This widget has an element that slides up to meet a header
 * @since 1.0.0
 * @author Nate Northway
 * 
 * @since 1.3.0
 * @author Nate Northway
 * - Added background overlay option (for background of hidden text when shown)
 * - Added background image option
 * - Added subheading option
 * - Added subheading text color option
 * - Added accent color options 
 * - Changed all selectors to set variables rather than properties (makes CSS cleaner)
 * - Changed render() to include subheading
 * - Changed render() to only render icon container when icon is set
 * */
class Elementor_Slide_Up_Widget extends \Elementor\Widget_Base {
	public function get_name() { return 'Slide Up';}
	public function get_title() { return esc_html__('Slide Up', 'gl');}
	public function get_icon() { return 'eicon-code';}
	public function get_categories() { return ['grieve-law'];}
	public function get_keywords() {
		return ['slide up', 'slideup', 'square'];
	}
	public function get_style_depends() {
		return ['slideupWidgetStyle'];
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
			'icon',
			[
				'label' => esc_html__('Icon', 'gl'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-building-columns',
					'library' => 'fa-solid',
				]
			]
		);
		$this->add_control(
			'heading',
			[
				'label' => esc_html__('Heading', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		$this->add_control(
			'subheading',
			[
				'label' => esc_html__('Subheading', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('description', 'gl'),
				'type' => \Elementor\Controls_Manager::WYSIWYG
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'gl'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'label_block' => true,
			],
		);
		$this->add_control(
			'link_text',
			[
				'label' => esc_html__('Link Text', 'gl'),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'styles',
			[
				'label' => esc_html__('Styles', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__('Background Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-slideup' => '--background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => esc_html__('Background', 'gl'),
				'types' => ['image']
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label' => esc_html__('Background Overlay Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-slideup' => '--overlay-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'accent_color',
			[
				'label' => esc_html__('Accent Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-slideup' => '--accent-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'subheading_text_color',
			[
				'label' => esc_html__('Subheading Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-slidup'=> '--subheading-text-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-slideup' => '--text-color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<a class='gl-slideup' href='<?= $settings['link']['url']; ?>' style='
			--background-image: url(<?php echo $settings['Background_image']['url']; ?>); 
			--background-position: <?php echo $settings['Background_position']; ?>;
			--background-repeat: <?php echo $settings['Background_repeat']; ?>;
			--background-size: <?php echo $settings['Background_size']; ?>;
			'>
			<div class='inner'>
				<div class='title'>
					<?php if ($settings['icon']['value'] != "" && $settings['icon']['value'] != null) : ?>
						<div class='icon'>
							<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
						</div>
					<?php endif; ?>
					<h3><?php echo $settings['heading']; ?></h3>
					<span class='subheading'><?php echo $settings['subheading']; ?></span>
				</div>
				<div class='content'>
					<p><?php echo $settings['description']; ?></p>
					<span class='link_text'><?php echo $settings['link_text']; ?></span>
				</div>
			</div>
		</a>
		<?php 
	}
}