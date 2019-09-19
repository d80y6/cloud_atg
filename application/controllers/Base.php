<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once './assets/Spout/Autoloader/autoload.php';



use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\Style\Color;


class Base extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		//session_start();
		// Load form helper library
		$this->load->helper('form');
		
		// Load form validation library
		$this->load->library('form_validation');

		//user_agent_browser
		$this->load->library('user_agent');

		
		// Load session library
		$this->load->library('session');
		$this->load->model('base_model');
		
		
		
	}


	function browser(){
		return $browser = $this->agent->browser();
	}
	function platform(){
		return $browser = $this->agent->platform();
	}



	public function index()
	{
		$this->load->view('landing');

	}
	
	public function login()
	{
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				redirect('general');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				redirect('company');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				redirect('station');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				redirect('general');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				redirect('company');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				redirect('station');

			}

	
		}
		else{
			$this->load->view('login');

		}
	}


	public function companymgt($id = null)
	{
		// $this->load->view('general/companymgt');

		$data = array();
		$data['lowerID'] = $id ? $id : null;

		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/companymgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				// $this->load->view('company/dashboard');
				redirect('company');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				// $this->load->view('station/dashboard');
				redirect('station');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/companymgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				// $this->load->view('company/dashboard');
				redirect('company');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				// $this->load->view('station/dashboard');
				redirect('station');

			}

	
		}
		else{
			redirect("logout");
		}
	}


	function companies_loadtable($id = null)
    {
		

         $result = $id ? $this->base_model->load_companies($id) : $this->base_model->load_companies();
		 echo $result;
			
		
        
	}


	function enableCompany($Id= null,$name=null)
    {
		$result = $this->base_model->enableCompany($Id); 
		
		$name = $this->getCompany($Id,true) ? $this->getCompany($Id,true)[0]['name'] : "Not Found";
		
		$email = $this->getCompany($Id,true) ? json_decode($this->getCompany($Id,true)[0]['email'],true)[4]['value'] : null;

		
		

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Enable Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),
			);

			$this->base_model->addActivityLog($logArr);

			
			if($email){
	
				$title = "New Company Profile Approved Successfully";
	
				$message = "Dear ". $name. ", <br/><br/>  Your Ash ATG Company profile has been approved successfully. You can now Login using this email address and the password you provided on sign up. <br/><br/> Welcome Aboard <br/><br/>  Regards,";
	
				$emailSend = $this->sendMail($email, $title, $message);
				if($emailSend){
					echo $result;
					return;
				}
	
				else{
					echo 0;
					return;
	
				}
			}

		}
		 
		echo $result;

	}


	function disableCompany($Id= null,$name=null)
    {
		$result = $this->base_model->disableCompany($Id); 

		$name = $this->getCompany($Id,true) ? $this->getCompany($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Disable Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),
			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}

	function deleteCompany($Id= null,$name=null)
    {
		$result = $this->base_model->deleteCompany($Id); 

		$name = $this->getCompany($Id,true) ? $this->getCompany($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Delete Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	function approveCompany($Id= null,$name=null)
    {
		$result = $this->base_model->approveCompany($Id); 

		$name = $this->getCompany($Id,true) ? $this->getCompany($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Approve Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// if result is true, send approved email
		// if approved email is true, return result true
		 
		echo $result;

	}


	function addCompany()
    {
		$result = $this->base_model->addCompany(); 

		$emailSend = null;

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add Company | ".$this->input->post('name')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

			if($this->input->post('land') == "yes"){

				// $this->load->helper('string');


				// $user = array();

				// $user['fname'] = $this->input->post('name');
				// $user['lname'] = "User";
				// $user['user_password'] = $pword;


				$toEmail = json_decode($this->input->post('email'),true)[4]['value'];

				// $pword = random_string('alnum', 7);

				// $pword = strrev($toEmail);

				// $user['email'] = $toEmail;
				// $user['company'] = $result;
				// $user['station'] = 0;
				// $user['acctType'] = "companyAdmin";

				// $resUser = $this->base_model->addUser($user); 



				// echo $toEmail;
				// print_r($this->input->post('email'));
				
				$title = "New Company Profile Created Successfully";
				
				// $message = "";
				
				$message = "Dear ". $this->input->post('name'). ", <br/><br/>  Your Ash ATG Company Profile has been created successfully. Your details will be reviewed and approved shortly <br/><br/> Welcome Aboard <br/><br/>  Regards";
				
				
					$emailSend = $this->sendMail($toEmail, $title, $message);
					if($emailSend){
						echo $result;
						return;
					}

					else{
						echo 0;
						return;

					}
					
				
			}

		}

		// var_dump($this->input->post());
		
		

			echo $result;
		

	}



	function editCompany(){
 
		$id = $this->input->post('id',true);

		echo $result = $this->base_model->editCompany($id);

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit Company | ".$this->input->post('name')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

	}


	function getCompany($id = null, $within = null){

		// $id = $this->post->("num",true); 
		if($id == null){
			$id = $this->input->post('num',true);
		}


		if(!$within){

			echo json_encode($this->base_model->getCompany($id));
		}

		if($within){

			return $this->base_model->getCompany($id);
		}


		// return $this->base_model->getCompany($id);
	}
	
	function getCompanies($id = null){
		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');

		echo json_encode($this->base_model->companyGet(null, null,null,null,null,$coy,$stat));
	}
	
	



	// ===================================================company end========================================

	
	public function stationmgt($id = null)
	{

		$data = array();
		$data['lowerID'] = $id ? $id : null;
		// $this->load->view('general/stationmgt');
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/stationmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/stationmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				// $this->load->view('station/stationmgt');
				redirect('station');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/stationmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/stationmgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				redirect('station');
				// $this->load->view('station/stationmgt');

			}

	
		}
		else{
			redirect("logout");
		}

	}


	function stations_loadtable($id = null)
    {
					
		//  $result = $this->base_model->load_stations();
         $result = $id ? $this->base_model->load_stations($id) : $this->base_model->load_stations();
		 
		 echo $result;
			
		
        
	}


	function enableStation($Id= null,$name=null)
    {
		$result = $this->base_model->enableStation($Id); 

		$name = $this->getStation($Id,true) ? $this->getStation($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Enable Station | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}


	function disableStation($Id= null,$name=null)
    {
		$result = $this->base_model->disableStation($Id); 

		$name = $this->getStation($Id,true) ? $this->getStation($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Disable Station | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}

	
	function deleteStation($Id= null,$name=null)
    {
		$result = $this->base_model->deleteStation($Id); 


		$name = $this->getStation($Id,true) ? $this->getStation($Id,true)[0]['name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Delete Station | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		 
		echo $result;

	}
	
	


	function addStation()
    {
		$result = $this->base_model->addStation(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add Station | ".$this->input->post('name')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}



	function editStation(){
 
		$id = $this->input->post('id',true);

		echo $result = $this->base_model->editStation($id);

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit Station | ".$this->input->post('name')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// echo $result;

	}


	function getStation($id = null, $within =  null){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);

		if($id == null){
			$id = $this->input->post('num',true);
		}

		if(!$within){


		echo json_encode($this->base_model->getStation($id));
		}

		if($within){

		return $this->base_model->getStation($id);
		}
	}

	function getStations($id = null){

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');

		echo json_encode($this->base_model->stationGet(null,$coy,$stat));
	}


	// ===================================================station end========================================
	
	
	function notLogs_loadtable($id = null)
    {
		
		//  $result = $this->base_model->load_actLogs();
         $result = $id ? $this->base_model->load_notLogs($id) : $this->base_model->load_notLogs();
		 
		 echo $result;
			
		
        
	}
	

	function notifications($id = null)
    {

		$data = array();
		$data['lowerID'] = $id ? $id : null;

		//  $this->load->view('actLog');
		 if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/notifications', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/notifications', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/notifications', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/notifications', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/notifications', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/notifications', $data);

			}

	
		}
		else{
			redirect("logout");
		}
        
	}
	
	// ===================================================actLog end========================================
	

	function actLogs_loadtable($id = null)
    {
		
		//  $result = $this->base_model->load_actLogs();
         $result = $id ? $this->base_model->load_actLogs($id) : $this->base_model->load_actLogs();
		 
		 echo $result;
			
		
        
	}
	

	function actLog($id = null)
    {

		$data = array();
		$data['lowerID'] = $id ? $id : null;

		//  $this->load->view('actLog');
		 if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/actLog', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/actLog', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/actLog', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/actLog', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/actLog', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/actLog', $data);

			}

	
		}
		else{
			redirect("logout");
		}
        
	}
	
	// ===================================================actLog end========================================

	public function controllermgt($id = null)
	{
		// $this->load->view('general/controllermgt');

		$data = array();
		$data['lowerID'] = $id ? $id : null;
		
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/controllermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/controllermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/controllermgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/controllermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/controllermgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/controllermgt', $data);

			}

	
		}
		else{
			redirect("logout");
		}
	}


	function controllers_loadtable($id = null)
    {
		
			// $result = $this->base_model->load_controllers();
			$result = $id ? $this->base_model->load_controllers($id) : $this->base_model->load_controllers();
			
		 echo $result;
			
		
        
	}


	function enableController($Id= null,$name=null)
    {
		$result = $this->base_model->enableController($Id); 

		$name = $this->getController($Id) ? $this->getController($Id)['contName'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Enable Controller | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}

	function disableController($Id= null,$name=null)
    {
		$result = $this->base_model->disableController($Id); 

		$name = $this->getController($Id) ? $this->getController($Id)['contName'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Disable Controller | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	function deleteController($Id= null,$name=null)
    {
		$result = $this->base_model->deleteController($Id); 


		$name = $this->getController($Id) ? $this->getController($Id)['contName'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Delete Controller | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		 
		echo $result;

	}
	
	


	function addController()
    {
		$result = $this->base_model->addController(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add Controller | ".$this->input->post('contName')." | ".$this->input->post('contId')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}



	function editController(){
 
		$id = $this->input->post('id',true);

		echo $result = $this->base_model->editController($id);

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit Controller | ".$this->input->post('contName')." | ".$this->input->post('contId')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// echo $result;

	}


	function getController($id = null){

		// $id = $this->post->("num",true);

		if ($id==null){
			
			$id = $this->input->post('num',true);
			echo json_encode($this->base_model->getController($id));
		}
		else{
			$cont = (count($this->base_model->getController($id)) > 0) ? $this->base_model->getController($id)[0] : false;
			return $cont;
		}

	}

	function getControllers($id = null){

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');

		echo json_encode($this->base_model->deviceGet(null,$coy,$stat));
	}

	


	// ===================================================Controller end========================================

	public function tankmgt($id = null)
	{

		$data = array();
		$data['lowerID'] = $id ? $id : null;
		// $this->load->view('general/tankmgt');
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/tankmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/tankmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/tankmgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/tankmgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/tankmgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/tankmgt', $data);

			}

	
		}
		else{
			redirect("logout");
		}
	}


	function tanks_loadtable($id = null)
    {
		
				
			// $result = $this->base_model->load_tanks();
			$result = $id ? $this->base_model->load_tanks($id) : $this->base_model->load_tanks();
			
		 echo $result;
			
		
        
	}


	function enableTank($Id= null,$name=null)
    {
		$result = $this->base_model->enableTank($Id); 

		$name = $this->getTank($Id,true) ? $this->getTank($Id,true)['tank_name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Enable Tank | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}


	function disableTank($Id= null,$name=null)
    {
		$result = $this->base_model->disableTank($Id); 

		$name = $this->getTank($Id,true) ? $this->getTank($Id,true)['tank_name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Disable Tank | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	
	function deleteTank($Id= null,$name=null)
    {
		$result = $this->base_model->deleteTank($Id); 


		$name = $this->getTank($Id,true) ? $this->getTank($Id,true)['tank_name'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Delete Tank | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		 
		echo $result;

	}
	
	


	function addTank()
    {
		$result = $this->base_model->addTank(); 


		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add Tank | ".$this->input->post('tank_name')." | ".$this->input->post('tank_num')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}



	function editTank(){
 
		$id = $this->input->post('id',true);

		echo $result = $this->base_model->editTank($id);

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit Tank | ".$this->input->post('tank_name')." | ".$this->input->post('tank_num')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
	}


	function getTank($id = null, $within = null){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);
		if($id == null){
			$id = $this->input->post('num',true);
		}

		if(!$within){

		echo json_encode($this->base_model->getTank($id));
		}

		if($within){

		return $this->base_model->getTank($id);
		}
	}



	function getCurrentTankData($id = null, $cont = null){

		$id = $this->input->post('id',true);
		
		$cont = $this->input->post('cont',true);

		// $contid = $this->getController($cont) ? $this->getController($cont)['contId'] : false;

		$currVal = null;

		// if($contid){
		if($cont){
			
			// $currVal = $this->base_model->getCurrentTankData($id,$contid);
			$currVal = $this->base_model->getCurrentTankData($id,$cont);
		}
		else{
			$currVal = "3";
		}
		
		
		
		echo json_encode($currVal);

	}




	public function calibrationImport($id = null)
	{ 
		// var_dump($id);
			
						set_time_limit(0);
						$this->load->library('form_validation');
						// var_dump($_FILES);
						
						if($_FILES['upload']['tmp_name'] =="")
						{
			echo "Select a file to upload";
			return;
						}
			
			
						if($_FILES['upload']['tmp_name'] !="")
						{
			
			
				if($_FILES['upload']['size'] > 5000000)
								{
			echo "File size is larger than 5MB";
			return;
								}
								ini_set('memory_limit', '254M');
			
								$config['upload_path'] = './upload/calibration_imports/';
								$config['allowed_types']        = 'xlsx|csv';
											
								$this->load->library('upload', $config); 
								
								if (!$this->upload->do_upload('upload'))
								{
			echo $this->upload->display_errors();
			return;
								}
						else
								{    
			$inc = array('upload_data' => $this->upload->data());
			$file = $inc['upload_data']['file_name'];
			$ext = strtoupper(str_replace(".","",$inc['upload_data']['file_ext']));



			if($ext=="XLSX")
			{
		$reader = ReaderFactory::create(Type::XLSX);
			}
		elseif($ext=="CSV")
			{
		$reader = ReaderFactory::create(Type::CSV); 
			}

			$filepath= "./upload/calibration_imports/".$file;
			$reader->open($filepath);

			$header = array();
			
			$dat = array();
			$subDat = array();
			$bulkDb = array();

			$i = 0;


			foreach ($reader->getSheetIterator() as $sheet) 
			{
		foreach ($sheet->getRowIterator() as $key=>$row)
				{

		if($key>0 && $row!="")
		{ 
		foreach($row as $k=>$t)
		{ 
		// if ($i == $key){

				array_push($subDat,$t);
		// }
		
		}
		// $i = $key;
		// echo('<br/>');
		// echo('<br/>');
		array_push($dat,$subDat);
		array_push($subDat,$id);

		// print_r($subDat);
		$subDat = array();

		}
				}
				}

		// echo json_encode($dat);




		foreach ($dat as $result) {
			$i++;
			$resArr = array();
			
			
			$resArr['dip']=$result[0];
			$resArr['volume']=$result[1];
			$resArr['tank_id']=$id;
			
			$bulkDB[$i]=$resArr;
			
		}

		// echo json_encode($bulkDB);

		// $this->db->insert_batch('tank_calibration',$bulkDB);

		$addTankCalibration = $this->base_model->insert_batch('tank_calibration',$bulkDB, $id);


		// $this->load->library('user_agent');

		// $browser = $this->agent->browser();


		// $logArr = array(
		// 'user' => $this->session->userdata('userId'),
		// 	'activity' =>"Uploaded Calibration Chart for Tank ".$id." | ".$browser
		// );




		echo $addTankCalibration;
								}



								return;
			
						}
			
	 
		 
	}

	


	// ===================================================Controller end========================================
	
	
	public function usermgt($id = null)
	{
		$data = array();
		$data['lowerID'] = $id ? $id : null;

		// $this->load->view('general/usermgt');
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/usermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/usermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/usermgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/usermgt', $data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/usermgt', $data);

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/usermgt', $data);

			}

	
		}
		else{
			redirect("logout");
		}
	}


	function users_loadtable($id = null)
    {
		
				

			// $result = $this->base_model->load_users();
			$result = $id ? $this->base_model->load_users($id) : $this->base_model->load_users();
			
		 echo $result;
			
		
        
	}


	function enableUser($Id= null,$name=null)
    {
		$result = $this->base_model->enableUser($Id); 

		$name = $this->getUser($Id ,true) ? $this->getUser($Id,true)[0]['fname']." | ".$this->getUser($Id,true)[0]['lname'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Enable User | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	function disableUser($Id= null,$name=null)
    {
		$result = $this->base_model->disableUser($Id); 

		$name = $this->getUser($Id,true) ? $this->getUser($Id,true)[0]['fname']." | ".$this->getUser($Id,true)[0]['lname'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Disable User | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	function deleteUser($Id= null,$name=null)
    {
		$result = $this->base_model->deleteUser($Id); 

		$name = $this->getUser($Id,true) ? $this->getUser($Id,true)[0]['fname']." | ".$this->getUser($Id,true)[0]['lname'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Delete User | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
		 
		echo $result;

	}
	
	


	function addUser()
    {
		$result = $this->base_model->addUser(); 
		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add User | ".$this->input->post('fname')." | ".$this->input->post('lname')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);


			$toEmail = $this->input->post('email');

			$title = "New User Account Created Successfully";
			
			// $message = "";

			$message = "Dear ". $this->input->post('fname'). ", <br/><br/>  Your Ash ATG account has been created successfully. <br/><br/> Url:
			".base_url()."login <br/><br/> Username: 
			".$this->input->post('email')." <br/><br/> Password: 
			".$this->input->post('user_password')." <br/> <br/>
			
			Regards";
   
			if($this->input->post('land') != "yes"){

				$this->sendMail($toEmail, $title, $message);
			}

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}



	function editUser(){
 
		$id = $this->input->post('id',true);

		echo $result = $this->base_model->editUser($id);

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit User | ".$this->input->post('fname')." | ".$this->input->post('lname')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}
	}


	function getUser($id = null, $within = null){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);
		if($id == null){
			$id = $this->input->post('num',true);
		}

		if(!$within){

		echo json_encode($this->base_model->getUser($id));
		}

		if($within){

		return $this->base_model->getUser($id);
		}
	}

	public function profile()
	{
		// $this->load->view('general/profile');
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/profile');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/profile');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/profile');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/profile');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/profile');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/profile');

			}

	
		}
		else{
			redirect("logout");
		}
	}
	
	// ===================================================user end========================================
	
	
	public function settings()
	{
		// $this->load->view('general/settings');
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/settings');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/settings');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/settings');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/settings');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/settings');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/settings');

			}

	
		}
		else{
			redirect("logout");
		}
	}
	
	function getKAT(){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);
		// if($this->session->userdata('acctType') == "admin"){

			echo json_encode($this->base_model->getKAT());
		// }
		// else{
		// 	echo "0";
		// }

	}

	function addKAT()
    {
		$result = $this->base_model->addKAT(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add KAT | ".$this->input->post('value')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}
	
	function editKAT()
    {
		$result = $this->base_model->editKAT(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit KAT | ".$this->input->post('value')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}
	
	function getPCD(){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);
		// if($this->session->userdata('acctType') == "admin"){

			echo json_encode($this->base_model->getPCD());
		// }
		// else{
		// 	echo "0";
		// }

	}
	
	function getSysSettings(){

		// $syssettings = $this->base_model->getSysSettings();

		echo json_encode($this->base_model->getSysSettings());
		

	}

	function addPCD()
    {
		$result = $this->base_model->addPCD(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Add PCD | ".$this->input->post('value')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}
	
	function editPCD()
    {
		$result = $this->base_model->editPCD(); 

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Edit PCD | ".$this->input->post('value')." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		// var_dump($this->input->post());
		 
		echo $result;

	}
	
	// ===================================================settings end========================================


	
	public function general()
	{
		$data = array();
		// $data['companyGet'] = count($this->base_model->companyGet());
		// $data['inactiveCompanyGet'] = count($this->base_model->companyGet("yes"));
		// $data['notifications'] = $this->base_model->notificationGet();
		// $data['notificationsCount'] = $this->base_model->notificationGet("yes");
		// $this->load->view('general/dashboard',$data);
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				$this->load->view('general/dashboard',$data);
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				redirect('company');
				// $this->load->view('company/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				redirect('station');
				// $this->load->view('station/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				$this->load->view('general/dashboard',$data);
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				redirect('company');
				// $this->load->view('company/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				redirect('station');
				// $this->load->view('station/dashboard');

			}

	
		}
		else{
			redirect("logout");
		}
	}


	function generalDashLoad(){
				ini_set('memory_limit', '1024M');
				// ini_set('memory_limit', '254M');

		// if()
		$from = $this->input->post('from',true);
		$to = $this->input->post('to',true);
		$userType = $this->input->post('userType',true);
		$company = $this->input->post('company',true);
		$station = $this->input->post('station',true);
		$location = $this->input->post('location',true);

		
		
		$stations = $this->base_model->stationGet(null, $company, $station, $location);
		// var_dump($stations);
		$reorderFreq = [];
		foreach ($stations as $key=>$stat) {
		
			$name = $stat['name'];
			$id = $stat['station_id'];
			$coy = $stat['company_id'];
			$loc = $stat['location'];

			$tanks = $this->base_model->tankGet(null,null,$id);

			$reorders = [];
			foreach ($tanks as $key=>$tank) {
				$grbt = $this->getReordersByTank($tank);
				// var_dump($grbt);
				if($grbt == null || count($grbt)<1){
					continue;
				}
				$reorders = array_merge($reorders,$grbt);

			
			}

			array_push($reorderFreq,array($name,$loc,count($reorders),$coy));



		}	



		$data = array();

		$data['reorders'] = $reorderFreq;



		$data['companies'] = $this->base_model->companyGet(null, null, null, null,$userType,$company);
		$data['companiesSel'] = $this->base_model->companyGet(null, null, null, null,null,null);
		$data['stations'] = $this->base_model->stationGet(null, $company, $station, $location);
		$data['stationsSel'] = $this->base_model->stationGet(null, null, null, null);
		$data['companyCount'] = count($this->base_model->companyGet(null, null, null, null,$userType,$company));
		$data['inactiveCompanyCount'] = count($this->base_model->companyGet("yes", null, null, null,$userType,$company));
		$data['stationCount'] = count($this->base_model->stationGet(null, $company, $station, $location));
		$data['inactiveStationCount'] = count($this->base_model->stationGet("yes", $company, $station, $location));
		$data['userCount'] = count($this->base_model->userGet(null, null, null, $company, $station, $userType));
		$data['inactiveUserCount'] = count($this->base_model->userGet("yes", null, null, $company, $station, $userType));
		$data['tankCount'] = count($this->base_model->tankGet(null,$company,$station));
		$data['inactiveTankCount'] = count($this->base_model->tankGet("yes",$company,$station));
		$data['deviceCount'] = count($this->base_model->deviceGet(null,$company,$station));
		$data['inactiveDeviceCount'] = count($this->base_model->deviceGet("yes",$company,$station));
		$data['AGOvol'] = $this->getTotalAGO($from,$company,$station);
		$data['PMSvol'] = $this->getTotalPMS($from,$company,$station);
		$data['DPKvol'] = $this->getTotalDPK($from,$company,$station);
		$data['pendingApprovals'] = $this->base_model->companyGet(null,'yes', null, null,$userType,$company);
		$data['recentLogs'] = $this->base_model->actLogGet($company,$station,$from,$to,$userType);
		$data['mostActiveUsers'] = $this->base_model->mostActiveGet($company,$station,$from,$to,$userType);
		$data['inactiveDevices'] = $this->base_model->deviceGet("yes",$company,$station);
		$data['locations'] = $this->base_model->locationGet($company, $station, $location);
		$data['locationsSel'] = $this->base_model->locationGet(null, null, null);
		$data['notifications'] = $this->base_model->notificationGet();
		$data['notificationsCount'] = $this->base_model->notificationGet("yes");
		$data['userTypes'] = $this->base_model->userGet(null,"yes", null, $company, $station, $userType);
		$data['userTypesSel'] = $this->base_model->userGet(null,"yes", null, null, null, null);
		$data['userOnline'] = count($this->base_model->userGet(null,null, "yes", $company, $station, $userType));
		$data['userOffline'] = count($this->base_model->userGet(null,null, "no", $company, $station, $userType));
		$data['agoSevenLogs'] = $this->getLastSevenLogs("AGO",$from,$company,$station);
		$data['pmsSevenLogs'] = $this->getLastSevenLogs("PMS",$from,$company,$station);
		$data['dpkSevenLogs'] = $this->getLastSevenLogs("DPK",$from,$company,$station);
		
		$currVal = $this->base_model->getTankDay("01",'1',null,'2018-03-27');
		// var_dump($currVal);
		
		$data['currVal'] = $currVal;


		// $this->getTotalAGO();
		// var_dump($data);
		echo json_encode($data);


	}






	function getLastSevenLogs($prod,$date = null,$coy = null,$stat = null){

		// var_dump($this->getTotalAGO((new \DateTime())->format('Y-m-d')));
		// var_dump(date('Y-m-d', strtotime('-1 day', strtotime('2015-08-10'))));
		// var_dump(date('Y-m-d', strtotime('-1 day')));
		// var_dump(date('Y-m-d'));
		$arr = array();
		$count = 0;
		$time = $date;
		if($date == null){

			$time = date('Y-m-d');
		}
		// else{
		// 	$time = $date
		// }

		while($count<7){
			// var_dump($time);
			if($prod == "AGO"){
				array_push($arr,$this->getTotalAGO($time,$coy,$stat));
			}
			if($prod == "PMS"){
				array_push($arr,$this->getTotalPMS($time,$coy,$stat));
			}
			if($prod == "DPK"){
				array_push($arr,$this->getTotalDPK($time,$coy,$stat));
			}
			$count++;
			$time = date('Y-m-d', strtotime('-1 day', strtotime($time)));

		}

		// var_dump($arr);

		return $arr;

	}




	function getTotalAGO($date=null,$coy=null,$stat = null){
		
		$maxvol = 0;

		$tanks = $this->base_model->tankGet();

		if(isset($coy) && $coy != null && $coy != 0){
			
			$tanks = $this->base_model->tankGet(null,$coy);
		}
		
		if(isset($stat) && $stat != null && $stat != 0){
			
			$tanks = $this->base_model->tankGet(null,null,$stat);
		}
		
		foreach ($tanks as $tank) {
			
			// var_dump($tank['tank_name']);
			if($date == null){

				$curr = $this->getCurrVolumeByTank($tank,"DIE");
			}
			elseif($date !=null){
				$curr = $this->getCurrVolumeByTank($tank,"DIE",$date);

			}
		// var_dump($curr);

			$maxvol += $curr;
		
		}
		
		return $maxvol;
		
	}
	
	function getTotalPMS($date=null,$coy=null,$stat = null){
		
		$maxvol = 0;
		$tanks = $this->base_model->tankGet();
		
		if(isset($coy) && $coy != null && $coy != 0){
			
			$tanks = $this->base_model->tankGet(null,$coy);
		}

		if(isset($stat) && $stat != null && $stat != 0){
			
			$tanks = $this->base_model->tankGet(null,null,$stat);
		}
		
		foreach ($tanks as $tank) {
			
			// var_dump($tank);

			// $curr = $this->getCurrVolumeByTank($tank,"PET");
			if($date == null){

				$curr = $this->getCurrVolumeByTank($tank,"PET");
			}
			elseif($date !=null){
				$curr = $this->getCurrVolumeByTank($tank,"PET",$date);

			}

			$maxvol += $curr;
		
		}
		
		return $maxvol;
		
	}
	
	function getTotalDPK($date=null,$coy=null,$stat = null){
		
		$maxvol = 0;
		$tanks = $this->base_model->tankGet();

		if(isset($coy) && $coy != null && $coy != 0){
			
			$tanks = $this->base_model->tankGet(null,$coy);
		}

		if(isset($stat) && $stat != null && $stat != 0){
			
			$tanks = $this->base_model->tankGet(null,null,$stat);
		}
		
		foreach ($tanks as $tank) {
			
			// var_dump($tank);

			// $curr = $this->getCurrVolumeByTank($tank,"KER");
			if($date == null){

				$curr = $this->getCurrVolumeByTank($tank,"KER");
			}
			elseif($date !=null){
				$curr = $this->getCurrVolumeByTank($tank,"KER",$date);

			}

			$maxvol += $curr;
		
		}
		
		return $maxvol;
		
	}

	
	function getCurrVolumeByTank($tank,$prod,$date=null){

		$currVol = 0;

		if($date==null){

			$currVol = $this->base_model->getCurrentTankData($tank['tank_num'],$tank['device_id'],$prod);
			// var_dump($currVol);
			$currVol = (gettype($currVol) == "string") ? 0 : json_decode($currVol['log_decoded'],true)['fuelVol'];
		}
		else{
			$currVol = $this->base_model->getCurrentTankData($tank['tank_num'],$tank['device_id'],$prod,$date);
			// var_dump($currVol);
			$currVol = (gettype($currVol) == "string") ? 0 : json_decode($currVol['log_decoded'],true)['fuelVol'];
		}

		return $currVol;

	}


	function getTankLogs(){
		$num = $this->input->post('num',true);
		$devid = $this->input->post('devid',true);
		$from = $this->input->post('from',true);
		$to = $this->input->post('to',true);

		// var_dump($from);
		// var_dump($to);

		$currVol = $this->base_model->getTankLogs($num,$devid,null,null,$from,$to);
			$currVol = (gettype($currVol) == "string") ? [] : $currVol;

			echo json_encode($currVol);


	}





	function toggleApprove($cId = null){

		$method = $this->input->post('method',true);

		$result = null;

		if(($method == 1) || ($method == 0)){

			$result = $this->base_model->toggleApprove($cId,$method); 
		}


		$name = $this->getCompany($cId,true) ? $this->getCompany($cId,true)[0]['name'] : "Not Found";

		if($result){

			if(($method == 1) ){

				$logArr = array(
					'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
					'activity' =>"Approve Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
					'company' => $this->session->userdata('company'),
					'station' => $this->session->userdata('station'),
					'target_user' => $this->session->userdata('id'),

				);


			}
			if(($method == 0) ){

				$logArr = array(
					'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
					'activity' =>"Disapprove Company | ".$name." | ".$this->browser(). " | ".$this->platform(),
					'company' => $this->session->userdata('company'),
					'station' => $this->session->userdata('station'),
					'target_user' => $this->session->userdata('id'),

				);

				
			}
			$this->base_model->addActivityLog($logArr);
		}




		echo $result;
	}


	function deleteNotification($nId = null){

		$result = $this->base_model->deleteNotification($nId); 

		$name = $this->getNotification($nId,true) ? $this->getNotification($nId,true)[0]['activity'] : "Not Found";

		if($result){
			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Close Notification | ".$name." | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);

			$this->base_model->addActivityLog($logArr);

		}

		echo $result;
	}



	function getNotification($id = null, $within = null){

		// $id = $this->post->("num",true);
		// $id = $this->input->post('num',true);
		if($id == null){
			$id = $this->input->post('num',true);
		}

		if(!$within){
		echo json_encode($this->base_model->getNotification($id));
		}

		if($within){
		return $this->base_model->getNotification($id);
		}
	}


	
	function getNotifications(){

		// $result = $this->base_model->deleteNotification($nId); 
		$data = array();
		$data['notifications'] = $this->base_model->notificationGet();
		$data['notificationsCount'] = $this->base_model->notificationGet("yes");

		// echo $result;
		echo json_encode($data);

	}





	
	public function company()
	{
		// $this->load->view('company/dashboard');

		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				redirect('general');
				// $this->load->view('general/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				$this->load->view('company/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				redirect('station');
				// $this->load->view('station/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				redirect('general');
				// $this->load->view('general/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				$this->load->view('company/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				redirect('station');
				// $this->load->view('station/dashboard');

			}

	
		}
		else{
			redirect("logout");
		}
		
	}


	function generalCompany(){
				ini_set('memory_limit', '1024M');
				// ini_set('memory_limit', '254M');

		// if()
		$from = $this->input->post('from',true);
		$to = $this->input->post('to',true);
		$userType = $this->input->post('userType',true);
		$station = $this->input->post('station',true);
		$location = $this->input->post('location',true);

		$coy = $this->session->userdata('company');
		$coyName = (count($this->base_model->getCompany($coy))>0) ? $this->base_model->getCompany($coy)[0]["name"] : null;

		$stations = $this->base_model->stationGet(null,$coy,$station,$location);
		$reorderFreq = [];
		$salesFreq = [];
		foreach ($stations as $key=>$stat) {
		
			$name = $stat['name'];
			$id = $stat['station_id'];
			$loc = $stat['location'];

			$tanks = $this->base_model->tankGet(null,null,$id);

			$reorders = [];
			foreach ($tanks as $key=>$tank) {
				$grbt = $this->getReordersByTank($tank);
				// var_dump($grbt);
				if($grbt == null || count($grbt)<1){
					continue;
				}
				$reorders = array_merge($reorders,$grbt);

			
			}


			$sales = [];
			foreach ($tanks as $key=>$tank) {
				$grbt = $this->getSalesByTank($tank);
				// var_dump($grbt);
				if($grbt == null || count($grbt)<1){
					continue;
				}
				$sales = array_merge($sales,$grbt);

			
			}

			array_push($reorderFreq,array($name,$loc,count($reorders),$reorders));
			array_push($salesFreq,array($name,$loc,count($sales),$sales));



		}		
		


// var_dump($coyName);
		$data = array();

		$data['reorders'] = $reorderFreq;
		$data['sales'] = $salesFreq;

		// $data['companies'] = $this->base_model->companyGet();
		$data['stations'] = $this->base_model->stationGet(null,$coy,$station,$location);
		$data['stationsSel'] = $this->base_model->stationGet(null,$coy,null,null);
		// $data['companyCount'] = count($this->base_model->companyGet());
		// $data['inactiveCompanyCount'] = count($this->base_model->companyGet("yes"));
		$data['stationCount'] = count($this->base_model->stationGet(null,$coy,$station,$location));
		$data['inactiveStationCount'] = count($this->base_model->stationGet("yes",$coy,$station,$location));
		$data['userCount'] = count($this->base_model->userGet(null,null,null,$coy,$station,$userType));
		$data['inactiveUserCount'] = count($this->base_model->userGet("yes",null,null,$coy,$station,$userType));
		$data['userTypes'] = $this->base_model->userGet(null,"yes",null,$coy,$station,$userType);
		$data['userTypesSel'] = $this->base_model->userGet(null,"yes",null,$coy,null,null);
		$data['userOnline'] = count($this->base_model->userGet(null,null, "yes",$coy,$station,$userType));
		$data['userOffline'] = count($this->base_model->userGet(null,null, "no",$coy,$station,$userType));
		$data['deviceCount'] = count($this->base_model->deviceGet(null,$coy,$station));
		$data['inactiveDeviceCount'] = count($this->base_model->deviceGet("yes",$coy,$station));
		$data['inactiveDevices'] = $this->base_model->deviceGet("yes",$coy,$station);
		$data['tankCount'] = count($this->base_model->tankGet(null,$coy,$station));
		$data['inactiveTankCount'] = count($this->base_model->tankGet("yes",$coy,$station));
		$data['locations'] = $this->base_model->locationGet($coy,$station,$location);
		$data['locationsSel'] = $this->base_model->locationGet($coy,null,null);
		$data['notificationsCount'] = $this->base_model->notificationGet("yes",$coyName);
		$data['notifications'] = $this->base_model->notificationGet(null,$coyName);



		$data['AGOvol'] = $this->getTotalAGO($from,$coy,$station);
		$data['PMSvol'] = $this->getTotalPMS($from,$coy,$station);
		$data['DPKvol'] = $this->getTotalDPK($from,$coy,$station);
		// $data['pendingApprovals'] = $this->base_model->companyGet(null,'yes');
		
		$data['recentLogs'] = $this->base_model->actLogGet($coy,$station,$from,$to,$userType);
		$data['mostActiveUsers'] = $this->base_model->mostActiveGet($coy,$station,$from,$to,$userType);
		
		$data['agoSevenLogs'] = $this->getLastSevenLogs("AGO",$from,$coy,$station);
		$data['pmsSevenLogs'] = $this->getLastSevenLogs("PMS",$from,$coy,$station);
		$data['dpkSevenLogs'] = $this->getLastSevenLogs("DPK",$from,$coy,$station);



		// $this->getTotalAGO();
		// var_dump($data);
		echo json_encode($data);


	}

	function getcoyNotifications(){
		$coy = $this->session->userdata('company');

		$coyName = (count($this->base_model->getCompany($coy))>0) ? $this->base_model->getCompany($coy)[0]["name"] : null;

		// $result = $this->base_model->deleteNotification($nId); 
		$data = array();
		$data['notifications'] = $this->base_model->notificationGet(null,$coyName);
		$data['notificationsCount'] = $this->base_model->notificationGet("yes",$coyName);

		// echo $result;
		echo json_encode($data);

	}







	public function station()
	{
		// $this->load->view('station/dashboard');

		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				redirect('general');
				// $this->load->view('general/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				redirect('company');
				// $this->load->view('company/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				$this->load->view('station/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				redirect('general');
				// $this->load->view('general/dashboard');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				redirect('company');
				// $this->load->view('company/dashboard');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				$this->load->view('station/dashboard');

			}

	
		}
		else{
			redirect("logout");
		}
	}





	function getSalesByTank($tank = null){

		$tankLogs = $this->base_model->getTankDay("01",'1');

		$tankLogs = $this->base_model->getTankDay($tank['tank_num'],$tank['device_id']);

		if($tankLogs == "2" || $tankLogs == "7"){
			return null;
		}
		$sale = [];
		
		foreach ($tankLogs as $key=>$log) {
			if ($key ==0){
				continue;
			}
			$dec = $log['log_decoded'];
			$dec = json_decode($dec,true);
			$vol = $dec['fuelVol'];
			if($vol<1){
				continue;
			}
			$pdec = $tankLogs[$key-1]['log_decoded'];
			$pdec = json_decode($pdec,true);
			$pvol = $pdec['fuelVol'];
			// var_dump($dec['fuelVol']);
			if(($pvol-$vol) > 1){
				array_push($sale,$log);
				// var_dump($log);
				// echo "<br/>" ;
				// echo "<br/>" ;
				// echo "<br/>" ;

			}
		}


		// print_r($reorder);


		return $sale;

		
	}



	function getReordersByTank($tank = null){

		$tankLogs = $this->base_model->getTankDay("01",'1');

		$tankLogs = $this->base_model->getTankDay($tank['tank_num'],$tank['device_id']);

		if($tankLogs == "2" || $tankLogs == "7"){
			return null;
		}
		$reorder = [];
		
		foreach ($tankLogs as $key=>$log) {
			if ($key ==0){
				continue;
			}
			$dec = $log['log_decoded'];
			$dec = json_decode($dec,true);
			$vol = $dec['fuelVol'];
			if($vol<1){
				continue;
			}
			$pdec = $tankLogs[$key-1]['log_decoded'];
			$pdec = json_decode($pdec,true);
			$pvol = $pdec['fuelVol'];
			// var_dump($dec['fuelVol']);
			if(($vol-$pvol) > 100){
				array_push($reorder,$log);
				// var_dump($log);
				// echo "<br/>" ;
				// echo "<br/>" ;
				// echo "<br/>" ;

			}
		}


		// print_r($reorder);


		return $reorder;

		
	}




	function generalStation(){
				ini_set('memory_limit', '1024M');
				// ini_set('memory_limit', '254M');

		// if()
		$from = $this->input->post('from',true);
		$to = $this->input->post('to',true);
		$userType = $this->input->post('userType',true);
		

		$stat = $this->session->userdata('station');
		$statName = (count($this->base_model->getStation($stat))>0) ? $this->base_model->getStation($stat)[0]["name"] : null;
		
		$tanks = $this->base_model->tankGet(null,null,$stat);
		$reorders = [];
		foreach ($tanks as $key=>$tank) {
			$grbt = $this->getReordersByTank($tank);
			// var_dump($grbt);
			if($grbt == null || count($grbt)<1){
				continue;
			}
			$reorders = array_merge($reorders,$grbt);

		
		}

		$sales = [];
		foreach ($tanks as $key=>$tank) {
			$grbt = $this->getSalesByTank($tank);
			// var_dump($grbt);
			if($grbt == null || count($grbt)<1){
				continue;
			}
			$sales = array_merge($sales,$grbt);

		
		}



		$data = array();

		// $currVal = $this->base_model->getTankDay("01",'1',null,'2018-03-27');
		// var_dump($currVal);
		
		$data['reorders'] = $reorders;
		$data['sales'] = $sales;


		
		
		$data['userCount'] = count($this->base_model->userGet(null,null,null,null,$stat,$userType));
		$data['inactiveUserCount'] = count($this->base_model->userGet("yes",null,null,null,$stat,$userType));
		$data['userTypes'] = $this->base_model->userGet(null,"yes",null,null,$stat,$userType);
		$data['userTypesSel'] = $this->base_model->userGet(null,"yes",null,null,$stat,null);
		$data['userOnline'] = count($this->base_model->userGet(null,null, "yes",null,$stat,$userType));
		$data['userOffline'] = count($this->base_model->userGet(null,null, "no",null,$stat,$userType));
		$data['deviceCount'] = count($this->base_model->deviceGet(null,null,$stat));
		$data['inactiveDeviceCount'] = count($this->base_model->deviceGet("yes",null,$stat));
		$data['inactiveDevices'] = $this->base_model->deviceGet("yes",null,$stat);
		$data['tankCount'] = count($this->base_model->tankGet(null,null,$stat));
		$data['inactiveTankCount'] = count($this->base_model->tankGet("yes",null,$stat));
		$data['inactiveTanks'] = $this->base_model->tankGet("yes",null,$stat);
		
		// $data['locations'] = $this->base_model->locationGet(null,$stat);
		$data['notificationsCount'] = $this->base_model->notificationGet("yes",null,$statName);
		$data['notifications'] = $this->base_model->notificationGet(null,null,$statName);



		$data['AGOvol'] = $this->getTotalAGO($from,null,$stat);
		$data['PMSvol'] = $this->getTotalPMS($from,null,$stat);
		$data['DPKvol'] = $this->getTotalDPK($from,null,$stat);
		// $data['pendingApprovals'] = $this->base_model->companyGet(null,'yes');
		
		$data['recentLogs'] = $this->base_model->actLogGet(null,$stat,$from,$to,$userType);
		$data['mostActiveUsers'] = $this->base_model->mostActiveGet(null,$stat,$from,$to,$userType);
		
		// $data['agoSevenLogs'] = $this->getLastSevenLogs("AGO");
		// $data['pmsSevenLogs'] = $this->getLastSevenLogs("PMS");
		// $data['dpkSevenLogs'] = $this->getLastSevenLogs("DPK");
		$data['agoSevenLogs'] = $this->getLastSevenLogs("AGO",$from,null,$stat);
		$data['pmsSevenLogs'] = $this->getLastSevenLogs("PMS",$from,null,$stat);
		$data['dpkSevenLogs'] = $this->getLastSevenLogs("DPK",$from,null,$stat);



		// $this->getTotalAGO();
		// var_dump($data);
		echo json_encode($data);


	}



	function getstatNotifications(){
		$stat = $this->session->userdata('station');

		$statName = (count($this->base_model->getStation($stat))>0) ? $this->base_model->getStation($stat)[0]["name"] : null;

		// $result = $this->base_model->deleteNotification($nId); 
		$data = array();
		$data['notifications'] = $this->base_model->notificationGet(null,null,$statName);
		$data['notificationsCount'] = $this->base_model->notificationGet("yes",null,$statName);

		// echo $result;
		echo json_encode($data);

	}
	
	
	
	function gettankNotifications(){
		// $stat = $this->session->userdata('station');
		$num = $this->input->post('num',true);
		$cont = $this->input->post('cont',true);

	// var_dump($num);
	// var_dump($cont);

// $statName = (count($this->base_model->getStation($stat))>0) ? $this->base_model->getStation($stat)[0]["name"] : null;
		$devId = (count($this->base_model->getController($cont)) ==1) ? $this->base_model->getController($cont)[0]['contId'] : 0;

		// $result = $this->base_model->deleteNotification($nId); 
		$data = array();
		$data = $this->base_model->tanknotificationGet($num,$devId);
		// $data['notifications'] = $this->base_model->notificationGet(null,null,$statName);
		// $data['notificationsCount'] = $this->base_model->notificationGet("yes",null,$statName);

		// echo $result;
		echo json_encode($data);

	}


	function tankLogDays($num,$cont){
		$devId = (count($this->base_model->getController($cont)) ==1) ? $this->base_model->getController($cont)[0]['contId'] : 0;

		$res = $this->base_model->tankLogDays($num,$devId);
		// var_dump($res);
		
		$days = array_column($res, 'dt');
		// var_dump($days);

		return $ret = is_array($days) ? $days : []; 
	}


	function dailyAvgs(){
		$num = $this->input->post('num',true);
		$cont = $this->input->post('cont',true);
		$num = ($num) ? $num : "01";
		$cont = ($cont) ? $cont : "1";
		// var_dump($num);

		$devId = (count($this->base_model->getController($cont)) ==1) ? $this->base_model->getController($cont)[0]['contId'] : 0;


		$days = $this->tankLogDays($num,$cont);
		// var_dump($days);
		
		$finAvg = 0;
		$allDailyAvgs = [];
		foreach($days as $val)
		{ 
			$currVol = $this->base_model->getTankLogs($num,$devId,100,$val);
			$currVol = (gettype($currVol) == "string") ? [] : $currVol;
			$sAllDailyAvgs = [];

			foreach($currVol as $k=>$sval)
			{ 
				if($k == 0){
					continue;
				}

				$dayVol = json_decode($sval['log_decoded'],true)["fuelVol"];
				$ydayVol = json_decode($currVol[$k-1]['log_decoded'],true)["fuelVol"];
				// var_dump($ydayVol);
				// var_dump($k);

				$diff = $dayVol - $ydayVol;
				$diff = ($diff > - 1) ? $diff : 0; 
				
				array_push($sAllDailyAvgs,$diff);
				// var_dump(json_decode($sval['log_decoded'],true));
				// var_dump($sval['log_decoded']);

				
			}
			// echo "<br/><br/>";
			
			
			$sAllDailyAvgs = array_filter($sAllDailyAvgs);
			if(count($sAllDailyAvgs)) {
				// var_dump($sAllDailyAvgs);
				
				$average = array_sum($sAllDailyAvgs)/count($sAllDailyAvgs);
				// echo "<br/>";
				array_push($allDailyAvgs,$average);

			}
			else{
				array_push($allDailyAvgs,0);

			}
			
		}
		// var_dump($allDailyAvgs);

		$allDailyAvgs = array_filter($allDailyAvgs);
		if(count($allDailyAvgs)) {
			 $finAvg = array_sum($allDailyAvgs)/count($allDailyAvgs);
			// array_push($AllDailyAvgs,$average);

		}
		else{
			$finAvg = 0;
		}


		echo is_numeric($finAvg) ? $finAvg : 0;

	}





// ================================backend ops=================================================

public function getStationThresholds(){
	$oldStationList = $this->base_model->getStations();
	$newStationList = array();

	foreach ($oldStationList as $item) {
	$res = $this->base_model->getTanksSummary($item["station_id"]);
	$pms = 0;
	$ago = 0;
	$dpk = 0;

		if(json_decode($res) && $res!= 2){
			// $item["numberOfTanks"] = count(json_decode($res));

			// var_dump(json_decode($res));
				
		foreach (json_decode($res) as $tank) {
			$currentTankData = $this->base_model->getCurrentData($tank->tank_id);
			
			if(count($currentTankData)){
				
				// var_dump($currentTankData->log_decoded);
				$currentTankLog = json_decode($currentTankData->log_decoded, true);
				

				if ($currentTankLog["fuelType"] == "PET"){
					$pms += (int)$currentTankLog["fuelVol"];
				}
				else if ($currentTankLog["fuelType"] == "DIE"){
					$ago += (int)$currentTankLog["fuelVol"];
				}
				else if ($currentTankLog["fuelType"] == "KER"){
					$dpk += (int)$currentTankLog["fuelVol"];
				}
				
				// var_dump("<br/><br/><br/><br/><br/><br/><br/>");
			}

			
		}		

		$item["totalPMSVolume"] = $pms;
		$item["totalAGOVolume"] = $ago;
		$item["totalDPKVolume"] = $dpk;


		var_dump($item["dpk_threshold"]);
				var_dump("<br/><br/><br/><br/><br/><br/><br/>");
				$toEmail = $this->base_model->getCompanyEmailByStation($item["station_id"],"preAlarm");

		if ($dpk <= $item["dpk_threshold"] ){


			if ($toEmail){
				$this->base_model->addNotification("DPK Is Due For a Refill at Station ".$item["name"],$item["company"],$item["name"],"","","Station Threshold","High");
				
				echo $this->sendMail($toEmail,"DPK Is Due For a Refill", "Station ".$item["name"]." has reached its threshold for DPK and is due for a refill");
				
			}
			
		}
		
		if ($ago <= $item["ago_threshold"] ){
			
			
			if ($toEmail){
				$this->base_model->addNotification("AGO Is Due For a Refill at Station ".$item["name"],$item["company"],$item["name"],"","","Station Threshold","High");
				
				echo $this->sendMail($toEmail,"AGO Is Due For a Refill", "Station ".$item["name"]." has reached its threshold for AGO and is due for a refill");
				
			}
			
		}
		
		if ($ago <= $item["pms_threshold"] ){
			
			
			if ($toEmail){
				$this->base_model->addNotification("PMS Is Due For a Refill at Station ".$item["name"],$item["company"],$item["name"],"","","Station Threshold","High");
				
				echo $this->sendMail($toEmail,"PMS Is Due For a Refill", "Station ".$item["name"]." has reached its threshold for PMS and is due for a refill");
				
			}

		}
		





			
			// var_dump("<br/><br/><br/><br/><br/><br/><br/>");
			
		}
		else{
			// $item["numberOfTanks"] = 0;
			$item["totalPMSVolume"] = 0;
			$item["totalAGOVolume"] = 0;
			$item["totalDPKVolume"] = 0;
			
		}
		
		array_push($newStationList,$item);

	}

	// var_dump($newStationList);

}





public function getRawLogs(){

	$result = $this->base_model->getRawLogs();

	// print_r($result);
	// print_r($result[0]["uID"]);

	foreach ($result as $row)
	{
		$this->getLogs($row);
			// echo $row->Data."<br/>";
	}


	$this->getStationThresholds();
	

} 



public function toJson($arr){
	echo json_encode($arr)."<br/><br/><br/>";
	echo $arr["uID"]."<br/><br/>";
	echo "stoJson"."<br/><br/>";
   $jsonArray = json_encode($arr);

   $log = array();
   
   
   // echo Hex2String(substr($rawData,4,8)) . " station code<br>";
   
   $log['log_decoded'] = $jsonArray;
   // $log['id'] = $arr["uID"];
   $log['timestamp'] = $arr["timestamp"];
   $log['log_raw'] = $arr["raw"];
   $log['device_id'] = $arr["stationCode"];

   $result = $this->base_model->addDecodedLog($log);
//    $fID = $result;
   $fID = $arr["uID"];

// echo $fID ."<br/><br/>";
   
   if ($result){
	   
	   $deleteResult = $this->base_model->deleteRawLog($fID);
	   
	   if ($deleteResult){
		   
		   print_r($log)."<br/>";
	   }
	   
   }
   
   
   // $log['json'] = $jsonArray;
}





public function getLogs($Data){
		
	// $rawData = "013235353539303130504554343438343139393934363844313436363434453434363636343646444146363634363631333630303030303030303030303030303030303030303030303030303030303030303030323404";
	$rawData = $Data->Data;
	$uID = $Data->uID;
	$ts = $Data->Timestamp;

	echo $rawData. '<br>';
	
	echo  strlen($rawData) .'<br>';
	echo "==================================================================================================.<br>";
	// echo substr($rawData,24,8). '<br>';
	$funcCode = "";
	if (isset($rawData) && $rawData != null && $rawData != ""){
	$startBytes = $rawData[0].$rawData[1];
	$endBytes = substr($rawData,-2);
	// echo $endBytes ."<br>";
	
	$funcCode = $rawData[2].$rawData[3];
}
else{
echo "stream data is null or empty";
}
	echo $funcCode;
	echo "<br>";
	
	
	if (strlen($rawData) != 174 || $startBytes != '01' || $endBytes != '04'){
		return "invalid stream data";
		// return;
	}
	
	if ($funcCode == '31'){
	
		$this->inventoryLog($rawData, $uID, $ts);
	}
	
	elseif ($funcCode == '32'){
		$this->unloadingLog($rawData, $uID, $ts);
		// echo "func 32 loading";
	}
	
	elseif ($funcCode == '33'){
		$this->alarmLog($rawData, $uID, $ts);
		// echo "func 33 alarm";
	}

}






public function Hex2String($hex){
	$string='';
	for ($i=0; $i < strlen($hex)-1; $i+=2){
		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		// $string .= chr($hex[$i].$hex[$i+1]);
	}
	return $string;
}




public function toDec($binary){
	$res =0;
	$strlen = strlen( $binary );
	$frac = -1;
	for( $i = 0; $i <= $strlen; $i++ ) {
		$char = substr( $binary, $i, 1 );
		$newVal = $char * pow(2, $frac);
		$res += $newVal;
	   
		$frac--;
		// $char contains the current character, so do your processing here
	}

	return $res;
}





public function getNumericVal($rawHexa){

	// $float = decbin(hexdec(Hex2String("3432353133333332")));
	$float = decbin(hexdec($this->Hex2String($rawHexa)));
	return $this->decodebin($float);
}




public function inventoryLog($rawData, $uID , $ts){

	$retVal = array();
	
	
	// echo Hex2String(substr($rawData,4,8)) . " station code<br>";
	
	$retval['funcCode'] = "Inventory";
	
	$retval['uID'] = $uID;
	$retval['timestamp'] = $ts;
	
	
	$retval['raw'] = $rawData;

	$retval['stationCode'] = $this->Hex2String(substr($rawData,4,8));	
	
	// echo Hex2String(substr($rawData,12,4)) . " tank number<br>";
	
	$retval['tankNum'] = $this->Hex2String(substr($rawData,12,4));
	
	// echo $rawData[18].$rawData[19] .'<br>';

	
	
	// echo Hex2String(substr($rawData,18,6)) . " fuel type <br>";
	
	$retval['fuelType'] = $this->Hex2String(substr($rawData,18,6));
	
	
	// echo getNumericVal(substr($rawData,24,16)) . " fuel level <br>";
	
	$retval['fuelLevel'] = $this->getNumericVal(substr($rawData,24,16));
	
	
	// echo getNumericVal(substr($rawData,40,16)) . " water level <br>";
	
	$retval['waterLevel'] = $this->getNumericVal(substr($rawData,40,16));
	
	
	// echo getNumericVal(substr($rawData,56,16)) . " temperature <br>";
	
	$retval['temp'] = $this->getNumericVal(substr($rawData,56,16));
	
	
	// echo getNumericVal(substr($rawData,72,16)) . " fuel volume <br>";
	
	$retval['fuelVol'] = $this->base_model->getCalFuelVol($retval['stationCode'],$retval['tankNum'],$retval['fuelLevel']);

	// print_r($retval['fuelVol']);
	// print_r("new");

	$retval['probeFuelVol'] = $this->getNumericVal(substr($rawData,72,16));
	
	
	// echo getNumericVal(substr($rawData,88,16)) . " water volume <br>";
	
	$retval['waterVol'] = $this->base_model->getCalFuelVol($retval['stationCode'],$retval['tankNum'],$retval['waterLevel']);
	$retval['probeWaterVol'] = $this->getNumericVal(substr($rawData,88,16));
	

	// =======================================================================================
	$threshold = $this->getTankThreshold($retval['tankNum'],$retval['stationCode']);
	
	$reorder = $this->getTankReorder($retval['tankNum'],$retval['stationCode']);

	if ($retval['fuelVol'] <= $threshold){
		//send threshold alarm email and add to notifications
	$toEmail = $this->base_model->getCompanyEmailByController($retval['stationCode'],"threshold");


	$tankName = "";
	$tankNum = $retval['tankNum'] ? $retval['tankNum'] : 0;
	

	$controller = $retval['stationCode'];

	$message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
	
	$coy = $this->base_model->getCompanyByController($controller);
	
	$station = $this->base_model->getStationByController($controller);

	$type = "Threshold";

	$severity = "High";
	
	$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);


	
	echo $this->sendMail($toEmail, "Threshold Level", "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold");
	
	}

	if ($retval['fuelVol'] <= $reorder){
		//send reorder alarm email and add to notifications
	$toEmail = $this->base_model->getCompanyEmailByController($retval['stationCode'],"reorder");

	$tankName = "";
	
	$controller = $retval['stationCode'];

	$message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Re-order Level";
	
	$coy = $this->base_model->getCompanyByController($controller);
	
	$station = $this->base_model->getStationByController($controller);

	$type = "Reorder";

	$severity = "High";
	
	$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);

	echo $this->sendMail($toEmail, "Re-order Level", "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Re-order Level");
	
	
	}

	echo "toemeil <br/>";
	$toEmail = $this->base_model->getCompanyEmailByController($retval['stationCode'],"preAlarm");
	
	print_r($toEmail);
	
	$controller = $retval['stationCode'];

	$devId = (count($this->getControllerbyContId($controller)) ==1) ? $this->getControllerbyContId($controller)[0]['Source_id'] : 0;

	$currVol = $this->base_model->getCurrentTankData($retval['tankNum'],$devId);

	$currVol = (gettype($currVol) == "string") ? 0 : json_decode($currVol['log_decoded'],true)['fuelVol'];

	$newVol = $retval['fuelVol'];

	if($currVol > $newVol ){

		echo "theft detection";
		$diff = $currVol - $newVol;
		if($diff > 500){

			$tankName = "";

			$message = "There Appers to be an issue on Tank ".$retval['tankNum']." on Controller ".$retval['stationCode'].". Please check it out for discrepancies";
			
			$coy = $this->base_model->getCompanyByController($controller);
			
			$station = $this->base_model->getStationByController($controller);

			$type = "Reorder";

			$severity = "High";
			
			$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);


			$toEmail = $this->base_model->getCompanyEmailByController($retval['stationCode'],"alarmStart");

			echo $this->sendMail($toEmail, "Theft Detection", "There Appers to be an issue on Tank ".$retval['tankNum']." on Controller ".$retval['stationCode'].". Please check it out for discrepancies");

		}

	}


	// =======================================================================================
	
	// echo getNumericVal(substr($rawData,104,16)) . " Ullage volume <br>";
	
	$retval['ullageVol'] = $this->getNumericVal(substr($rawData,104,16));
	
	
	// echo getNumericVal(substr($rawData,120,16)) . " tank height <br>";
	
	$retval['tankHeight'] = $this->getNumericVal(substr($rawData,120,16));
	
	
	// echo substr($rawData,-2) .' end bytes<br>';
	
	
	// print_r($retval);
	$this->toJson($retval);
	
	// echo "<br>";
	
	// echo json_encode($retVal);
	// echo $retVal[''];
	
	}




	function getTankThreshold($tank,$controller){


		$res = $this->base_model->getTankThreshold($tank,$controller);

		return $res;

	}
	
	
	function getTankReorder($tank,$controller){


		$res = $this->base_model->getTankReorder($tank,$controller);

		return $res;

	}



	public function getAlarmType($code){
		$ret = '';
		// echo $code;
		switch ($code) {
			case "31":
				$ret = "Oil high pre-alarm";
				break;
			case "32":
				$ret = "Oil high alarm";
				break;
			case "33":
				$ret = "Oil low pre-alarm";
				break;
			case "34":
				$ret = "Oil low alarm";
				break;
			case "35":
				$ret = "Water high alarm";
				break;
			case "36":
				$ret = "Communication fault";
				break;
			default:
				$ret = "Something went wrong";
		}
	
	
		return $ret;
	}







	public function alarmLog($rawData ,$uID, $ts){
		$retVal = array();
		
		
		// echo Hex2String(substr($rawData,4,8)) . " station code<br>";
	
	$retval['funcCode'] = "Alarm";
	
	$retval['uID'] = $uID;
	
	$retval['raw'] = $rawData;
	
	$retval['timestamp'] = $ts;
	

		$retval['stationCode'] = $this->Hex2String(substr($rawData,4,8));
		
		
		// echo Hex2String(substr($rawData,12,4)) . " tank number<br>";
		
		$retval['tankNum'] = $this->Hex2String(substr($rawData,12,4));
		
		// echo $rawData[18].$rawData[19] .'<br>';
	
		
		$retval['fuelType'] = $this->Hex2String(substr($rawData,18,6));
		
		
		// echo getNumericVal(substr($rawData,24,16)) . " fuel level <br>";
		
		$retval['alarmGenEnd'] = $this->getNumericVal(substr($rawData,24,2)) == "31" ? "Alarm Generation":"Alarm End";
		
		
		// echo getNumericVal(substr($rawData,40,16)) . " water level <br>";
		
		$retval['alarmType'] = $this->getAlarmType(substr($rawData,26,2));

		// $roles = $this->getRoles();

		// $roles->email;
		$tankNum = $retval['tankNum'];
		
		$stationCode = $retval['stationCode'];

		// $toEmail = "email by company";
		
		$alarmType = $retval['alarmType'];
		
		// $pos = strpos($alarmType, "pre-alarm");
		$pos = strpos($alarmType, "re-alarm");
		
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"preAlarm");

		// if((is_numeric(array_search("receivePreAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Pre-Alarm' On tank ".$tankNum." on controller ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";
				
				$controller = $stationCode;
		
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Pre-Alarm";
		
				$severity = "Medium";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);



				$this->sendMail($toEmail, 'Pre-Alarm', $message);
			}
		// }
		
		$pos = strpos($alarmType, "ow alarm");
		
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"alarmStart");
		

		// if((is_numeric(array_search("receiveStartAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Oil Low' Alarm On tank ".$tankNum." at station ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";
				
				$controller = $stationCode;
		
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Oil Low";
		
				$severity = "High";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);
				
			$this->sendMail($toEmail, 'Oil Low', $message);
			}
		// }
		
		$pos = strpos($alarmType, "igh alarm");
		
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"alarmStart");
		
		// if((is_numeric(array_search("receiveStartAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Oil High' Alarm On tank ".$tankNum." at station ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";
				
				$controller = $stationCode;
		
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Oil High";
		
				$severity = "High";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);
				
			$this->sendMail($toEmail, 'Oil High', $message);
			}
			// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
		// }
		
		
		$pos = strpos($alarmType, "ater high");
		
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"alarmStart");
		
		// if((is_numeric(array_search("receiveStartAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Water High' Alarm On tank ".$tankNum." at station ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";
				
				$controller = $stationCode;
				
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Water High";
		
				$severity = "High";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);
				
			$this->sendMail($toEmail, 'Water High', $message);
			}

			// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
		// }
		

		$pos = strpos($alarmType, "ommunication fault");
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"alarmStart");
		

		// if((is_numeric(array_search("receiveStartAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Communication fault' Alarm On tank ".$tankNum." at station ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";
				

				$controller = $stationCode;
				
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Communication fault";
		
				$severity = "High";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);

				
			$this->sendMail($toEmail, 'Communication fault', $message);
			}
			// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
		// }
		
		
		
		$pos = strpos($alarmType, "Something went wrong");
		$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"alarmStart");
		

		// if((is_numeric(array_search("receiveStartAlarmEmail",$roles->email))) && ($pos))
		// {
			// redirect('dashboard');
			$message = "There has been a 'Something went wrong' Alarm On tank ".$tankNum." at station ".$stationCode.".";
			if($toEmail != null && ($pos)){

				$tankName = "";

				$controller = $stationCode;
				
				// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
				
				$coy = $this->base_model->getCompanyByController($controller);
				
				$station = $this->base_model->getStationByController($controller);
		
				$type = "Something went wrong";
		
				$severity = "Medium";
				
				$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);

				
			$this->sendMail($toEmail, 'Something went wrong', $message);
			}
			// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
		// }


		
		
		// print_r($retval);
	$this->toJson($retval);
	
		// echo "<br>";
	
		// echo substr($rawData,26,2) ."<br>";
		// echo $rawData ."<br>";
		
		// echo json_encode($retVal);
		// echo $retVal[''];
		
		}





		public function unloadingLog($rawData ,$uID, $ts){
			$retVal = array();
			
			
			// echo Hex2String(substr($rawData,4,8)) . " station code<br>";
			
			$retval['funcCode'] = "Receipt";

		$retval['uID'] = $uID;
		
		$retval['raw'] = $rawData;

		$retval['timestamp'] = $ts;
		
		
			$retval['stationCode'] = $this->Hex2String(substr($rawData,4,8));
			
			
			// echo Hex2String(substr($rawData,12,4)) . " tank number<br>";
			
			$retval['tankNum'] = $this->Hex2String(substr($rawData,12,4));
			
			// echo $rawData[18].$rawData[19] .'<br>';
		
			
			$retval['fuelType'] = $this->Hex2String(substr($rawData,18,6));
		
			// echo substr($rawData,24,16) ."<br>";
			
			
			// echo getNumericVal(substr($rawData,24,16)) . " fuel level <br>";
			
			$retval['startFuelLevel'] = $this->getNumericVal(substr($rawData,24,16));
			
			// $retval['startFuelVol'] = $this->getNumericVal(substr($rawData,40,16));
			$retval['startFuelVol'] = $this->base_model->getCalFuelVol($retval['stationCode'],$retval['tankNum'],$retval['startFuelLevel']);
		
			$retval['probeStartFuelVol'] = $this->getNumericVal(substr($rawData,40,16));
		   
			$retval['endFuelLevel'] = $this->getNumericVal(substr($rawData,56,16));
			
			// $retval['endFuelVol'] = $this->getNumericVal(substr($rawData,72,16));
			$retval['endFuelVol'] = $this->base_model->getCalFuelVol($retval['stationCode'],$retval['tankNum'],$retval['endFuelLevel']);
			
			$retval['probeEndFuelVol'] = $this->getNumericVal(substr($rawData,72,16));
			
			$retval['unloadingVol'] = $this->getNumericVal(substr($rawData,88,16));
		
			// echo substr($rawData,88,16);
			if ($retval['startFuelVol'] > $retval['endFuelVol']){
			$retval['funcCode'] = "Dispense";
			
			}



			// $roles = $this->getRoles();
			
			// $roles->email;
			$tankNum = $retval['tankNum'];
			
			$stationCode = $retval['stationCode'];

			$funcCode = $retval['funcCode'];

			$pos = strpos($funcCode, "ispense");

			$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"unloading");
			

			// if((is_numeric(array_search("receiveUnloadingEmail",$roles->email))) && ($pos))
			// {
				// redirect('dashboard');
				$message = "There has been a 'Dispense' On tank ".$tankNum." at station ".$stationCode.".";
				if($toEmail != null && ($pos)){

					$tankName = "";
					
					$controller = $stationCode;
			
					// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
					
					$coy = $this->base_model->getCompanyByController($controller);
					
					$station = $this->base_model->getStationByController($controller);
			
					$type = "Dispense";
			
					$severity = "Medium";
					
					$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);
					
				$this->sendMail($toEmail, 'Dispense', $message);
				}
				// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
			// }
			
			
			$pos = strpos($funcCode, "eceipt");
			$toEmail = $this->base_model->getCompanyEmailByController($stationCode,"unloading");
			
			echo ($pos);
			
			// if((is_numeric(array_search("receiveUnloadingEmail",$roles->email))) && ($pos))
			// {
				// redirect('dashboard');
				$message = "There has been a 'Receipt' On tank ".$tankNum." at station ".$stationCode.".";
				if($toEmail != null && ($pos)){

echo "add notification <br/>";
					
					$tankName = "";
					
					$controller = $stationCode;
			
					// $message = "Tank ".$retval['tankNum']." on Controller ".$retval['stationCode']." has hit the defined Threshold";
					
					$coy = $this->base_model->getCompanyByController($controller);
					
					$station = $this->base_model->getStationByController($controller);
			
					$type = "Receipt";
			
					$severity = "Medium";
					
				echo	$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);

echo "<br/>add notification<br/>";

					
				$this->sendMail($toEmail, 'Receipt', $message);
				}
				// $this->sendMail($toEmail, 'atg@sahara-group.com', $message);
			// }

			
			// print_r($retval);
			$this->toJson($retval);
			
			// echo "<br>";
			
			// echo json_encode($retVal);
			// echo $retVal[''];
			
			}





			public function decodebin($float){
				
				if(strlen($float)<32)
					 {
			   $float = "0".$float;
					 }
			   
			   // echo $float."<br>";
			   
				$sign = substr($float,0,1);
				$exponent= substr($float,1,8);
				$mantissa=substr($float,9);
			   
				$exponent = bindec($exponent) -127;
				
				$mantissa_one = substr($mantissa,0,$exponent);
				$mantissa_two = substr($mantissa,$exponent);
				
				$mantissa_one = bindec("1".$mantissa_one);
				$mantissa_two = $this->toDec($mantissa_two);
			   //  echo toDec($mantissa_two) ."<br>";
			   //  echo $mantissa_two ."<br>";
			   // return;
				$val = $mantissa_one + $mantissa_two;
			   
				if($sign=="1")
					{
			   $val = $val * -1;
					}
				
			   //  echo $val;
				return $val;
				   } 





// =======================Small Atg=====================================
function synch(){
	ini_set('max_execution_time', 0); 
	$res = $this->base_model->synchGet();

	foreach($res as $id=>$val){

		echo "<br/>";
		echo "<br/>";
		$tempVal = array();
		// unset($val['eLid']);

		// var_dump($val);
		$decVal = json_decode($val['Json_data']);
		// var_dump($decVal);
		$tempVal['timestamp'] = $val['Date'];
		$tempVal['log_raw'] = $val['Json_data'];
		
		$decoded = array();
		$decoded['funcCode'] = 'Inventory';
		$decoded['timestamp'] = $val['Date'];
		$decoded['stationCode'] = '0002';
		$decoded['tankNum'] = '01';
		$decoded['fuelType'] = 'DIE';

		$tank = $this->base_model->getTankByNumCont($decoded['tankNum'], $decoded['stationCode']);
		$height = $tank["height"] ? $tank["height"] : 0; 

		if ($height == 0){
			continue;
		}

		$fuelLevel = (float)$height - (float)$val['Raw_distance'];

echo "=====<br/>";
var_dump($height);
var_dump($fuelLevel);
echo "=====<br/>";


		
		
		$decoded['fuelLevel'] = $fuelLevel;

		
		$fuelVol = $this->base_model->getCalFuelVol($decoded['stationCode'],$decoded['tankNum'],$decoded['fuelLevel']);
		
		
		$decoded['waterLevel'] = '0';
		$decoded['temp'] = $val['Temp'];
		// $decoded['fuelVol'] = $val['Raw_distance'];
		// $decoded['probeFuelVol'] = $val['Raw_distance'];
		$decoded['fuelVol'] = $fuelVol;
		$decoded['probeFuelVol'] = $fuelVol;
		$decoded['waterVol'] = '0';
		$decoded['probeWaterVol'] = '0';
		$decoded['tankHeight'] = (float)$height;

		$decodeJson = json_encode($decoded);

		$tempVal['log_decoded'] = $decodeJson;
		$tempVal['device_id'] = $tank['device_id'] ? $tank['device_id'] : 0;
		$tempVal['type'] = 'small';

		var_dump($val);
		var_dump($tempVal);

		// return;

		// id, timestamp, log_raw, log_decoded, source_id
		// continue;

		$result = $this->base_model->synchPut($tempVal);

		if($result){
			$srcSyn = $this->base_model->updateGet($val['uID']);
			// $destSyn = $this->pdb_model->updatePut($val['eLid']);
		}

		// var_dump($tempVal);
		echo '<br>====================Done==================<br>';



	}

}

// ============================Ibafon ATG Logs===================================================

function ibafonLogs(){
	$path = "./upload/ibafon/tankData.csv";
		// $tpath = "\\\\sah06\\tankdata\\tankData.csv";
		$tpath = "/home/biadmin/tankdata/tankData.csv";

		$copied = copy($tpath, $path);

		echo $copied;
		$cont = null;

		if($copied){
			
			$myfile = fopen($path, "r") or die("Unable to open file!");
			$cont =  fread($myfile,filesize($path));

			// $contline

			fclose($myfile);
			
			// echo $myfile;
			echo $cont;
		}

		$contArr = explode("\n",$cont);
		
		foreach ($contArr as $key=>$val) {
			$contVal = explode(",",$val);
			
			if (count($contVal) < 307){
				continue;
			}
			echo '<br><br>';			
			var_dump($key);
			echo '<br>--------------------<br>';
			// var_dump($contVal[188]);

			$vol = $contVal[188];
			$wv = $contVal[192];
			$wl = floatval(str_replace(" ","",$contVal[150]))/10;
			$ts = $contVal[4];
			$fl = floatval(str_replace(" ","",$contVal[2]))/10;
			$lr = json_encode($contVal);

			// var_dump(json_decode($lr));
			// echo '<br><br>';			


			$tempVal['timestamp'] = $ts;
		$tempVal['log_raw'] = $lr;

			$decoded = array();
		$decoded['funcCode'] = 'Inventory';
		$decoded['timestamp'] = $ts;
		$decoded['stationCode'] = '0003';
		
		$tankNum = '0'.$contVal[0];
		$decoded['tankNum'] = str_replace(" ","",$tankNum);
		$decoded['fuelType'] = 'DIE';

		$tank = $this->base_model->getTankByNumCont($decoded['tankNum'], $decoded['stationCode']);
		// var_dump($tank);
		$height = $tank["height"] ? $tank["height"] : 0; 

		// if ($height == 0){
		// 	continue;
		// }

		$decoded['fuelLevel'] = $fl;
		$decoded['waterLevel'] = $wl;
		$decoded['temp'] = $contVal[24];
		$decoded['fuelVol'] = $vol;
		$decoded['probeFuelVol'] = $vol;
		$decoded['waterVol'] = $wv;
		$decoded['probeWaterVol'] = $wv;
		$decoded['tankHeight'] = (float)$height;

		$decodeJson = json_encode($decoded);

		$tempVal['log_decoded'] = $decodeJson;
		$tempVal['device_id'] = $tank['device_id'] ? $tank['device_id'] : 0;
		$tempVal['type'] = 'ibafon';

		$result = $this->base_model->synchPut($tempVal);


			
			var_dump($tempVal);
			echo '<br>--------------------<br>';
			var_dump($result);
			echo '<br>=========Done==============<br>';

		// echo '<br><br>';

		}

}

// ========================================================

	// ==============================================Maintenance check==================================================
	function maintCheck(){
		$maints = $this->base_model->getMaints();
	
			foreach ($maints as $item) {
				if ($item->maint =="[]" || $item->maint == ""){
					continue;
				}
				// print_r((array)$item->maint);
				// print_r($item->tank_name);
	
				$tankName = $item->tank_name;
				$tankNum = $item->tank_num;
				$controller = $item->device_id;
	
				$toEmail = $this->base_model->getCompanyEmailByController($controller,"preAlarm");			
				print_r($toEmail);
				
	$arrItem = $item->maint;
		$curMaint = '{"curMaint":'.$arrItem.'}';
		$manage = (array) json_decode($curMaint);
				
		// print_r($manage["curMaint"]);
	
		$manage = $manage["curMaint"];
				foreach ($manage as $item) {
					$maintDate = ($item->date);
					$maintType = strtoupper($item->type);
	
					if( strtotime($maintDate) <= time() ){
						// Your date is in the past
						echo $maintDate;

						$contName = (count($this->base_model->getController($controller)) ==1) ? $this->base_model->getController($controller)[0]['contName'] : "Controller Name";
	
						$message = "Tank ".$tankName.", ".$tankNum." on controller ".$contName." is due for ".$maintType." Maintenance";
						
						echo $message;

						$coy = $this->base_model->getCompanyByController($controller);
						
						$station = $this->base_model->getStationByController($controller);
	
						$type = "Maintenance";
	
						$severity = "High";
						
						$this->base_model->addNotification($message,$coy,$station,$controller,$tankName."|".$tankNum,$type,$severity);
	
						echo $this->sendMail($toEmail,"Maintenance is due", "Tank ".$tankName.", ".$tankNum." on controller ".$contName." is due for ".$maintType." Maintenance");
						
					} 
				echo "<br/>";
				
				}
	
	
				echo "<br/>";
			}
	
	}
	
		// ================================================================================================
		
		

		public function backup()
	{
		// echo "stu";
		$this->load->dbutil();

		$backup= null;
		
		$prefs = array(
			'tables'        => array(),   // Array of tables to backup.
			'ignore'        => array(),                     // List of tables to omit from the backup
			'format'        => 'zip',                       // gzip, zip, txt
			'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
			'newline'       => "\n"                         // Newline character used in backup file
	);
	
	$backup = $this->dbutil->backup($prefs);

	$file = 'mybackup'.time();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$fish = write_file('./upload/db_backup/'.$file.'.zip', $backup);

		echo $fish;
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($file.'.zip', $backup);
		echo "Done";
	}


		
		
		// =================================================Sendemail===============================================
		function testMail(){
			//echo $this->sendMail("abdurraheem.abdul-majeed@sahara-group.com","some Sub", "sample message from atg");
			
			
			echo $this->sendMail("isaiah.iroko@sahara-group.com","some gmail Sub", "sample message from atg");
			}


		
		 function sendMail($email = null,$subject = null,$msg = null)
		{
	
			$config['protocol'] = "sendmail";
			
			$config['smtp_host'] = "smtp.sahara-group.com";
			
			$config['smtp_user'] = "abdurraheem.abdul-majeed@sahara-group.com";
			
			$config['smtp_password'] = "ABCDE12345@1";
			
			$config['smtp_port'] = "25";
			// $config['smtp_port'] = "587";
			// $config['smtp_crypto'] = "tls";
			
			$config['newline'] = "\r\n";
			
			$config['mailtype'] = "html";
			
			$config['charset'] = 'iso-8859-1';
			
			$email_from = "abdurraheem.abdul-majeed@sahara-group.com";
			
			$name_from = "ATG";
			
			$this->load->library('email');
			$this->email->initialize($config);      
			$this->email->from($email_from, $name_from);
			if($email == null){
			
				$this->email->to("abdurraheem.abdul-majeed@sahara-group.com"); 
			}
			else {
				$this->email->to($email);
			}
			

			// return "1";

			
			$this->email->subject($subject);
			
			$this->email->message("<br><br>".$msg."<br><br><br><br>");  
			if ($this->email->send())
					{
			// echo "Email Send Successful";
			// echo $this->email->print_debugger();
			// echo $email;
			// echo $subject;
			// echo $msg;
			return "1";
					} 
			else
					{
			// echo $this->email->print_debugger();
			// echo $email;
			// echo $subject;
			// echo $msg;

			return "0";
					}  

		 }





// ================================backend ops=================================================














	
	public function login_submit()
	{
		if  ($this->session->userdata('id') != null ){
			// redirect('index');
			
			if  ($this->session->userdata('acctType') == "admin" ){
				redirect('general');
				
			}
			elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
				redirect('company');
				
			}
			elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
				redirect('station');

			}
			elseif  ($this->session->userdata('acctType') == "regUser" ){
				redirect('general');
				
			}
			elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
				redirect('company');

			}
			elseif  ($this->session->userdata('acctType') == "regStatUser" ){
				redirect('station');

			}
	
		}




		$data = array();
		$this->form_validation->set_rules('userId', 'UserId', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$session_data = null;
		
		
		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('success', 'No field edited');
			// $data["error"] = "Something Went Wrong";			
			$data["validationError"] = validation_errors();			
			$this->load->view('login',$data);
		}
		else{

			$username = $this->input->post('userId');
			$password = $this->input->post('password');
			$userData = $this->base_model->validateUserAndGetData($username,$password);
// var_dump($userData);
// return;
			if(count($userData) == 1 ){

				$session_data = $userData[0];

				if($session_data['status'] == 'inactive'){
					$data["error"] = "Account might be Inactive, Please try again or Contact the Admin";	
					$this->load->view('login',$data);
					return;
				}

				$coy = $session_data['company'];
				$coyStat = (count($this->getCompany($coy,true)) == 1) ? $this->getCompany($coy,true)[0]['status'] : "NF";

				if($session_data['acctType'] != "admin"){
					// var_dump($this->getCompany($coy,true));
					// var_dump($coy);
					// var_dump($coyStat);
					// return;

					if($coyStat == 'inactive' || $coyStat == 'NF'){
						$data["error"] = "Parent Company might be Inactive, Please try again or Contact the Admin";	
						$this->load->view('login',$data);
						return;
					}
				}
					
				if($coyStat == 'deleted'){
					$data["error"] = "Company does not appear to exist, Please try again or Contact the Admin";	
					$this->load->view('login',$data);
					return;
				}


				ini_set('memory_limit', '1024M');
				// $syssettings = $this->base_model->getSysSettings();

				// // if($syssettings){
				// 	array_push($session_data,$syssettings);				
				// // }

				// // var_dump($session_data);
				// // $session
				$this->session->set_userdata($session_data);

				$Id = $this->session->userdata('id');

				$name = $this->getUser($Id,true) ? $this->getUser($Id,true)[0]['fname']." | ".$this->getUser($Id,true)[0]['lname'] : "Not Found";


					$logArr = array(
						'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
						'activity' =>"Login | ".$this->browser(). " | ".$this->platform(),
						'company' => $this->session->userdata('company'),
						'station' => $this->session->userdata('station'),
						'target_user' => $this->session->userdata('id'),

					);
				
					$this->base_model->addActivityLog($logArr);

				// $this->base_model->addActivity("Login",$this->session->userdata('id'));

				// redirect('index');
				// ===============================
				if  ($this->session->userdata('acctType') == "admin" ){
					redirect('general');
					
				}
				elseif  ($this->session->userdata('acctType') == "companyAdmin" ){
					redirect('company');
					
				}
				elseif  ($this->session->userdata('acctType') == "stationAdmin" ){
					redirect('station');
	
				}
				elseif  ($this->session->userdata('acctType') == "regUser" ){
					redirect('general');
					
				}
				elseif  ($this->session->userdata('acctType') == "regCoyUser" ){
					redirect('company');
					
				}
				elseif  ($this->session->userdata('acctType') == "regStatUser" ){
					redirect('station');
	
				}
				// ===============================
			
			}
			else{
			$data["error"] = "Something went wrong, Please try again or contact the Admin";	
			$this->load->view('login',$data);
				
			}
			
	
			
		}	



	}





	public function landing(){
		$this->load->view('landing');

	}


	public function logout(){

		if  ($this->session->userdata('id') != null ){

			$logArr = array(
				'user' => $this->session->userdata('fname')." ".$this->session->userdata('lname'),
				'activity' =>"Logout | ".$this->browser(). " | ".$this->platform(),
				'company' => $this->session->userdata('company'),
				'station' => $this->session->userdata('station'),
				'target_user' => $this->session->userdata('id'),

			);
		
			$this->base_model->addActivityLog($logArr);

		}
		
		$session_data = null;
		
		if  ($this->session->userdata('id') != null ){
			// $this->pdb_model->addActivity("Logout",$this->session->userdata('_user_autoID'));
			// redirect('index');
			$this->session->set_userdata($session_data);
			$this->session->sess_destroy();
			
	
		}

		$this->load->view('login');
		
	}





}
