<?php

function load_stylesheets(){ 
    wp_register_style('bsStyle', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css', array(), 1, 'all');
    wp_enqueue_style('bsStyle');

    wp_register_style('miStyle', 'https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css', array(), 1, 'all');
    wp_enqueue_style('miStyle');

    // fonts
    // wp_register_style('font1', 'https://fonts.googleapis.com/css2?family=Megrim&display=swap', array(), 1, 'all');
    // wp_enqueue_style('font1');

    wp_register_style('font1', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&amp;display=swap', array(), 1, 'all');
    wp_enqueue_style('font1');

    wp_register_style('style', get_template_directory_uri() . '/style/profile.css?1', array(), 1, 'all');
    wp_enqueue_style('style');    
}
add_action('wp_enqueue_scripts', 'load_stylesheets');


//load _scripts
function addjs(){
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.js', "", 1, 1, 1);
    wp_enqueue_script('jquery');
    // wp_register_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js', "", 1, 1, 1);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js', "", 1, 1, 1);
    wp_enqueue_script('bootstrap');

    wp_register_script('three', 'https://unpkg.com/three@0.139.2/build/three.min.js', "", 1, 1, 1);
    wp_enqueue_script('three');

    wp_register_script('controls', 'https://unpkg.com/three@0.139.2/examples/js/controls/OrbitControls.js', "", 1, 1, 1);
    wp_enqueue_script('controls');

    wp_register_script('SVGLoader', 'https://unpkg.com/three@0.139.2/examples/js/loaders/SVGLoader.js', "", 1, 1, 1);
    wp_enqueue_script('SVGLoader');

    
    
    // wp_register_script('custom',  get_template_directory_uri() . '/custom.js', "", 1, 1, 1);
    // wp_enqueue_script('custom');
}
add_action( 'wp_enqueue_scripts', 'addjs' ); 

//add support
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );

//reg menus
// register_nav_menus(
//     array('main-top-menu' => __('Main Top Menu','theme'),
    
//     ) 
// );

//My get image by id and size function
// $size = 'thumbnail' or 'medium' or 'medium_large' or 'large'
function getMyImage($id, $size){
    if( $id ) {$src = wp_get_attachment_image_src( $id, $size, false ); 
        echo $src[0] ;
    }
}

function post_contact() {

    $page = get_page_by_path('home page'); 

    $messageError = '';
    $nameError = '';
    $emailError = '';

    if(trim($_POST['contactName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }

    if(trim($_POST['email']) === '')  {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    $phone = trim($_POST['phone']);

    if(trim($_POST['message']) === '') {
        $messageError = 'Please enter a message.';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $message = stripslashes(trim($_POST['message']));
        } else {
            $message = trim($_POST['message']);
        }
    }

    $focus = '15'; //trim($_POST['focus']);
    if(!isset($hasError) && $focus === '15') {
        $emailTo = get_field( "contact_us_send_to_email_address",  $page->ID );

        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }

        $subject = '[Contact] From '.$name;
        $body = "\n\nPhone: $phone \n\n";
        $body .= "Email: $email \n\n";
        $body .= "Name: $name \n\n";
        

        $body .= "Message: $message \n\n";
        $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' .$name.' <'. $email.'>';        

        wp_mail($emailTo, $subject, $body, $headers);

        $emailSent = true;
    }

    $myObj = new stdClass();
    $myObj->hasError = $hasError;

    $myObj->nameError = $nameError;
    $myObj->emailError = $emailError;
    $myObj->messageError = $messageError;

    $myObj->emailSent = $emailSent;

    $myJSON = json_encode($myObj);

    echo $myJSON;

    die();
}
add_action('wp_ajax_post_contact', 'post_contact');
add_action('wp_ajax_nopriv_post_contact', 'post_contact');
     