<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
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
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        parent::__construct();

        // Load the user model
        $this->load->model('user_model');
        $this->load->model('settings_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
    }

    public function datatable_post()
    {
        // return response if token is valid
        $output = [];
        if ($this->token) {
            $items = $this->settings_model->getRows([], $this->post(null, true));
            $data = [];
            $i = (!empty($this->post('start', true)) ? $this->post('start', true) : 0);
            if (!empty($items)) :
                foreach ($items as $item) :
                    $i++;
                    $proccessing = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item updateSettingsBtn" href="javascript:void(0)" data-url="' . base_url("settings/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item" href="' . base_url("dashboard/language") . '"><i class="fa fa-language mr-2"></i>Dil Sabitlerini Düzenle</a>
                        <a class="dropdown-item remove-btn d-none" href="javascript:void(0)" data-table="settingsTable" data-url="' . base_url("settings/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "company_name" => $item->company_name, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $proccessing];
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

    public function rank_post()
    {
        if ($this->settings_model->update(["id" => $this->post('id', true)], ["rank" => $this->post('rank', true)])) {
            $this->response([
                'status' => TRUE,
                'message' => "Sıralama Başarıyla Güncellendi."
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => FALSE,
            'message' => "Sıralama Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function isactive_post()
    {
        $isActive = boolval($this->post("isActive", true)) === true ? 1 : 0;
        if ($this->settings_model->update(["id" => $this->post('id', true)], ["isActive" => $isActive])) {
            $this->response([
                'status' => TRUE,
                'message' => "Durum Başarıyla Güncellendi."
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => TRUE,
            'message' => "Durum Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
