<?php
class Admin extends CI_controller
{
   public function __construct()
   {
       parent::__construct();

       $this->load->model(['Common']);
     

   }
   public function login()
   {
     if($this->input->post())
     {
          $this->form_validation->set_rules('email','Email','required|valid_email');
          $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() == false)
        {
        
        }
        else{
            $data = ['email'=>$this->input->post('email'),'password'=>md5($this->input->post('password'))];   
            $admin_info = $this->Common->login('admin_info',$data);
           if(!empty($admin_info))
           {
              $this->session->set_userdata('admin',$admin_info);
               return redirect('dashboard'); 
           }
           else{
              $this->session->set_flashdata('error','Username or password is wrong');

           }
        }
     }
     
    $this->load->view('admin/login');

   }

   public function dashboard()
   {
      
      if(empty($this->session->userdata('admin')))
      {
          redirect('login');exit;

      }
      $data['admin_info'] =  $this->session->userdata('admin');

      $this->load->view('include/header',$data);
      $this->load->view('admin/dashboard');
      $this->load->view('include/footer');
       
    

   }
   public function logout()
   {
      $this->session->sess_destroy();
      redirect('login');

   }


}
?>