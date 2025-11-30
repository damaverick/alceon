<?php

class My_Mega_Menu_Walker extends Walker_Nav_Menu
{
    private $top_type = '';
    private $top_id   = 0;

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $title   = apply_filters('the_title', $item->title, $item->ID);
        $url     = ! empty($item->url) && $item->url !== '#' ? $item->url : '';
        $classes = ! empty($item->classes) ? (array) $item->classes : [];

        if ($depth === 0) {
            // Determine what kind of top-level column this is.
            if (in_array('mega-two-col', $classes, true)) {
                $this->top_type = 'two-col';
            } elseif (in_array('mega-one-col', $classes, true)) {
                $this->top_type = 'one-col';
            } else {
                $this->top_type = 'single';
            }

            $this->top_id = $item->ID;

            // Column width
            if ($this->top_type === 'two-col') {
                $output .= '<div class="col-lg-6">';
            } else {
                $output .= '<div class="col-lg-3">';
            }

            // h5 heading (linked)
            $heading_class = 'mega-heading ' . ($this->top_type === 'single' ? 'mb-3' : 'mb-4');
            $output .= '<h5 class="' . esc_attr($heading_class) . '">';

            if ($url) {
                $output .= '<a href="' . esc_url($url) . '">';
                $output .= esc_html($title);
                $output .= '</a>';
            } else {
                $output .= esc_html($title);
            }

            $output .= '</h5>';

            // For "single" (Your Career) we’re done here (no children expected).
            // Children will be handled in start_lvl / start_el as usual when present.

        } elseif ($depth === 1) {

            // Depth 1 are headings like "Types of Investors", "Capabilities"
            if ($this->top_type === 'two-col') {
                // Each depth-1 item is a column
                $output .= '<div class="col-6">';
            }

            // Heading for this group
            $output .= '<h6 class="mega-subheading mb-3">' . esc_html($title) . '</h6>';

            // For "one-col", we do not wrap in a col-6, just the heading;
            // its children (depth 2) will create a single list.

        } elseif ($depth === 2) {

            // Depth 2 are actual links inside <ul>
            $output .= '<li>';
            if ($url) {
                $output .= '<a href="' . esc_url($url) . '">';
                $output .= esc_html($title);
                $output .= '</a>';
            } else {
                $output .= esc_html($title);
            }
            // </li> will be closed in end_el
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        if ($depth === 0) {
            // Close column
            $output .= '</div>';
        } elseif ($depth === 1) {
            if ($this->top_type === 'two-col') {
                // Close col-6 wrapper for two-column group
                $output .= '</div>';
            }
        } elseif ($depth === 2) {
            $output .= '</li>';
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        if ($depth === 0 && $this->top_type === 'two-col') {
            // Children of "Your Capital": open row for the two inner columns
            $output .= '<div class="row gx-4">';
        } elseif ($depth === 1) {
            // Children of a depth-1 heading: the list of links
            $output .= '<ul class="list-unstyled mega-links">';
        }
        // No wrapper for depth 0 when top_type is one-col or single
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        if ($depth === 0 && $this->top_type === 'two-col') {
            // Close row for the two inner columns
            $output .= '</div>';
        } elseif ($depth === 1) {
            // Close UL
            $output .= '</ul>';
        }
    }
}
