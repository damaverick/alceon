# Team Accordion Section - Implementation Guide

## Files Created

1. **Template Part**: `template-parts/section/team-accordion.php`
   - Main template file for rendering the team accordion section

2. **ACF Fields**: `inc/acf-team-accordion-fields.php`
   - Programmatically registers ACF fields
   - Already included in functions.php

3. **Styles**: `src/sass/theme/modules/_team-accordion.scss`
   - SCSS styling for the accordion and team grid
   - Already imported in \_child_theme.scss

## How to Use

### In Flexible Content Layout

Add this to your flexible content template:

```php
<?php elseif (get_row_layout() == 'team_accordion_section'): ?>
    <?php get_template_part('template-parts/section/team-accordion'); ?>
```

### Field Structure

- **Section Heading**: Main H2 title
- **Introduction Text**: Optional intro paragraph
- **Team Locations** (Repeater):
  - **Location Name**: e.g., "New South Wales", "Victoria"
  - **Team Members** (Sub-repeater):
    - Name
    - Position
    - Image
    - Biography (for modal)

### Layout Features

- **Desktop**: 4 team members per row
- **Tablet**: 3 per row
- **Mobile**: 2 per row (1 on very small screens)
- **Row Gap**: 30px (rem(30))
- **No horizontal gaps**: Cards are flush against each other
- **Accordion**: H3 headings with expand/collapse icons
- **Modals**: Bootstrap modals with image and bio content

### Styling Classes

Main classes you can customize:

- `.section--team-accordion` - Section wrapper
- `.accordion--team` - Accordion container
- `.team-grid` - Grid layout for team members
- `.team-member-card` - Individual team card
- `.team-member-card__image` - Profile image
- `.team-member-card__name` - Name (H4)
- `.team-member-card__position` - Position text
- `.team-member-card__btn` - Read more button

### Next Steps

1. **Compile SCSS**: Run your Sass build process to generate CSS
2. **Add to Flexible Content**: Register the layout in your ACF flexible content field
3. **Test**: Add content and verify accordion behavior and modals work correctly

## Example ACF Flexible Content Registration

```php
// Add this to your existing flexible content field
array(
    'key' => 'layout_team_accordion',
    'name' => 'team_accordion_section',
    'label' => 'Team Accordion',
    'display' => 'block',
    'sub_fields' => array(
        // The fields are already registered in acf-team-accordion-fields.php
        // Just reference them by key:
        'field_team_accordion_heading',
        'field_team_accordion_intro',
        'field_team_locations',
    ),
)
```
