<?php

class My_Mega_Menu_Walker extends Walker_Nav_Menu
{
    private $top_type = '';
    private $top_id   = 0;

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $title   = apply_filters('the_title', $item->title, $item->ID);
        $url     = ! empty($item->url) ? $item->url : '';
        $classes = ! empty($item->classes) ? (array) $item->classes : [];

        // 1. Check if the user added the 'no-link' class in the WP Menu
        $is_no_link = in_array('no-link', $classes);

        // =========================================================
        // DEPTH 0: Main Columns (Your Capital, Investor Type)
        // =========================================================
        if ($depth === 0) {

            // Layout Logic (Two Col vs One Col)
            if (in_array('mega-two-col', $classes, true)) {
                $this->top_type = 'two-col';
            } elseif (in_array('mega-one-col', $classes, true)) {
                $this->top_type = 'one-col';
            } else {
                $this->top_type = 'single';
            }
            $this->top_id = $item->ID;

            // Open Column Wrapper
            if ($this->top_type === 'two-col') {
                $output .= '<div class="col-lg-6">';
            } else {
                $output .= '<div class="col-lg-4">';
            }

            $heading_class = 'mega-heading ' . ($this->top_type === 'single' ? 'mb-3' : 'mb-4');
            $output .= '<h5 class="' . esc_attr($heading_class) . '">';

            // Logic: Link it UNLESS 'no-link' is set
            if ($url && !$is_no_link) {
                $output .= '<a href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
            } else {
                $output .= esc_html($title);
            }

            $output .= '</h5>';

            // =========================================================
            // DEPTH 1: Sub-Headers (Capabilities) OR Direct Links
            // =========================================================
        } elseif ($depth === 1) {

            if ($this->top_type === 'two-col') {
                $output .= '<div class="col-6">';
            }

            // SCENARIO A: Has 'no-link' class -> Render as H6 Heading (Text Only)
            if ($is_no_link) {
                $output .= '<h6 class="mega-subheading mb-3">' . esc_html($title) . '</h6>';
            }
            // SCENARIO B: Default -> Render as List Item with Link
            else {
                // We wrap it in a UL so it looks identical to the children lists
                $output .= '<ul class="list-unstyled mega-links mb-2"><li>';

                if ($url) {
                    $output .= '<a href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
                } else {
                    $output .= esc_html($title);
                }
                // Closing tags (</li></ul>) are handled in end_el
            }

            // =========================================================
            // DEPTH 2+: Standard List Items
            // =========================================================
        } elseif ($depth >= 2) {

            $output .= '<li>';
            if ($url && !$is_no_link) {
                $output .= '<a href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
            } else {
                $output .= esc_html($title);
            }
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $classes = ! empty($item->classes) ? (array) $item->classes : [];
        $is_no_link = in_array('no-link', $classes);

        if ($depth === 0) {
            $output .= '</div>'; // Close col-lg-3/6
        } elseif ($depth === 1) {

            // If it was a standard link (Scenario B), we need to close the UL/LI wrapper
            if (!$is_no_link) {
                $output .= '</li></ul>';
            }

            if ($this->top_type === 'two-col') {
                $output .= '</div>'; // Close col-6
            }
        } elseif ($depth >= 2) {
            $output .= '</li>';
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        // Wrapper for Two-Col Columns inner row
        if ($depth === 0 && $this->top_type === 'two-col') {
            $output .= '<div class="row gx-4">';
        }
        // Wrapper for children lists (e.g. items under a Depth 1 H6)
        elseif ($depth === 1) {
            $output .= '<ul class="list-unstyled mega-links">';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        if ($depth === 0 && $this->top_type === 'two-col') {
            $output .= '</div>';
        } elseif ($depth === 1) {
            $output .= '</ul>';
        }
    }
}
