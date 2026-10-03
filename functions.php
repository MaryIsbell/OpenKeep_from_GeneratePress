<?php
/**
 * OpenKeep from GeneratePress functions and definitions
 */

add_action( 'after_setup_theme', 'ok_child_theme_support' );
function ok_child_theme_support() {
    // Enables the block editor's Layout panel (Constrained/Flex/Grid) on Group blocks.
    // Without this, GeneratePress (a classic theme with no theme.json) falls back to
    // wrapping block children in an extra .wp-block-group__inner-container div, which
    // breaks markup that needs an exact DOM structure (e.g. the Splide carousel).
    add_theme_support( 'appearance-tools' );
}

// Favicon: hardcoded to the theme's icon, replacing any Site Icon set in the Customizer.
remove_action( 'wp_head', 'wp_site_icon', 99 );
add_action( 'wp_head', 'ok_site_icon' );
function ok_site_icon() {
    $icon = get_stylesheet_directory_uri() . '/images/OpenKeep_Icon.svg';
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( $icon ) . '">' . "\n";
}

add_action( 'wp_enqueue_scripts', 'ok_child_enqueue_assets' );
function ok_child_enqueue_assets() {
    // Enqueue Parent Theme
    wp_enqueue_style( 'generatepress-style', get_template_directory_uri() . '/style.css' );
    
    // Enqueue Splide.js (Carousel Library) from CDN
    wp_enqueue_style( 'splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4' );
    wp_enqueue_script( 'splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '4.1.4', true );

    // Enqueue Child Theme Styles
    wp_enqueue_style( 'ok-child-style', get_stylesheet_uri(), array('generatepress-style'), '1.0.0' );
    wp_enqueue_style( 'ok-custom-components', get_stylesheet_directory_uri() . '/custom-components.css', array('ok-child-style'), '1.0.0' );

    // Enqueue Carousel Init Script
    wp_enqueue_script( 'ok-carousel-init', get_stylesheet_directory_uri() . '/carousel-init.js', array('splide-js'), '1.0.0', true );

    // Enqueue Mobile Nav Toggle Script
    wp_enqueue_script( 'ok-nav-toggle', get_stylesheet_directory_uri() . '/nav-toggle.js', array(), '1.0.0', true );
}

// Footer: social icon row + copyright, shared across every page via GeneratePress's own footer hooks.
add_action( 'generate_before_copyright', 'ok_social_icons_row' );
function ok_social_icons_row() {
    $socials = array(
        array(
            'label' => 'Instagram',
            'url'   => '#', // TODO: replace with real Instagram URL.
            'icon'  => 'openkeep_ig.svg',
        ),
        array(
            'label' => 'LinkedIn',
            'url'   => '#', // TODO: replace with real LinkedIn URL.
            'icon'  => 'openkeep_li.svg',
        ),
        array(
            'label' => 'YouTube',
            'url'   => '#', // TODO: replace with real YouTube URL.
            'icon'  => 'openkeep_yt.svg',
        ),
    );
    ?>
    <div class="ok-social-icons">
        <?php foreach ( $socials as $social ) : ?>
            <a href="<?php echo esc_url( $social['url'] ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/' . $social['icon'] ); ?>" alt="<?php echo esc_attr( $social['label'] ); ?>">
            </a>
        <?php endforeach; ?>
    </div>
    <?php
}

add_filter( 'generate_copyright', 'ok_footer_copyright' );
function ok_footer_copyright( $copyright ) {
    return '';
}

// Pages put their own <h1> in the hero section, so never print GeneratePress's title.
add_filter( 'generate_show_title', 'ok_hide_page_titles' );
function ok_hide_page_titles( $show ) {
    return is_page() ? false : $show;
}

// Header: logo left, nav right, replacing GeneratePress's own header markup entirely.
// Runs on after_setup_theme (not immediately) so GeneratePress has already registered
// generate_construct_header before we try to remove it.
add_action( 'after_setup_theme', 'ok_override_header', 20 );
function ok_override_header() {
    remove_action( 'generate_header', 'generate_construct_header' );
    add_action( 'generate_header', 'ok_construct_header' );
}

function ok_construct_header() {
    // TODO: confirm these slugs match your actual page permalinks.
    $nav_items = array(
        array(
            'label' => 'Home',
            'url'   => home_url( '/home' ),
        ),
        array(
            'label' => 'About',
            'url'   => home_url( '/about/' ),
        ),
        array(
            'label' => 'Editorial Team',
            'url'   => home_url( '/editorial-team/' ),
        ),
    );
    ?>
    <header class="ok-site-header">
        <div class="ok-header-inner">
            <div class="ok-header-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/OpenKeep_Logo.svg' ); ?>" alt="OpenKeep">
                </a>
            </div>
            <button class="ok-nav-toggle" aria-expanded="false" aria-controls="ok-primary-nav" aria-label="<?php esc_attr_e( 'Toggle menu', 'openkeep' ); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="ok-primary-nav" class="ok-header-nav" aria-label="Primary">
                <?php foreach ( $nav_items as $item ) : ?>
                    <a class="ok-nav-pill" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>
    <?php
}