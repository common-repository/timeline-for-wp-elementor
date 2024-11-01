<?php
/**
 * WP Timeline for Elementor
 *
 * @since 1.0.0
 */
namespace WPMTE\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WP_Timeline extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wpte-timeline';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'WP Timeline', 'wpte' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tb-icon eicon-time-line';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Timeline', 'wpte' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
	

		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'wpmte_icon',
			[
				'label' => esc_html__( 'Icon', 'wpte' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'fa-solid',
				],
			]
		);
		
		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'wpte' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Timeline' , 'wpte' ),
			]
		);
		$repeater->add_control(
			'list_time', [
				'label' => __( 'Time', 'wpte' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '2021.' , 'wpte' ),
			]
		);
		$repeater->add_control(
			'list_content', [
				'label' => __( 'Description', 'wpte' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Item content. Click the edit button to change this text.' , 'wpte' ),
			]
		);
		
		$repeater->add_control(
			'wpmte_item_color', [
			'label' => __( 'Item Color', 'wpte' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .timeline-icon' => 'background: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .timeline-content' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .timeline-year' => 'color: {{VALUE}}',
    			],
			'default' => '',
		]
		);
		

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater Control', '' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Timeline', 'wpte' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'wpte' ),
						'list_time' => __( '2021', 'wpte' ),
					],
					[
						'list_title' => __( 'Timeline', 'wpte' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'wpte' ),
						'list_time' => __( '2022', 'wpte' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

	$this->end_controls_section();
	
	
	$this->start_controls_section(
		'content_style',
		[
			'label' => __( 'Content Style', 'wpte' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'label' => __('Title Typography','wpte'),
			'name' => 'tile_typography',
			//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .wpmte-timeline .title',
		]
	);
	$this->add_control(
		'title_color', [
		'label' => __( 'Title Fonts Color', 'wpte' ),
		'type' => Controls_Manager::COLOR,
		
		'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .title' => 'color: {{VALUE}}',
				],
			'default' => '#333333',
		]
	);
		$this->add_group_control(
		Group_Control_Text_Shadow::get_type(),
		[
			'label' => __('Title Text Shadow','wpte'),
			'name' => 'text_shadow',
			'selector' => '{{WRAPPER}} .wpmte-timeline .title',
		]
		
	);
	$this->add_control(
		'title_margin',
		[
			'label' => __( 'Title Margin', 'wpte' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .wpmte-timeline .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'=> 'after',
			
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[	'label' => __('Description Typography', 'wpte'),
			'name' => 'content_typography',
			//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .wpmte-timeline .description',
		]
	);
	$this->add_control(
		'content_color', [
		'label' => __( 'Description Color', 'wpte' ),
		'type' => Controls_Manager::COLOR,
		
		'selectors' => [
			'{{WRAPPER}} .wpmte-timeline .description' => 'color: {{VALUE}}',
			
		],
		'default' => '#333333',
	]
	);
	$this->end_controls_section();
		/*
		Time Style 
		*/
		$this->start_controls_section(
			'section_time_style',
			[
				'label' => __( 'Time Style', 'wpte' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => __('Time Typography', 'wpte'),
				'name' => 'time_typography',
				//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wpmte-timeline .timeline-year',
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'time_box_shadow',
				'selector' => '{{WRAPPER}} .wpmte-timeline .timeline-year',
			]
		);
		$this->add_control(
			'time_border_radius',
			[
				'label' => __( 'Border Radius', 'wpte' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-year' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'=>[
					'top' =>10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'isLinked' => true,
				],
			]
		);
		$this->add_control(
			'time_padding',
			[
				'label' => __( 'Padding', 'wpte' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-year' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'=>[
					'top' =>5,
					'right' => 10,
					'bottom' => 5,
					'left' => 10,
					'isLinked' => true,
				],
			]
		);
	
		$this->end_controls_section();
	
		/*
		BoxStyle 
		*/
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Box Style', 'wpte' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .wpmte-timeline .timeline-content',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'wpte' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'=>[
					'top' =>50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'isLinked' => true,
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Box Border', 'wpte' ),
				'selector' => '{{WRAPPER}} .wpmte-timeline .timeline-content',
			]
		);
	
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon Box Style', 'wpte' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'wpte' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'=>[
					'top' =>50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
					'isLinked' => true,
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', 'wpte' ),
				'selector' => '{{WRAPPER}} .wpmte-timeline .timeline-icon',
			]
		);
		$this->add_control(
			'icon_box_size',
			[
				'label' => __( 'Size', 'wpte' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'wpte' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_position_rl',
			[
				'label' => __( 'Icon Position R/L', 'wpte' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-icon' => 'left: {{SIZE}}{{UNIT}}; right:auto',
					'{{WRAPPER}} .wpmte-timeline .wpmte-timeline-inner:nth-child(even) .timeline-icon' => 'right: {{SIZE}}{{UNIT}}; left:auto',
				],
			]
		);
		$this->add_control(
			'icon_position_tb',
			[
				'label' => __( 'Icon Position T/B', 'wpte' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpmte_icon_color', [
			'label' => __( 'Icon Color', 'wpte' ),
			'type' => Controls_Manager::COLOR,
			
			'selectors' => [
					'{{WRAPPER}} .wpmte-timeline .timeline-icon i' => 'color: {{VALUE}}',
			],
		]
		);
		$this->end_controls_section();

	}
	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$data	  = $settings['list'];
		?>
            <div class="wpmte-timeline">
				<?php foreach($data as $index=>$content): 
					$item_id = 'elementor-repeater-item-' . $content['_id'];
				?>
				<div class="wpmte-timeline-inner <?php echo $item_id; ?>">
					<div class="timeline-content">
						<div class="timeline-icon">
							<?php \Elementor\Icons_Manager::render_icon( $content['wpmte_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<h3 class="title"><?php echo $content['list_title']; ?></h3>
						<p class="description">
							<?php echo $content['list_content']; ?>
						</p>
						<div class="timeline-year">
							<?php echo $content['list_time']; ?>
						</div>
					</div>
				</div>
				 <?php endforeach;?>
            </div>
	<?php }
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new WP_Timeline() );