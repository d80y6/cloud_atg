<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}





 function __construct()
{
	$this->load->database();
	$this->load->model('base_model');

	
	
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}





/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}




// ========================================================================


// if(!function_exists('editDeleteUserBtn'))
// {
//     function editDeleteUserBtn($id,$act)
//     {
// 		$CI = &get_instance();
// 		$this_ = $CI;

// 		$this_->load->helper('url');

// 		$cpurl = base_url().'index.php/editPassword/';

// 		if($act == "" || $act == "yes"){
			
// 			$str = "<i title='View/Edit' class='ion ion-edit text-primary' onclick='edit(".$id.")'> </i> 
// 			<i style='color:grey' title='Change Password' class='ion ion-key'  onclick='editPass(".$id.")' > </i> 
// 			<i title='Delete' class='ion ion-trash-a text-warning' onclick='confirmDelete(".$id.")'> </i>";
// 		}
// 		else{
// 			// <i title='Enable' class='ion ion-checkmark text-secondary' onclick='disable(".$id.")'> </i> 
// 			// <a style='color:grey' href='".$cpurl."'><i title='Change Password' class='ion ion-key' > </i></a> 
// 			$str = "<i title='View/Edit' class='ion ion-edit text-primary' onclick='edit(".$id.")'> </i> 
// 			<i style='color:grey' title='Change Password' class='ion ion-key'  onclick='editPass(".$id.")' > </i> 
// 			<i title='Delete' class='ion ion-trash-a text-warning' onclick='confirmDelete(".$id.")'> </i>";
// 		}

// 		return $str;
// 	}
// }


if(!function_exists('getCoy'))
{
    function getCoy($id)
    {
		$CI = &get_instance();
		$this_ = $CI;

		$this_->load->helper('url');
		$this_->load->model('base_model');

		$coy = $this_->base_model->getCompany($id);

		$str = (count($coy) > 0) ? $coy[0]['name'] : 'No Name';

		

		return $str;
	}
}



if(!function_exists('getStat'))
{
    function getStat($id)
    {
		$CI = &get_instance();
		$this_ = $CI;

		$this_->load->helper('url');
		$this_->load->model('base_model');

		$coy = $this_->base_model->getStation($id);

		$str = (count($coy) > 0) ? $coy[0]['name'] : 'No Name';

		

		return $str;
	}
}


if(!function_exists('controllerMgt'))
{
    function controllerMgt($id,$val)
    {
		$str = $id;
		if($val != null && $id != null){

			$str = $val." (".$id.")";
		}

		return $str;
	}
}


if(!function_exists('companyBtn'))
{
    function companyBtn($id,$status)
    {

		if($status == 'new'){

			// <i class='fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			$str = "<i  class=' fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i> 
			<i class='rem fa fa-check text-secondary' title='Approve' onclick='approve(".$id.")'> </i> 
			<i class='rem fa fa-close text-danger' title='Reject' onclick='toggleApprove(".$id.",0)'> </i> ";
		}
		elseif($status == 'inactive'){
			$str = "<i class=' fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			<i class='rem fa fa-check-square-o text-secondary' title='Enable' onclick='enable(".$id.")'> </i> 
			<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
		}
		else{
			$str = "<i class=' fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
		}

		return $str;
	}
}


if(!function_exists('companyNameMgt'))
{
    function companyNameMgt($coy,$status)
    {

		if($status == 'new'){

			$str = $coy." <span class='badge bg-green pull-right'>New</span>";
		}
		elseif($status == 'inactive'){

			$str = $coy." <span class='badge bg-red pull-right'>Inactive</span>";
		}
		else{
			$str = $coy;
		}

		return $str;
	}
}





if(!function_exists('stationBtn'))
{
    function stationBtn($id,$status)
    {
		
			// $str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			// <i class='fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			// <i class='fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";

			if($status == 'inactive'){
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-check-square-o text-secondary' title='Enable' onclick='enable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}
			else{
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}

		return $str;
	}
}



if(!function_exists('nodeNameMgt'))
{
    function nodeNameMgt($name,$status)
    {

		if($status == 'inactive'){

			$str = $name." <span class='badge bg-red pull-right'>Inactive</span>";
		}
		else{
			$str = $name;
		}

		return $str;
	}
}




if(!function_exists('controllerBtn'))
{
    function controllerBtn($id,$status)
    {
		
			// $str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			// <i class='fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			// <i class='fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			if($status == 'inactive'){
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-check-square-o text-secondary' title='Enable' onclick='enable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}
			else{
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}

		return $str;
	}
}



if(!function_exists('tankBtn'))
{
    function tankBtn($id,$status)
    {
		
			$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i> 
			<i class=' fa fa-qrcode text-default' title='Current Readings' onclick='currData(".$id.")'> </i> 
			<i class='rem fa fa-bar-chart-o text-warning' title='Upload Calibration' onclick='calChart(".$id.")'> </i> 
			";

			if($status == 'inactive'){
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-check-square-o text-secondary' title='Enable' onclick='enable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i> 
				<i class='fa fa-qrcode text-default' title='Current Readings' onclick='currData(".$id.")'> </i> 
				<i class='rem fa fa-bar-chart-o text-warning' title='Upload Calibration' onclick='calChart(".$id.")'> </i> ";
			}
			else{
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i> 
				<i class='fa fa-qrcode text-default' title='Current Readings' onclick='currData(".$id.")'> </i> 
				<i class='rem fa fa-bar-chart-o text-warning' title='Upload Calibration' onclick='calChart(".$id.")'> </i> ";
			}
			

		return $str;
	}
}


if(!function_exists('userBtn'))
{
    function userBtn($id,$status)
    {
		
			// $str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
			// <i class='fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
			// <i class='fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";

			if($status == 'inactive'){
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-check-square-o text-secondary' title='Enable' onclick='enable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}
			else{
				$str = "<i class='fa fa-file-text-o text-primary' title='View/Edit' onclick='edit(".$id.")'> </i> 
				<i class='rem fa fa-ban text-secondary' title='Disable' onclick='disable(".$id.")'> </i> 
				<i class='rem fa fa-trash text-danger' title='Delete' onclick='confirmDelete(".$id.")'> </i>";
			}

		return $str;
	}
}


if(!function_exists('linkToCoy'))
{
    function linkToCoy($fname,$coy)
    {
		
			// $str = ""$fname;
			$str =  '<a href="'.base_url().'index.php/companymgt/'.$coy.'" title="View Companies">'.$fname.'</a>';


		return $str;
	}
}


if(!function_exists('linkToStat'))
{
    function linkToStat($name,$stat)
    {
		
			// $str = ""$fname;
			$str =  '<a href="'.base_url().'index.php/stationmgt/'.$stat.'" title="View Stations">'.$name.'</a>';


		return $str;
	}
}


if(!function_exists('linkToDev'))
{
    function linkToDev($name,$dev)
    {
		
			// $str = ""$fname;
			$str =  '<a href="'.base_url().'index.php/controllermgt/'.$dev.'" title="View Devices">'.$name.'</a>';


		return $str;
	}
}


if(!function_exists('linkToTank'))
{
    function linkToTank($name,$tank)
    {
		
			// $str = ""$fname;
			$str =  '<a href="'.base_url().'index.php/tankmgt/'.$tank.'" title="View Tanks">'.$name.'</a>';


		return $str;
	}
}


if(!function_exists('linkToLogs'))
{
    function linkToLogs($name,$usr)
    {
		
			// $str = ""$fname;
			$str =  '<a href="'.base_url().'index.php/actLog/'.$usr.'" title="View Logs">'.$name.'</a>';


		return $str;
	}
}





if(!function_exists('concatName'))
{
    function concatName($fname,$lname)
    {
		
			$str = $lname." ".$fname;

		return $str;
	}
}


if(!function_exists('stat'))
{
    function stat($stat)
    {
		
			$str = ($stat) ? $stat : "Active";

		return $str;
	}
}

if(!function_exists('acct'))
{
    function acct($type)
    {

		$str = null;
		switch ($type) {
			case "admin":
				$str = "Admin";
				break;
			case "companyAdmin":
				$str = "Company Admin";
				break;
			case "stationAdmin":
				$str = "Station Admin";
				break;
			case "regUser":
				$str = "Regular Super User";
				break;
			case "regCoyUser":
				$str = "Regular Company User";
				break;
			case "regStatUser":
				$str = "Regular Station User";
				break;
			default:
				// echo "Not Found";
				$str = "Not Found";

		}
			// $str = ($stat == "") ? $stat : "Active";

		return $str;
	}
}



if(!function_exists('getstatName'))
{
    function getstatName($stat)
    {
		
			// $str = ($stat) ? $stat : "Active";
			$CI = &get_instance();
			$this_ = $CI;

			$res = count($this_->base_model->getStation($stat)) > 0 ? ucfirst($this_->base_model->getStation($stat)[0]['name']) : "Not Found";

			if($stat == 0){
				$res = "";
			}



		return $res;
	}
}

if(!function_exists('getcoyName'))
{
    function getcoyName($coy)
    {
		
		$CI = &get_instance();
		$this_ = $CI;

		$res = count($this_->base_model->getCompany($coy)) > 0 ? ucfirst($this_->base_model->getCompany($coy)[0]['name']) : "Not Found";

		if($coy == 0){
			$res = "Admin";
		}

	return $res;
		// return $str;
	}
}


if(!function_exists('notificationMgt'))
{
    function notificationMgt($coy)
    {
		
	// 	$CI = &get_instance();
	// 	$this_ = $CI;

	// 	$data = array(
	// 		'closed' => 'Yes'
	// 	 );
		 
	// 	 // $this->db->replace('source', $data);
	// 	 $this_->db->where('notification_id', $coy);
	// 	 $res = $this_->db->update('notifications', $data);


	// return $res;

	$str = "<i class='rem fa fa-close text-danger' title='Close' onclick='deleteNotification(".$coy.")'> </i> ";
	
		return $str;


	}
}

if(!function_exists('numbForm'))
{
    function numbForm($num)
    {
		
	$str = is_numeric($num) ? number_format($num): $num;
	
		return $str;


	}
}






?>
