<?php

class My_Mega_Menu_Walker extends Walker_Nav_Menu
{
    private $top_type = ''; // Options: 'single', 'two-col', 'one-col', 'split'
    private $top_id   = 0;

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $title   = apply_filters('the_title', $item->title, $item->ID);
        $url     = ! empty($item->url) ? $item->url : '';
        $classes = ! empty($item->classes) ? (array) $item->classes : [];
        $is_no_link = in_array('no-link', $classes);

        // =========================================================
        // DEPTH 0: Main Columns (Your Capital)
        // =========================================================
        if ($depth === 0) {
            // We force this to be WIDER (col-lg-8) so there is room for the split view
            // You can adjust 'col-lg-8' to 'col-lg-9' if you need more space
            $output .= '<div class="col-lg-8 position-relative">'; 
            
            $output .= '<h5 class="mega-heading mb-4">';
            if ($url && !$is_no_link) {
                $output .= '<a href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
            } else {
                $output .= esc_html($title);
            }
            $output .= '</h5>';

        // =========================================================
        // DEPTH 1: The Trigger Rows (Investor Type, Capabilities...)
        // =========================================================
        } elseif ($depth === 1) {
            
            // 1. OPEN THE WRAPPER (This keeps the menu open on hover)
            $output .= '<div class="flyout-row">';

            // 2. THE TRIGGER (The Text/Link on the left)
            // We check for 'no-link' to decide if it's an H6 or an A tag
            if ($is_no_link) {
                $output .= '<h6 class="mega-subheading mb-3 flyout-trigger">' . esc_html($title) . ' <span class="arrow">&rsaquo;</span></h6>';
            } else {
                $output .= '<a href="' . esc_url($url) . '" class="mega-subheading mb-3 d-block flyout-trigger">' . esc_html($title) . ' <span class="arrow">&rsaquo;</span></a>';
            }
            
            // Note: We do NOT close the </div> here. 
            // The UL (children) will be printed next, sitting INSIDE this wrapper.
        } 

        // =========================================================
        // DEPTH 2+: The Links (Inside the hidden list)
        // =========================================================
        elseif ($depth >= 2) {
            $output .= '<li class="menu-item">';
            if ($url && !$is_no_link) {
                $output .= '<a href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
            } else {
                $output .= esc_html($title);
            }
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        // DEPTH 0: Close the main Column
        if ($depth === 0) {
            $output .= '</div>'; 
        } 
        // DEPTH 1: Close the Wrapper (flyout-row)
        elseif ($depth === 1) {
             // Close the <ul> which was opened in start_lvl (handled by WP default usually, but we need to close our custom wrapper)
             // Note: start_lvl outputs the <ul>. end_lvl outputs </ul>.
             // So here we just close the div we opened in start_el.
             $output .= '</div>'; 
        } 
        // DEPTH 2: Close the List Item
        elseif ($depth >= 2) {
            $output .= '</li>';
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        // 1. Depth 0 -> 1 Wrappers
        if ($depth === 0) {
            if ($this->top_type === 'two-col') {
                $output .= '<div class="row gx-4">';
            } elseif ($this->top_type === 'split') {
                // This UL wraps the Left Column Items
                $output .= '<ul class="list-unstyled mega-links mega-split-left-nav">';
            }
        }
        
        // 2. Depth 1 -> 2 Wrappers (The Flyout Content)
        elseif ($depth === 1) {
            if ($this->top_type === 'split') {
                // This UL is the Right Column (Hidden by default)
                $output .= '<ul class="list-unstyled mega-links mega-split-content-right">';
            } else {
                $output .= '<ul class="list-unstyled mega-links">';
            }
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        if ($depth === 0) {
            if ($this->top_type === 'two-col') {
                $output .= '</div>';
            } elseif ($this->top_type === 'split') {
                $output .= '</ul>';
            }
        } elseif ($depth === 1) {
            $output .= '</ul>';
        }
    }
}