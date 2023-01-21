<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function home() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Dashboard';
            $data['num_orders'] = $this->User_Model->countOrders();
            $data['num_drivers'] = $this->User_Model->countDrivers();
            $data['num_customers'] = $this->User_Model->countCustomers();
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/home', $data);
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function customer_view() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Customer';
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/customer');
            $this->load->view('admin/viewPhone_Modal');
            $this->load->view('admin/viewEmail_Modal');
            $this->load->view('admin/addCustomer_Modal');
            $this->load->view('admin/editCustomer_Modal');
            $this->load->view('admin/viewCustomer_Modal');
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function driver_view() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Driver';
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/driver');
            $this->load->view('admin/viewPhone_Modal');
            $this->load->view('admin/viewEmail_Modal');
            $this->load->view('admin/driverClaims_Modal');
            $this->load->view('admin/addDriver_Modal');
            $this->load->view('admin/editDriver_Modal');
            $this->load->view('admin/viewDriver_Modal');
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function order_view() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Order';
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/order');
            $this->load->view('admin/addOrder_Modal');
            $this->load->view('admin/editOrder_Modal');
            $this->load->view('admin/viewOrder_Modal');
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function report_view() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Report';
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/report');
            $this->load->view('admin/addAdmin_Modal');
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function profile() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data['title'] = 'Profile';
            $this->load->view('admin/includes/header', $data);
            $this->load->view('admin/includes/js');
            $this->load->view('admin/profile', $data);
            $this->load->view('admin/includes/footer');
        } else {
            redirect('login');
        }
    }

    public function sendEmail() {
        $this->load->config('email');
        $from = $this->config->item('smtp_user');
        $to = $this->input->post('to_address');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $footer = '\nKind Regards\nTel:+268 76671033';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message . $footer);

        if ($this->email->send()) {
            echo 'Email successfully sent.';
        } else {
            echo show_error($this->email->print_debugger());
        }
    }

    function fetch_single_user() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $output = array();
            $data = $this->User_Model->fetch_single_user($_SESSION['is_session_on']['usr_id']);
            foreach ($data as $row) {
                $output['usr_id'] = $row->usr_id;
                $output['usr_username'] = $row->usr_username;
                $output['usr_fname'] = $row->usr_fname;
                $output['usr_lname'] = $row->usr_lname;
                $output['usr_email'] = $row->usr_email;
                $output['usr_phone'] = $row->usr_phone;
                $output['usr_password'] = $row->usr_password;
                $output['usr_status'] = $row->usr_status;
                $output['usr_type'] = $row->usr_type;
                $output['usr_create_date'] = $row->usr_create_date;
                $output['usr_near_facility'] = $row->usr_near_facility;
                $output['usr_chiefdom'] = $row->usr_chiefdom;
                $output['usr_constituency'] = $row->usr_constituency;
                $output['usr_region'] = $row->usr_region;
            }
            echo json_encode($output);
        } else {
            redirect('login');
        }
    }

    function updateUser_Password() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $data = array(
                'usr_password' => $this->input->post('user_password')
            );
            if ($this->User_Model->updateUser_Password($_SESSION['is_session_on']['usr_id'], $data)) {
                echo 'Data Edited';
            } else {
                echo 'Error Editing Data';
            }
        } else {
            redirect('login');
        }
    }

}
