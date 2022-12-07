<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Emailsettings_model extends CI_Model
{
    public $tableName = "email_settings";
    public function __construct()
    {
        parent::__construct();
        // Set searchable column fields
        $this->column_search = ['rank', 'id', 'host', 'port', 'email', 'password', 'lang', 'createdAt', 'updatedAt', 'isActive'];
        // Set default order
        $this->order = ['rank' => 'ASC'];
    }
    public function get($select = null, $where = [], $joinTable = [], $likes = [],$wherein = [], $distinct = null, $groupBy = null)
	{
		if (!empty($select)) :
			$this->db->select($select);
		endif;
		if (!empty($joinTable)) :
			foreach ($joinTable as $key => $value) :
				$this->db->join($key, $value[0], $value[1]);
			endforeach;
		endif;
		if (!empty($distinct)) :
			$this->db->distinct();
		endif;
		$this->db->where($where);
		if (!empty($wherein)) :
			foreach ($wherein as $key => $value) :
				$this->db->where_in($key, $value);
			endforeach;
		endif;
		if (!empty($likes)) :
			$i = 0;
			$j = 0;
			foreach ($likes as $key => $value) :
				if (!is_array($value)) :
					// first loop
					if ($i === 0) :
						// open bracket
						$this->db->group_start();
						$this->db->like($key, $value, 'both');
						$this->db->or_like($key, strto("lower", $value), 'both');
						$this->db->or_like($key, strto("lower|upper", $value), 'both');
						$this->db->or_like($key, strto("lower|ucwords", $value), 'both');
						$this->db->or_like($key, strto("lower|capitalizefirst", $value), 'both');
						$this->db->or_like($key, strto("lower|ucfirst", $value), 'both');
					else :
						$this->db->or_like($key, $value, 'both');
						$this->db->or_like($key, strto("lower", $value), 'both');
						$this->db->or_like($key, strto("lower|upper", $value), 'both');
						$this->db->or_like($key, strto("lower|ucwords", $value), 'both');
						$this->db->or_like($key, strto("lower|capitalizefirst", $value), 'both');
						$this->db->or_like($key, strto("lower|ucfirst", $value), 'both');
					endif;

					// last loop
					if (count($likes) - 1 == $i) :
						// close bracket
						$this->db->group_end();
					endif;
					$i++;
				else :
					// first loop
					if ($i === 0) :
						// open bracket
						$this->db->group_start();
					endif;
					foreach ($value as $k => $v) :
						foreach ($v as $kk => $vv) :
							// first loop
							if ($j === 0) :

								$this->db->like($kk, $vv, 'both');
								$this->db->or_like($kk, strto("lower", $vv), 'both');
								$this->db->or_like($kk, strto("lower|upper", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucwords", $vv), 'both');
								$this->db->or_like($kk, strto("lower|capitalizefirst", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucfirst", $vv), 'both');
							else :
								$this->db->or_like($kk, $vv, 'both');
								$this->db->or_like($kk, strto("lower", $vv), 'both');
								$this->db->or_like($kk, strto("lower|upper", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucwords", $vv), 'both');
								$this->db->or_like($kk, strto("lower|capitalizefirst", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucfirst", $vv), 'both');
							endif;
							$j++;
						endforeach;
					endforeach;

					// last loop
					if (count($likes) - 1 == $i) :
						// close bracket
						$this->db->group_end();
					endif;
					$i++;
				endif;
			endforeach;
		endif;
		if (!empty($groupBy)) :
			$this->db->group_by($groupBy);
		endif;
		$query = $this->db->get($this->tableName)->row();
		return $query;
	}
	public function get_all($select = null, $order = null, $where = [],  $likes = [], $joinTable = [], $limit = [], $wherein = [], $distinct = null, $groupBy = null)
	{
		if (!empty($select)) :
			$this->db->select($select);
		endif;
		if (!empty($joinTable)) :
			foreach ($joinTable as $key => $value) :
				$this->db->join($key, $value[0], $value[1]);
			endforeach;
		endif;
		if (!empty($distinct)) :
			$this->db->distinct();
		endif;
		//$this->db->where(["id!=" => null]);
		$this->db->where($where);
		if (!empty($wherein)) :
			foreach ($wherein as $key => $value) :
				$this->db->where_in($key, $value);
			endforeach;
		endif;
		if (!empty($likes)) :
			$i = 0;
			$j = 0;
			foreach ($likes as $key => $value) :
				if (!is_array($value)) :
					// first loop
					if ($i === 0) :
						// open bracket
						$this->db->group_start();
						$this->db->like($key, $value, 'both');
						$this->db->or_like($key, strto("lower", $value), 'both');
						$this->db->or_like($key, strto("lower|upper", $value), 'both');
						$this->db->or_like($key, strto("lower|ucwords", $value), 'both');
						$this->db->or_like($key, strto("lower|capitalizefirst", $value), 'both');
						$this->db->or_like($key, strto("lower|ucfirst", $value), 'both');
					else :
						$this->db->or_like($key, $value, 'both');
						$this->db->or_like($key, strto("lower", $value), 'both');
						$this->db->or_like($key, strto("lower|upper", $value), 'both');
						$this->db->or_like($key, strto("lower|ucwords", $value), 'both');
						$this->db->or_like($key, strto("lower|capitalizefirst", $value), 'both');
						$this->db->or_like($key, strto("lower|ucfirst", $value), 'both');
					endif;

					// last loop
					if (count($likes) - 1 == $i) :
						// close bracket
						$this->db->group_end();
					endif;
					$i++;
				else :
					// first loop
					if ($i === 0) :
						// open bracket
						$this->db->group_start();
					endif;
					foreach ($value as $k => $v) :
						foreach ($v as $kk => $vv) :
							// first loop
							if ($j === 0) :

								$this->db->like($kk, $vv, 'both');
								$this->db->or_like($kk, strto("lower", $vv), 'both');
								$this->db->or_like($kk, strto("lower|upper", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucwords", $vv), 'both');
								$this->db->or_like($kk, strto("lower|capitalizefirst", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucfirst", $vv), 'both');
							else :
								$this->db->or_like($kk, $vv, 'both');
								$this->db->or_like($kk, strto("lower", $vv), 'both');
								$this->db->or_like($kk, strto("lower|upper", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucwords", $vv), 'both');
								$this->db->or_like($kk, strto("lower|capitalizefirst", $vv), 'both');
								$this->db->or_like($kk, strto("lower|ucfirst", $vv), 'both');
							endif;
							$j++;
						endforeach;
					endforeach;

					// last loop
					if (count($likes) - 1 == $i) :
						// close bracket
						$this->db->group_end();
					endif;
					$i++;
				endif;
			endforeach;
		endif;
		if (!empty($groupBy)) :
			$this->db->group_by($groupBy);
		endif;
		$this->db->order_by($order);
		if (!empty($limit)) :
			if (!empty($limit[1])) :
				$this->db->limit($limit[0], $limit[1]);
			else :
				$this->db->limit($limit[0]);
			endif;
		endif;
		$query = $this->db->get($this->tableName)->result();
		return $query;
	}
    public function add($data = [])
    {
        return $this->db->insert($this->tableName, $data);
    }
    public function update($where = [], $data = [])
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }
    public function delete($where = [])
    {
        return $this->db->where($where)->delete($this->tableName);
    }
	public function deleteBulk($wherein = null, $data = [])
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
