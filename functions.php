<?php


function launcher_setup_theme(){
    load_theme_textdomain( 'launcher' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action('after_setup_theme','launcher_setup_theme');


function launcher_scripts(){

//echo basename(get_page_template(  ));
//die();

if(is_page( )){
    if(basename(get_page_template(  )) == "launcher.php"){

        wp_enqueue_style( 'launcher-font', '//fonts.googleapis.com/css?family=Open+Sans:400,700,800');
        wp_enqueue_style( 'animate-css', get_theme_file_uri( '/assets/css/animate.css' ));
        wp_enqueue_style( 'icomoon-css', get_theme_file_uri( '/assets/css/icomoon.css' ));
        wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ));
        wp_enqueue_style( 'style-css', get_theme_file_uri( '/assets/css/style.css' ),null,null);
        wp_enqueue_style( 'launcher-style', get_stylesheet_uri());
    
        wp_enqueue_script( 'modernizr-js', get_theme_file_uri( '/assets/js/modernizr-2.6.2.min.js' ),array('null'), null, 'false' );
        wp_enqueue_script( 'jquery-js', get_theme_file_uri( '/assets/js/jquery.min.js' ), array('jquery'), null, 'ture' );
        wp_enqueue_script( 'easing-jquery-js', get_theme_file_uri( '/assets/js/jquery.easing.1.3.js' ), array('jquery'), null, 'ture' );
        wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array('jquery'), null, 'ture' );
        wp_enqueue_script( 'waypoint-js', get_theme_file_uri( '/assets/js/jquery.waypoints.min.js' ), array('jquery'), null, 'ture' );
        wp_enqueue_script( 'counddown-js', get_theme_file_uri( '/assets/js/simplyCountdown.js' ), array('jquery'), null, 'ture' );
        wp_enqueue_script( 'main-js', get_theme_file_uri( '/assets/js/main.js' ), array('jquery'), null, 'ture' );
    
    
        $launcher_year = get_post_meta( get_the_ID(  ), "year", 'ture' );
        $launcher_month = get_post_meta( get_the_ID(  ), "month", 'ture' );
        $launcher_day = get_post_meta( get_the_ID(  ), "day", 'ture' );
    
        wp_localize_script( "main-js", "datedata", array(
            "year" => $launcher_year,
            "month" => $launcher_month,
            "day" => $launcher_day
        ) );
    }else{
        wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ));
        wp_enqueue_style( 'launcher-style', get_stylesheet_uri());
    }
}



}
add_action( 'wp_enqueue_scripts','launcher_scripts' );


function launcher_sidebar(){
    register_sidebar( array(
        'name'          => __( 'Left sidebar', 'launcher' ),
        'id'            => 'footer-left',
        'description'   => __( 'left sidebar description', 'launcher' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Right sidebar', 'launcher' ),
        'id'            => 'footer-right',
        'description'   => __( 'Right sidebar description', 'launcher' ),
        'before_widget' => '<section id="%1$s" class="text-right widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action('widgets_init','launcher_sidebar' );




function launcher_header_image(){
    $thumbnail_image_url = get_the_post_thumbnail_url( null, "large" );
    if(is_page()){
        ?>
        <style>
.bg-image{
    background: url(<?php echo $thumbnail_image_url; ?>);
}

        </style>
        <?php
    }
}
add_action( 'wp_head','launcher_header_image' );