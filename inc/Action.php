<?php
namespace SOLP;
class Action
{
    function __construct(){
        add_shortcode( 'soalwp_login', array($this,'user_login_en_callback'));
        add_action('rest_api_init', array($this, 'soalwp_login_rest'));
    }
    public function soalwp_login_rest()
    {

        register_rest_route(
            'wp/v1',
            '/login',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'soalwp_callback_login_en_rest'),
                'permission_callback' => array( $this, 'test_curl_permissions_check' ),

            )
        );
    }
    public function test_curl_permissions_check(){
        return true;
    }
    public function soalwp_callback_login_en_rest(\WP_REST_Request $request){
        $username= $request->get_param('username');
        $password= $request->get_param('password');
        $creds['user_login'] = $username;
        $creds['user_password'] = $password;
        $creds['remember'] = true;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)){
            $data= json_encode(array("status" => 0, 'msg' =>$user->get_error_message()));
            $response = new \WP_REST_Response();
            $response->set_status(200);
            $response->set_data($data);
        }
        else {
            $redirect_to = get_permalink( wc_get_page_id( 'myaccount' ) );
            $data= json_encode(array("status"=>1,'msg'=>"با موفقیت وارد شدید لطفا کمی صبر کنید.",'url'=>$redirect_to));
            wp_clear_auth_cookie();
            wp_set_current_user(  $user->ID, $user->user_login );
            wp_set_auth_cookie(  $user->ID );
            do_action( 'wp_login', $user->user_login, $user );
            $response = new \WP_REST_Response();
            $response->set_status(200);
            $response->set_data($data);
        }
        return $response;
    }
    public function user_login_en_callback($attr){

        if(file_exists(SOLP_PATH.'/templates/login.php')){
            include(SOLP_PATH.'/templates/login.php');
        }
    }
}