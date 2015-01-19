<?php

class Api_model extends CI_Model {

    public function insert($table, $data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($table, $data);
    }

    public function read($table, $field_name, $field_value) {
        $this->db->from($table);
        $this->db->where($field_name, $field_value);
        return $this->db->get()->row();
    }

    public function update($table, $data, $field_name, $field_value) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function check_user_existance_by_email($table, $data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->get($table);
        $rows = $query->num_rows();
        if ($rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function authenticate_user($table, $data) {
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $query = $this->db->get($table);
        $rows = $query->num_rows();
        if ($rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}
