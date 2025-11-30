<?php

/**
 * Select Drop Down Component
 *
 * This file contains the HTML, CSS, and JS for the
 * custom-styled dependent dropdown menus.
 */
?>

<form class="select-container mt-5 d-none d-lg-flex" id="header-select-form" novalidate data-aos="fade-up">
    <div class="select-wrapper">
        <label for="category" class="visually-hidden">
            <?php echo esc_html(($placeholders['menu_1_placeholder'] ?? 'I am a...')); ?>
        </label>
        <?php $cats = get_field('menu_1', 'option') ?: []; ?>
        <select id="category" class="custom-select" required>
            <option value="" disabled selected>I am a...</option>
            <?php foreach (array_values($cats) as $i => $row):
                $label = trim($row['label'] ?? '');
                if (!$label) {
                    continue;
                } ?>
                <option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="select-wrapper">
        <label for="lookup" class="visually-hidden">
            <?php echo esc_html(($placeholders['menu_2_placeholder'] ?? 'I’m looking to...')); ?>
        </label>
        <select id="lookup" class="custom-select" required disabled>
            <option value="" disabled selected>
                <?php echo esc_html(($placeholders['menu_2_placeholder'] ?? 'I’m looking to...')); ?>
            </option>
        </select>
    </div>

    <button id="go-button" class="go-button" type="submit" disabled>
        <?php echo esc_html(($placeholders['go_label'] ?? 'Go')); ?>
    </button>
</form>