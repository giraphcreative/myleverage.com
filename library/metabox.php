<?php


// init cmb2
require_once( 'cmb2/init.php' );



// add metabox(es)
function page_metaboxes( $meta_boxes ) {


    $colors = array(
        'sky' => 'Sky',
        'teal' => 'Teal',
        'navy' => 'Navy',
        'forest' => 'Forest',
        'lime' => 'Lime',
        'orange' => 'Orange',
        'yellow' => 'Yellow',
        'red' => 'Red',
        'grey-light' => 'Grey - Light',
        'grey-dark' => 'Grey - Dark',
    );


    // showcase metabox
    $title_metabox = new_cmb2_box( array(
        'id' => 'title_metabox',
        'title' => 'Large Title',
        'object_types' => array( 'page', 'product' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ));

    $title_metabox->add_field( array(
        'name' => 'Title',
        'id'   => CMB_PREFIX . 'large-title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $title_metabox->add_field( array(
        'name' => 'Icon',
        'id'   => CMB_PREFIX . 'large-title-icon',
        'type' => 'file',
        'preview_size' => array( 30, 30 )
    ) );

    $title_metabox->add_field( array(
        'name' => 'Color',
        'id'   => CMB_PREFIX . 'large-title-color',
        'type' => 'select',
        'default' => 'navy',
        'options' => $colors
    ) );



    // showcase metabox
    $showcase_metabox = new_cmb2_box( array(
        'id' => 'showcase_metabox',
        'title' => 'Showcase',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_metabox_group = $showcase_metabox->add_field( array(
        'id' => CMB_PREFIX . 'showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Slide', 'cmb2'),
            'remove_button' => __('Remove Slide', 'cmb2'),
            'group_title'   => __( 'Slide {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Image/Video',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 80 )
    ) );



    // partner information
    $partner_info = new_cmb2_box( array(
        'id' => 'partner_info',
        'title' => 'Partner Information',
        'object_types' => array( 'partner' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $partner_info->add_field( array(
        'name' => 'Logo',
        'desc' => 'Set a partner logo image.',
        'id' => CMB_PREFIX . 'partner_logo',
        'type' => 'file',
        'allow' => array( 'url', 'attachment' )
    ) );

    $partner_info->add_field( array(
        'name' => 'Website',
        'id' => CMB_PREFIX . 'partner_website',
        'type' => 'text_url'
    ) );

    $partner_info->add_field( array(
        'name' => 'Sort Order',
        'id' => CMB_PREFIX . 'partner_sort',
        'type' => 'text_small',
        'default' => '99'
    ) );



    // thumb showcase metabox
    $thumb_showcase_metabox = new_cmb2_box( array(
        'id' => 'thumb_showcase_metabox',
        'title' => 'The Hive',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $thumb_showcase_metabox_group = $thumb_showcase_metabox->add_field( array(
        'id' => CMB_PREFIX . 'thumb_showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Thumb', 'cmb2'),
            'remove_button' => __('Remove Thumb', 'cmb2'),
            'group_title'   => __( 'Thumb {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Subtitle',
        'id'   => 'subtitle',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Image/Video',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'default' => 'navy',
        'options' => $colors
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Type',
        'id'   => 'type',
        'type' => 'select',
        'default' => 'normal',
        'options' => array(
            'normal' => 'Normal Link',
            'iframe' => 'Video/Map'
        )
    ) );



    // accordion metabox
    $accordion_metabox = new_cmb2_box( array(
        'id' => 'accordion_metabox',
        'title' => 'Accordions',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $accordion_metabox_group = $accordion_metabox->add_field( array(
        'id' => CMB_PREFIX . 'accordion',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Box', 'cmb'),
            'remove_button' => __('Remove Box', 'cmb'),
            'group_title'   => __( 'Accordion Box {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Icon',
        'id'   => 'icon',
        'type' => 'file',
        'preview_size' => array( 30, 30 )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'default' => 'navy',
        'options' => $colors
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Default State',
        'id'   => 'state',
        'type' => 'select',
        'default' => 'closed',
        'options' => array(
            'closed' => 'Closed',
            'open' => 'Open',
        )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'options' => array( 'textarea_rows' => 7 )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Hide this accordion',
        'id'   => 'hide',
        'type' => 'checkbox'
    ) );



    // showcase metabox
    $showcase_footer_metabox = new_cmb2_box( array(
        'id' => 'showcase_footer_metabox',
        'title' => 'Footer Showcase',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_footer_metabox_group = $showcase_footer_metabox->add_field( array(
        'id' => CMB_PREFIX . 'showcase_footer',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Slide', 'cmb2'),
            'remove_button' => __('Remove Slide', 'cmb2'),
            'group_title'   => __( 'Slide {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $showcase_footer_metabox->add_group_field( $showcase_footer_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
    ) );

    $showcase_footer_metabox->add_group_field( $showcase_footer_metabox_group, array(
        'name' => 'Icon',
        'id'   => 'icon',
        'type' => 'file',
        'preview_size' => array( 40, 40 )
    ) );

    $showcase_footer_metabox->add_group_field( $showcase_footer_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $showcase_footer_metabox->add_group_field( $showcase_footer_metabox_group, array(
        'name' => 'Image/Video',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 80 )
    ) );

    $showcase_footer_metabox->add_group_field( $showcase_footer_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'default' => 'navy',
        'options' => $colors
    ) );


    // interstitial metabox
    $interstitial_metabox = new_cmb2_box( array(
        'id' => 'interstitial_metabox',
        'title' => 'Interstitial',
        'desc' => "A lightweight floating advertisement/video that shows up over the top of the page for a set amount of seconds.",
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ));

    $interstitial_metabox->add_field( array(
        'name' => 'Image/Video',
        'id'   => CMB_PREFIX . 'interstitial',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $interstitial_metabox->add_field( array(
        'name' => 'Link',
        'id'   => CMB_PREFIX . 'interstitial-link',
        'type' => 'text_url',
    ) );

    $interstitial_metabox->add_field( array(
        'name' => 'Delay',
        'desc' => 'Set a timeout for how long the ad/video should display. Set to "0" for no timeout.',
        'id'   => CMB_PREFIX . 'interstitial-delay',
        'type' => 'text',
        'default' => '30'
    ) );

}
add_filter( 'cmb2_init', 'page_metaboxes' );



// get CMB value
function get_cmb_value( $field ) {
    return get_post_meta( get_the_ID(), CMB_PREFIX . $field, 1 );
}


// get CMB value
function has_cmb_value( $field ) {
    $cval = get_cmb_value( $field );
    return ( !empty( $cval ) ? true : false );
}


// get CMB value
function show_cmb_value( $field ) {
    print get_cmb_value( $field );
}


// get CMB value
function show_cmb_wysiwyg_value( $field ) {
    print apply_filters( 'the_content', get_cmb_value( $field ) );
}



function cmb2_taxonomy_meta_initiate() {

    require_once( 'cmb2-taxonomy/Taxonomy_MetaData_CMB2.php' );

    /**
     * Semi-standard CMB2 metabox/fields array
     */
    $meta_box = array(
        'id'         => 'cat_options',
        // 'key' and 'value' should be exactly as follows
        'show_on'    => array( 'key' => 'options-page', 'value' => array( 'unknown', ), ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Icon',
                'desc' => 'Select a product category icon',
                'id'   => 'icon',
                'type' => 'file',
            ),
            array(
                'name' => 'Color',
                'description' => 'Select a background color for the header.',
                'id'   => 'color',
                'type' => 'select',
                'default' => 'teal',
                'options' => array(
                    'teal' => 'Teal',
                    'river' => 'River',
                    'navy' => 'Navy',
                    'forest' => 'Forest',
                    'lime' => 'Lime',
                    'orange' => 'Orange',
                    'grey-light' => 'Grey - Light',
                    'grey-dark' => 'Grey - Dark',
                )
            ),
            array(
                'name'    => 'Left Text/Ad',
                'id'      => 'left',
                'type'    => 'wysiwyg',
                'options' => array( 'textarea_rows' => 5, ),
            ),
            array(
                'name'    => 'Right Text',
                'id'      => 'right',
                'type'    => 'wysiwyg',
                'options' => array( 'textarea_rows' => 10, ),
            ),
        )
    );

    /**
     * Instantiate our taxonomy meta class
     */
    $cats = new Taxonomy_MetaData_CMB2( 'product_cat', $meta_box, __( 'Category Settings', 'taxonomy-metadata' ) );

}
cmb2_taxonomy_meta_initiate();




?>