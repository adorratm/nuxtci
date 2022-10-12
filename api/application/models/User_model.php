<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        // Load the database library
        $this->load->database();

        $this->tableName = 'users';
    }

    /*
     * Get rows from the $this->tableName table
     */
    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->tableName);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->row_array() : [];
            } else {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : [];
            }
        }

        //return fetched data
        return $result;
    }

    /*
     * Insert $this->tableName data
     */
    public function insert($data)
    {
        //add created and modified date if not exists
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        //insert data to $this->tableName table
        $insert = $this->db->insert($this->tableName, $data);

        //return the status
        return $insert ? $this->db->insert_id() : false;
    }

    /*
     * Update $this->tableName data
     */
    public function update($data, $id)
    {
        //add modified date if not exists
        if (!array_key_exists('modified', $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        //update data in $this->tableName table
        $update = $this->db->update($this->tableName, $data, array('id' => $id));

        //return the status
        return $update ? true : false;
    }

    /*
     * Delete $this->tableName data
     */
    public function delete($id)
    {
        //delete data from $this->tableName table
        $delete = $this->db->delete($this->tableName, array('id' => $id));
        //return the status
        return $delete ? true : false;
    }
}
