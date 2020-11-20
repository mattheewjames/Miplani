<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Validation extends MY_Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
   	}
 	public function index()
	{
  		$id = $this->input->get('id', TRUE);
		if(is_numeric($id))
		{
			$id = $id;
 		}
		else
		{
			$id =  base64_decode($this->input->get('id', TRUE));
 			if(!empty($_POST['type']))
			{
				$get_type =  base64_decode($this->input->get('type', TRUE));
				if($get_type=='faq')
				{
					$id = 6;
				}
				elseif($get_type=='reviews')
				{
					$id = 8;
				}
				elseif($get_type=='review image')
				{
					$id = 9;
				}
				elseif($get_type=='state')
				{
					$id = 12;
				}
				elseif($get_type=='city')
				{
					$id = 15;
				}
				elseif($get_type=='Service')
				{
					$id = 18;
				}
			}
 		}
		switch($id)
		{
  			case 1: $this->change_password_validation(); break;
			case 2: $this->update_profile_validation(); break;
			case 3: $this->system_settings_validation(); break;
 			case 4: $this->add_faq_validation(); break;
			case 5: $this->update_faq_validation(); break;
			case 6: $this->delete_faq_validation(); break;
			case 7: $this->update_review_validation(); break;
			case 8: $this->delete_review_validation(); break;
			case 9: $this->delete_review_image_validation(); break;	
			case 10: $this->add_state_validation(); break;
			case 11: $this->update_state_validation(); break;	
			case 12: $this->delete_state_validation(); break;	
			case 13: $this->add_city_validation(); break;
			case 14: $this->update_city_validation(); break;	
			case 15: $this->delete_city_validation(); break;	
  			case 16: $this->add_service_validation(); break;
			case 17: $this->update_service_validation(); break;	
			case 18: $this->delete_service_validation(); break;	
      		default: echo "Default"; break;
		}
 	}
	
 	/*==================Setting validation===========================*/
	public function system_settings_validation()
	{
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('setting_email', '', 'trim|required|callback_check_email',
			array('required' => 'Please enter email' )
		);
		$this->form_validation->set_rules('setting_phone_number', '', 'trim|required|callback_check_phone_number',
			array('required' => 'Please enter phone number')
		);
		$this->form_validation->set_rules('setting_address', '', 'trim|required',
			array('required' => 'Please enter address')
		);
		$this->form_validation->set_rules('facebook_url', '', 'trim|required|callback_check_fb_url',
			array('required' => 'Please enter facebook url')
		);
 		$this->form_validation->set_rules('instagram_url', '', 'trim|required|callback_check_instagram_url',
			array('required' => 'Please enter instagram url')
		);
   		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_setting_m","setting");
 			$this->setting->save_system_setting();
 			echo 'done-SEPARATOR-save-SEPARATOR-'.base_admin_url('setting');
 		}
   	}
	public function update_profile_validation()
	{
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('username', '', 'trim|required|callback_check_login_username',
			array('required' => 'Please enter login user name' )
		);
 		$this->form_validation->set_rules('user_email', '', 'trim|required|callback_check_login_user_email',
			array('required' => 'Please enter email' )
		);
		$this->form_validation->set_rules('user_full_name', '', 'trim|required',
			array('required' => 'Please enter full name')
		);
   		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_user_m","user");
 			$this->user->update_user_profile();
 			echo 'done-SEPARATOR-save-SEPARATOR-'.base_admin_url('setting/profile');
 		}
   	}
	public function change_password_validation()
	{
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('old_password', '', 'trim|required|callback_check_user_password',
				array('required' => 'Please enter current password')
		);
		$this->form_validation->set_rules('new_password', '', 'trim|required|min_length[8]|max_length[25]|callback_check_password_strength',
			array(
					'required' => 'Please enter new password',
					'min_length' => 'New password must have minimum 8 characters or numbers',
					'max_length' => 'New password must have maximum 25 characters or numbers',
				 )
		);
		$this->form_validation->set_rules('confirm_password', '', 'trim|required|matches[new_password]',
				array(
					'required' => 'Please enter confirm password',
					'matches' => 'New password and confirm password not match'
				 )
		);
   		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_user_m","user");
 			$this->user->update_user_password();
 			echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/Changepassword');
 		}
   	}
	/*==================States & Cities validation===========================*/
	protected function add_faq_validation()
	{
 		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('question', '', 'trim|required',
			array('required' => 'Please enter question')
		);
 		$this->form_validation->set_rules('answer', '', 'trim|required',
			array(
				'required' => 'Please enter answer',
 			 )
		);
   		if($this->form_validation->run() == FALSE)
		{
				echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_setting_m","setting");
			$this->setting->add_faq();
  			echo 'done-SEPARATOR-add-SEPARATOR-'.base_admin_url('setting/Faq');
  		}
	}
 	protected function update_faq_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('update_id', '', 'trim|required|callback_check_faq_record',
			array('required' => 'Please select valid faq to continue')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			 $this->form_validation->set_rules('question', '', 'trim|required',
				array('required' => 'Please enter question')
			);
			$this->form_validation->set_rules('answer', '', 'trim|required',
				array('required' => 'Please enter answer')
			);
			if($this->form_validation->run() == FALSE)
			{
					echo validation_errors();
			}
			else
			{
				$this->load->model("Admin_setting_m","setting");
				$this->setting->update_faq();
				echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/Faq');
			}
		}
	}
	protected function delete_faq_validation()
	{
		$this->load->model("Admin_setting_m","setting");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
 				if($this->setting->check_faq_record($id)>0)
				{
					$this->setting->delete_faq($id);
					echo 'done';
				}
				else
				{
					echo "Please select valid record to continue";	
				}
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
 	/*==================States & Cities validation===========================*/
	protected function add_state_validation()
	{
 		$this->form_validation->set_error_delimiters('', '');
 		$this->form_validation->set_rules('state_name', '', 'trim|required|callback_check_state_name',
			array('required' => 'Please enter state name')
		);
		if($this->form_validation->run() == FALSE)
		{
				echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_setting_m","setting");
			$this->setting->add_state();
  			echo 'done-SEPARATOR-add-SEPARATOR-'.base_admin_url('setting/States');
  		}
	}
	protected function update_state_validation()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('update_id', '', 'trim|required|callback_check_state_record',
			array('required' => 'Please select valid state to continue')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			 $this->form_validation->set_rules('state_name', '', 'trim|required|callback_check_update_state_name',
				array('required' => 'Please enter state name')
			);
			if($this->form_validation->run() == FALSE)
			{
					echo validation_errors();
			}
			else
			{
				$this->load->model("Admin_setting_m","setting");
				$this->setting->update_state();
				echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/States');
			}
		}
	}
	protected function delete_state_validation()
	{
		$this->load->model("Admin_setting_m","setting");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
				if($this->setting->check_state_record($id)>0)
				{
					if($this->setting->count_state_cities($id)<1)
					{
						if($this->setting->count_sp_in_state($id)<1)
						{
							$this->setting->delete_state($id);
							echo 'done';
						}
						else
						{
							echo "This state can't be deleted, because some service providers belong to this state";
						}
					}
					else
					{
						echo "This state can't be deleted, because some cities belongs to this state";
					}
				}
				else
				{
					echo "Please select valid record to continue";	
				}
				
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
	protected function add_city_validation()
	{
 		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('city_name', '', 'trim|required|callback_check_add_city_name',
			array('required' => 'Please enter city name')
		);
		$this->form_validation->set_rules('state_id', '', 'trim|required|callback_check_state_id',
			array('required' => 'Please select state')
		);
		if($this->form_validation->run() == FALSE)
		{
				echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_setting_m","setting");
			$this->setting->add_city();
  			echo 'done-SEPARATOR-add-SEPARATOR-'.base_admin_url('setting/Cities');
  		}
	}
	protected function update_city_validation()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('update_id', '', 'trim|required|callback_check_city_record',
			array('required' => 'Please select valid city to continue')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->form_validation->set_rules('city_name', '', 'trim|required|callback_check_update_city_name',
				array('required' => 'Please enter city name')
			);
			$this->form_validation->set_rules('state_id', '', 'trim|required|callback_check_state_id',
				array('required' => 'Please select state')
			); 
			if($this->form_validation->run() == FALSE)
			{
					echo validation_errors();
			}
			else
			{
				$this->load->model("Admin_setting_m","setting");
				$this->setting->update_city();
				echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/Cities');
			}
		}
	}
	protected function delete_city_validation()
	{
		$this->load->model("Admin_setting_m","setting");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
				if($this->setting->check_city_record($id)>0)	
				{
					if($this->setting->count_sp_in_city($id)<1)	
					{
						$this->setting->delete_city($id);
						echo 'done';
					}
					else
					{
 						echo "This city can't be deleted, because some service providers belong to this city";
					}
				}
				else
				{
					echo "Please select valid record to continue";	
				}
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
	/*==================Reviews Functions===========================*/
	protected function update_review_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('update_id', '', 'trim|required|callback_check_review_record',
			array('required' => 'Please select valid review to continue')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->form_validation->set_rules('general_rating', '', 'trim|required',array('required' => 'Please select general rating'));
			$this->form_validation->set_rules('services_rating', '', 'trim|required',array('required' => 'Please select services rating'));
			$this->form_validation->set_rules('app_rating', '', 'trim|required',array('required' => 'Please select availability of appointment rating')); 
			$this->form_validation->set_rules('price_rating', '', 'trim|required',array('required' => 'Please select price rating')); 
			$this->form_validation->set_rules('review_title', '', 'trim|required',array('required' => 'Please enter review title'));
			$this->form_validation->set_rules('review_description', '', 'trim|required',array('required' => 'Please enter review detail'));
			$this->form_validation->set_rules('review_images[]', '', 'callback_check_review_images');
			if($this->form_validation->run() == FALSE)
			{
					echo validation_errors();
			}
			else
			{
				$this->load->helper('file');
				$upload_folder = FCPATH.'uploads';
				$target_folder = FCPATH.'uploads/sp-reviews-images';
				if(!file_exists($upload_folder)) 
				{
					mkdir($upload_folder, 0777, true);
				}
				if(!file_exists($target_folder)) 
				{
					mkdir($target_folder, 0777, true);
				}
				$config['upload_path']   = $target_folder.'/';
				$config['allowed_types'] = '*';

				if(!empty($_FILES['review_images']))
				{
					for($i=0;$i<sizeof($_FILES['review_images']['tmp_name']);$i++)
					{
						$j= $i+1;
						$time = time().$j;
						$_FILES['image']['name'] = $_FILES['review_images']['name'][$i];
						$_FILES['image']['type'] = $_FILES['review_images']['type'][$i];
						$_FILES['image']['tmp_name'] = $_FILES['review_images']['tmp_name'][$i];
						$_FILES['image']['error'] = $_FILES['review_images']['error'][$i];
						$_FILES['image']['size'] = $_FILES['review_images']['size'][$i];
						$new_name = $this->session->userdata('MiPlani_user_id').$time.$_FILES['review_images']['name'][$i];
						 // File upload configuration
						$config['upload_path'] = $target_folder.'/';
						$config['allowed_types'] = '*';
						$config['file_name'] = $new_name;
						// Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						// Upload file to server
						if($this->upload->do_upload('image'))
						{
							// Uploaded file data
							$fileData = $this->upload->data();
							$uploadData[$i]['file_name'] = $fileData['file_name'];
						}
					}
				}

				if(!empty($uploadData))
				{
					$this->reviews->update_review($uploadData);
				}
				else
				{
					$this->reviews->update_review();
				}
					
				echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('reviews');
			}
		}
	}
	protected function delete_review_validation()
	{
		$this->load->model("Reviews_m","reviews");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
 				if($this->reviews->check_review_record($id)>0)
				{
					$target_folder = FCPATH.'uploads/sp-reviews-images';
					$review_images_list = $this->reviews->get_review_images_list($id);
					if(!empty($review_images_list))
					{
						foreach($review_images_list as $img_list)
						{
							echo $img_name = $img_list->img_name;
							if(!empty($img_name))
							{
								@unlink($target_folder.'/'.$img_name);
							}
						}
					}
					$this->reviews->delete_review($id);
					echo 'done';
				}
				else
				{
					echo "Please select valid record to continue";	
				}
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
	protected function delete_review_image_validation()
	{
		$this->load->model("Reviews_m","reviews");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
				$review_image_row = $this->reviews->get_review_image_row($id);
 				if(!empty($review_image_row))
				{
					$target_folder = FCPATH.'uploads/sp-reviews-images';
					@unlink($target_folder.'/'.$review_image_row->img_name);
					$this->reviews->delete_review_image($id);
					echo 'done';
				}
				else
				{
					echo "Please select valid record to continue";	
				}
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
	/*==================Services Functions===========================*/
 	protected function add_service_validation()
	{
  		$this->form_validation->set_error_delimiters('<li>', '</li>');
 		$this->form_validation->set_rules('service_name', '', 'trim|required|callback_check_service_name',
			array('required' => 'Please enter service name')
		);
		$this->form_validation->set_rules('service_icon', '', 'callback_check_service_icon');
		if($this->form_validation->run() == FALSE)
		{
				echo validation_errors();
		}
		else
		{
			$this->load->model("Admin_setting_m","setting");
 			$this->load->helper('file');
			$upload_folder = FCPATH.'uploads';
			$target_folder = FCPATH.'uploads/services-icons';
			if(!file_exists($upload_folder)) 
			{
				mkdir($upload_folder, 0777, true);
			}
			if(!file_exists($target_folder)) 
			{
				mkdir($target_folder, 0777, true);
			}
 			$config['upload_path']   = $target_folder.'/';
			$config['allowed_types'] = '*';
			$new_name = 'equ-service-'.time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('service_icon'))
			{
 				$uploadData = $this->upload->data();
				$uploadedFile = $uploadData['file_name'];
				//Resize after upload start
				$config['image_library'] = 'gd2'; 
				$config['source_image'] = $target_folder.'/'.$uploadData["file_name"]; 
				$config['create_thumb'] = FALSE; 
				$config['maintain_ratio'] = FALSE; 
				$config['quality'] = '60%'; 
				$config['width'] = 16; 
				$config['height'] = 16; 
				$config['new_image'] = $target_folder.'/'.$uploadData["file_name"]; 
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				//Resize after upload end
				$this->setting->add_service($uploadedFile);
				echo 'done-SEPARATOR-add-SEPARATOR-'.base_admin_url('setting/Services');
 			}
 			else
			{
				$this->setting->add_service();
				echo 'done-SEPARATOR-add-SEPARATOR-'.base_admin_url('setting/Services');
			}
  			
  		}
	}
 	protected function update_service_validation()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('update_id', '', 'trim|required|callback_check_service_record',
			array('required' => 'Please select valid service record to continue')
		);
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			 $this->form_validation->set_rules('service_name', '', 'trim|required|callback_check_update_service_name',
				array('required' => 'Please enter service name')
			);
			if(isset($_FILES['service_icon']['name']) && $_FILES['service_icon']['name']!="")
			{
				$this->form_validation->set_rules('service_icon', '', 'callback_check_service_icon');
			}
			if($this->form_validation->run() == FALSE)
			{
					echo validation_errors();
			}
			else
			{
  				$this->load->model("Admin_setting_m","setting");
				$this->load->helper('file');
				$upload_folder = FCPATH.'uploads';
				$target_folder = FCPATH.'uploads/services-icons';
				if(!file_exists($upload_folder)) 
				{
					mkdir($upload_folder, 0777, true);
				}
				if(!file_exists($target_folder)) 
				{
					mkdir($target_folder, 0777, true);
				}
				$config['upload_path']   = $target_folder.'/';
				$config['allowed_types'] = '*';
				$new_name = 'equ-service-'.time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('service_icon'))
				{
					$service_id = base64_decode($this->input->post('update_id'));
					$service_row = $this->setting->get_service_row($service_id);
					if(!empty($service_row))
					{
						if(!empty($service_row->service_icon))
						{
							@unlink($target_folder.'/'.$service_row->service_icon);
						}
					}
					$uploadData = $this->upload->data();
					$uploadedFile = $uploadData['file_name'];
					//Resize after upload start
					$config['image_library'] = 'gd2'; 
					$config['source_image'] = $target_folder.'/'.$uploadData["file_name"]; 
					$config['create_thumb'] = FALSE; 
					$config['maintain_ratio'] = FALSE; 
					$config['quality'] = '60%'; 
					$config['width'] = 16; 
					$config['height'] = 16; 
					$config['new_image'] = $target_folder.'/'.$uploadData["file_name"]; 
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->clear();
					//Resize after upload end
					$this->setting->update_service($uploadedFile);
					echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/Services');
				}
				else
				{
					$this->setting->update_service();
					echo 'done-SEPARATOR-update-SEPARATOR-'.base_admin_url('setting/Services');
				}
			}
		}
	}
	protected function delete_service_validation()
	{
		$this->load->model("Admin_setting_m","setting");
  		if(!empty($_POST['ids']))
		{
			$id = base64_decode($this->input->post('ids'));
			if($id>0)
			{
				$row = $this->setting->get_service_row($id);
 				if(!empty($row))
				{
					$service_icon = $row->service_icon;
					if(!empty($service_icon))
					{
						$target_folder = FCPATH.'uploads/services-icons/';
						@unlink($target_folder.$service_icon);
					}
					$this->setting->delete_service($id);
					echo 'done';
				}
				else
				{
					echo "Please select valid record to continue";	
				}
 			}
			else
			{
				echo "Please select valid record to continue";
			}
		}
		else
		{
			echo "Please select valid record to continue";	
		}
 	}
	/*==================Common CallBack Functions===========================*/
 	public function check_password()
    {
		if(!empty($_POST['customer_password']))
		{
			$password = $this->input->post('customer_password');
		}
		elseif(!empty($_POST['user_password']))
		{
			$password = $this->input->post('user_password');
		}
		elseif(!empty($_POST['password']))
		{
			$password = $this->input->post('password');
		}
		else
		{
			$password = '';
		}
        if(!empty($password))
		{
  			$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
			
 			$total_upper_case = strlen(preg_replace('![^A-Z]+!', '', $password));
			$total_lower_case = strlen(preg_replace('![^a-z]+!', '', $password));
			$total_number =strlen(preg_replace('![^0-9]+!', '', $password));
			$total_special_characters = 0;
			if(preg_match($pattern,$password))
			{
				$total_special_characters = 1;	
			}
 			if($total_upper_case<1) // lacking uppercase characters
			{
 				$this->form_validation->set_message('check_password', 'Password must contain at least one uppercase character(A-Z)');
				return FALSE;
			}
			elseif($total_lower_case<1) // lacking lowercase characters
			{
 				$this->form_validation->set_message('check_password', 'Password must contain at least one lowercase character(a-z)');
				return FALSE;
			}
			elseif($total_number<1) //  lacking numbers
			{
 				$this->form_validation->set_message('check_password', 'Password must contain at least one number(0-9)');
				return FALSE;
			}
			elseif($total_special_characters<1) //  lacking Special characters
			{
 				$this->form_validation->set_message('check_password', 'Password must contain at least one special character');
				return FALSE;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
    }
 	public function check_user_password()
	{
		$this->load->model("Admin_user_m","user");
		if(!empty($this->session->userdata('MiPlani_admin_id')))
		{
			$user_id = $this->session->userdata('MiPlani_admin_id');
		}
		else
		{
			$user_id = 0;
		}
		if($this->user->check_user_password($user_id,$this->input->post('old_password'))<1)
		{
			$this->form_validation->set_message('check_user_password', 'please enter valid current password');
			return FALSE;
		}
 		else
		{
			return TRUE;
		}
	}
	
	public function check_password_strength()
	{
		if(!empty($_POST['new_password']))
		{
			$user_password = $this->input->post('new_password');
		}
		elseif(!empty($_POST['user_password']))
		{
			$user_password = $this->input->post('user_password');
		}
		elseif(!empty($_POST['password']))
		{
			$user_password = $this->input->post('password');
		}
		else
		{
			$user_password = '';
		}
		if(!empty($user_password))
		{
			$response_msg = check_password_strength($user_password);
			if(empty($response_msg) || $response_msg=='success')
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_password_strength', $response_msg);
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
 	public function check_faq_record()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['update_id'])
		{
			$faq_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_faq_record($faq_id)<1)
			{
				$this->form_validation->set_message('check_faq_record', 'Please select valid record!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
    public function check_email()
    {
		$email = '';
 		if(!empty($_POST['setting_email']))
		{
			$email = trim($this->input->post('setting_email', TRUE));
 		}
		elseif(!empty($_POST['user_email']))
		{
			$email = trim($this->input->post('user_email', TRUE));
 		}
 		if(!empty($email))
		{
 			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$this->form_validation->set_message('check_email', 'Please enter valid email');
				return FALSE;
			}
 			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;	
		}
    } 
	 
	public function check_login_username()
    {
		if(!empty($this->session->userdata('MiPlani_admin_id')))
		{
			if(!empty($_POST['username']))
			{
				$this->load->model("Admin_user_m","user");
 				if( $this->input->post('username') !== str_replace(' ','',$this->input->post('username')) )
				{
 					$this->form_validation->set_message('check_login_username', 'Please enter login user name without spaces');
					return FALSE;
				}
 				elseif($this->user->check_user_name_email_record('update','username',$this->input->post('username'),$this->session->userdata('MiPlani_admin_id')))
				{
					$this->form_validation->set_message('check_login_username', 'This login user name is already exist');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
			else
			{
				return TRUE;	
			}
		}
		else
		{
			return TRUE;	
		}
    } 
	public function check_login_user_email()
    {
		if(!empty($this->session->userdata('MiPlani_admin_id')))
		{
			$this->load->model("Admin_user_m","user");
			if(!empty($_POST['user_email']))
			{
				$email = trim($this->input->post('user_email', TRUE));
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$this->form_validation->set_message('check_login_user_email', 'Please enter valid email');
					return FALSE;
				}
				elseif($this->user->check_user_name_email_record('update','user_email',$email,$this->session->userdata('MiPlani_admin_id')))
				{
					$this->form_validation->set_message('check_login_user_email', 'This email is already exist');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
			else
			{
				return TRUE;	
			}
		}
		else
		{
			return TRUE;	
		}
    } 
	public function check_phone_number()
	{
		if(!empty($_POST['setting_phone_number']))
		{
			$phone_number = trim($this->input->post('setting_phone_number'));
		}
 		else
		{
			$phone_number = '';
		}
		if(!empty($phone_number))
		{
			$response_msg = check_phone_number($phone_number);
			if(empty($response_msg) || $response_msg=='success')
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_phone_number', $response_msg);
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
 	public function check_fb_url()
	{
 		if(!empty($_POST['facebook_url']))
		{
			$msg = 'Please enter valid facebook url like https://www.facebook.com/';
 			return $this->check_url($this->input->post('facebook_url'),$msg,'check_fb_url');
		}
	}
	public function check_twitter_url()
	{
		if(!empty($_POST['twitter_url']))
		{
			$msg = 'Please enter valid twitter url like https://www.twitter.com/';
 			return $this->check_url($this->input->post('twitter_url'),$msg,'check_twitter_url');
		}
	}
	public function check_instagram_url()
	{
		if(!empty($_POST['instagram_url']))
		{
			$msg = 'Please enter valid instagram url like https://www.instagram.com/';
 			return $this->check_url($this->input->post('instagram_url'),$msg,'check_instagram_url');
		}
	}
 	public function check_url($url,$msg,$call_back_function_name)
    {
   		if(!empty($url) && !empty($msg) && !empty($call_back_function_name))
		{
 			if(!filter_var($url, FILTER_VALIDATE_URL))
			{
				$this->form_validation->set_message($call_back_function_name, $msg);
				return FALSE;
			}
 			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;	
		}
    } 
	public function check_review_record()
	{
 		$this->load->model("Reviews_m","reviews");
		if($_POST['update_id'])
		{
			echo $review_id = base64_decode($this->input->post('update_id'));
			if($this->reviews->check_review_record($review_id)<1)
			{
				$this->form_validation->set_message('check_review_record', 'Please select valid record!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_review_images()
	{
  		if(!empty($_FILES['review_images']['name']))
		{
			$allowed_size = 5.1;
			$allowed_file_extension = array('png', 'jpg','jpeg','gif');
			$type_error = 0;
			$size_error = 0;
			$type_error_msg = "";
			$size_error_msg = "";
  			for($i=0;$i<sizeof($_FILES['review_images']['name']);$i++)
			{
				$j = $i+1;
				$image = $_FILES['review_images']['name'][$i];	
				if(!empty($image))
				{
					$File_extension  = strtolower(substr($_FILES['review_images']['name'][$i], strrpos($_FILES['review_images']['name'][$i], '.')+1));
					$get_file_size = filesize($_FILES['review_images']['tmp_name'][$i]);
					$current_file_size = (($get_file_size/1024)/1024);
					if(!in_array($File_extension,$allowed_file_extension))
					{
						$type_error = 1;
						$type_error_msg = "Please upload png, jpg, gif image for image instead of ".$_FILES['review_images']['name'][$i];
 						break; 
					}
					else
					{
						if(($allowed_size < $current_file_size) || $get_file_size=='')
						{
							$size_error = 1;
							$size_error_msg = "Please upload max 5MB image for image instead of ".$_FILES['review_images']['name'][$i];
 							break; 
						}
 					}
				}
			}
			
			if($type_error==1)
			{
				$this->form_validation->set_message('check_review_images', $type_error_msg);
				return FALSE;
			}
			elseif($size_error==1)
			{
				$this->form_validation->set_message('check_review_images', $size_error_msg);
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	public function check_state_record()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['update_id'])
		{
			$state_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_state_record($state_id)<1)
			{
				$this->form_validation->set_message('check_state_record', 'Please select valid record!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_state_id()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['state_id'])
		{
			$state_id = $this->input->post('state_id');
			if($this->setting->check_state_record($state_id)<1)
			{
				$this->form_validation->set_message('check_state_id', 'Please select valid state!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_state_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if(!empty($_POST['state_name']))
		{
			if($this->setting->check_state_name($this->input->post('state_name'))>0)
			{
				$this->form_validation->set_message('check_state_name', 'This state name already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
 		else
		{
			return TRUE;
		}
	}
	public function check_update_state_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if(!empty($_POST['state_name']) && !empty($_POST['update_id']))
		{
			$state_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_update_state_name($this->input->post('state_name'),$state_id)>0)
			{
				$this->form_validation->set_message('check_update_state_name', 'This state name already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
 		else
		{
			return TRUE;
		}
	}
	public function check_add_city_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if(!empty($_POST['city_name']) && !empty($_POST['state_id']))
		{
			if($this->setting->check_add_city_name($this->input->post('city_name'),$this->input->post('state_id'))>0)
			{
				$this->form_validation->set_message('check_add_city_name', 'This city name already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
 		else
		{
			return TRUE;
		}
	}
	public function check_update_city_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if(!empty($_POST['city_name']) && !empty($_POST['state_id']) && !empty($_POST['update_id']))
		{
 			$city_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_update_city_name($this->input->post('city_name'),$this->input->post('state_id'),$city_id)>0)
			{
				$this->form_validation->set_message('check_update_city_name', 'This city name already exists!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
 		else
		{
			return TRUE;
		}
	}
	public function check_city_record()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['update_id'])
		{
			$city_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_city_record($city_id)<1)
			{
				$this->form_validation->set_message('check_city_record', 'Please select valid record!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_update_service_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if(!empty($_POST['service_name']) &&  !empty($_POST['update_id']))
		{
 			$service_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_update_service_name($this->input->post('service_name'),$service_id)>0)
			{
				$this->form_validation->set_message('check_update_service_name', 'This service name already exist!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
 		else
		{
			return TRUE;
		}
	}
	public function check_service_name()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['service_name'])
		{
			$service_name = $this->input->post('service_name');
 			if($this->setting->check_service_name($service_name)>0)
			{
				$this->form_validation->set_message('check_service_name', 'This service name already exist!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_service_record()
	{
 		$this->load->model("Admin_setting_m","setting");
		if($_POST['update_id'])
		{
			$service_id = base64_decode($this->input->post('update_id'));
			if($this->setting->check_service_record($service_id)<1)
			{
				$this->form_validation->set_message('check_service_record', 'Please select valid record!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function check_service_icon()
	{
		if(isset($_FILES['service_icon']['name']) && $_FILES['service_icon']['name']!="")
		{
			$allowed_size = 10.1;
			$allowed_file_extension = array('png', 'jpg','jpeg','gif');
			$File_extension  = strtolower(substr($_FILES['service_icon']['name'], strrpos($_FILES['service_icon']['name'], '.')+1));
			$get_file_size = filesize($_FILES["service_icon"]['tmp_name']);
			$current_file_size = (($get_file_size/1024)/1024);
			if(!in_array($File_extension,$allowed_file_extension))
			{
				$this->form_validation->set_message('check_service_icon', "Please upload png, jpg, gif format service icon only");
				return FALSE;
			}
			else
			{
				if(($allowed_size < $current_file_size) || $get_file_size=='')
				{
					$this->form_validation->set_message('check_service_icon', "Please upload service icon upto max 10 MB");
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
		}
		else
		{
 			$this->form_validation->set_message('check_service_icon', "Please upload service icon");
			return FALSE;
		}
 	}
 }