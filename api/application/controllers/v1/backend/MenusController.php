<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class MenusController extends RestController
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

        // Load the model
        $this->load->model('menu_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
        $this->moduleName = ucfirst($this->router->fetch_class());
    }

    public function index_get($id = null)
    {
        if ($this->token) {
            if (!isAllowedViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            $menu =  $this->menu_model->get_all();
            if (!empty($id)) {
                $menu = $this->menu_model->get(null, ["id" => $id]);
            }

            $this->response([
                'status' => TRUE,
                'message' => "Menü Başarıyla Getirildi.",
                'menu' => $menu
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => FALSE,
            'message' => "Menü Getirilirken Hata Oluştu."
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
            $items = $this->menu_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "title" => $item->title, "position" => $item->position, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->menu_model->rowCount(),
                "recordsFiltered" => $this->menu_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
                "data" => $data,
            ];
        }
        // Output to JSON format
        return $this->response($output, RestController::HTTP_OK);
    }

    public function rank_put($id = null)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if ($this->menu_model->update(["id" => $id], ["rank" => $this->put('rank', true), "top_id" => $this->put('top_id', true)])) {
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

    public function isactive_put($id = null)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            $isActive = boolval($this->put("isActive", true)) === true ? 1 : 0;
            if ($this->menu_model->update(["id" => $id], ["isActive" => $isActive])) {
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
            $data["rank"] = $this->menu_model->rowCount() + 1;
            if ($this->menu_model->add($data)) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Menü Başarıyla Kayıt Edildi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Menü Kayıt Edilirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function update_post($id = null)
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if (!empty($id)) {
                $menu = $this->menu_model->get(null, ["id" => $id]);
                if (!empty($menu)) {
                    $data = $this->post();
                    if ($this->menu_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Menü Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Menü Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function delete_delete($id = null)
    {
        if ($this->token) {
            if (!isAllowedDeleteViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if (!empty($id)) {
                if ($this->menu_model->delete(["id" => $id])) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Menü Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Menü Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function delete_post()
    {
        if ($this->token) {
            if (!isAllowedDeleteViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            if (!empty($this->post("id", true))) {
                $ids = @explode(",", $this->post("id", true));
                if ($this->menu_model->deleteBulk("id", $ids)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Menü Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Menü Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
