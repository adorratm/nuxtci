<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_model extends CI_Model
{
    public $tableName = "product_categories";
    public function __construct()
    {
        parent::__construct();
        // Set searchable column fields
        $this->column_search = ['rank', 'id', 'title', 'lang', 'createdAt', 'updatedAt', 'isActive'];
        // Set default order
        $this->order = ['rank' => 'ASC'];
    }

    public function get_all($where = [], $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();;
    }

    public function add($data = [])
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function get($where = [])
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function update($where = [], $data = [])
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = [])
    {
        return $this->db->where($where)->delete($this->tableName);
    }

    public function deleteBulk($wherein = '', $data = [])
    {
        return $this->db->where_in($wherein, $data)->delete($this->tableName);
    }

    public function rowCount($where = [])
    {
        return $this->db->where($where)->count_all_results($this->tableName);
    }

    public function countFiltered($where = [], $postData = null)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->where($where)->get();
        return $query->num_rows();
    }

    public function getRows($where = [], $postData = [])
    {
        if (!empty($where)) :
            $this->db->where($where);
        endif;
        $this->_get_datatables_query($postData);
        if ($postData['start'] >= 0) :
            $this->db->limit($postData['perPage'], $postData['start']);
        endif;
        return $this->db->get()->result();
    }

    private function _get_datatables_query($postData = [])
    {
        $this->db->where(["id!=" => null]);
        $this->db->from($this->tableName);
        $i = 0;
        // loop searchable columns
        if (!empty($this->column_search)) :
            foreach ($this->column_search as $item) :
                // if datatable send POST for search

                if (!empty($postData['searchTerm'])) :
                    // first loop
                    if ($i === 0) :
                        // open bracket
                        $this->db->group_start();
                        $this->db->like($item, $postData['searchTerm'], 'both');
                        $this->db->or_like($item, strto("lower", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|upper", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|ucwords", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|capitalizefirst", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|ucfirst", $postData['searchTerm']), 'both');
                    else :
                        $this->db->or_like($item, $postData['searchTerm'], 'both');
                        $this->db->or_like($item, strto("lower", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|upper", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|ucwords", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|capitalizefirst", $postData['searchTerm']), 'both');
                        $this->db->or_like($item, strto("lower|ucfirst", $postData['searchTerm']), 'both');
                    endif;
                    // last loop
                    if (count($this->column_search) - 1 == $i) :
                        // close bracket
                        $this->db->group_end();
                    endif;
                endif;
                $i++;
            endforeach;
        endif;
        if (isset($postData['sort'])) :
            foreach ($postData['sort'] as $sKey => $sValue) :
                if ($sValue["type"] != "none") :
                    $this->db->order_by($sValue["field"], $sValue["type"]);
                endif;
            endforeach;
        elseif (isset($this->order)) :
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        endif;
    }
}
