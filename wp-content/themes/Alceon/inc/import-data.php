<?php

// Allow triggering import via URL: https://alceon.local/?file=full
add_action('template_redirect', function () {
    if (isset($_GET['file']) && !empty($_GET['file'])) {
        // Only allow on local environment
        $is_local = (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local');
        $is_admin = current_user_can('manage_options');
        if ($is_local || $is_admin) {
            import_file_shortcode(sanitize_text_field($_GET['file']));
        }
    }
});

add_shortcode('import_file', 'import_file_shortcode');
function import_file_shortcode($atts)
{
    if (isset($_GET['file']) && !empty($_GET['file'])) {
        $parametr = $_GET['file'];
    } else {
        $parametr = $atts;
    }

    switch ($parametr) {
        case 'full':
            global $wpdb;
            $wpdb->query('TRUNCATE TABLE real_estate');

            /* $file = get_field('file_1', 204); */
            //$url_file = get_attached_file($file['ID']);
            //$url_file = 'https://www.dropbox.com/s/0md55su8m49pfbh/Alceon%20Real%20Estate%20Website%20Date%20File-AAPF%20ADIF.csv?dl=0';
            //$url_file = 'https://www.dropbox.com/s/0cix1cx49wr8qen/Alceon%20Real%20Estate%20Website%20Date%20File-AAPF%20ADIF.csv?dl=1';

            $url_file = 'https://www.dropbox.com/scl/fi/vvidti92pmk2600r1hsyt/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF.csv?rlkey=74gbe0e8fuhd5wa8p4a2tugaf&dl=1';
            $url_file = 'https://www.dropbox.com/scl/fi/0s3bst2n1xlfm5g5e9x02/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF_NEW.csv?rlkey=i189dltfdjl0exzpzc9cww1vn&st=i87jlm5c&dl=1';
            $url_file = 'https://www.dropbox.com/scl/fi/47hyhpvpwiwiv8fiml4tg/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF_NEW.csv?rlkey=am43l97dqnc0f0cjop9gp1le9&e=1&st=13tbjsdu&dl=1';

            /* $rows = migrateCSV(fopen($url_file, 'r'), $file['filename']); */
            $rows = migrateCSV(fopen($url_file, 'r'));

            // Temporary debug: log total rows and key facts rows
            error_log('CSV Import: Total rows = ' . count($rows));
            for ($r = 27; $r <= 36; $r++) {
                if (isset($rows[$r])) {
                    error_log('CSV Row ' . $r . ': ' . json_encode($rows[$r]));
                } else {
                    error_log('CSV Row ' . $r . ': NOT SET');
                }
            }

            list($day, $month, $year) = explode('/', $rows[18][0]);
            $date_time = mktime(0, 0, 0, $month, $day, $year);

            list($day, $month, $year) = explode('/', $rows[2][0]);
            $date_time_2 = mktime(0, 0, 0, $month, $day, $year);

            $data = array(
                'date_debt' => $date_time,

                'total_net_return_1_month' => $rows[23][2],
                'total_net_return_3_month' => $rows[23][4],
                'total_net_return_6_month' => $rows[23][6],
                'total_net_return_1_year' => $rows[23][8],
                'total_net_return_2_year' => $rows[23][10],
                'total_net_return_3_year' => $rows[23][11],
                'total_net_return_since_incpetion' => $rows[23][12],

                'distribution_return_1_month' => $rows[24][2],
                'distribution_return_3_month' => $rows[24][4],
                'distribution_return_6_month' => $rows[24][6],
                'distribution_return_1_year' => $rows[24][8],
                'distribution_return_2_year' => $rows[24][10],
                'distribution_return_3_year' => $rows[24][11],
                'distribution_return_since_incpetion' => $rows[24][12],

                'since_inception' => $rows[13][1],
                'diversified_across' => $rows[14][1],

                'date_property' => $date_time_2,
                'freehold_australian_property_fund_month' => $rows[4][1],
                'freehold_australian_property_fund_quarter' => $rows[4][2],
                'freehold_australian_property_fund_1_year' => $rows[4][3],
                'freehold_australian_property_fund_3_years' => $rows[4][4],
                'freehold_australian_property_fund_5_years' => $rows[4][5],
                'freehold_australian_property_fund_since_inception' => $rows[4][6],

                'fund_benchmark_month' => $rows[5][1],
                'fund_benchmark_quarter' => $rows[5][2],
                'fund_benchmark_1_year' => $rows[5][3],
                'fund_benchmark_3_years' => $rows[5][4],
                'fund_benchmark_5_years' => $rows[5][5],
                'fund_benchmark_since_inception' => $rows[5][6],

                'value_add_month' => $rows[6][1],
                'value_add_quarter' => $rows[6][2],
                'value_add_1_year' => $rows[6][3],
                'value_add_3_years' => $rows[6][4],
                'value_add_5_years' => $rows[6][5],
                'value_add_since_inception' => $rows[6][6],

                // Key Facts - homepage (rows 28-35)
                // Values run through alc_abbreviate_large_numbers() to shorten e.g. "billion" → "b"
                'keyfact_capital_invested' => alc_abbreviate_large_numbers($rows[28][0]),
                'keyfact_capital_invested_text' => $rows[28][1],
                'keyfact_funds_under_management' => alc_abbreviate_large_numbers($rows[29][0]),
                'keyfact_funds_under_management_text' => $rows[29][1],
                'keyfact_managed_investments' => alc_abbreviate_large_numbers($rows[30][0]),
                'keyfact_managed_investments_text' => $rows[30][1],
                'keyfact_weighted_avg_irr' => alc_abbreviate_large_numbers($rows[31][0]),
                'keyfact_weighted_avg_irr_text' => $rows[31][1],
                'keyfact_professionals' => alc_abbreviate_large_numbers($rows[32][0]),
                'keyfact_professionals_text' => $rows[32][1],
                'keyfact_avg_experience' => alc_abbreviate_large_numbers($rows[33][0]),
                'keyfact_avg_experience_text' => $rows[33][1],
                'keyfact_staff_owned' => alc_abbreviate_large_numbers($rows[34][0]),
                'keyfact_staff_owned_text' => $rows[34][1],
                'keyfact_sqm_rating' => alc_abbreviate_large_numbers($rows[35][0]),
                'keyfact_sqm_rating_text' => $rows[35][1],
            );

            foreach ($data as $key => $value) {
                setField($key, $value);
            }
            break;

        case 'debt-income':
            $file = get_field('file_1', 204);
            //$url_file = get_attached_file($file['ID']);
            $url_file = 'https://www.dropbox.com/scl/fi/vvidti92pmk2600r1hsyt/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF.csv?rlkey=74gbe0e8fuhd5wa8p4a2tugaf&dl=1';

            $rows = migrateCSV(fopen($url_file, 'r'), $file['filename']);

            list($day, $month, $year) = explode('/', $rows[18][0]);
            $date_time = mktime(0, 0, 0, $month, $day, $year);

            /*echo '<pre>';
            var_dump($rows);
            echo '</pre>';*/

            $data = array(
                'date_debt' => $date_time,

                /*'net_return_cumulative_1_month' => $rows[23][2],
                'net_return_cumulative_3_month' => $rows[23][4],
                'net_return_cumulative_6_month' => $rows[23][6],
                'net_return_cumulative_1_year' => $rows[23][8],
                'net_return_cumulative_since_incpetion' => $rows[23][10],

                'net_return_annualised_1_month' => $rows[24][2],
                'net_return_annualised_3_month' => $rows[24][4],
                'net_return_annualised_6_month' => $rows[24][6],
                'net_return_annualised_1_year' => $rows[24][8],
                'net_return_annualised_since_incpetion' => $rows[24][10],

                'distribution_cumaltive_1_month' => $rows[25][2],
                'distribution_cumaltive_3_month' => $rows[25][4],
                'distribution_cumaltive_6_month' => $rows[25][6],
                'distribution_cumaltive_1_year' => $rows[25][8],
                'distribution_cumaltive_since_incpetion' => $rows[25][10],

                'distribution_annualised_1_month' => $rows[26][2],
                'distribution_annualised_3_month' => $rows[26][4],
                'distribution_annualised_6_month' => $rows[26][6],
                'distribution_annualised_1_year' => $rows[26][8],
                'distribution_annualised_since_incpetion' => $rows[26][10],*/

                'total_net_return_1_month' => $rows[23][2],
                'total_net_return_3_month' => $rows[23][4],
                'total_net_return_6_month' => $rows[23][6],
                'total_net_return_1_year' => $rows[23][8],
                'total_net_return_2_year' => $rows[23][10],
                'total_net_return_3_year' => $rows[23][11],
                'total_net_return_since_incpetion' => $rows[23][12],

                'distribution_return_1_month' => $rows[24][2],
                'distribution_return_3_month' => $rows[24][4],
                'distribution_return_6_month' => $rows[24][6],
                'distribution_return_1_year' => $rows[24][8],
                'distribution_return_1_year' => $rows[24][10],
                'distribution_return_since_incpetion' => $rows[24][12],

                'since_inception' => $rows[13][1],
                'diversified_across' => $rows[14][1],
            );

            foreach ($data as $key => $value) {
                setField($key, $value);
            }
            break;

        case 'property':
            $file = get_field('file_2', 205);
            //$url_file = get_attached_file($file['ID']);
            //$url_file = 'https://www.dropbox.com/s/0md55su8m49pfbh/Alceon%20Real%20Estate%20Website%20Date%20File-AAPF%20ADIF.csv?dl=1';
            $url_file = 'https://www.dropbox.com/scl/fi/vvidti92pmk2600r1hsyt/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF.csv?rlkey=74gbe0e8fuhd5wa8p4a2tugaf&dl=1';

            $rows = migrateCSV(fopen($url_file, 'r'), $file['filename']);

            list($day, $month, $year) = explode('/', $rows[1][0]);
            $date_time = mktime(0, 0, 0, $month, $day, $year);

            /*echo '<pre>';
            var_dump($rows);
            echo '</pre>';*/

            $data = array(
                'date_property' => $date_time,
                'freehold_australian_property_fund_month' => $rows[3][1],
                'freehold_australian_property_fund_quarter' => $rows[3][2],
                'freehold_australian_property_fund_1_year' => $rows[3][3],
                'freehold_australian_property_fund_3_years' => $rows[3][4],
                'freehold_australian_property_fund_5_years' => $rows[3][5],
                'freehold_australian_property_fund_since_inception' => $rows[3][6],

                'a_reits_index_month' => $rows[4][1],
                'a_reits_index_quarter' => $rows[4][2],
                'a_reits_index_1_year' => $rows[4][3],
                'a_reits_index_3_years' => $rows[4][4],
                'a_reits_index_5_years' => $rows[4][5],
                'a_reits_index_since_inception' => $rows[4][6],

                'listed_infrastructure_index_month' => $rows[5][1],
                'listed_infrastructure_index_quarter' => $rows[5][2],
                'listed_infrastructure_index_1_year' => $rows[5][3],
                'listed_infrastructure_index_3_years' => $rows[5][4],
                'listed_infrastructure_index_5_years' => $rows[5][5],
                'listed_infrastructure_index_since_inception' => $rows[5][6],

                'unlisted_property_index_month' => $rows[6][1],
                'unlisted_property_index_quarter' => $rows[6][2],
                'unlisted_property_index_1_year' => $rows[6][3],
                'unlisted_property_index_3_years' => $rows[6][4],
                'unlisted_property_index_5_years' => $rows[6][5],
                'unlisted_property_index_since_inception' => $rows[6][6],
            );

            foreach ($data as $key => $value) {
                setField($key, $value);
            }
            break;
    }

    return;
}

function migrateCSV($csv, $file_name = '')
{
    //$first_row = fgetcsv($csv, 0, ',', '"');
    $result = array();

    while ($row = fgetcsv($csv, 0, ',', '"')) {
        $result[] = $row;
    }

    return $result;
}

/**
 * Abbreviate large-number words: "billion" → "b", "million" → "m", "trillion" → "t".
 * E.g. "A$5.5 billion" becomes "A$5.5b", "A$5.5 Billion" becomes "A$5.5b".
 */
function alc_abbreviate_large_numbers($value)
{
    $value = preg_replace('/\s*billion/i', 'b', $value);
    $value = preg_replace('/\s*million/i', 'm', $value);
    $value = preg_replace('/\s*trillion/i', 't', $value);

    return $value;
}

function getField($name)
{
    global $wpdb;
    $output = $wpdb->get_row("SELECT value FROM real_estate WHERE field = '" . $name . "'", 'ARRAY_A');

    if ($output) {
        return $output['value'];
    } else {
        return false;
    }
}

function setField($name, $value)
{
    global $wpdb;

    if (empty($name) || empty($value)) {
        return false;
    }

    if (getField($name) !== false) {
        $wpdb->update(
            'real_estate',
            ['value' => $value],
            ['field' => $name]
        );
    } else {
        $wpdb->insert('real_estate', array(
            'field' => $name,
            'value' => $value,
        ));
    }

    return true;
}

function getData()
{
    global $wpdb;

    $output = $wpdb->get_results('SELECT field, value FROM `real_estate`', 'OBJECT_K');

    return $output;
}

add_action('wpb_custom_cron_import_file', 'cron_import_file');
function cron_import_file()
{
    import_file_shortcode('full');

    return;
}

add_action('add_meta_boxes', function () {
    add_meta_box('real_estate_table', 'Available Shortcodes', 'alc_real_estate_table_content', 'fund', 'side', 'low');
    add_meta_box('csv_debug_dump', 'CSV Debug Dump (temporary)', 'alc_csv_debug_dump', 'fund', 'normal', 'low');
});
// Display available shortcodes in the sidebar of the post "Funds"
function alc_real_estate_table_content()
{
    $table_data = getData();
    $table_data = (array) $table_data;
    $date_keys = array('date_debt', 'date_property');

    // Group keys by fund / section
    $groups = array(
        'Alceon Debt Income Fund (ADIF)' => array(
            'color'  => '#1a3d6e',
            'keys'   => array('date_debt', 'total_net_return_1_month', 'total_net_return_3_month', 'total_net_return_6_month', 'total_net_return_1_year', 'total_net_return_2_year', 'total_net_return_3_year', 'total_net_return_since_incpetion', 'distribution_return_1_month', 'distribution_return_3_month', 'distribution_return_6_month', 'distribution_return_1_year', 'distribution_return_2_year', 'distribution_return_3_year', 'distribution_return_since_incpetion'),
        ),
        'Freehold Australian Property Fund (AAPF)' => array(
            'color'  => '#155cd5',
            'keys'   => array('date_property', 'freehold_australian_property_fund_month', 'freehold_australian_property_fund_quarter', 'freehold_australian_property_fund_1_year', 'freehold_australian_property_fund_3_years', 'freehold_australian_property_fund_5_years', 'freehold_australian_property_fund_since_inception', 'fund_benchmark_month', 'fund_benchmark_quarter', 'fund_benchmark_1_year', 'fund_benchmark_3_years', 'fund_benchmark_5_years', 'fund_benchmark_since_inception', 'value_add_month', 'value_add_quarter', 'value_add_1_year', 'value_add_3_years', 'value_add_5_years', 'value_add_since_inception'),
        ),
        'Company Key Facts (Homepage)' => array(
            'color'  => '#00457c',
            'keys'   => array('since_inception', 'diversified_across', 'keyfact_capital_invested', 'keyfact_capital_invested_text', 'keyfact_funds_under_management', 'keyfact_funds_under_management_text', 'keyfact_managed_investments', 'keyfact_managed_investments_text', 'keyfact_weighted_avg_irr', 'keyfact_weighted_avg_irr_text', 'keyfact_professionals', 'keyfact_professionals_text', 'keyfact_avg_experience', 'keyfact_avg_experience_text', 'keyfact_staff_owned', 'keyfact_staff_owned_text', 'keyfact_sqm_rating', 'keyfact_sqm_rating_text'),
        ),
    );
    ?>
    <style>
        .real-estate-table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            width: 100%;
        }
        .real-estate-table td {
            border: 1px solid #ccc;
            word-break: break-all;
            padding: 3px 5px;
        }
        .sc-group-header {
            margin: 14px 0 6px;
            padding: 6px 8px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            border-radius: 3px;
        }
        .sc-group-header:first-child { margin-top: 0; }
    </style>
    <p style="font-size:11px; color:#666;">Copy &amp; paste these into the <b>Statistic</b> fields. Use <code>prefix</code> to prepend a character (e.g. <code>+</code>).</p>

    <?php foreach ($groups as $group_label => $group): ?>
        <div class="sc-group-header" style="background:<?php echo esc_attr($group['color']); ?>;">
            <?php echo esc_html($group_label); ?>
        </div>
        <table class="real-estate-table" style="font-size:11px; margin-bottom:4px;">
            <thead>
                <tr style="background:#f5f5f5;">
                    <td><b>Shortcode</b></td>
                    <td><b>Output</b></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($group['keys'] as $key):
                    if (!isset($table_data[$key])) {
                        continue;
                    }
                    $value = $table_data[$key]->value;
                    if (in_array($key, $date_keys)) {
                        $date_obj = new DateTime();
                        $date_obj->setTimezone(new DateTimeZone('Australia/Sydney'));
                        $date_obj->setTimestamp((int) $value);
                        $value = $date_obj->format('j F Y');
                    }
                    $shortcode = '[stat key="' . $key . '"]';
                    ?>
                    <tr>
                        <td><code style="font-size:10px;background:#f0f0f0;padding:1px 3px;"><?php echo esc_html($shortcode); ?></code></td>
                        <td><?php echo esc_html($value); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    <div class="sc-group-header" style="background:#555;">Helpers</div>
    <table class="real-estate-table" style="font-size:11px;">
        <tbody>
            <tr>
                <td colspan="2" style="padding-top:6px;"><b>With prefix example:</b></td>
            </tr>
            <tr>
                <td><code style="font-size:10px;background:#f0f0f0;padding:1px 3px;">[stat key="since_inception" prefix="+"]</code></td>
                <td><?php echo '+' . esc_html(isset($table_data['since_inception']) ? $table_data['since_inception']->value : '—'); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:6px;"><b>Years in operation:</b></td>
            </tr>
            <tr>
                <td><code style="font-size:10px;background:#f0f0f0;padding:1px 3px;">[years_in_operation date="01/07/2018"]</code></td>
                <td><?php
                    $now = new DateTime('now', new DateTimeZone('Australia/Sydney'));
    echo '+' . $now->diff(new DateTime('2018-07-01'))->y;
    ?> <em style="color:#999;">(change date)</em></td>
            </tr>
        </tbody>
    </table>
<?php
}

// Temporary full-width CSV debug dump
function alc_csv_debug_dump()
{
    $url_file = 'https://www.dropbox.com/scl/fi/47hyhpvpwiwiv8fiml4tg/Alceon-Real-Estate-Website-Date-File-AAPF-ADIF_NEW.csv?rlkey=am43l97dqnc0f0cjop9gp1le9&e=1&st=13tbjsdu&dl=1';
    $csv_handle = @fopen($url_file, 'r');
    if ($csv_handle) {
        $rows = [];
        while ($row = fgetcsv($csv_handle, 0, ',', '"')) {
            $rows[] = $row;
        }
        fclose($csv_handle);
        $max_cols = 0;
        foreach ($rows as $row) {
            $max_cols = max($max_cols, count($row));
        }
        ?>
        <p><small>Find the inception date cell, then report the <b>Row</b> and <b>Col</b> number. Remove this box after.</small></p>
        <div style="overflow-x:auto;">
        <table style="border-collapse:collapse; width:100%; font-size:12px;">
            <thead>
                <tr style="background:#f0f0f0;">
                    <th style="border:1px solid #ccc; padding:4px 6px;">Row</th>
                    <?php for ($c = 0; $c < $max_cols; $c++) : ?>
                        <th style="border:1px solid #ccc; padding:4px 6px;">Col <?php echo $c; ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $i => $row) : ?>
                    <tr>
                        <td style="border:1px solid #ccc; padding:4px 6px; font-weight:bold; background:#f9f9f9;"><?php echo $i; ?></td>
                        <?php for ($c = 0; $c < $max_cols; $c++) : ?>
                            <td style="border:1px solid #ccc; padding:4px 6px; white-space:nowrap;"><?php echo esc_html(isset($row[$c]) ? $row[$c] : ''); ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <?php
    } else {
        echo '<p style="color:red;">Could not open CSV file.</p>';
    }
}

// show some value of the table 'real_estate'
add_shortcode('stat', 'alc_stat_callback');
function alc_stat_callback($atts)
{
    $attr = shortcode_atts([
        'key' => '',
        'prefix' => '',
    ], $atts);
    $key = trim($attr['key']);
    $prefix = $attr['prefix'];
    $val = getField($key);

    return ($val === false) ? '0' : $prefix . $val;
}

// Calculate years in operation from an inception date passed as a shortcode parameter
// Usage: [years_in_operation date="01/07/2018"] → "+7"
add_shortcode('years_in_operation', 'alc_years_in_operation_callback');
function alc_years_in_operation_callback($atts)
{
    $attr = shortcode_atts([
        'date' => '',
    ], $atts);
    $date_str = trim($attr['date']);

    if (empty($date_str)) {
        return '0';
    }

    // Try to parse the date in various formats
    $date = DateTime::createFromFormat('d/m/Y', $date_str);
    if (!$date) {
        $date = DateTime::createFromFormat('m/Y', $date_str);
    }
    if (!$date) {
        $date = DateTime::createFromFormat('Y-m-d', $date_str);
    }
    if (!$date) {
        // Fallback: let PHP try to parse it (handles "July 2018", "Jul 2018", etc.)
        try {
            $date = new DateTime($date_str);
        } catch (\Exception $e) {
            return '0';
        }
    }

    $now = new DateTime('now', new DateTimeZone('Australia/Sydney'));
    $diff = $now->diff($date);
    $years = $diff->y;

    return '+' . $years;
}
