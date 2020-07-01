<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class ListKalender extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('List_model');
    }

    public function index_get()
    {
        $lowongan = $this->List_model->getListKalender();

        if($lowongan) {
            $this->response([
                'status' => true,
                'data' => $lowongan
            ], REST_Controller::HTTP_OK);
        }
    } 
    
}