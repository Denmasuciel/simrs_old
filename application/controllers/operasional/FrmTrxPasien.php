<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FrmTrxPasien extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('operasional/FrmTrxPasien_model','pasien');
    }

    public function index(){
        $data=array(
            //			'menu_1'=>$this->M_menu->menu()->result(),
            'data_table'=>'View Pasien',
            'role'=>'admin',
//            'maxjadwal'=> $this->frmcomjadwal_model->maxjadwal()
        );
        $this->template->load('template','operasional/FrmTrxPasien',$data);

        //        date_default_timezone_set("Asia/jakarta");
        //        echo "The time is " . date("h:i:s");

    }




    

public function ajax_list()//ok
    {
       
        $cari = $this->input->post('txt_cari');
        // $cari = 'eko prasetyo bp';
                
        $result = array();
        $result['total'] = $this->db->query("SELECT  pasien_cd,no_rm,pasien_nm FROM trx_pasien where 1=1 and no_rm like '%$cari%' or pasien_nm like '%$cari%' ")->num_rows();
        $row = array(); 
        $criteria = $this->db->query("SELECT  pasien_cd,no_rm,pasien_nm FROM trx_pasien where 1=1 and no_rm like '%$cari%' or pasien_nm like '%$cari%'  ORDER BY pasien_nm ASC");
        $no=1;
        foreach($criteria->result_array() as $data)
        {   
                            $row[] = array(
                            'pasien_cd'=>$data['pasien_cd'],
                            'no_rm'=>$data['no_rm'],
                            'pasien_nm'=>$data['pasien_nm']
                            );                                              
        }
        
        //$result=array_merge($result,array('rows'=>$row));
        $result=array('aaData'=>$row);
        echo  json_encode($result);
    }

public function ajax_list_100()//ok
    {
       
                 
        $result = array();
        $result['total'] = $this->db->query("SELECT top 100  pasien_cd,no_rm,pasien_nm FROM trx_pasien  ")->num_rows();
        $row = array(); 
        $criteria = $this->db->query("SELECT top 100 pasien_cd,no_rm,pasien_nm FROM trx_pasien ORDER BY pasien_nm ASC");
        $no=1;
        foreach($criteria->result_array() as $data)
        {   
                            $row[] = array(
                            'pasien_cd'=>$data['pasien_cd'],
                            'no_rm'=>$data['no_rm'],
                            'pasien_nm'=>$data['pasien_nm']
                            );                                              
        }
        
        //$result=array_merge($result,array('rows'=>$row));
        $result=array('aaData'=>$row);
        echo  json_encode($result);
    }


}


/* End of file crud.php */
/* Location: ./application/controllers/crud.php */