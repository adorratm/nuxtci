<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class SettingsController extends RestController
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
        $this->load->model('user_model');
        $this->load->model('settings_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
        $this->moduleName = ucfirst($this->router->fetch_class());
        $this->viewFolder = "settings";
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
            if (!empty($id)) {
                $settings = $this->settings_model->get(null, ["id" => $id]);
                $settings->address_informations = json_decode($settings->address_informations, true);
                $this->response([
                    'status' => TRUE,
                    'message' => "Site Ayarı Başarıyla Getirildi.",
                    'settings' => $settings
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Site Ayarı Getirilirken Hata Oluştu."
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
            $items = $this->settings_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "company_name" => $item->company_name, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->settings_model->rowCount(),
                "recordsFiltered" => $this->settings_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
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
            if ($this->settings_model->update(["id" => $id], ["rank" => $this->put('rank', true)])) {
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
            if ($this->settings_model->update(["id" => $id], ["isActive" => $isActive])) {
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
            $logo = upload_picture("logo", "uploads/$this->viewFolder", [], "*");
            $mobile_logo = upload_picture("mobile_logo", "uploads/$this->viewFolder", [], "*");
            $favicon = upload_picture("favicon", "uploads/$this->viewFolder", [], "*");
            if ($logo["success"]) :
                $data["logo"] = $logo["file_name"];
            endif;
            if ($mobile_logo["success"]) :
                $data["mobile_logo"] = $mobile_logo["file_name"];
            endif;
            if ($favicon["success"]) :
                $data["favicon"] = $favicon["file_name"];
            endif;
            if (!empty($data["address_informations"])) :
                foreach (json_decode($data["address_informations"]) as $adKey => $adValue) :
                    json_decode($data["address_informations"])[$adKey]->map = htmlspecialchars(html_entity_decode(json_decode($data["address_informations"])[$adKey]->map));
                endforeach;
                $data["address_informations"] = json_encode($data["address_informations"]);
            endif;
            $data["rank"] = $this->settings_model->rowCount() + 1;
            if ($this->settings_model->add($data)) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Site Ayarları Başarıyla Kayıt Edildi."
                ], RestController::HTTP_OK);
            }
            if ($logo["success"]) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$data["logo"]}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$data["logo"]}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$data["logo"]}");
                endif;
            endif;
            if ($mobile_logo["success"]) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$data["mobile_logo"]}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$data["mobile_logo"]}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$data["mobile_logo"]}");
                endif;
            endif;
            if ($favicon["success"]) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$data["favicon"]}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$data["favicon"]}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$data["favicon"]}");
                endif;
            endif;
        }
        $this->response([
            'status' => FALSE,
            'message' => "Site Ayarları Kayıt Edilirken Hata Oluştu."
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
                $settings = $this->settings_model->get(null, ["id" => $id]);
                if (!empty($settings)) {
                    $data = $this->post();
                    $logo = upload_picture("logo", "uploads/$this->viewFolder", [], "*");
                    $mobile_logo = upload_picture("mobile_logo", "uploads/$this->viewFolder", [], "*");
                    $favicon = upload_picture("favicon", "uploads/$this->viewFolder", [], "*");
                    if ($logo["success"]) :
                        $data["logo"] = $logo["file_name"];
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}");
                        endif;
                    endif;
                    if ($mobile_logo["success"]) :
                        $data["mobile_logo"] = $mobile_logo["file_name"];
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}");
                        endif;
                    endif;
                    if ($favicon["success"]) :
                        $data["favicon"] = $favicon["file_name"];
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}");
                        endif;
                    endif;
                    if (!empty($data["address_informations"])) :
                        foreach (json_decode($data["address_informations"]) as $adKey => $adValue) :
                            json_decode($data["address_informations"])[$adKey]->map = htmlspecialchars(html_entity_decode(json_decode($data["address_informations"])[$adKey]->map));
                        endforeach;
                        $data["address_informations"] = json_encode($data["address_informations"]);
                    endif;
                    if ($this->settings_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Site Ayarları Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Site Ayarları Güncellenirken Hata Oluştu."
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
            $settings = $this->settings_model->get(null, ["id" => $id]);
            if ($this->settings_model->delete(["id" => $id])) {
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->logo}");
                endif;
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->mobile_logo}");
                endif;
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$settings->favicon}");
                endif;
                $this->response([
                    'status' => TRUE,
                    'message' => "Site Ayarları Başarıyla Silindi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Site Ayarları Silinirken Hata Oluştu."
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
                $settings = $this->settings_model->get_all(null, null, [], [], [], [], $ids);
                if (!empty($settings)) {
                    foreach ($settings as $key => $value) {
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->logo}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->logo}");
                        endif;
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->mobile_logo}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->mobile_logo}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->mobile_logo}");
                        endif;
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->favicon}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->favicon}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->favicon}");
                        endif;
                    }
                }

                if ($this->settings_model->deleteBulk("id", $ids)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Site Ayarları Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Site Ayarları Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
