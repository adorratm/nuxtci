<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \chriskacerguis\RestServer\RestController;

class ProductCategoriesController extends RestController
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
        $this->load->model('product_category_model');
        $this->token = AUTHORIZATION::verifyHeaderToken();
        $this->moduleName = ucfirst($this->router->fetch_class());
        $this->viewFolder = "productcategories";
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
            $productCategory =  $this->product_category_model->get_all();
            if (!empty($id)) {
                $productCategory = $this->product_category_model->get(null, ["id" => $id]);
            }

            $this->response([
                'status' => TRUE,
                'message' => "Ürün Kategorisi Başarıyla Getirildi.",
                'productCategory' => $productCategory
            ], RestController::HTTP_OK);
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kategorisi Getirilirken Hata Oluştu."
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
            $items = $this->product_category_model->getRows([], $this->post(null, true));
            $data = [];
            if (!empty($items)) :
                foreach ($items as $item) :
                    $data[] = ["rank" => $item->rank, "id" => $item->id, "title" => $item->title, "lang" => $item->lang, "isActive" => $item->isActive, "createdAt" => turkishDate("d F Y, l H:i:s", $item->createdAt), "updatedAt" => turkishDate("d F Y, l H:i:s", $item->updatedAt), "actions" => $item->id];
                endforeach;
            endif;
            $output = [
                "recordsTotal" => $this->product_category_model->rowCount(),
                "recordsFiltered" => $this->product_category_model->countFiltered([], (!empty($this->post(null, true)) ? $this->post(null, true) : [])),
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
            if ($this->product_category_model->update(["id" => $id], ["rank" => $this->put('rank', true), "top_id" => $this->put('top_id', true)])) {
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
            if ($this->product_category_model->update(["id" => $id], ["isActive" => $isActive])) {
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
            $img_url = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
            $banner_url = upload_picture("banner_url", "uploads/$this->viewFolder", [], "*");
            if ($img_url["success"]) :
                $data["img_url"] = $img_url["file_name"];
            endif;
            if ($banner_url["success"]) :
                $data["banner_url"] = $banner_url["file_name"];
            endif;
            $data["rank"] = $this->product_category_model->rowCount() + 1;
            if ($this->product_category_model->add($data)) {
                $this->response([
                    'status' => TRUE,
                    'message' => "Ürün Kategorisi Başarıyla Kayıt Edildi."
                ], RestController::HTTP_OK);
            }
            if ($img_url["success"]) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$data["img_url"]}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$data["img_url"]}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$data["img_url"]}");
                endif;
            endif;
            if ($banner_url["success"]) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$data["banner_url"]}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$data["banner_url"]}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$data["banner_url"]}");
                endif;
            endif;
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kategorisi Kayıt Edilirken Hata Oluştu."
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
                $productCategory = $this->product_category_model->get(null, ["id" => $id]);
                if (!empty($productCategory)) {
                    $data = $this->post();
                    $img_url = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
                    $banner_url = upload_picture("banner_url", "uploads/$this->viewFolder", [], "*");
                    if ($img_url["success"]) :
                        $data["img_url"] = $img_url["file_name"];
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}");
                        endif;
                    endif;
                    if ($banner_url["success"]) :
                        $data["banner_url"] = $banner_url["file_name"];
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}");
                        endif;
                    endif;
                    if ($this->product_category_model->update(["id" => $id], $data)) {
                        $this->response([
                            'status' => TRUE,
                            'message' => "Ürün Kategorisi Başarıyla Güncellendi."
                        ], RestController::HTTP_OK);
                    }
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kategorisi Güncellenirken Hata Oluştu."
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
                $productCategory = $this->product_category_model->get(null, ["id" => $id]);
                if (!empty($productCategory)) {
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->banner_url}");
                    endif;
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$productCategory->img_url}");
                    endif;
                }
                if ($this->product_category_model->delete(["id" => $id])) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Ürün Kategorisi Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kategorisi Silinirken Hata Oluştu."
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
                $productCategories = $this->product_category_model->get_all(null, null, [], [], [], [], $ids);
                if (!empty($productCategories)) {
                    foreach ($productCategories as $key => $value) {
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->banner_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->banner_url}");
                        endif;
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->img_url}");
                        endif;
                    }
                }

                if ($this->product_category_model->deleteBulk("id", $ids)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Ürün Kategorisi Başarıyla Silindi."
                    ], RestController::HTTP_OK);
                }
            }
        }
        $this->response([
            'status' => FALSE,
            'message' => "Ürün Kategorisi Silinirken Hata Oluştu."
        ], RestController::HTTP_BAD_REQUEST);
    }
}
