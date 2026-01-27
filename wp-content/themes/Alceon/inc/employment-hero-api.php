<?php

/**
 * Employment Hero API Helper Class.
 *
 * Handles API calls to Employment Hero and provides demo data fallback
 */

defined('ABSPATH') || exit;

class Alceon_Employment_Hero_API
{
    /**
     * Get all jobs from Employment Hero API or return demo data.
     */
    public static function get_jobs($location = 'all', $page = 1, $per_page = 12)
    {
        // If demo mode is enabled or no org ID, return demo data
        if (EMPLOYMENT_HERO_DEMO_MODE || EMPLOYMENT_HERO_ORG_ID === 'demo') {
            return self::get_demo_jobs($location, $page, $per_page);
        }

        // Make real API call
        $endpoint = EMPLOYMENT_HERO_API_BASE . '/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs';

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . trim(EMPLOYMENT_HERO_ACCESS_TOKEN),
                'Accept' => 'application/json',
                'Content-Type'  => 'application/json',
            ),
            'timeout' => 15,
        );

        $response = wp_remote_get($endpoint, $args);

        if (is_wp_error($response)) {
            error_log('Employment Hero API Error: ' . $response->get_error_message());

            return array(
                'jobs' => array(),
                'total' => 0,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => 0,
            );
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        // Log API response for debugging
        error_log('Employment Hero API Response Status: ' . $status_code);
        error_log('Employment Hero API Response Body: ' . substr($body, 0, 500)); // Log first 500 chars

        $data = json_decode($body, true);

        if (!$data || !isset($data['jobs'])) {
            error_log('Employment Hero API: Invalid response structure. Full body: ' . $body);

            return array(
                'jobs' => array(),
                'total' => 0,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => 0,
            );
        }

        // Log the number of jobs found
        error_log('Employment Hero API: Found ' . count($data['jobs']) . ' jobs');

        // Filter by location if specified
        $jobs = $data['jobs'];
        if ($location !== 'all') {
            $jobs = array_filter($jobs, function ($job) use ($location) {
                return isset($job['location']) && stripos($job['location'], $location) !== false;
            });
        }

        return self::paginate_jobs($jobs, $page, $per_page);
    }

    /**
     * Get a single job by ID or slug.
     */
    public static function get_job($job_identifier)
    {
        // If demo mode, return from demo data
        if (EMPLOYMENT_HERO_DEMO_MODE || EMPLOYMENT_HERO_ORG_ID === 'demo') {
            $demo_jobs = self::get_all_demo_jobs();
            foreach ($demo_jobs as $job) {
                // Check both ID and slug
                if ($job['id'] == $job_identifier || (isset($job['slug']) && $job['slug'] === $job_identifier)) {
                    return $job;
                }
            }

            return null;
        }

        // Make real API call
        $endpoint = EMPLOYMENT_HERO_API_BASE . '/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs/' . $job_identifier;

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . trim(EMPLOYMENT_HERO_ACCESS_TOKEN),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ),
            'timeout' => 15,
        );

        $response = wp_remote_get($endpoint, $args);

        if (is_wp_error($response)) {
            return null;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return isset($data['job']) ? $data['job'] : null;
    }

    /**
     * Get demo jobs data.
     */
    private static function get_demo_jobs($location = 'all', $page = 1, $per_page = 12)
    {
        $all_jobs = self::get_all_demo_jobs();

        // Filter by location
        if ($location !== 'all') {
            $all_jobs = array_filter($all_jobs, function ($job) use ($location) {
                return isset($job['location']) && stripos($job['location'], $location) !== false;
            });
            $all_jobs = array_values($all_jobs); // Re-index array
        }

        return self::paginate_jobs($all_jobs, $page, $per_page);
    }

    /**
     * Paginate jobs array.
     */
    private static function paginate_jobs($jobs, $page = 1, $per_page = 12)
    {
        $total = count($jobs);
        $total_pages = ceil($total / $per_page);
        $offset = ($page - 1) * $per_page;

        $paginated_jobs = array_slice($jobs, $offset, $per_page);

        return array(
            'jobs' => $paginated_jobs,
            'total' => $total,
            'page' => $page,
            'per_page' => $per_page,
            'total_pages' => $total_pages,
        );
    }

    /**
     * Get all demo jobs (full dataset).
     */
    private static function get_all_demo_jobs()
    {
        return array(
            array(
                'id' => 1,
                'slug' => 'senior-financial-analyst',
                'title' => 'Senior Financial Analyst',
                'department' => 'Finance',
                'location' => 'Sydney, NSW',
                'posted_date' => '2025-01-15',
                'description' => '<p>We are seeking an experienced Senior Financial Analyst to join our growing finance team in Sydney. This role will be responsible for financial planning, analysis, and reporting.</p><h3>Key Responsibilities:</h3><ul><li>Prepare monthly financial reports and analysis</li><li>Support budgeting and forecasting processes</li><li>Conduct variance analysis and identify trends</li><li>Collaborate with stakeholders across the business</li></ul><h3>Requirements:</h3><ul><li>Bachelor\'s degree in Finance, Accounting, or related field</li><li>5+ years of experience in financial analysis</li><li>Advanced Excel and financial modeling skills</li><li>Strong communication and presentation skills</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$90,000 - $120,000',
            ),
            array(
                'id' => 2,
                'slug' => 'marketing-manager',
                'title' => 'Marketing Manager',
                'department' => 'Marketing',
                'location' => 'Melbourne, VIC',
                'posted_date' => '2025-01-20',
                'description' => '<p>Join our dynamic marketing team as a Marketing Manager. You will lead marketing initiatives and drive brand awareness across Australia and New Zealand.</p><h3>Key Responsibilities:</h3><ul><li>Develop and execute marketing strategies</li><li>Manage marketing campaigns across multiple channels</li><li>Analyze campaign performance and optimize ROI</li><li>Lead a team of marketing professionals</li></ul><h3>Requirements:</h3><ul><li>7+ years of marketing experience</li><li>Proven track record in digital marketing</li><li>Strong leadership and team management skills</li><li>Experience with marketing automation tools</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$100,000 - $130,000',
            ),
            array(
                'id' => 3,
                'slug' => 'software-engineer',
                'title' => 'Software Engineer',
                'department' => 'Technology',
                'location' => 'Brisbane, QLD',
                'posted_date' => '2025-02-01',
                'description' => '<p>We are looking for a talented Software Engineer to join our technology team in Brisbane. You will work on cutting-edge projects and help build scalable solutions.</p><h3>Key Responsibilities:</h3><ul><li>Design and develop software applications</li><li>Write clean, maintainable code</li><li>Participate in code reviews and technical discussions</li><li>Collaborate with cross-functional teams</li></ul><h3>Requirements:</h3><ul><li>Bachelor\'s degree in Computer Science or related field</li><li>3+ years of software development experience</li><li>Proficiency in modern programming languages</li><li>Experience with cloud platforms (AWS, Azure, or GCP)</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$95,000 - $125,000',
            ),
            array(
                'id' => 4,
                'slug' => 'human-resources-coordinator',
                'title' => 'Human Resources Coordinator',
                'department' => 'Human Resources',
                'location' => 'Perth, WA',
                'posted_date' => '2025-02-05',
                'description' => '<p>Our Perth office is seeking a HR Coordinator to support our growing team. This is an excellent opportunity for someone looking to advance their HR career.</p><h3>Key Responsibilities:</h3><ul><li>Coordinate recruitment and onboarding processes</li><li>Maintain employee records and HR systems</li><li>Support employee relations and HR initiatives</li><li>Assist with HR reporting and compliance</li></ul><h3>Requirements:</h3><ul><li>2+ years of HR experience</li><li>Strong organizational and communication skills</li><li>Knowledge of Australian employment law</li><li>Proficiency in HRIS systems</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$65,000 - $80,000',
            ),
            array(
                'id' => 5,
                'slug' => 'business-development-manager',
                'title' => 'Business Development Manager',
                'department' => 'Sales',
                'location' => 'Auckland, NZ',
                'posted_date' => '2025-02-10',
                'description' => '<p>We are expanding our presence in New Zealand and seeking a Business Development Manager to drive growth in the Auckland region.</p><h3>Key Responsibilities:</h3><ul><li>Identify and pursue new business opportunities</li><li>Build and maintain client relationships</li><li>Develop sales strategies and presentations</li><li>Achieve sales targets and KPIs</li></ul><h3>Requirements:</h3><ul><li>5+ years of B2B sales experience</li><li>Proven track record of meeting sales targets</li><li>Strong negotiation and presentation skills</li><li>Experience in financial services preferred</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => 'NZD $110,000 - $140,000',
            ),
            array(
                'id' => 6,
                'slug' => 'operations-manager',
                'title' => 'Operations Manager',
                'department' => 'Operations',
                'location' => 'Sydney, NSW',
                'posted_date' => '2025-02-12',
                'description' => '<p>Join our operations team as an Operations Manager. You will be responsible for optimizing processes and ensuring operational excellence.</p><h3>Key Responsibilities:</h3><ul><li>Oversee day-to-day operations</li><li>Implement process improvements</li><li>Manage operational budgets</li><li>Lead and develop operations team</li></ul><h3>Requirements:</h3><li>8+ years of operations management experience</li><li>Strong analytical and problem-solving skills</li><li>Experience with process optimization</li><li>Excellent leadership abilities</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$115,000 - $145,000',
            ),
            array(
                'id' => 7,
                'slug' => 'junior-accountant',
                'title' => 'Junior Accountant',
                'department' => 'Finance',
                'location' => 'Melbourne, VIC',
                'posted_date' => '2025-02-18',
                'description' => '<p>Great opportunity for a recent graduate or early-career accountant to join our finance team in Melbourne.</p><h3>Key Responsibilities:</h3><ul><li>Process accounts payable and receivable</li><li>Assist with month-end close procedures</li><li>Reconcile accounts and maintain ledgers</li><li>Support senior accountants with various tasks</li></ul><h3>Requirements:</h3><ul><li>Bachelor\'s degree in Accounting</li><li>0-2 years of accounting experience</li><li>Strong attention to detail</li><li>Proficiency in accounting software</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$55,000 - $65,000',
            ),
            array(
                'id' => 8,
                'slug' => 'customer-success-manager',
                'title' => 'Customer Success Manager',
                'department' => 'Customer Service',
                'location' => 'Brisbane, QLD',
                'posted_date' => '2025-02-20',
                'description' => '<p>We are looking for a passionate Customer Success Manager to ensure our clients achieve their goals and have an exceptional experience.</p><h3>Key Responsibilities:</h3><ul><li>Build strong relationships with key clients</li><li>Provide product training and support</li><li>Identify upsell and cross-sell opportunities</li><li>Monitor customer health metrics</li></ul><h3>Requirements:</h3><ul><li>4+ years of customer success experience</li><li>Strong communication and interpersonal skills</li><li>Experience with CRM systems</li><li>Problem-solving mindset</li></ul>',
                'employment_type' => 'Full-time',
                'salary_range' => '$80,000 - $95,000',
            ),
        );
    }
}
