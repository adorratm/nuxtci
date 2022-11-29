<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class AuthController extends RestController
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public $token = false;

    public function __construct()
    {
        parent::__construct();

        // Load the user model
        $this->load->model('user_model');
        $this->load->model('user_role_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
    }

    public function login_post()
    {
        // Get the post data
        $email = @strip_tags($this->post('email', true));
        $password = @strip_tags($this->post('password', true));

        // Validate the post data
        if (!empty($email) && !empty($password)) {

            $user = $this->user_model->get([
                'email' => $email,
                'password' => mb_substr(sha1(md5($password)), 0, 32),
                'isActive' => 1,
                'role_id' => 1
            ]);
            $user->timestamp = time();
            $user->permissions = @$this->user_role_model->get(["id" => $user->role_id])->permissions;
            $user->token = AUTHORIZATION::generateToken((array)$user);
            if ($user) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Başarıyla Giriş Yaptınız.',
                    'user' => $user,
                ], RestController::HTTP_OK);
            } else {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => "E-Mail Adresiniz veya Şifreniz Hatalı."
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => "Lütfen Geçerli Bir Email Adresi ve Şifre Giriniz."
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function register_post()
    {
        // Get the post data
        $first_name = @strip_tags($this->post('first_name', true));
        $last_name = @strip_tags($this->post('last_name', true));
        $email = @strip_tags($this->post('email', true));
        $password = @strip_tags($this->post('password', true));
        $phone = @strip_tags($this->post('phone', true));

        // Validate the post data
        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {

            $userCount = $this->user_model->rowCount(['email' => $email]);

            if ($userCount > 0) {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => "Girmiş Olduğunuz E-Mail Adresi Sistemde Farklı Bir Kullanıcı Tarafından Kullanılıyor. Lütfen Farklı Bir Email Adresi İle Tekrar Deneyin."
                ], RestController::HTTP_BAD_REQUEST);
            }
            // Insert user data
            $userData = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => mb_substr(sha1(md5($password)), 0, 32),
                'phone' => $phone
            );
            $insert = $this->user_model->add($userData);

            // Check if the user data is inserted
            if ($insert) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Başarıyla Kayıt Oldunuz.',
                    'data' => $insert
                ], RestController::HTTP_OK);
            }
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Kayıt Olurken Hata Oluştu, Lütfen Daha Sonra Tekrar Deneyin.'
            ], RestController::HTTP_BAD_REQUEST);
        }
        // Set the response and exit
        $this->response([
            'status' => FALSE,
            'message' => 'Provide complete user info to add.'
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function currentUser_get()
    {
        // return response if token is valid
        if ($this->token) {
            // Returns all the users data if the id not specified,
            // Otherwise, a single user will be returned.
            $con = !empty($this->token->id) ? array('id' => $this->token->id, 'isActive' => 1) : NULL;
            if (!empty($con)) {
                $user = $this->user_model->get($con);
                $user->permissions = @$this->user_role_model->get(["id" => $user->role_id])->permissions;

                // Check if the user data exists
                if (!empty($user)) {
                    // Set the response and exit
                    //OK (200) being the HTTP response code
                    $this->response(['status' => TRUE, "user" => $user], RestController::HTTP_OK);
                }
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'Girmiş Olduğunuz Bilgilerle Eşleşen Kullanıcı Bulunamadı.'
            ], RestController::HTTP_NOT_FOUND);
        }
        // return response if token is invalid
        $this->response([
            'status' => FALSE,
            'message' => 'Bu İşlemi Yapabilmeniz İçin Yetkiniz Yok.'
        ], RestController::HTTP_UNAUTHORIZED);
    }
}
