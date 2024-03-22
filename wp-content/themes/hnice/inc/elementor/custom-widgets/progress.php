<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Progress;

add_action('elementor/element/progress/section_progress_style/before_section_end', function ($element, $args) {
    $element->add_control(
        'bar_border_radius1',
        [
            'label'      => esc_html__('Progress Done Border Radius ', 'hnice'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-progress-bar' => 'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_progress_style/before_section_end', function ($element, $args) {
    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'        => 'button_border_width',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .elementor-progress-wrapper',
            'separator'   => 'before',
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_progress_style/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'progress_bar_padding',
        [
            'label'      => esc_html__('Progress bar padding', 'hnice'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-progress-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_title/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'title_margin',
        [
            'label'      => esc_html__('Title Margin', 'hnice'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_title/before_section_end', function ($element, $args) {
    $element->add_control(
        'percentage_text_heading',
        [
            'label'     => esc_html__('Percentage Text', 'hnice'),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_title/before_section_end', function ($element, $args) {
    $element->add_control(
        'percentage_text_color',
        [
            'label'     => esc_html__('Percentage Color', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-progress-percentage' => 'color: {{VALUE}};',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_title/before_section_end', function ($element, $args) {
    $element->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name'     => 'percentage_typography',
            'selector' => '{{WRAPPER}} .elementor-progress-percentage',
            'exclude'  => [
                'line_height',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/progress/section_title/before_section_end', function ($element, $args) {
    $element->add_group_control(
        Group_Control_Text_Shadow::get_type(),
        [
            'name'     => 'percentage_shadow',
            'selector' => '{{WRAPPER}} .elementor-progress-percentage',
        ]
    );
}, 10, 2);


class Hnice_Elementor_Progress extends Widget_Progress {
    /**
     * Render progress widget output on the frontend.
     * Make sure value does no exceed 100%.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $progress_percentage = is_numeric($settings['percent']['size']) ? $settings['percent']['size'] : '0';
        if (100 < $progress_percentage) {
            $progress_percentage = 100;
        }

        $this->add_render_attribute('title', [
            'class' => 'elementor-title',
        ]);

        $this->add_inline_editing_attributes('title');

        $this->add_render_attribute('wrapper', [
            'class'          => 'elementor-progress-wrapper',
            'role'           => 'progressbar',
            'aria-valuemin'  => '0',
            'aria-valuemax'  => '100',
            'aria-valuenow'  => $progress_percentage,
            'aria-valuetext' => $settings['inner_text'],
        ]);

        if (!empty($settings['progress_type'])) {
            $this->add_render_attribute('wrapper', 'class', 'progress-' . $settings['progress_type']);
        }

        $this->add_render_attribute('progress-bar', [
            'class'    => 'elementor-progress-bar',
            'data-max' => $progress_percentage,
        ]);

        $this->add_render_attribute('inner_text', [
            'class' => 'elementor-progress-text',
        ]);

        $this->add_inline_editing_attributes('inner_text');

        echo '<div class="progress-title">';

        if (!Utils::is_empty($settings['title'])) { ?>
            <div <?php $this->print_render_attribute_string('title'); ?>><?php $this->print_unescaped_setting('title'); ?></div>
        <?php } ?>

        <?php if ('hide' !== $settings['display_percentage']) { ?>
            <div class="elementor-progress-percentage">
                <?php echo sprintf('%s', $progress_percentage); ?>%
            </div>
        <?php } ?>

        <?php echo '</div>'; ?>

        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('progress-bar'); ?>>
                <span <?php $this->print_render_attribute_string('inner_text'); ?>><?php $this->print_unescaped_setting('inner_text'); ?></span>
            </div>
        </div>
        <?php
    }

    /**
     * Render progress widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
        let progress_percentage = 0;
        if ( ! isNaN( settings.percent.size ) ) {
        progress_percentage = 100 < settings.percent.size ? 100 : settings.percent.size;
        }

        view.addRenderAttribute( 'title', {
        'class': 'elementor-title'
        } );

        view.addInlineEditingAttributes( 'title' );

        view.addRenderAttribute( 'progressWrapper', {
        'class': [ 'elementor-progress-wrapper', 'progress-' + settings.progress_type ],
        'role': 'progressbar',
        'aria-valuemin': '0',
        'aria-valuemax': '100',
        'aria-valuenow': progress_percentage,
        'aria-valuetext': settings.inner_text
        } );

        view.addRenderAttribute( 'inner_text', {
        'class': 'elementor-progress-text'
        } );

        view.addInlineEditingAttributes( 'inner_text' );
        #>
        <div class="progress-title">
            <# if ( settings.title ) { #>
            <div {{{ view.getRenderAttributeString(
            'title' ) }}}>{{{ settings.title }}}
        </div><#
        } #>
        <# if ( 'hide' !== settings.display_percentage ) { #>
        <div class="elementor-progress-percentage">{{{ progress_percentage }}}%</div>
        <# } #>
        </div>

        <div {{{ view.getRenderAttributeString( 'progressWrapper' ) }}}>
        <div class="elementor-progress-bar" data-max="{{ progress_percentage }}">
            <span {{{ view.getRenderAttributeString( 'inner_text' ) }}}>{{{ settings.inner_text }}}</span>
        </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Hnice_Elementor_Progress());
