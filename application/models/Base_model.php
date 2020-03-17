<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class base_model extends CI_Model {


	public function __construct()
	{
		$this->load->database();
		$this->load->library('Datatables');
		$this->load->library('session');
		
		
	}


	

	
	
	
	
	// ==========================================actlogs=============================================================
	
	function load_actLogs($id = null){

		$company = $this->session->userdata('company');
		
		$station = $this->session->userdata('station');



		// $id = $this->session->userdata('id');

		$this->datatables->select('user, activity, company, station, timestamp');
		
		// $this->datatables->where('company !=', "");

		if(isset($company) && $company != null && $company != 0){
			$this->datatables->where('company', $company);
		}
		
		if(isset($station) && $station != null && $station != 0){
			
			$this->datatables->where('station', $station);
		}
			

		if(isset($id) && $id != null && $id != 0){
			$this->datatables->where('target_user', $id);
		}


		
		$this->datatables->from('activity_log');
	
		$this->db->order_by("timestamp", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		// $this->datatables->edit_column('activity', '$1','linkToUser(activity,target_users)');
		$this->datatables->edit_column('station', '$1','getstatName(station)');
		$this->datatables->edit_column('company', '$1','getcoyName(company)');

		
	
		return $this->datatables->generate();
	}


	// ==========================================user=============================================================
	
	function load_notLogs($id = null){

		$company = $this->session->userdata('company');
		
		$station = $this->session->userdata('station');

		$coyName = (count($this->getCompany($company))>0) ? $this->getCompany($company)[0]["name"] : null;

		$statName = (count($this->getStation($station))>0) ? $this->getStation($station)[0]["name"] : null;




		// $id = $this->session->userdata('id');

		$this->datatables->select('company, message, severity, station, created, notification_id');
		
		$this->datatables->where('closed !=', "Yes");

		// $this->db->group_by("location");
		if(isset($coyName) && $coyName != null && $coyName != ""){
			
			$this->datatables->where('company', $coyName);
		}
		
		if(isset($statName) && $statName != null && $statName != ""){
			
			$this->datatables->where('station', $statName);
		}


		
		$this->datatables->from('notifications');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		// $this->datatables->edit_column('activity', '$1','linkToUser(activity,target_users)');
		$this->datatables->edit_column('notification_id', '$1','notificationMgt(notification_id)');

		
	
		return $this->datatables->generate();
	}


	// ==========================================user=============================================================
	
	function load_users($id = null){

		$company = $this->session->userdata('company');
		
		$station = $this->session->userdata('station');



		$cid = $this->session->userdata('id');

		$this->datatables->select('fname, lname, email, acctType, status, id');
		
		$this->datatables->where('status !=', "deleted");
		$this->datatables->where('id !=', $cid);

		
		if(isset($company) && $company != null && $company != 0){
			if(isset($station) && $station != null && $station != 0){
				
				$this->datatables->where('station', $station);
			}
			else{
				$this->datatables->where('company', $company);
				
			}
		}

		
		if(isset($id) && $id != null && $id != 0){
			$this->datatables->where('company', $id);
		}

		
		$this->datatables->from('user');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('email', '$1','linkToLogs(email, id)');
		$this->datatables->edit_column('id', '$1','userBtn(id,status)');
		// $this->datatables->edit_column('status', '$1','stat(status)');
		$this->datatables->edit_column('acctType', '$1','acct(acctType)');
		$this->datatables->edit_column('fname', '$1','concatName(fname, lname)');
		$this->datatables->edit_column('fname', '$1','nodeNameMgt(fname, status)');

		
		$this->datatables->unset_column('lname');
		// $this->datatables->unset_column('fname');

		
	
		return $this->datatables->generate();
	}

	function addUser($dat = null){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		if($dat == null){

			$new_data = $this->input->post();
		}
		else{
			$new_data = $dat;
		}

		if(isset($new_data['land']) ){
			unset($new_data['land']);

		}

		$new_data["user_password"] = sha1(md5($new_data["user_password"]));
			
	
	
	  $res = $this->db->insert('user', $new_data);
	  return $res;
	}


	function getUser($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('id', $id);
		
		$query = $this->db->get('user');
	
		return $query->result_array();
	
	}




	function editUser($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		if($new_data["user_password"] == ""){
			unset($new_data['user_password']);

		}else{

			$new_data['lastPWChange'] = date("Y-m-d H:i:s");
			$new_data["user_password"] = sha1(md5($new_data["user_password"]));
		}

		
	
			$this->db->where('id', $id);		
	  $res = $this->db->update('user', $new_data);
	  return $res;
	}



	function enableUser($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('id', $Id);
		 $res = $this->db->update('user', $data);
		
		return $res;
	}



	function disableUser($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('id', $Id);
		 $res = $this->db->update('user', $data);
		
		return $res;
	}


	function deleteUser($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('id', $Id);
		 $res = $this->db->update('user', $data);
		
		return $res;
	}


	// ==========================================pumps=============================================================
	
	function load_pumps($id = null){
		$company = $this->session->userdata('company');
		$station = null;
		if(isset($id) && $id != null && $id != 0){
			$station = $id;
		}
		else{
			$station =  $this->session->userdata('station');

		}
		
		
		if(isset($company) && $company != null && $company != 0){

			if(isset($station) && $station != null && $station != 0){
					$this->datatables->where('station', $station);
			}
			else{

					
				$statIds = null;
				
			$stats = $this->stationGet(null,$company);
			if(count($stats) > 0){
				$statIds = array_column($stats, 'station_id');
				
				// var_dump($statIds);
				$this->datatables->where_in('station', $statIds);

			}
			else{

				$this->datatables->where('station', $statIds);
				
			}

		}
	
		}
			
				

		$this->datatables->select('pump_name, product, manufacturer, model, status, station, created, pID');
		
		$this->datatables->where('status !=', "deleted");
		
		
				
		$this->datatables->from('pumps');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('pID', '$1','pumpBtn(pID,status)');
		
		// $this->datatables->edit_column('device_name', '$1','controllerMgt(device_id,device_name)');
		$this->datatables->edit_column('pump_name', '$1','nodeNameMgt(pump_name, status)');
		
		$this->datatables->edit_column('station', '$1','getStat(station)');
		// $this->datatables->edit_column('height', '$1','numbForm(height)');

		
		// $this->datatables->unset_column('device_id');
		$this->datatables->unset_column('status');

		
	
		return $this->datatables->generate();
	}



	function addPumpLogs($obj = null){

		$new_data = $obj;
	
	  $res = $this->db->insert('pump_logs', $new_data);
	  return $res;
	}



	function getStartDate($connID){
	
		$this->db->select_max('datetime','max');
		$this->db->where('pID', $connID);
		$query = $this->db->get('pump_logs');

		// var_dump($query->result_array());
		return $query->result_array()[0]['max'];


	}




	function getRangePumpLogs( $num = null, $count = null, $date = null,$from = null,$to = null, $prod=null){

		
		// if(isset($num) && $num != null && $num != 0){
		// 	var_dump($num);
		if(count($num) > 0){

			$this->db->where_in('pID', $num);
		}
		else{
			
			$this->db->where('pID', null);
		}

		// }


		if(isset($from) && $from != null && $from != 0){
			$this->db->where('datetime >=', $from);
		}
		if(isset($to) && $to != null && $to != 0){
			$this->db->where('datetime <=', $to);
		}

		// if(isset($prod) && $prod != null && $prod != 0){
			$this->db->where('prod ', $prod);
		// }


		if($count!=null){
			// $this->db->like('timestamp', $date);
			$query = $this->db->get('pump_logs',$count);
		}
		else{
			$query = $this->db->get('pump_logs');

		}
        // $query = $this->db->get('sLogs', 1);


         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array();
		 }
		 else{
			return "2";         
		 }
        
        return "7";         
		}


		
	function getPumpLogs( $num = null, $count = null, $date = null,$from = null,$to = null, $prod=null){

            
        if($num != null && $num != "" ){

        $this->db->where('pID', $num);
		// $this->db->where('log_decoded', "inventory");


		if(isset($from) && $from != null && $from != 0){
			$this->db->where('datetime >=', $from);
		}
		if(isset($to) && $to != null && $to != 0){
			$this->db->where('datetime <=', $to);
		}

		if(isset($prod) && $prod != null && $prod != 0){
			$this->db->where('prod ', $prod);
		}


		if($count!=null){
			// $this->db->like('timestamp', $date);
			$query = $this->db->get('pump_logs',$count);
		}
		else{
			$query = $this->db->get('pump_logs',15);

		}
        // $query = $this->db->get('sLogs', 1);


         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array();
		 }
		 else{
			return "2";         
		 }
        }
        return "7";         
		}


	function getPump($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('pID', $id);
		
		$query = $this->db->get('pumps');
	
		return $query->result_array();
	
	}
	
	function getPumpsByStat($id = null){

		$company = $this->session->userdata('company');
		// $station = $this->session->userdata('station');
		$station = null;
		if(isset($id) && $id != null && $id != 0){
			$station = $id;
		}
		else{
			$station =  $this->session->userdata('station');

		}


		if(isset($company) && $company != null && $company != 0){

			if(isset($station) && $station != null && $station != 0){
					$this->datatables->where('station', $station);
			}
			else{

					
				$statIds = null;
				
			$stats = $this->stationGet(null,$company);
			if(count($stats) > 0){
				$statIds = array_column($stats, 'station_id');
				
				// var_dump($statIds);
				$this->datatables->where_in('station', $statIds);

			}
			else{

				$this->datatables->where('station', $statIds);
				
			}

		}
	
		}



		$this->db->where('status !=', "deleted");

		// $this->db->where('station', $stat);

		// $this->db->where('pID', $id);
		
		$query = $this->db->get('pumps');
	
		return $query->result_array();
	
	}
	
	function getPumps($prod = null){

		$this->db->where('status !=', "deleted");

		
		// $this->db->where('pID', $id);
		
		$query = $this->db->get('pumps');
	
		return $query->result_array();
	
	}

	function addPump(){

		$new_data = $this->input->post();
	
	  $res = $this->db->insert('pumps', $new_data);
	  return $res;
	}

	function editPump($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		
	
			$this->db->where('pID', $id);		
	  $res = $this->db->update('pumps', $new_data);
	  return $res;
	}



	function enablePump($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('pID', $Id);
		 $res = $this->db->update('pumps', $data);
		
		return $res;
	}


	function disablePump($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('pID', $Id);
		 $res = $this->db->update('pumps', $data);
		
		return $res;
	}

	function deletePump($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('pID', $Id);
		 $res = $this->db->update('pumps', $data);
		
		return $res;
	}



	function getCurrentPumpData( $id = null, $count = null, $sdate = null, $edate = null){
            
       

		if($sdate != null){
			$this->db->where('datetime >=', $sdate);
		}
		
		if($edate != null){
			$this->db->where('datetime <=', $edate);
		}
        
        $this->db->order_by('plID', 'DESC');
		
		
        $this->db->where('pID', $id);

		if($count != null){
        
        	$query = $this->db->get('pump_logs', $count);

		}
		else{

			$query = $this->db->get('pump_logs');

		}

         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array();
		 }
		 else{
			return "2";         
		 }

		return "7";         
		
		}




	
	// ==========================================tanks=============================================================
	
	function load_tanks($id = null){
		$company = $this->session->userdata('company');
		$station = $this->session->userdata('station');
		
				if(isset($company) && $company != null && $company != 0){

					if(isset($station) && $station != null && $station != 0){
						$devIds = null;
						$devs = $this->deviceGet(null,null,$station);
						// var_dump($devs);
						if(count($devs) > 0){
							$devIds = array_column($devs, 'Source_id');
			
							// $this->db->where_in('device_id', $devIds);
							$this->datatables->where_in('device_id', $devIds);
							
						}
						else{
							
							$this->datatables->where('device_id', $devIds);
							
						}
					}
					else{

						$devIds = null;
						$devs = $this->deviceGet(null,$company);
						// var_dump($devs);
						if(count($devs) > 0){
							$devIds = array_column($devs, 'Source_id');
							
							$this->datatables->where_in('device_id', $devIds);
							
						}
						else{
							
							$this->datatables->where('device_id', $devIds);
							
						}
					}
		
		
				}

				

		$this->datatables->select('tank_name, tank_num, device_id, device_name, volume, height, product, status, tank_id');
		
		$this->datatables->where('status !=', "deleted");
		
		if(isset($id) && $id != null && $id != 0){
			$this->datatables->where('device_id', $id);
		}
				
		$this->datatables->from('tank');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('tank_id', '$1','tankBtn(tank_id,status)');
		$this->datatables->edit_column('device_name', '$1','controllerMgt(device_id,device_name)');
		$this->datatables->edit_column('tank_name', '$1','nodeNameMgt(tank_name, status)');
		
		$this->datatables->edit_column('volume', '$1','numbForm(volume)');
		$this->datatables->edit_column('height', '$1','numbForm(height)');

		
		$this->datatables->unset_column('device_id');
		$this->datatables->unset_column('status');

		
	
		return $this->datatables->generate();
	}

	function addTank(){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		$new_data = $this->input->post();
			
	
	
	  $res = $this->db->insert('tank', $new_data);
	  return $res;
	}
	
	
	function addcronscript($tag = null,$json = null){

		$new_data = array();

		$new_data["cscode"] = $tag;
		$new_data["json"] = $json;

		$this->db->delete('cronscript', array('cscode' => $tag));
	
	
	  $res = $this->db->insert('cronscript', $new_data);
	  return $res;

	}


	
	function getAdminHeavy(){

		// $this->db->where('status !=', "deleted");
		$this->db->where('cscode', "adminDashHeavy");
		
		$query = $this->db->get('cronscript');
	
		return $query->result_array();
	
	}
	
	function getCoyHeavy(){

		// $this->db->where('status !=', "deleted");
		$this->db->where('cscode', "coyDashHeavy");
		
		$query = $this->db->get('cronscript');
	
		return $query->result_array();
	
	}
	
	function getStatHeavy(){

		// $this->db->where('status !=', "deleted");
		$this->db->where('cscode', "statDashHeavy");
		
		$query = $this->db->get('cronscript');
	
		return $query->result_array();
	
	}




	function getTank($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('tank_id', $id);
		
		$query = $this->db->get('tank');
	
		return $query->result_array();
	
	}


	function editTank($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		
	
			$this->db->where('tank_id', $id);		
	  $res = $this->db->update('tank', $new_data);
	  return $res;
	}



	function enableTank($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('tank_id', $Id);
		 $res = $this->db->update('tank', $data);
		
		return $res;
	}


	function disableTank($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('tank_id', $Id);
		 $res = $this->db->update('tank', $data);
		
		return $res;
	}

	function deleteTank($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('tank_id', $Id);
		 $res = $this->db->update('tank', $data);
		
		return $res;
	}

	// ==========================================controller=============================================================
	
	function load_controllers($id = null){
		$company = $this->session->userdata('company');
		
		$station = $this->session->userdata('station');

		if(isset($company) && $company != null && $company != 0){
			if(isset($station) && $station != null && $station != 0){
	
				$this->datatables->where('statId', $station);
				
			}
			else{

					
					$statIds = null;
					
				$stats = $this->stationGet(null,$company);
				if(count($stats) > 0){
					$statIds = array_column($stats, 'station_id');
					
					// var_dump($statIds);
					$this->datatables->where_in('statId', $statIds);

				}
				else{

					$this->datatables->where('statId', $statIds);
					
				}

			}
			
			// $this->db->where('company_id', $company);
		}

		$this->datatables->select('contName, statId, contId, source_extra_details, status, Source_id');
		

		$this->datatables->where('status !=', "deleted");

		if(isset($id) && $id != null && $id != 0){
			$this->datatables->where('statId', $id);
		}
		
		$this->datatables->from('device');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('contName', '$1','linkToTank(contName, Source_id)');
		$this->datatables->edit_column('Source_id', '$1','controllerBtn(Source_id,status)');
		$this->datatables->edit_column('statId', '$1','getStat(statId)');
		$this->datatables->edit_column('contName', '$1','nodeNameMgt(contName, status)');


		$this->datatables->unset_column('status');

		
	
		return $this->datatables->generate();
	}



	function addController(){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		$new_data = $this->input->post();
			
	
	
	  $res = $this->db->insert('device', $new_data);
	  return $res;
	}


	function getController($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('Source_id', $id);
		
		$query = $this->db->get('device');
	
		return $query->result_array();
	
	}


	function editController($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		// var_dump($new_data);
		// return;
	
			$this->db->where('Source_id', $id);		
	  $res = $this->db->update('device', $new_data);
	  return $res;
	}



	function enableController($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('Source_id', $Id);
		 $res = $this->db->update('device', $data);
		
		return $res;
	}


	function disableController($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('Source_id', $Id);
		 $res = $this->db->update('device', $data);
		
		return $res;
	}

	function deleteController($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('Source_id', $Id);
		 $res = $this->db->update('device', $data);
		
		return $res;
	}
	// ==========================================station=============================================================
	
	function load_stations($id = null){

		$company = $this->session->userdata('company');
		
		$this->datatables->select('name, company_id, nickname, location, address, state, status, station_id');
		
		$this->datatables->where('status !=', "deleted");

		if(isset($company) && $company != null && $company != 0){
			
			$this->datatables->where('company_id', $company);
		}

		if(isset($id) && $id != null && $id != 0){
			
			$this->datatables->where('company_id', $id);
		}
		
		$this->datatables->from('station');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('name', '$1','linkToDev(name, station_id)');
		$this->datatables->edit_column('station_id', '$1','stationBtn(station_id,status)');
		$this->datatables->edit_column('company_id', '$1','getCoy(company_id)');
		$this->datatables->edit_column('name', '$1','nodeNameMgt(name, status)');

		$this->datatables->unset_column('status');
		
	
		return $this->datatables->generate();
	}

	function addStation(){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		$new_data = $this->input->post();
			
	
	
	  $res = $this->db->insert('station', $new_data);
	  return $res;
	}


	function getStation($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('station_id', $id);
		
		$query = $this->db->get('station');
	
		return $query->result_array();
	
	}


	function editStation($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		// var_dump($new_data);
		// return;
	
			$this->db->where('station_id', $id);		
	  $res = $this->db->update('station', $new_data);
	  return $res;
	}



	function enableStation($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('station_id', $Id);
		 $res = $this->db->update('station', $data);
		
		return $res;
	}


	function disableStation($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('station_id', $Id);
		 $res = $this->db->update('station', $data);
		
		return $res;
	}


	function deleteStation($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('station_id', $Id);
		 $res = $this->db->update('station', $data);
		
		return $res;
	}


	// ==========================================companies===========================================================
	
	function load_companies($id = null){
		$this->datatables->select('name, phone_no, comments, company_id, status');
		
		$this->datatables->where('status !=', "deleted");

		
		$this->datatables->from('company');
	
		// $this->db->order_by("del_time", "desc");
		// $this->db->order_by("created", "desc");
	
		$this->load->helper('base_helper');
		$this->datatables->edit_column('name', '$1','linkToStat(name, company_id)');
		$this->datatables->edit_column('company_id', '$1','companyBtn(company_id, status)');
		
		
		$this->datatables->edit_column('name', '$1','companyNameMgt(name, status)');
		
		$this->datatables->unset_column('status');


	
	
		return $this->datatables->generate();
	}



	function approveCompany($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('company_id', $Id);
		 $res = $this->db->update('company', $data);
		
		return $res;
	}

	
	function enableCompany($Id)
	{
		$data = array(
			'status' => ''
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('company_id', $Id);
		 $res = $this->db->update('company', $data);
		
		return $res;
	}


	function disableCompany($Id)
	{
		$data = array(
			'status' => 'inactive'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('company_id', $Id);
		 $res = $this->db->update('company', $data);
		
		return $res;
	}

	
	function deleteCompany($Id)
	{
		$data = array(
			'status' => 'deleted'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('company_id', $Id);
		 $res = $this->db->update('company', $data);
		
		return $res;
	}


	function addCompany(){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		$new_data = $this->input->post();
		if(isset($new_data['land']) ){
			// if( $new_data['land'] == "yes" ){
			unset($new_data['land']);
				
				$this->db->insert('company', $new_data);
				$res = $this->db->insert_id();
			// }
		}
		else{
			$res = $this->db->insert('company', $new_data);

		}
			
	
	
	  return $res;
	}



	



	function editCompany($id){

		$new_data = $this->input->post();

		// var_dump($this->input->post());
		unset($new_data['id']);
		// var_dump($new_data);
		// return;
	
			$this->db->where('company_id', $id);		
	  $res = $this->db->update('company', $new_data);
	  return $res;
	}


	

	function getCompany($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('company_id', $id);
		
		$query = $this->db->get('company');
	
		return $query->result_array();
	
	}


	// ==========================================notification===========================================================

	function tankLogDays($name = null, $controller = null,$count = null){
// var_dump($num);
// var_dump($cont);
		
		$this->db->select('log_decoded, Date(logs.timestamp) dt');
		$this->db->like('log_decoded', "inventory");

		$this->db->like('log_decoded', 'Num":"'.$name);
        $this->db->like('device_id', $controller);		        


		$this->db->group_by("Date(logs.timestamp)");
			$this->db->order_by('timestamp', 'ASC');
			$query = $this->db->get('logs', 10);
		
			return $query->result_array();
			
	}
	
	
	function tanknotificationGet($num = null,$cont = null){
// var_dump($num);
// var_dump($cont);
		
		$this->db->where('closed !=', "Yes");
		$this->db->where('controller', $cont);
		$this->db->like('tank', $num);

		// $this->db->group_by("location");
			$this->db->order_by('notification_id', 'ASC');
			$query = $this->db->get('notifications', 7);
		
			return $query->result_array();
			
	}
		
		
				
	
	function notificationReorderGet($companyName = null,$stationName = null){

		
		$this->db->where('closed !=', "Yes");

		$this->db->group_by(array("station"));
		if(isset($companyName) && $companyName != null && $companyName != ""){
			
			$this->db->where('company', $companyName);
		}
		
		if(isset($stationName) && $stationName != null && $stationName != ""){
			
			$this->db->where('station', $stationName);
		}
		
		$this->db->where('type', "Reorder");
		$this->db->limit(5);
		
		// if($count == "yes"){
		// 	$this->db->from('notifications');
		// 	return $this->db->count_all_results();
		// }
		// if($count != "yes"){
			
			$this->db->order_by('created', 'desc');
			$query = $this->db->get('notifications', 5);
		
			return $query->result_array();
		// }


		

	}


	function notificationGet($count = null,$companyName = null,$stationName = null){

		
		$this->db->where('closed !=', "Yes");

		// $this->db->group_by("location");
		if(isset($companyName) && $companyName != null && $companyName != ""){
			
			$this->db->where('company', $companyName);
		}
		
		if(isset($stationName) && $stationName != null && $stationName != ""){
			
			$this->db->where('station', $stationName);
		}
		
		if($count == "yes"){
			$this->db->from('notifications');
			return $this->db->count_all_results();
		}
		if($count != "yes"){
			
			$this->db->order_by('notification_id', 'ASC');
			$query = $this->db->get('notifications', 5);
		
			return $query->result_array();
		}


		

	}

	
	
	
	function deleteNotification($Id)
	{
		$data = array(
			'closed' => 'Yes'
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('notification_id', $Id);
		 $res = $this->db->update('notifications', $data);
		
		return $res;
	}



	function getNotification($id){

		// $this->db->where('status !=', "deleted");
		$this->db->where('notification_id', $id);
		
		$query = $this->db->get('notifications');
	
		return $query->result_array();
	
	}


	// ==========================================location===========================================================

	function locationGet($company = null,$station = null, $location = null){

		
		$this->db->where('status !=', "deleted");

		$this->db->group_by("location");
		$this->db->order_by('station_id', 'ASC');


		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company_id', $company);
		}
		
		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('station_id', $station);
		}
		
		if(isset($location) && $location != null){
		
			
			$this->db->where('location', $location);
		}

		

		$query = $this->db->get('station');


		return $query->result_array();
		

	}


	// ==========================================Company Companies===================================================

	
	function toggleApprove($Id,$meth)
	{

		$stat = $meth ? "" : "deleted";
		$data = array(
			'status' => $stat
		 );
		 
		 // $this->db->replace('source', $data);
		 $this->db->where('company_id', $Id);
		 $res = $this->db->update('company', $data);
		
		return $res;
	}



	function getSysSettings(){

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');


		$this->db->where('company', $coy);
		$this->db->where('station', $stat);
		$query = $this->db->get('sys_settings');
	
		return (count($query->result_array()) > 0) ? $query->result_array() : null ;
	}



	function companyGetCount($inactive = null,$new = null, $from = null, $to = null, $userType = null, $company = null, $station = null, $location = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');

		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company_id', $company);
		}

		if($from != null){

		}

		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){

			$this->db->where('status !=', "inactive");
		}
		if($new == "yes"){

			$this->db->where('status ', "new");
		}
		$this->db->where('status !=', "deleted");

		// $this->db->get('company');

		$query = $this->db->count_all_results('company');
		
		// $query = $this->db->get('company');

        return $query;

	}

	function companyGet($inactive = null,$new = null, $from = null, $to = null, $userType = null, $company = null, $station = null, $location = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');

		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company_id', $company);
		}

		if($from != null){

		}

		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){

			$this->db->where('status !=', "inactive");
		}
		if($new == "yes"){

			$this->db->where('status ', "new");
		}
		$this->db->where('status !=', "deleted");
		
		$query = $this->db->get('company');

        return $query->result_array();

	}
	
	// ==========================================station stations===================================================

	
	function stationGet($inactive = null,$company = null,$station = null, $location = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');
		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){
			
			$this->db->where('status', "");
		}
		
		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company_id', $company);
		}
		
		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('station_id', $station);
		}
		
		if(isset($location) && $location != null){
		
			// var_dump($location);
			
			$this->db->where('location', $location);
		}

		$this->db->where('status !=', "deleted");
		
		$query = $this->db->get('station');

		// print_r($this->db->last_query());    


        return $query->result_array();

	}

	// ========================================== activity log===================================================

	
	function actLogGet( $company = null, $station = null, $from = null, $to = null, $userType = null){

		
		
		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company', $company);
		}
		
		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('station', $station);
		}


		if($userType == "admin" || $userType == "regUser"){

			$this->db->where('company', 0);
			$this->db->where('station', 0);

		}
		if($userType == "companyAdmin" || $userType == "regCoyUser"){
			$this->db->where('company !=', 0);
			$this->db->where('station', 0);

		}
		if($userType == "stationAdmin" || $userType == "regStatUser"){
			$this->db->where('company !=', 0);
			$this->db->where('station !=', 0);
		}

		if(isset($from) && $from != null){
			
			$this->db->where('timestamp >=', $from);
		}
		
		if(isset($to) && $to != null){
			
			$this->db->where('timestamp <=', $to);
		}






		$this->db->order_by('activity_id', 'DESC');
		$query = $this->db->get('activity_log', 4);




		// return $query->result_array();
        return array_reverse($query->result_array());
		

	}

	function mostActiveGet($company = null, $station = null, $from = null, $to = null, $userType = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		$this->db->select('user, count(*) as cnt, company');

		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company', $company);
		}

		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('station', $station);
		}


		if($userType == "admin" || $userType == "regUser"){

			$this->db->where('company', 0);
			$this->db->where('station', 0);

		}
		if($userType == "companyAdmin" || $userType == "regCoyUser"){
			$this->db->where('company !=', 0);
			$this->db->where('station', 0);

		}
		if($userType == "stationAdmin" || $userType == "regStatUser"){
			$this->db->where('company !=', 0);
			$this->db->where('station !=', 0);
		}

		if(isset($from) && $from != null){
			
			$this->db->where('timestamp >=', $from);
		}
		
		if(isset($to) && $to != null){
			
			$this->db->where('timestamp <=', $to);
		}


		
		$this->db->group_by("user");
		$this->db->order_by('cnt', 'DESC');
		// $this->db->order_by('count(*)', 'DESC');
		$query = $this->db->get('activity_log', 4);


		return $query->result_array();
        // return array_reverse($query->result_array());
		

	}
	
	// ==========================================device Management=====================================================

	
	function deviceGet($inactive = null, $company = null,$station = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');
		if(isset($company) && $company != null && $company != 0){

			$statIds = null;
			
			$stats = $this->stationGet(null,$company);
			if(count($stats) > 0){
				$statIds = array_column($stats, 'station_id');

				// var_dump($statIds);
				$this->db->where_in('statId', $statIds);

			}
			else{

				$this->db->where('statId', $statIds);

			}


			// $this->db->where('company_id', $company);
		}


		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('statId', $station);
		}
		
		
		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){

			$this->db->where('status', "");
		}

		


		$this->db->where('status !=', "deleted");
		
		
		$query = $this->db->get('device');

        return $query->result_array();
        // return $this->db->last_query();

	}

	// ==========================================tank Management=====================================================

	function tanksalereord($tank, $type, $val){

		$this->db->where('tank',$tank);
		$this->db->where('type',$type);

		$q = $this->db->get('sales_reorders');

		$data = array(
			"value"=>$val,
			"type"=>$type,
			"tank"=>$tank,
		);

		if ( $q->num_rows() > 0 ) 
		{
			$this->db->where('tank',$tank);
			$this->db->where('type',$type);
			$this->db->update('sales_reorders',$data);
		} else {
			// $this->db->where('tank',$tank);
			// $this->db->where('type',$type);
			$this->db->insert('sales_reorders',$data);
		}

	}
	
	
	function gettanksalereord($tank, $type){

		$this->db->where('tank',$tank);
		$this->db->where('type',$type);

		$q = $this->db->get('sales_reorders');

		

		if ( $q->num_rows() > 0 ) 
		{
			return $q->result_array()[0];

		} else {
			return null;
		}

	}
	



	function tankGet($inactive = null, $company = null, $station = null, $location = null,$prod = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');
		if(isset($company) && $company != null && $company != 0){
			$devIds = null;
			$devs = $this->deviceGet(null,$company);
			// var_dump($devs);
			if(count($devs) > 0){
				$devIds = array_column($devs, 'Source_id');

				$this->db->where_in('device_id', $devIds);
				
			}
			else{
				
				$this->db->where('device_id', $devIds);
				
			}


		}
		
		if(isset($station) && $station != null && $station != 0){
			$devIds = null;
			$devs = $this->deviceGet(null,null,$station);
			// var_dump($devs);
			if(count($devs) > 0){
				$devIds = array_column($devs, 'Source_id');

				$this->db->where_in('device_id', $devIds);
				
			}
			else{
				
				$this->db->where('device_id', $devIds);
				
			}


		}
		
		// if(isset($location) && $location != null && $location != 0){
		// 	$devIds = null;
		// 	$devs = $this->deviceGet(null,null,null,$location);
		// 	// var_dump($devs);
		// 	if(count($devs) > 0){
		// 		$devIds = array_column($devs, 'Source_id');

		// 		$this->db->where_in('device_id', $devIds);
				
		// 	}
		// 	else{
				
		// 		$this->db->where('device_id', $devIds);
				
		// 	}


		// }
		
		if(isset($prod) && $prod != null && $prod != ""){
			$this->db->where('product', $prod);
		}
		
		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){

			$this->db->where('status', "");
		}

		

		$this->db->where('status !=', "deleted");
		
		$query = $this->db->get('tank');

        return $query->result_array();

	}





	
	function statCurTankVol($stat, $prod, $date, $vol){

		$cvData = array(
			'stat'=>$stat, 
			'prod'=>$prod, 
			'volume'=>$vol, 
			'created'=>$date, 
			);
	
		return $this->db->insert('curvol', $cvData);
		
	}




	function getstatCurTankVol($stat = null, $prod = null, $date = null){

		// var_dump($date);
		// var_dump($date);
		// var_dump($date);

		$this->db->where_in('stat', $stat);

		$this->db->where('prod', $prod);

		if($date==null){

			$date = date('Y-m-d H:i:s');
			
		}

		$this->db->where('created <=', $date);
		
		
		$query = $this->db->get('curvol');
	
		return $query->result_array();
	
	}






	function getCurrentTankData( $name = null, $controller = null,$prod = null,$date = null){
			
		
        if($name != null && $controller != null && $name != "" && $controller != ""){

        // if($name != null && $controller != null && $name != "" && $controller != ""){

        // $this->db->select('l.*,t.volume');
        // $this->db->from('logs l');
        // $this->db->join('tank t', 't.controller = l.source_id', 'inner');
        
		$this->db->like('log_decoded', 'Num":"'.$name);
		
		if($prod!=null){
		
        	$this->db->like('log_decoded', 'fuelType":"'.$prod);
		}        
        // $this->db->like('source_id', $controller);
        $this->db->where('device_id', $controller);
        // $this->db->like('t.tank_num', $name);
		
		$this->db->like('log_decoded', "inventory");

		if($date!=null){
			$this->db->where('timestamp <=', $date);
		}
		// if($date!=null){
		// 	$this->db->like('timestamp', $date);
		// }
        
        $this->db->order_by('id', 'DESC');
        
        

        $query = $this->db->get('logs', 1);
        // $query = $this->db->get('sLogs', 1);

		// var_dump($query->result_array());

         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array()[0];
		 }
		 else{
			return "2";         
		 }
        }
        return "7";         
		}





		function getTankDay( $name = null, $controller = null,$prod = null,$date = null){
            
        if($name != null && $controller != null && $name != "" && $controller != ""){
        
		$this->db->like('log_decoded', 'Num":"'.$name);
		
		if($prod!=null){
		
        	$this->db->like('log_decoded', 'fuelType":"'.$prod);
		}        
        // $this->db->like('source_id', $controller);
        $this->db->where('device_id', $controller);
        // $this->db->like('t.tank_num', $name);
		
		$this->db->like('log_decoded', "inventory");

		if($date!=null){
			$this->db->like('timestamp', $date);
		}
		else{
			$this->db->where('timestamp >=', date('Y-m-d H:i:s', strtotime('-1 month')));

		}
        
        $this->db->order_by('id', 'asc');
        
        

        $query = $this->db->get('logs');
        // $query = $this->db->get('sLogs', 1);


         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array();
		 }
		 else{
			return "2";         
		 }
        }
        return "7";         
		}
		
		
		
		// function getTankLogs( $name = null, $controller = null, $count = null, $date = null){
		function getTankLogs( $name = null, $controller = null, $count = null, $date = null,$from = null,$to = null){

            
        if($name != null && $controller != null && $name != "" && $controller != ""){

        // $this->db->select('l.*,t.volume');
        // $this->db->from('logs l');
        // $this->db->join('tank t', 't.controller = l.source_id', 'inner');
        
		$this->db->like('log_decoded', 'Num":"'.$name);
		
		        
        // $this->db->like('source_id', $controller);
        $this->db->where('device_id', $controller);
        // $this->db->like('t.tank_num', $name);
		
		$this->db->like('log_decoded', "inventory");
		
		if($date!=null){
        	$this->db->like('timestamp', $date);

        	$this->db->order_by('id', 'asc');
		}
		else{
			$this->db->order_by('id', 'desc');

		}



		if(isset($from) && $from != null && $from != 0){
			$this->db->where('timestamp >=', $from);
		}
		if(isset($to) && $to != null && $to != 0){
			$this->db->where('timestamp <=', $to);
		}



		if($count!=null){
			// $this->db->like('timestamp', $date);
			$query = $this->db->get('logs',$count);
		}
		else{
			$query = $this->db->get('logs',5);

		}
        // $query = $this->db->get('sLogs', 1);


         if (count($query->result_array()) != 0){
			//  var_dump($query->result_array()[0]);
             return $query->result_array();
		 }
		 else{
			return "2";         
		 }
        }
        return "7";         
		}



		
		function insert_batch($table,$arr, $id)
        {


            $this->db->delete($table, array('tank_id' => $id));

          
        $res = $this->db->insert_batch($table,$arr);


        if ($res != false){
            return true;
        }
        else {
            return false;
        }

              
        }
	
	// ==========================================User Management=====================================================

	
	function userGet($inactive = null,$unique = null,$online = null,$company = null,$station = null, $userType = null){

		// $this->db->select(' _username, _firstName, _lastName, _email, _phoneNo, _station, _status, _access,  _user_autoid');
		// $this->db->select('title, content, date');
		if($inactive == "yes"){

			$this->db->where('status', "inactive");
		}
		if($inactive == "no"){

			$this->db->where('status', "");
		}
		$this->db->where('status !=', "deleted");

		if($unique == "yes"){
			$this->db->group_by("acctType");
		$this->db->order_by('id', 'ASC');
		}

		if($online == "yes"){
			$this->db->where('online', "yes");

		}
		elseif($online == "no"){
			$this->db->where('online', "");

		}

		if(isset($company) && $company != null && $company != 0){
			
			$this->db->where('company', $company);
		}

		if(isset($station) && $station != null && $station != 0){
			
			$this->db->where('station', $station);
		}
		
		if(isset($userType) && $userType != null ){
			
			$this->db->where('acctType', $userType);
		}
		
		$query = $this->db->get('user');

        return $query->result_array();

	}




	
	function validateUserAndGetData($username, $password){

		$password = sha1(md5($password));

		$this->db->where('email', $username);
		// $this->db->where('status !=', "inactive");
		$this->db->where('status !=', "deleted");
		// $this->db->or_where('_email', $username);
		$this->db->where('user_password', $password);
		$query = $this->db->get('user');
		return $query->result_array();
		

	}

 
	// ===================================================settings=============================================
	function getKAT(){

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');


		$this->db->where('company', $coy);
		$this->db->where('station', $stat);
		// $this->db->where('status !=', "deleted");
		$this->db->where('property', "KeepAliveTime");
		$this->db->order_by('config_id', 'DESC');
		$query = $this->db->get('sys_settings',1);
	
		return (count($query->result_array()) > 0) ? $query->result_array() : null ;
	
	}

	function addKAT(){

		
		$new_data = $this->input->post();

		// $new_data["user_password"] = sha1(md5($new_data["user_password"]));
			
	
	
	  $res = $this->db->insert('sys_settings', $new_data);
	  return $res;
	}

	function editKAT(){

		$oldKAT = $this->getKAT();

		// var_dump($oldKAT);

		if($oldKAT){


		$new_data = $this->input->post();

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');


		$this->db->where('company', $coy);
		$this->db->where('station', $stat);

			$this->db->where('property', "KeepAliveTime");		
			$res = $this->db->update('sys_settings', $new_data);
			return $res;
		}
	  	else{
			$res = $this->addKAT();
			// var_dump($res);
			return $res; 
		}
	}
	
	function getPCD(){

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');


		$this->db->where('company', $coy);
		$this->db->where('station', $stat);

		// $this->db->where('status !=', "deleted");
		$this->db->where('property', "PasswordDuration");
		$this->db->order_by('config_id', 'DESC');
		$query = $this->db->get('sys_settings',1);
	
		return (count($query->result_array()) > 0) ? $query->result_array() : null ;
	
	}

	function addPCD(){

		// $new_data = array(
		// 'name'=>$this->input->post('name'), 
		// 'email'=>$this->input->post('email'), 
		// 'password'=>sha1(md5("Password2019@"))
		// );
		$new_data = $this->input->post();

		// $new_data["user_password"] = sha1(md5($new_data["user_password"]));
			
	
	
	  $res = $this->db->insert('sys_settings', $new_data);
	  return $res;
	}

	function editPCD(){

		$oldPCD = $this->getPCD();

		// var_dump($oldPCD);

		if($oldPCD){
			

		$new_data = $this->input->post();

		$coy = $this->session->userdata('company');
		$stat = $this->session->userdata('station');


		$this->db->where('company', $coy);
		$this->db->where('station', $stat);

			$this->db->where('property', "PasswordDuration");		
	  $res = $this->db->update('sys_settings', $new_data);
	  return $res;
		}
		else{
			$res = $this->addPCD();
			// var_dump($res);

			return $res;
		}
	}




	function getRawLogs()
    {
       
        $query = $this->db->get('atgrawdata', 500);

        return $query->result();
    }



	function getControllerbyContId($id){

		$this->db->where('status !=', "deleted");
		$this->db->where('status !=', "inactive");

		$this->db->where('contId', $id);
		
		$query = $this->db->get('device');
	
		return $query->result_array();
	
	}



	function getCalFuelVol($controller = null, $tank = null, $level = null){

		var_dump("calfueltank");
		var_dump($tank);
		var_dump("<br>");

		$devId = (count($this->getControllerbyContId($controller)) ==1) ? $this->getControllerbyContId($controller)[0]['Source_id'] : 0;

		var_dump("calfueldev");
		var_dump($devId);
		var_dump("<br>");


		$this->db->select('tank_id');
		$this->db->where('tank_num', $tank);
		$this->db->where('device_id', $devId);
		$this->db->where('status !=', "inactive");
		$this->db->where('status !=', "deleted");


		// $this->db->where('controller', $controller);
		$result_set = $this->db->get('tank');
		$result_arr = $result_set->result_array();
		// var_dump($result_arr);
		// var_dump($tank);
		
		$tank_id = count($result_arr) > 0 ? $result_arr[0]["tank_id"] : 0;
		
		// var_dump($tank_id);
		// var_dump("asd");


	   $upperLimit = $this->getLimit($level,$tank_id,"upper");
	   $lowerLimit = $this->getLimit($level,$tank_id,"lower");

		$upperLimit = (is_numeric($upperLimit) ? $upperLimit : 0);
		$lowerLimit = (is_numeric($lowerLimit) ? $lowerLimit : 0);


		var_dump("<br/>");
		var_dump($upperLimit);
		var_dump("<br/>");
		var_dump($lowerLimit);
		var_dump("stupper");


		

		var_dump($level);
		var_dump("stlower");
		

		
	 return ($upperLimit + $lowerLimit)/2;
	//  return $result_arr[0];
	}




	function getLimit($level, $tank_id, $method){
			var_dump($level);
		if ($method == "upper"){
			$this->db->select('volume');  
			$this->db->where('dip >'. $level);
			$this->db->where('tank_id', $tank_id);
			$this->db->limit(1);

			$query = $this->db->get('tank_calibration');
			$result_arr = $query->result_array();
			var_dump("start");
			var_dump($result_arr);
			var_dump($tank_id);
			

			if (!empty($result_arr)) {

				$upperLimit = $result_arr[0]["volume"];
			}
			else{
				
				$upperLimit = 0;
		   }

		   return $upperLimit;

		}
		else if ($method == "lower"){
			$this->db->select('volume');  
			$this->db->where('dip <'. $level);
			$this->db->where('tank_id', $tank_id);
			$this->db->order_by('tc_id', 'DESC');
			
			$this->db->limit(1);

			$query = $this->db->get('tank_calibration');
			$result_arr = $query->result_array();
			var_dump("stop");
			var_dump($result_arr);
			var_dump($tank_id);



			if (!empty($result_arr)) {

				$lowerLimit = $result_arr[0]["volume"];
			}
			else{
				
				$lowerLimit = 0;
		   }

		   return $lowerLimit;
		}

	}



	function getTankThreshold($tank,$controller){

		$devId = (count($this->getControllerbyContId($controller)) ==1) ? $this->getControllerbyContId($controller)[0]['Source_id'] : 0;
           
		$this->db->select('threshold');
		$this->db->where('tank_num',$tank);
		$this->db->where('device_id', $devId);
		// $this->db->where('controller',$controller);
		
		$query = $this->db->get('tank');
		$result_arr = $query->result_array();

		// var_dump($result_arr);

		return count($result_arr) > 0 ? $result_arr[0]["threshold"] : 0;


	}




	function getTankReorder($tank,$controller){

		$devId = (count($this->getControllerbyContId($controller)) ==1) ? $this->getControllerbyContId($controller)[0]['Source_id'] : 0;
           
		$this->db->select('rlevel');
		$this->db->where('tank_num',$tank);
		$this->db->where('device_id', $devId);
		// $this->db->where('controller',$controller);
		
		$query = $this->db->get('tank');
		$result_arr = $query->result_array();

		// var_dump($result_arr);

		return count($result_arr) > 0 ? $result_arr[0]["rlevel"] : 0;


	}



	function getCompanyEmailByController($controller = null,$emailType = null){



		if (isset($controller)){

		$controller = (count($this->getController($controller)) ==1) ? $this->getController($controller)[0]['contId'] : 0;


			$this->db->select('(select email from company where company_id = 
			(select company_id from station where station_id = 
			(select statId from device where contId = '.$controller.')))', FALSE);
			$query = $this->db->get('company');

			$result_arr = $query->result_array()[0];

			$keys = array_keys( $result_arr);
			$emails = $result_arr[ $keys[0] ];

			$emails = '{"Emails":'.$emails.'}';

			// $manage = (array) json_decode($emails)->Emails;
			$manage =  json_decode($emails)->Emails;
			$fin = "";
			foreach ($manage as $item) {
			if($emailType != null)
				{
					if($item->id == $emailType){
				$fin = $item->value;
				}
			}

			}
			
			// $manage = key((array)$manage[0]);

			// return $emails[0];
			return $fin;
		}
		else{
			return null;
		}



	}




	function getCompanyByController($controller = null){
                
		$fin = "";
		
		if (isset($controller)){

		$controller = (count($this->getController($controller)) ==1) ? $this->getController($controller)[0]['contId'] : 0;

			$this->db->select('(select name from company where company_id = 
			(select company_id from station where station_id = 
			(select statId from device where contId = '.$controller.')))', FALSE);
			$query = $this->db->get('company');

			$result_arr = $query->result_array()[0];
			$keys = array_keys( $result_arr);
			$fin = $result_arr[ $keys[0] ];
			

			return $fin;
		}
		else{
			return null;
		}

	}




	function getStationByController($controller = null){

		$fin = "";
		
		if (isset($controller)){
			$controller = (count($this->getController($controller)) ==1) ? $this->getController($controller)[0]['contId'] : 0;

			$this->db->select('
			(select name from station where station_id = 
			(select statId from device where contId = '.$controller.'))', FALSE);
			$query = $this->db->get('station');

			$result_arr = $query->result_array()[0];

			$result_arr = $query->result_array()[0];
			$keys = array_keys( $result_arr);
			$fin = $result_arr[ $keys[0] ];
			
			// $manage = key((array)$manage[0]);

			// return $emails[0];
			return $fin;
		}
		else{
			return null;
		}

	}








	function addNotification($message,$coy,$station,$controller,$tank,$type,$severity){

		$notification = array(
			'message'=>$message, 
			'company'=>$coy, 
			'station'=>$station, 
			'controller'=>$controller, 
			'tank'=>$tank, 
			'type'=>$type, 
			'severity'=>$severity);
	
		return $this->db->insert('notifications', $notification);
		// return true;
// =========================================================
	}


	function addDecodedLog($data){

		// $logAuth = $this->authLog($data['id']);
		$logAuth = $this->authLog($data['device_id']);
		
				if($logAuth){
		
					$query = $this->db->insert('logs', $data);
				}
				
				else {
					
					$query = $this->db->insert('noauthlogs', $data);
				}


				// $query = $this->db->insert_id();
				
				return $query;
				
			}
		
		
		
	function deleteRawLog($id){
		
		$query = $this->db->delete('atgrawdata', array('uID' => $id));
		return $query;
		
	}

	function authLog($source_id){

        // $this->db->select('(SELECT count(source.id) FROM source WHERE source.id=$source_id)', FALSE);
        // $query = $this->db->get('source');

        $this->db->select('count(contId) as id_count');
        $this->db->from('device'); 
        $this->db->where('Source_id', $source_id);       
        $query = $this->db->get();

        print_r ($query->result()[0]->id_count);
        $query = $query->result()[0]->id_count;

        $res = false;
        

        if ($query > 0){
            $res = true;
        }

return $res;
    }





	function getStations($company = null){
       

        if (isset($company) && $company != "admin"){
            
            // $company = str_replace(" ","",$company);

            $company =  explode(',', $company);
        //    print_r($company);
            $this->db->select('station_id,name,dpk_threshold,ago_threshold,pms_threshold,company,state');
        
            $this->db->where_in('company', $company);
            $this->db->where('status != "deleted"');
            
            $result = $this->db->get('station');
        $result_arr = $result->result_array();
        
            
        }
        else {
            $this->db->select('station_id,name,dpk_threshold,ago_threshold,pms_threshold,company,state');
            $this->db->where('status != "deleted"');
            
            $query = $this->db->get('station');
            $result_arr = $query->result_array();
        }


        
        return $result_arr;
        
        }







		function getTanksSummary($statId = null){

			if (isset($statId)){

				$this->db->select('t.*');
				$this->db->from('tank t'); 
				$this->db->join('device s', 't.device_id = s.Source_id', 'inner');
				$this->db->join('station st', 's.statId = st.station_id', 'inner');
				$this->db->where('st.station_id',$statId);
		
				$this->db->where('t.status != "deleted"');
				
				$query = $this->db->get(); 

			//     // print_r($query->result_array());
			// $result_arr = $query->result_array();



				$result_arr = json_encode($query->result_array());

				// var_dump($result_arr);

				$fin = "";
				// $manage = key((array)$manage[0]);

				// return $emails[0];
				return $result_arr;
			}
			else{
				return 2;
			}



		}







		function getCurrentData($id = null){
            // select station and controller from tank then use those 2 along with inventory
            //  to filter from log_decoded

            $where['tank_id'] = $id;
            $result_set = $this->db->get_where('tank', $where);
         $result_arr = $result_set->result_array();
        
         $name = $result_arr[0]["tank_num"];
		 $controller = $result_arr[0]["device_id"];
		 
		$controller = (count($this->getController($controller)) ==1) ? $this->getController($controller)[0]['contId'] : 0;


// return $name;
        //    $this->datatables->where('controller like "5%"');
        // var_dump($controller);
        
        if($name != null && $controller != null && $name != "" && $controller != ""){

        $this->db->select('*');
        // $this->db->from('logs');
        $this->db->like('log_decoded', 'Num":"'.$name);
        // $this->db->like('log_decoded', 'Num":"' 03);
        $this->db->like('log_decoded', 'Code":"'.$controller);
		// $this->db->like('log_decoded', 'tankNum":"'.$tank);
		
		$this->db->order_by('id', 'DESC');

        
        $this->db->like('log_decoded', "inventory");

        $query = $this->db->get('logs', 1);
        // $query = $this->db->get('sLogs', 1);

        // $sql = "select * from logs where log_decoded like '%".$name."%' and log_decoded like '%".$controller."%' and log_decoded like '%inventory%'";

        // $query = $this->db->query($sql);

         if ($query->result() != null){

             return $query->result()[0];
         }
        return $query->result();
        }
        return "2";         
		}
		




		function getCompanyEmailByStation($station = null,$emailType = null){

			if (isset($station)){

				$this->db->select('(select email from company where company_id = 
				(select company_id from station where station_id = "'.$station.'"))', FALSE);
				$query = $this->db->get('company');

				$result_arr = $query->result_array()[0];

				$keys = array_keys( $result_arr);
				$emails = $result_arr[ $keys[0] ];

				$emails = '{"Emails":'.$emails.'}';

				// $manage = (array) json_decode($emails)->Emails;
				$manage =  json_decode($emails)->Emails;
				$fin = "";
				foreach ($manage as $item) {
				if($emailType != null)
					{
						if($item->id == $emailType){
					$fin = $item->value;
					}
				}

				}
				
				// $manage = key((array)$manage[0]);

				// return $emails[0];
				return $fin;
			}
			else{
				return null;
			}



		}




	// ======================================small atg=========================
	function synchGet(){
		$remote = $this->load->database('remote', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
	
		$remote->where('status', "");
		$remote->limit(500);
	
		$query = $remote->get('distance_height');
		
		return $query->result_array();
	}
	
	
	// ==============================================
	
	function synchPut($new_data){
		
	
		$res = $this->db->insert('logs', $new_data);
	
		return $res;
	}
	
	// ==============================================
	
	
	function UpdateGet($id){
		
		$remote = $this->load->database('remote', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
	
	
		$data = array(
			'status' => "Synched"
	);
	
	$remote->where('uID', $id);
	$query = $remote->update('distance_height', $data);
	
		return $query;
	
	}


	function getTankByNumCont($num,$controller){
var_dump($num);
var_dump($controller);
		$devId = (count($this->getControllerbyContId($controller)) ==1) ? $this->getControllerbyContId($controller)[0]['Source_id'] : 0;


        $this->db->where('tank_num',$num);
        // $this->db->where('device_id',$controller);
        $this->db->where('device_id',$devId);

		
        $query = $this->db->get('tank', 1);

        return (count($query->result_array())>0) ? $query->result_array()[0] : null;

        }
	// ======================================small atg=========================
	
	// ======================================maint=========================
	
	function getMaints() {
		//  $result_set = $this->db->get('source');
		$this->db->select('maint,tank_num,tank_name,device_id');
		$this->db->where('status != "deleted"');

		
		$query = $this->db->get('tank');
		
				return $query->result();
	 }
	
	
	// ======================================activity Log=========================
	
	public function addActivityLog($arr){

        $this->db->insert('activity_log', $arr);
    }

	// ======================================maint=========================



}

?>
