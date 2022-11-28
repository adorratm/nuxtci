<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class UserRolesController extends RestController
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
        $this->load->model('user_role_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
    }

    public function index_get($id = null)
    {
        if ($this->token) {
            $roles = $this->user_role_model->get_all(["isActive" => 1]);
            if (!empty($id)) {
                $roles = $this->user_role_model->get(["id" => $id, "isActive" => 1]);
            }
            $this->response([
                'status' => TRUE,
                'message' => "Yetki Başarıyla Getirildi.",
                'user_roles' => $roles,
                'controllers' => getControllerList()
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => FALSE,
            'message' => "Yetki Getirilirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function datatable_post()
    {
        // return response if token is valid
        $output = [];
        if ($this->token) {
            $items = $this->user_role_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "title" => $item->title, "permissions" => $item->permissions, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->user_role_model->rowCount(),
                "recordsFiltered" => $this->user_role_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
                "data" => $data,
            ];
        }
        // Output to JSON format
        return $this->response($output, RestController::HTTP_OK);
    }

    public function rank_put($id)
    {
        if ($this->token) {
            if ($this->user_role_model->update(["id" => $id], ["rank" => $this->put('rank', true)])) {
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
            $isActive = boolval($this->put("isActive", true)) === true ? 1 : 0;
            if ($this->user_role_model->update(["id" => $id], ["isActive" => $isActive])) {
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
            $data = $this->post();
            $data["rank"] = $this->user_role_model->rowCount() + 1;
            if (!empty($data["permissions"])) {
                $data["permissions"] = json_encode($data["permissions"]);
            }
            if ($this->user_role_model->add($data)) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Yetki Başarıyla Kayıt Edildi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Yetki Kayıt Edilirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function update_post($id)
    {
        if ($this->token) {
            if (!empty($id)) {
                $userRole = $this->user_role_model->get(["id" => $id]);
                if (!empty($userRole)) {
                    $data = $this->post();
                    if (!empty($data["permissions"])) {
                        $data["permissions"] = json_encode($data["permissions"]);
                    }
                    if ($this->user_role_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Yetki Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Yetki Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function delete_delete($id)
    {
        if ($this->token) {
            if ($this->user_role_model->delete(["id" => $id, "isCover" => 0])) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Yetki Başarıyla Silindi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Yetki Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
