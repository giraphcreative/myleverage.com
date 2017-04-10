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
        'name' => 'Subtitle',
        'id'   => 'subtitle',
        'type' => 'text',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Link',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Image (Small)',
        'desc' => 'Upload an image intended for screens smaller than 600 pixels wide.',
        'id'   => 'image-small',
        'type' => 'file',
        'preview_size' => array( 200, 200 )
    ) );

    $showcase_metabox->add_group_field( $showcase_metabox_group, array(
        'name' => 'Image (Large)',
        'desc' => 'Upload an image intended for screens larger than 600 pixels wide.',
        'id'   => 'image-large',
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
        'desc' => 'Set a partner logo image. Include the background color in the image, and make sure the image measures 300x140 pixels.',
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
        'name' => 'Image/Video',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Button #1 Text',
        'id'   => 'button-1-text',
        'type' => 'text',
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Button #1 Link',
        'id'   => 'button-1-link',
        'type' => 'text',
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Button #2 Text',
        'id'   => 'button-2-text',
        'type' => 'text',
    ) );

    $thumb_showcase_metabox->add_group_field( $thumb_showcase_metabox_group, array(
        'name' => 'Button #2 Link',
        'id'   => 'button-2-link',
        'type' => 'text',
    ) );



    // event metabox
    $event_metabox = new_cmb2_box( array(
        'id' => 'event_metabox',
        'title' => 'Event',
        'object_types' => array( 'event' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $event_metabox->add_field( array(
        'name' => 'Start Date/Time',
        'id'   => CMB_PREFIX . 'event_start',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'End Date/Time',
        'id'   => CMB_PREFIX . 'event_end',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Early Bird Deadline',
        'id'   => CMB_PREFIX . 'event_early_date',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Early Bird Price',
        'id'   => CMB_PREFIX . 'event_price_early',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Regular Price',
        'id'   => CMB_PREFIX . 'event_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Venue',
        'id'   => CMB_PREFIX . 'event_venue',
        'type' => 'text',
    ) );

    $event_metabox->add_field( array(
        'name' => 'Address',
        'id'   => CMB_PREFIX . 'event_address',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'City',
        'id'   => CMB_PREFIX . 'event_city',
        'type' => 'text_medium'
    ) );

    $event_metabox->add_field( array(
        'name' => 'State',
        'id'   => CMB_PREFIX . 'event_state',
        'type' => 'text_small'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Zipcode',
        'id'   => CMB_PREFIX . 'event_zipcode',
        'type' => 'text_small'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Email',
        'id'   => CMB_PREFIX . 'event_email',
        'type' => 'text_email'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Phone',
        'id'   => CMB_PREFIX . 'event_phone',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Fax',
        'id'   => CMB_PREFIX . 'event_fax',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Venue Website',
        'id'   => CMB_PREFIX . 'event_venue_website',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel',
        'id'   => CMB_PREFIX . 'event_hotel',
        'type' => 'text',
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Address',
        'id'   => CMB_PREFIX . 'event_hotel_address',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel City',
        'id'   => CMB_PREFIX . 'event_hotel_city',
        'type' => 'text_medium'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel State',
        'id'   => CMB_PREFIX . 'event_hotel_state',
        'type' => 'text_small'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Zipcode',
        'id'   => CMB_PREFIX . 'event_hotel_zipcode',
        'type' => 'text_small'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Email',
        'id'   => CMB_PREFIX . 'event_hotel_email',
        'type' => 'text_email'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Phone',
        'id'   => CMB_PREFIX . 'event_hotel_phone',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Rate',
        'id'   => CMB_PREFIX . 'event_hotel_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Hotel Website',
        'id'   => CMB_PREFIX . 'event_hotel_website',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Event Website',
        'id'   => CMB_PREFIX . 'event_website',
        'desc' => 'If populated, links from the calendar/listings will go directly to this URL instead of the event page on this website.',
        'type' => 'text'
    ) );



    // accordion metabox
    $accordion_metabox = new_cmb2_box( array(
        'id' => 'accordion_metabox',
        'title' => 'Boxes',
        'desc' => 'Boxes of content that alternate colors between white and grey.',
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
            'group_title'   => __( 'Content Box {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'show_names' => false,
        'options' => array( 'textarea_rows' => 7 )
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