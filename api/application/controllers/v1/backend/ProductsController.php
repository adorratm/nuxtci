<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class ProductsController extends RestController
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
        $this->load->model('product_model');
        $this->load->model('codes_model');
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
            if (!empty($id)) {
                $product = $this->product_model->get(null, ["id" => $id]);
                $this->response([
                    'status' => TRUE,
                    'message' => "Ürün Başarıyla Getirildi.",
                    'product' => $product
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Getirilirken Hata Oluştu."
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
            $items = $this->product_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "title" => $item->title, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->product_model->rowCount(),
                "recordsFiltered" => $this->product_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
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
            if ($this->product_model->update(["id" => $id], ["rank" => $this->put('rank', true)])) {
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
            if ($this->product_model->update(["id" => $id], ["isActive" => $isActive])) {
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
            $data["seo_url"] = seo($data["title"]);
            $data["rank"] = $this->product_model->rowCount() + 1;
            if ($this->product_model->add($data)) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Ürün Başarıyla Kayıt Edildi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kayıt Edilirken Hata Oluştu."
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
                $settings = $this->product_model->get(null, ["id" => $id]);
                if (!empty($settings)) {
                    $data = $this->post();
                    $data["seo_url"] = seo($data["title"]);
                    if ($this->product_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Ürün Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Güncellenirken Hata Oluştu."
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
            if ($this->product_model->delete(["id" => $id])) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Ürün Başarıyla Silindi."
                ], RestController::HTTP_OK);
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Silinirken Hata Oluştu."
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
                if ($this->product_model->deleteBulk("id", $ids)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Ürünler Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürünler Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function sync_products_get()
    {
        if ($this->token) {
            if (!isAllowedUpdateViewModule($this->token, $this->moduleName)) {
                $this->response([
                    'status' => FALSE,
                    'message' => "Bu İşlemi Yapabilmeniz İçin Yetkiniz Bulunmamaktadır."
                ], RestController::HTTP_UNAUTHORIZED);
            }
            // Login Token Update After 2 Hour
            if (strtotime('now') >= strtotime($this->codes_model->get(null, ["isActive" => 1])->updatedAt) + 7200) {
                $this->login_api();
            }
            $this->get_stocks();
            $this->response([
                'status' => TRUE,
                'message' => "Ürünler Başarıyla Güncellendi."
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürünler Güncellenirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }

    public function login_api()
    {
        $codesConnections = $this->codes_model->get_all(null, null, ["isActive" => 1]);
        if (!empty($codesConnections)) {
            foreach ($codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                $token = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "login", ['email' => $codesConnectionsValue->email, 'password' => $codesConnectionsValue->password])->message;
                if (!empty($token)) {
                    $this->codes_model->update(["id" => $codesConnectionsValue->id], ["token" => $token]);
                }
            }
        }
    }

    public function get_stocks()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $codesConnections = $this->codes_model->get_all(null, null, ["isActive" => 1]);
        if (!empty($codesConnections)) {
            $insertArray = [];
            $insertIfNotExistsArray = [];
            $replaceArray = [];
            foreach ($codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                $availableIds = [];
                $removeArray = [];
                $availableProducts = $this->product_model->get_all("codes_id", "rank ASC", ["codes" => $codesConnectionsValue->id]);
                if (!empty($availableProducts)) {
                    foreach ($availableProducts as $aKey => $aValue) {
                        if (!in_array(intval($aValue->codes_id), $availableIds)) {
                            array_push($availableIds, intval($aValue->codes_id));
                        }
                    }
                    $removeArray = $availableIds;
                }

                $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "stoklistele", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                if (!empty($data)) {
                    $rank = 1;
                    foreach ($data as $returnKey => $returnValue) {
                        $dataArray = [
                            'codes_id' => intval(clean($returnValue->Id)) ?? NULL,
                            'title' => clean($returnValue->Baslik) ?? NULL,
                            'seo_url' => clean(seo($returnValue->Baslik)) ?? NULL,
                            'barcode' => clean($returnValue->barcode) ?? NULL,
                            'brand' => clean($returnValue->Marka) ?? NULL,
                            'price' => clean($returnValue->Fiyat1) ?? NULL,
                            'vat' => clean($returnValue->KDV) ?? NULL,
                            'stock' => clean($returnValue->stok) ?? NULL,
                            'isActive' => clean($returnValue->Durum) ?? NULL,
                            'rank' => $rank,
                            'codes' => clean($codesConnectionsValue->id) ?? NULL
                        ];
                        if (!in_array($dataArray['codes_id'], $availableIds)) {
                            if ($dataArray['codes_id'] !== NULL) {
                                array_push($insertIfNotExistsArray, $dataArray);
                            }
                        }
                        if (!empty($removeArray)) {
                            $key = array_search($dataArray['codes_id'], $removeArray);
                            unset($removeArray[$key]);
                        }
                        if (empty($availableIds)) {
                            array_push($insertArray, $dataArray);
                        }
                        if (!empty($availableIds)) {
                            array_push($replaceArray, $dataArray);
                        }

                        $rank++;
                    }
                }
                if (!empty($removeArray)) {
                    $this->product_model->deleteBulk("codes_id", $removeArray);
                }
            }
            /**
             * Empty Records Bulk Save
             */
            if (!empty($insertArray)) {
                $this->product_model->add_batch($insertArray);
            }
            if (empty($insertArray) && !empty($insertIfNotExistsArray)) {
                $this->product_model->add_batch($insertIfNotExistsArray);
            }
            /**
             * Same Records Bulk Update
             */
            if (!empty($replaceArray)) {
                $this->product_model->update_batch($replaceArray, "codes_id");
            }
        }
    }
}
