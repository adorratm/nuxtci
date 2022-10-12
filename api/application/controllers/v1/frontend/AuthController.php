<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

        // Load the user model
        $this->load->model('user_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
    }

    public function login_post()
    {
        // Get the post data
        $email = @strip_tags($this->post('email', true));
        $password = @strip_tags($this->post('password', true));

        // Validate the post data
        if (!empty($email) && !empty($password)) {

            // Check if any user exists with the given credentials
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => mb_substr(sha1(md5($password)), 0, 32),
                'status' => 1,
                'role_id' => 2
            );
            $user = $this->user_model->getRows($con);
            $user["timestamp"] = time();
            $user["token"] = AUTHORIZATION::generateToken($user);

            if ($user) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'user' => $user,
                ], RestController::HTTP_OK);
            } else {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => "Wrong email or password."
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => "Provide email and password."
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

            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
            $userCount = $this->user_model->getRows($con);

            if ($userCount > 0) {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => "The given email already exists."
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
            $insert = $this->user_model->insert($userData);

            // Check if the user data is inserted
            if ($insert) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user has been added successfully.',
                    'data' => $insert
                ], RestController::HTTP_OK);
            }
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Some problems occurred, please try again.'
            ], RestController::HTTP_BAD_REQUEST);
        }
        // Set the response and exit
        $this->response([
            'status' => FALSE,
            'message' => 'Provide complete user info to add.'
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function user_get($id = 0)
    {
        // return response if token is valid
        if ($this->token) {
            // Returns all the users data if the id not specified,
            // Otherwise, a single user will be returned.
            $con = $id ? array('id' => $id) : '';
            $users = $this->user_model->getRows($con);

            // Check if the user data exists
            if (!empty($users)) {
                // Set the response and exit
                //OK (200) being the HTTP response code
                $this->response($users, RestController::HTTP_OK);
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], RestController::HTTP_NOT_FOUND);
        }
        // return response if token is invalid
        $this->response([
            'status' => FALSE,
            'message' => 'Unauthorized.'
        ], RestController::HTTP_UNAUTHORIZED);
    }

    public function currentUser_get()
    {
        // return response if token is valid
        if ($this->token) {
            // Returns all the users data if the id not specified,
            // Otherwise, a single user will be returned.
            $con = !empty($this->token->id) ? array('id' => $this->token->id, 'status' => 1, 'role_id' => 2) : NULL;
            if (!empty($con)) {
                $users = $this->user_model->getRows($con);

                // Check if the user data exists
                if (!empty($users)) {
                    // Set the response and exit
                    //OK (200) being the HTTP response code
                    $this->response(['status' => TRUE, "user" => $users], RestController::HTTP_OK);
                }
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], RestController::HTTP_NOT_FOUND);
        }
        // return response if token is invalid
        $this->response([
            'status' => FALSE,
            'message' => 'Unauthorized.'
        ], RestController::HTTP_UNAUTHORIZED);
    }

    public function user_put()
    {
        // return response if token is valid
        if ($this->token) {
            $id = $this->put('id', true);

            // Get the post data
            $first_name = @strip_tags($this->put('first_name', true));
            $last_name = @strip_tags($this->put('last_name', true));
            $email = @strip_tags($this->put('email', true));
            $password = @strip_tags($this->put('password', true));
            $phone = @strip_tags($this->put('phone', true));

            // Validate the post data
            // Update user's account data
            $userData = array();
            if (!empty($first_name)) {
                $userData['first_name'] = $first_name;
            }
            if (!empty($last_name)) {
                $userData['last_name'] = $last_name;
            }
            if (!empty($email)) {
                $userData['email'] = $email;
            }
            if (!empty($password)) {
                $userData['password'] = mb_substr(sha1(md5($password)), 0, 32);
            }
            if (!empty($phone)) {
                $userData['phone'] = $phone;
            }
            $update = $this->user_model->update($userData, $id);

            // Check if the user data is updated
            if ($update) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user info has been updated successfully.'
                ], RestController::HTTP_OK);
            }
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Some problems occurred, please try again.'
            ], RestController::HTTP_BAD_REQUEST);
        }
        // return response if token is invalid
        $this->response([
            'status' => FALSE,
            'message' => 'Unauthorized.'
        ], RestController::HTTP_UNAUTHORIZED);
    }
}
