<?php

class My_Mega_Menu_Walker extends Walker_Nav_Menu
{
    // 1. Start Level: Wrappers for the lists
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);

        // DEPTH 0 -> 1: The Main Vertical List inside the column
        if ($depth === 0) {
            $output .= "\n$indent<ul class=\"mega-col-nav\">\n";
        }
        // DEPTH 1 -> 2: The Flyout List
        elseif ($depth === 1) {
            $output .= "\n$indent<ul class=\"mega-flyout-menu\">\n";
        } else {
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }
    }

    // 2. Start Element: The List Items
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $indent  = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Add specific markers for Depth
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'mega-depth-' . $depth;

        // Check for children (to add arrows on depth 1)
        $has_children = ! empty($args->walker->has_children);
        if ($has_children) {
            $classes[] = 'has-children';
        }

        // --- DEPTH 0: Main Columns (Your Capital, Our Capital, etc.) ---
        if ($depth === 0) {
            $output .= $indent . '<li class="mega-col ' . esc_attr(implode(' ', $classes)) . '">';

            $title = apply_filters('the_title', $item->title, $item->ID);
            $url   = ! empty($item->url) ? esc_url($item->url) : '';

            // Heading is now a hyperlink
            $output .= '<h5 class="mega-col-heading">';

            if ($url) {
                $output .= '<a href="' . $url . '">';
                $output .= $title;
                $output .= '</a>';
            } else {
                $output .= $title;
            }

            $output .= '</h5>';
        }

        // --- DEPTH 1: The Trigger Rows (with optional arrows) ---
        elseif ($depth === 1) {
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $classes)) . '">';

            if ($has_children) {
                // Has children: not clickable, use span
                $arrow = '<span class="arrow"></span>';
                $output .= '<span class="flyout-trigger">';
                $output .= '<span>' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
                $output .= $arrow;
                $output .= '</span>';
            } else {
                // No children: clickable, use anchor
                $output .= '<a href="' . esc_url($item->url) . '" class="flyout-trigger">';
                $output .= '<span>' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
                $output .= '</a>';
            }
        }

        // --- DEPTH 2: Flyout Items ---
        else {
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $classes)) . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="flyout-link">';
            $output .= apply_filters('the_title', $item->title, $item->ID);
            $output .= '</a>';
        }
    }
}
