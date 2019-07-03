<?php
require_once('modal/class.Base.php');
require_once('modal/class.Consideration.php');
require_once('modal/class.AnalysisOption.php');
require_once('modal/class.CaseStudy.php');
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'font-awesome-5', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_style( 'google_font_montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,400,700');
    wp_enqueue_style( 'google_font_open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
add_image_size( 'feature', 575, 575, true);
add_image_size( 'plans', 1200);

add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'address', // Option ID
        'Address', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'address' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','email', 'esc_attr');
    register_setting('general','address', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;

}

function contactsMenu() {
    $html = '
    <ul>
        <li><a href="mailto:' . get_option('email') . '"><span class="fa fa-envelope"></span>' . get_option('email') . '</a></li>
        <li><a href="tel:' . formatPhoneNumber(get_option('phone')) . '"><span class="fa fa-phone-square"></span>' . get_option('phone') . '</a></li>
    </ul>';

    return $html;
}

function getAnalysisOptions() {
    $options = Array();
    $posts_array = get_posts([
        'post_type' => 'analysis-option',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $o = new AnalysisOption($post);
        $options[] = $o;
    }
    return $options;
}

function getConsiderations() {
    $considerations = Array();
    $posts_array = get_posts([
        'post_type' => 'consideration',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $c = new Consideration($post);
        $considerations[] = $c;
    }
    return $considerations;
}
function getCaseStudies() {
    $case_studies = Array();
    $posts_array = get_posts([
        'post_type' => 'case-study',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $c = new CaseStudy($post);
        $case_studies[] = $c;
    }
    return $case_studies;
}
function homeAnalysisOptions_shortcode() {
    $html = '
    <div class="analysis-options-wrapper row justify-content-center">';
    foreach (getAnalysisOptions() as $option) {
        $html .= '
        <div class="col-6 col-sm-4 option-tile">
            <a href="' . get_page_link(57) . '">
                <div class="image-wrapper">
                    <img src="' . $option->getImage() . '" alt="' . $option->getTitle() . '" />
                </div>
                <div class="title">' . $option->getTitle() . '</div>
            </a>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('analysis_option_tiles', 'homeAnalysisOptions_shortcode');

function homeConsiderations_shortcode() {
    $link = '';
    $html = '
    <div class="considerations-wrapper row">';
    foreach(getConsiderations() as $consideration) {
        $link = get_page_link(61);
        $anchor = str_replace(" ", "_", $consideration->getTitle());
        $anchor = strtolower($anchor);
        $link .= '#' . $anchor;
        $html .= '
        <div class="col-6 col-sm-3 consideration-tile">
            <a href="' . $link . '">
                <span class="fas fa-clipboard-list"></span>
                <div class="title">' . $consideration->getTitle() . '</div>
            </a>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('consideration_tiles', 'homeConsiderations_shortcode');

function caseStudies_shortcode()
{
    $html = '
    <div class="row">';
    foreach (getCaseStudies() as $caseStudy) {
        $html .= '
        <div class="col-12 col-sm-6 col-sm-4 panel">
            <a href="' . $caseStudy->link() . '">
                <h2>' . $caseStudy->getTitle() . '</h2>
            </a>
        </div>';
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('case_studies', 'caseStudies_shortcode');