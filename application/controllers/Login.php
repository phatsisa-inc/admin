<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $data['title'] = 'Login';
        $this->load->view('index', $data);
    }

    function getLogin() {
        /* Data that we receive from ajax */
        $username = $this->input->post('UserName');
        $Password = $this->input->post('Password');

        if (!isset($username) || $username == '' || $username == 'undefined') {
            /* If Username that we recieved is invalid, go here, and return 2 as output */
            echo 2;
            exit();
        }
        if (!isset($Password) || $Password == '' || $Password == 'undefined') {
            /* If Password that we recieved is invalid, go here, and return 3 as output */
            echo 3;
            exit();
        }
        $this->form_validation->set_rules('UserName', 'UserName', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            /* If Both Username &  Password that we recieved is invalid, go here, and return 4 as output */
            echo 4;
            exit();
        } else {
            /* validate($username, $Password) is the function in User_Model.php */
            $result = $this->User_Model->validate($username, $Password);
            if (count($result) == 1) {
                /* If everything is fine, then go here, and return 1 as output and set session */
                $session_data = array(
                    'usr_id' => $result[0]->usr_id,
                    'usr_fname' => $result[0]->usr_fname,
                    'usr_type' => $result[0]->usr_type,
                    'loged_in' => TRUE
                );
                $this->session->set_userdata('is_session_on', $session_data);
                echo 1;
            } else {
                /* If Both Username &  Password that we recieved is invalid, go here, and return 5 as output */
                echo 5;
            }
        }
    }

    public function signout() {
        unset($_SESSION['is_session_on']);
        redirect(base_url() . 'login');
    }

}
