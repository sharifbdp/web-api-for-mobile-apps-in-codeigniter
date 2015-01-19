<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Api_model', ''), '', TRUE);
    }

    public function index() {
        $this->load->view('api/form');
    }

    public function sign_up() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean|required|md5');

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            echo strip_tags(json_encode(array('message' => 'wrong input')));
        } else {
            $data['name'] = $this->input->post('name', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['password'] = $this->input->post('password', TRUE);
            $data['device_id'] = $this->input->post('device_id', TRUE);
            $data['phone_no'] = $this->input->post('phone_no', TRUE);
            $data['address'] = $this->input->post('address', TRUE);
            $data['status'] = 1;

            $check_user = $this->Api_model->check_user_existance_by_email('registrations', $data);
            if ($check_user) {
                $insert = $this->Api_model->insert('registrations', $data);
                if ($insert) {
                    echo strip_tags(json_encode(array('message' => 'success', 'user_details' => $data)));
                } else {
                    echo strip_tags(json_encode(array('message' => 'failed')));
                }
            } else {
                echo strip_tags(json_encode(array('message' => 'exists')));
            }
        }
    }

    public function sign_in() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|md5');
        if ($this->form_validation->run() == FALSE) {
            echo strip_tags(json_encode(array('message' => 'wrong input')));
        } else {
            $data['email'] = $this->input->post('email', TRUE);
            $data['password'] = $this->input->post('password', TRUE);

            $auth = $this->Api_model->authenticate_user('registrations', $data);
            if ($auth) {
                $user_details = $this->Api_model->read('registrations', 'email', $data['email']);
                echo strip_tags(json_encode(array('message' => 'success', 'user_details' => $user_details)));
            } else {
                echo strip_tags(json_encode(array('message' => 'failed')));
            }
        }
    }

    public function view($id = NULL) {
        $id = $this->input->get_post('id', TRUE);
        if (empty($id)) {
            echo strip_tags(json_encode(array('message' => 'id is required')));
            exit();
        }

        $user_details = $this->Api_model->read('registrations', 'id', $id);
        if (!empty($user_details)) {
            echo strip_tags(json_encode(array('message' => 'success', 'user_details' => $user_details)));
        } else {
            echo strip_tags(json_encode(array('message' => 'failed')));
        }
    }

    public function edit($id = NULL) {
        $id = $this->input->get_post('id', TRUE);
        if (empty($id)) {
            echo strip_tags(json_encode(array('message' => 'id is required')));
            exit();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean|md5');

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            echo strip_tags(json_encode(array('message' => 'wrong input')));
        } else {
            $data['name'] = $this->input->post('name', TRUE);
            if ($this->input->post('password') != "") {
                $data['password'] = $this->input->post('password', TRUE);
            }
            $data['device_id'] = $this->input->post('device_id', TRUE);
            $data['phone_no'] = $this->input->post('phone_no', TRUE);
            $data['address'] = $this->input->post('address', TRUE);

            $update = $this->Api_model->update('registrations', $data, 'id', $id);
            if ($update) {
                $user_details = $this->Api_model->read('registrations', 'id', $id);
                echo strip_tags(json_encode(array('message' => 'success', 'user_details' => $user_details)));
            } else {
                echo strip_tags(json_encode(array('message' => 'failed')));
            }
        }
    }

}
