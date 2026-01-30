<?php

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

function getField($name)
{
    global $wpdb;
    $output = $wpdb->get_row("SELECT value FROM real_estate WHERE field = '" . $name . "'", "ARRAY_A");

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
            'value' => $value
        ));
    }

    return true;
}

function getData()
{
    global $wpdb;

    $output = $wpdb->get_results("SELECT field, value FROM `real_estate`", "OBJECT_K");

    return $output;
}

add_action('wpb_custom_cron_import_file', 'cron_import_file');
function cron_import_file()
{
    import_file_shortcode('full');

    return;
}
