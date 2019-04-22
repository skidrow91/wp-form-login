<?php

if (!class_exists('Handle_Form')) {

    class Handle_Form {

        private $_validation;

        public function __construct() {
            add_action('init', array($this, 'init'));
            add_shortcode('show_login_form', [$this, 'showLoginForm']);
            add_shortcode('show_register_form', [$this, 'showRegisterForm']);
        }

        public function init() {
            if( 'POST' == $_SERVER['REQUEST_METHOD']) {
                $this->_validation = $this->validateRegisterPost();
                if (!is_wp_error($this->_validation)) {
                    if (($uid = $this->createUser()) !== false) {
                        wp_set_current_user($uid);
                        wp_set_auth_cookie($uid);
                        wp_redirect(home_url());
                        exit();
                    }
                }
            }
        }

        public function showLoginForm() {
            // $nonce = $_REQUEST['_wpnonce'];
            // if (wp_verify_nonce( $nonce, 'login' )) {

            // }
            if (!is_user_logged_in()) {
                include(plugin_dir_path( __FILE__ ).'/form/login.php');
            }
        }

        public function showRegisterForm($atts) {
            $atts = shortcode_atts( array(
                'redirect_url' => ''
            ), $atts, 'show_register_form' );
            // echo "<pre/>";
            // print_r($atts);
            // exit();
            if (!is_user_logged_in()) {
                // if( 'POST' == $_SERVER['REQUEST_METHOD']) {
                //     $errors = new WP_Error();
                //     if (!$_POST['user_login']) {
                //         $errors->add('empty_title', __('<strong>Notice</strong>: Please enter your username.', 'kvcodes'));
                //     }
                // }
                // else {
                // }
                // $validation = $this->validateRegisterPost();
                // if (!is_wp_error($validation) && 'POST' == $_SERVER['REQUEST_METHOD']) {
                    // echo 'test';
                    // die('test');
                    // if ($this->createUser() !== false) {
                    //     do_action('template_redirect');
                    //     // wp_redirect($atts['redirect_url'] ?? home_url());
                    //     header('Location: '.$atts['redirect_url'] ?? home_url());
                    //     exit();
                    // }
                    // exit();
                // }
                include(plugin_dir_path( __FILE__ ).'/form/register.php');
            }
        }

        private function validateRegisterPost() {
            $errors;
            if( 'POST' == $_SERVER['REQUEST_METHOD']) {
                if (!$_POST['user_login']) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_login', __('<strong>Notice</strong>: Please enter your username.', ''));
                }
                else {
                    $_SESSION['user_login'] = $_POST['user_login'];
                }
                if (!$_POST['user_email']) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_email', __('<strong>Notice</strong>: Please enter your email.', ''));
                }
                else {
                    $_SESSION['user_email'] = $_POST['user_email'];
                }
                if (!$_POST['user_pwd']) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_pwd', __('<strong>Notice</strong>: Please enter your password.', ''));
                }
                if ($_POST['user_pwd'] && $_POST['user_pwd'] !== $_POST['user_pwd_confirmation']) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_pwd_confirmation', __('<strong>Notice</strong>: Your password and password confirmation are different.', ''));
                }
                if (username_exists($_POST['user_login'])) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_login', __('<strong>Notice</strong>: Username has been taken.', ''));
                }
                if (email_exists($_POST['user_email'])) {
                    if (!is_wp_error($errors)) {
                        $errors = new WP_Error();
                    }
                    $errors->add('user_email', __('<strong>Notice</strong>: Email has been taken.', ''));
                }
            }
            return $errors;
        }

        private function createUser() {
            $result = false;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                global $wpdb;
                $table = 'wp_users';
                $data = [
                    'user_login' => $_POST['user_login'],
                    'user_pass' => wp_hash_password($_POST['user_pwd']),
                    'user_nicename' => $_POST['user_login'],
                    'user_email' => $_POST['user_email'],
                    'user_url' => '',
                    'user_registered' => date('Y-m-d H:s:i'),
                    'user_activation_key' => '',
                    'user_status' => 0,
                    'display_name' => $_POST['user_login']
                ];
                // echo "<pre/>";
                // print_r($data);
                // exit();
                $result = $wpdb->insert( $table, $data );
                if ($result) {
                    $result = $wpdb->insert_id;
                }
            }
            return $result;
        }

        private function redirect($url) {

        }
    }

}