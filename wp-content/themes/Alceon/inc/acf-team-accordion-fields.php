<?php

/**
 * ACF Team Accordion Fields
 * Adds team accordion layout to existing Page Builder flexible content.
 */

add_filter('acf/load_field/key=field_690c417709453', 'add_team_accordion_layout');

function add_team_accordion_layout($field)
{
    // Add the Team Accordion layout to the flexible content field
    $field['layouts']['layout_team_accordion'] = array(
        'key' => 'layout_team_accordion',
        'label' => 'Team Accordion',
        'name' => 'team_accordion_section',
        'display' => 'block',
        'min' => '',
        'max' => '',
        'sub_fields' => array(
            array(
                'key' => 'field_team_accordion_heading',
                'label' => 'Section Heading',
                'name' => 'team_accordion_heading',
                'type' => 'text',
                'instructions' => 'Main heading for the team accordion section',
                'required' => 0,
                'conditional_logic' => 0,
                'default_value' => 'Meet the Team',
                'ID' => '',
            ),
            array(
                'key' => 'field_team_accordion_intro',
                'label' => 'Introduction Text',
                'name' => 'team_accordion_intro',
                'type' => 'wysiwyg',
                'instructions' => 'Optional introduction paragraph',
                'required' => 0,
                'conditional_logic' => 0,
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'ID' => '',
            ),
            array(
                'key' => 'field_team_locations',
                'label' => 'Team Locations',
                'name' => 'team_locations',
                'type' => 'repeater',
                'instructions' => 'Add locations/provinces and their team members',
                'required' => 0,
                'conditional_logic' => 0,
                'layout' => 'block',
                'button_label' => 'Add Location',
                'min' => '',
                'max' => '',
                'collapsed' => '',
                'ID' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_location_name',
                        'label' => 'Location/Province Name',
                        'name' => 'location_name',
                        'type' => 'text',
                        'instructions' => 'e.g., New South Wales, Victoria, Queensland',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'ID' => '',
                        'wrapper' => array(
                            'width' => '100',
                        ),
                    ),
                    array(
                        'key' => 'field_team_members',
                        'label' => 'Team Members',
                        'name' => 'team_members',
                        'type' => 'repeater',
                        'instructions' => 'Add team members for this location',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'layout' => 'table',
                        'button_label' => 'Add Team Member',
                        'min' => '',
                        'max' => '',
                        'collapsed' => '',
                        'ID' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_member_name',
                                'label' => 'Name',
                                'name' => 'member_name',
                                '_name' => 'member_name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'ID' => '',
                                'wrapper' => array(
                                    'width' => '25',
                                ),
                            ),
                            array(
                                'key' => 'field_member_position',
                                'label' => 'Position',
                                'name' => 'member_position',
                                '_name' => 'member_position',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'ID' => '',
                                'wrapper' => array(
                                    'width' => '25',
                                ),
                            ),
                            array(
                                'key' => 'field_member_image',
                                'label' => 'Image',
                                'name' => 'member_image',
                                '_name' => 'member_image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'return_format' => 'array',
                                'preview_size' => 'thumbnail',
                                'library' => 'all',
                                'ID' => '',
                                'wrapper' => array(
                                    'width' => '25',
                                ),
                            ),
                            array(
                                'key' => 'field_member_bio',
                                'label' => 'Biography',
                                'name' => 'member_bio',
                                '_name' => 'member_bio',
                                'type' => 'wysiwyg',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'tabs' => 'all',
                                'toolbar' => 'basic',
                                'media_upload' => 0,
                                'ID' => '',
                                'wrapper' => array(
                                    'width' => '25',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );

    return $field;
}
