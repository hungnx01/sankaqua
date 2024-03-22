<?php

use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Widget_Image_Box;

add_action('elementor/element/image-box/section_image/before_section_end', function ($element, $args) {

    $element->add_control(
        'image_show_button',
        [
            'label' => esc_html__('Show Button', 'hnice'),
            'type'  => Controls_Manager::SWITCHER,
        ]
    );


    $element->add_control(
        'image_button_text',
        [
            'label'       => esc_html__('Button Text', 'hnice'),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' => esc_html__('Button', 'hnice'),
            'default'     => esc_html__('Button', 'hnice'),
            'condition'   => [
                'image_show_button' => 'yes'
            ]
        ]
    );

}, 10, 2);

class Hnice_Elementor_Image_Box extends Widget_Image_Box {

    /**
     * Render image box widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $has_content = !Utils::is_empty($settings['title_text']) || !Utils::is_empty($settings['description_text']);

        $html = '<div class="elementor-image-box-wrapper">';

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('link', $settings['link']);
        }

        if (!empty($settings['image']['url'])) {
            $this->add_render_attribute('image', 'src', $settings['image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['image']));

            if ($settings['hover_animation']) {
                $this->add_render_attribute('image', 'class', 'elementor-animation-' . $settings['hover_animation']);
            }

            $image_html = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'));



            $html .= '<figure class="elementor-image-box-img"><div class="elementor-image-box-img-inner">' . $image_html . '</div></figure>';
        }

        if ($has_content) {
            $html .= '<div class="elementor-image-box-content">';

            if (!Utils::is_empty($settings['title_text'])) {
                $this->add_render_attribute('title_text', 'class', 'elementor-image-box-title');

                $this->add_inline_editing_attributes('title_text', 'none');

                $title_html = $settings['title_text'];

                if (!empty($settings['link']['url'])) {
                    $title_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $title_html . '</a>';
                }

                $html .= sprintf('<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag($settings['title_size']), $this->get_render_attribute_string('title_text'), $title_html);
            }

            if (!Utils::is_empty($settings['description_text'])) {
                $this->add_render_attribute('description_text', 'class', 'elementor-image-box-description');

                $this->add_inline_editing_attributes('description_text');

                $html .= sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description_text'), $settings['description_text']);
            }

            if (!empty($settings['link']['url'])) {
                if ($settings['image_show_button']) {
                    $this->add_link_attributes('link_button', $settings['link']);
                    $this->add_render_attribute('link_button', 'class', 'elementor-image-box-button');
                    $html .= sprintf( '<div class="elementor-image-box-button-wrapper"><a ' . $this->get_render_attribute_string('link_button') . '><span class="elementor-image-box-button-text">' . $settings['image_button_text'] . '
<i class="hnice-icon-arrow_s"></i></span></a></div>');
                }
            }

            $html .= '</div>';
        }

        $html .= '</div>';

        Utils::print_unescaped_internal_string($html);
    }

    /**
     * Render image box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
        var html = '<div class="elementor-image-box-wrapper">';

            if ( settings.image.url ) {
            var image = {
            id: settings.image.id,
            url: settings.image.url,
            size: settings.thumbnail_size,
            dimension: settings.thumbnail_custom_dimension,
            model: view.getEditModel()
            };

            var image_url = elementor.imagesManager.getImageUrl( image );

            var imageHtml = '<img src="' + image_url + '" class="elementor-animation-' + settings.hover_animation + '" />';

            if ( settings.link.url ) {
                if (settings.image_show_button) {
                    imageHtml += '<div class="elementor-button-wrapper"><a class="elementor-button-link elementor-button" href="' + settings.link.url + '"><span class="elementor-button-content-wrapper"><span>' + settings.image_button_text + '</spanspan><span class="elementor-button-icon elementor-align-icon-after"><i class="hnice-icon-angle-right"></i></span></span></a></div>';
                }else {
                    imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
                }

            }
            html += '<figure class="elementor-image-box-img">' + imageHtml + '</figure>';
            }

            var hasContent = !! ( settings.title_text || settings.description_text );

            if ( hasContent ) {
            html += '<div class="elementor-image-box-content">';

                if ( settings.title_text ) {
                var title_html = settings.title_text,
                titleSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );

                if ( settings.link.url ) {
                title_html = '<a href="' + settings.link.url + '">' + title_html + '</a>';
                }

                view.addRenderAttribute( 'title_text', 'class', 'elementor-image-box-title' );

                view.addInlineEditingAttributes( 'title_text', 'none' );

                html += '<' + titleSizeTag  + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title_html + '</' + titleSizeTag  + '>';
            }

            if ( settings.description_text ) {
            view.addRenderAttribute( 'description_text', 'class', 'elementor-image-box-description' );

            view.addInlineEditingAttributes( 'description_text' );

            html += '<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>';
            }

            html += '</div>';
        }

        html += '</div>';

        print( html );
        #>
        <?php
    }

}

$widgets_manager->register(new Hnice_Elementor_Image_Box());
