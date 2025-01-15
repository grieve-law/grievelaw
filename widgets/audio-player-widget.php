<?php 
if (!defined('ABSPATH')) {
	exit; //exit if accessed directly
}

/**
 * Elementor Audio Player Widget
 * This widget is a "play" button that triggers/pauses an audio player with other controls
 * @since 1.0.5
 * @author Nate Northway
 * */
class Elementor_Audio_Player_Widget extends \Elementor\Widget_Base {
	public function get_name() { return 'Audio Player';}
	public function get_title() { return esc_html__('Audio Player', 'gl');}
	public function get_icon() { return 'eicon-code';}
	public function get_categories() { return ['grieve-law'];}
	public function get_keywords() {
		return ['audio', 'player', 'audio player', 'mp3'];
	}
	public function get_style_depends() {
		return ['audioPlayerWidgetStyle'];
	}
	public function get_script_depends() {
		return ['audioPlayerWidgetScript'];
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
					'value' => 'fas fa-circle-play',
					'library' => 'fa-solid'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'Background',
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} .gl-audio-player .background'
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label' => 'Background Overlay Color',
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-audio-player .background::before' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'source',
			[
				'label' => esc_html__('Source', 'gl'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['MP3', 'WAV', 'OGG']
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'styles',
			[
				'label' => esc_html__('Styles', 'gl'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'btn_bg_color',
			[
				'label' => esc_html__('Button Background Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-audio-player .player button' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'btn_txt_color',
			[
				'label' => esc_html__('Button Icon Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-audio-player .player button' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'track_color',
			[
				'label' => esc_html__('Timeline Track Color', 'gl'),
				'type' => \Elementor\Controls_manager::COLOR, 
				'selectors' => [
					'{{WRAPPER}} .gl-audio-player' => "--slider-bg: {{VALUE}}"
				]
			]
		);
		$this->add_control(
			'thumb_color',
			[
				'label' => esc_html__('Timeline Thumb Color', 'gl'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gl-audio-player' => "--thumb-color: {{VALUE}}"
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class='gl-audio-player'>
			<div class='background'>
				<div class='icon'>
					<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
				</div>
			</div>
			<div class='player'>
				<audio src='<?php echo $settings['source']['url']; ?>' preload='auto' controls='controls'></audio>
				<button class='pp-button'>play</button>
				<div class='time'>
					<span class='progress'>0:00</span>
					<input type='range' class='timeline' max='100' value='0' />
					<span class='total'>0:00</span>
				</div>
				<button class='mute-button'>mute</button>
			</div>
		</div>
		<?php
	}
}