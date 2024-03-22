<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Hnice_Elementor_Account extends Elementor\Widget_Base {

    public function get_name() {
        return 'hnice-account';
    }

    public function get_title() {
        return esc_html__('Hnice Account', 'hnice');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'header_group_config',
            [
                'label' => esc_html__('Config', 'hnice'),
            ]
        );

        $this->add_control(
            'account_icon',
            [
                'label'   => esc_html__('Icon', 'hnice'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'hnice-icon- hnice-icon-account',
                    'library' => 'hnice',
                ],
            ]
        );

        $this->add_control(
            'account_text',
            [
                'label'   => 'Content Login',
                'type'    => Controls_Manager::TEXT,
                'default' => 'Sign In / Register',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header-group-style',
            [
                'label' => esc_html__('Icon', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a:not(:hover) i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a:not(:hover):before'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a:hover i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a:hover:before'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Font Size', 'hnice'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'          => esc_html__('Width', 'hnice'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-header-account .header-group-action > div a .avatar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'account-content',
            [
                'label' => esc_html__('Content', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Content', 'hnice'),
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .site-header-account a .account-content',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Content Name', 'hnice'),
                'name'     => 'typography_content_admin',
                'selector' => '{{WRAPPER}} .site-header-account a .account-content .content-content',
                'selector' => '{{WRAPPER}} .site-header-account a .account-content .content-admin',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color Content', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account a .account-content .content-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('account_style_color');

        $this->start_controls_tab('account_normal',
            [
                'label' => esc_html__('Normal', 'hnice'),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account a:not(:hover) .account-content .content-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => esc_html__('Color Name', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account a .account-content .content-content:hover'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .site-header-account a:not(:hover) .account-content .content-content'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .site-header-account a:not(:hover) .account-content .content-admin' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('account_hover',
            [
                'label' => esc_html__('Hover', 'hnice'),
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account a:hover .account-content .content-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => esc_html__('Color Name Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-account a:hover .account-content .content-content'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .site-header-account a:hover .account-content .content-admin' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-header-account');
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div class="header-group-action">
                <?php
                if (hnice_is_woocommerce_activated()) {
                    $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
                } else {
                    $account_link = wp_login_url();
                }
                ?>
                <div class="site-header-account">
                    <a href="<?php echo esc_html($account_link); ?>">
                        <?php
                        if (!is_user_logged_in()) {
                            if (!empty($settings['account_icon'])) { ?>
                                <div class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['account_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                            <?php }
                        } else {
                            $user_id = get_current_user_id(); ?>
                            <div class="icon">
                                <?php echo get_avatar($user_id, 24); ?>
                            </div>
                        <?php } ?>
                        <div class="account-content">
                            <?php
                            if (!is_user_logged_in()) {
                                ?>
                                <span class="content-content"><?php printf('%s', $settings['account_text']); ?></span>
                                <?php
                            } else {

                                $user = wp_get_current_user(); ?>
                                <span class="content-admin"><?php echo esc_html($user->display_name); ?></span>
                            <?php } ?>
                        </div>
                    </a>
                    <div class="account-dropdown">

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Hnice_Elementor_Account());
