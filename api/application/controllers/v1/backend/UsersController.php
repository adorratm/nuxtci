<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class UsersController extends RestController
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
    public function __construct()
    {
        parent::__construct();

        // Load the user model
        $this->load->model('user_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
        $this->moduleName = ucfirst($this->router->fetch_class());
    }

    public function index_get($id)
    {
        if ($this->token) {
            if (!isAllowedViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if (!empty($id)) {
                $user = $this->user_model->get(["id" => $id]);
                $this->response([
                    'status' => TRUE,
                    'message' => "Kullanıcı Bilgileri Başarıyla Getirildi.",
                    'user' => $user
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Kullanıcı Bilgileri Getirilirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function datatable_post()
    {
        // return response if token is valid
        $output = [];
        if ($this->token) {
            if (!isAllowedViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            $items = $this->user_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "first_name" => $item->first_name, "last_name" => $item->last_name, "email" => $item->email, "phone" => $item->phone, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->user_model->rowCount(),
                "recordsFiltered" => $this->user_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
                "data" => $data,
            ];
        }
        // Output to JSON format
        return $this->response($output, RestController::HTTP_OK);
    }

    public function rank_put($id)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if ($this->user_model->update(["id" => $id], ["rank" => $this->put('rank', true)])) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Sıralama Başarıyla Güncellendi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Sıralama Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function isactive_put($id)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            $isActive = boolval($this->put("isActive", true)) === true ? 1 : 0;
            if ($this->user_model->update(["id" => $id], ["isActive" => $isActive])) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Durum Başarıyla Güncellendi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => TRUE,
            'message' => "Durum Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function save_post()
    {
        if ($this->token) {
            if (!isAllowedWriteViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            $data = $this->post();
            if (!empty($data["password"]) && !empty($data["password_repeat"]) && $data["password"] == $data["password_repeat"]) {
                $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
                unset($data["password_repeat"]);
                $data["rank"] = $this->user_model->rowCount() + 1;
                if ($this->user_model->add($data)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Kullanıcı Bilgileri Başarıyla Kayıt Edildi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Kullanıcı Bilgileri Kayıt Edilirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function update_post($id)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if (!empty($id)) {
                $settings = $this->user_model->get(["id" => $id]);
                if (!empty($settings)) {
                    $data = $this->post();
                    if (!empty($data["password"]) && !empty($data["password_repeat"]) && $data["password"] == $data["password_repeat"]) {
                        unset($data["password_repeat"]);
                        $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
                    }
                    if ($this->user_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Kullanıcı Bilgileri Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Kullanıcı Bilgileri Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function delete_delete($id)
    {
        if ($this->token) {
            if (!isAllowedDeleteViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if ($this->user_model->delete(["id" => $id])) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Kullanıcı Başarıyla Silindi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Kullanıcı Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
