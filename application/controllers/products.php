<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('template');
    }
    
	public function index()
	{ 
    $id = (!empty($_GET['id']))? strip_tags($_GET['id']): "";
    if(!$id) 
		  $this->home();
    else
      $this->prod_detail();
	}
  function home(){
    $this->load->model("get_db"); 
    
    if(!empty($_GET['cat'])){
      //$cat = strip_tags($_GET['cat']);
      $data['cat'] = strip_tags($_GET['cat']);
      $data['title'] = ucfirst(str_replace('_',' ', $data['cat']));       
      $data['sub_cat_menu'] = $this->sub_category($this->get_db->get_items('categories', 'main', $data['cat'])); 
     
      if(!empty($_GET['sub'])){
        $data['sub'] = strip_tags($_GET['sub']); 
        $data['prod'] = ($this->input->post('sort_submit'))? $this->prod_sort('sub', $data['sub']) : $this->get_db->get_items('tovar', 'sub', $data['sub']);       //pokial bol submitnuty formular sort, tak sorti, inak default
      }
      else 
        $data['prod'] = ($this->input->post('sort_submit'))? $this->prod_sort('category', $data['cat']) : $this->get_db->get_items('tovar', 'category', $data['cat']);     //pokial bol submitnuty formular sort, tak sorti, inak default
    
    }else
      $data['title'] = "Products";
    
    
    $this->template->write_view('content', 'view_prod', $data); 
    $this->template->render();
  }
  function sub_category($source){
    foreach($source as $val){
      $string = $val->sub;
    }
    if(isset($string))
      return explode(',', $string);
    
    return "";
  }  
  
  function prod_sort($prop, $val){
    $sort_set = strip_tags($this->input->post('sort'));
    if(isset($sort_set))
      return $this->get_db->get_items_sorted($sort_set, $prop, $val);    
  }

  function add_sub(){
    $this->load->model('get_db');
    $cat = strip_tags($this->input->post('cat'));
    $name = strtolower(strip_tags($this->input->post('sub_name')));
    
    if(isset($cat) && isset($name)){
      $new_menu = implode(',', $this->input->post('sub_menu')) . ',' .$name;
      if($this->get_db->update_submenu($cat, $new_menu))
        redirect('/products?cat='.$cat);
    }
  }
  function add_new_product(){
    $this->load->model('prod_mod');
    $this->load->library('form_validation');
    $config = array(
                array(
                  'field' => 'name', 'label' => 'Name', 'rules' => 'required|min_length[3]|max_length[40]|xss_clean|trim'      
                ) ,
                array(
                  'field' => 'cat', 'label' => 'Category', 'rules' => 'required|min_lenghth[3]|max_length[20]|xss_clean|trim'   
                )
                ,array(
                  'field' => 'sub', 'label' => 'Sub category', 'rules' => 'required|min_lenghth[5]|max_length[30]|xss_clean|trim'    
                )
                ,array(
                  'field' => 'item_label', 'label' => 'Item Label', 'rules' => 'required|min_lenghth[3]|max_length[25]xss_clean|trim'    
                )
                ,array(
                  'field' => 'about', 'label' => 'About', 'rules' => 'required|xss_clean|trim'    
                )
                ,array(
                  'field' => 'price', 'label' => 'Price', 'rules' => 'required|xss_clean|numeric|trim'    
                )
                ,array(
                  'field' => 'img', 'label' => 'Image', 'rules' => 'xss_clean|trim|callback_upload_img'    
                )    
    );
   
   $this->form_validation->set_rules($config); 
   if ($this->form_validation->run()){
    $temp = explode('.',$_FILES["img"]["name"]); 
    $data = array(
              array_map('strip_tags' ,array(
              'name' => $this->input->post('name'),   
              'category' => strtolower($this->input->post('cat')),
              'sub' => str_replace(" ", "_", $this->input->post('sub')),
              'item_label' => $this->input->post('item_label'),
              'price' => $this->input->post('price'),
              'about' => $this->input->post('about'),
              'date' => date('Y-m-d H:i:s'),
              'img_url' =>  "/media/prod_photo/" . ($this->last_id()+1). '.jpg',
              'rating' => 0
           )
          )
         );
     
    $this->prod_mod->insert_new_prod($data);
    $temp = "?cat=".strip_tags($_GET['cat']);
    redirect('/products'.$temp);
    //$this->profile("Your personal information has been changed!");  
   
   }else{ 
     echo validation_errors();
     echo $this->upload->display_errors();   
   }
  }  
  function upload_img(){
    $this->load->library('upload');
    
    $config['upload_path'] = './media/prod_photo';
		 $config['allowed_types'] = 'gif|jpg|png';
    $config['overwrite'] = TRUE;
    $config['file_name'] = $this->last_id()+1;
		 $config['max_size']	= '5000';
		 $config['max_width']  = '3000';
		 $config['max_height']  = '3000';
        
    $this->upload->initialize($config); 
    $this->upload->set_allowed_types('*');   
    if ($this->upload->do_upload('img')){
      
      $data = $this->upload->data();
      $this->image_resize($data['file_ext']);
      
      return true;
    
    }
			return false;
  }
  
  function image_resize($atr){
   
    $config['image_library'] = 'gd2';
    $config['source_image'] = './media/prod_photo/'. ($this->last_id()+1 . $atr);
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 210;
    $config['height'] = 210;
  
    $this->load->library('image_lib', $config); 
   
    $this->image_lib->resize();  
  }
  
  function del_product(){
    $ajDi = strip_tags($_GET['id']);
    $this->db->delete('tovar',array( 'id' => $ajDi));

    if(file_exists('./media/prod_photo/'.$ajDi.'.jpg')){
      unlink('./media/prod_photo/'.$ajDi.'.jpg');
      unlink('./media/prod_photo/'.$ajDi.'_thumb.jpg');
    }
    redirect('/products?cat='.strip_tags($_GET['cat']));
  }
  
  
  function prod_detail(){
  
    $this->load->model('get_db');
    
    $vstup = strip_tags($this->input->get('id'));
    
    if(is_numeric($vstup)){
      $data['prod'] = $this->get_db->get_items('tovar','id',$vstup); 
    }else
      $data['error'] = 'Invalid input';
    //$data['comments'] = $this->get_db->get_items('comments','id_prod', $vstup);
		 $data['comments'] = $this->get_db->get_comments($vstup);   
    $data['title'] = 'Products detail' ;
    $this->template->write_view('content', 'view_prod_detail', $data); 
    $this->template->render();  
  }
  
  function add_comment_rate(){
    $this->load->model('get_db');  
    $this->load->library('form_validation');
    $config = array(
                array(
                  'field' => 'comment', 'label' => 'Comment', 'rules' => 'required|min_length[3]|max_length[150]|xss_clean|trim'      
                ));
                
   $this->form_validation->set_rules($config); 
   if ($this->form_validation->run()){
      $rat = ($this->input->post('rating'))? strip_tags($this->input->post('rating')) : 0;
      $rat_times = strip_tags($this->input->post('times'));
      $rat_orig = strip_tags($this->input->post('rat_origin')); 
       
      $new_rating = ($rat > 0)? ($rat_orig+$rat) / ($rat_times+1) : $rat_orig; 
      
      $data = array( array(
          'id_prod' => $this->input->post('get'),
          'user' => $this->session->userdata('nick'),
          'user_id' => $this->session->userdata('id'),
          'comment' => strip_tags($this->input->post('comment')),
          'rate' => $new_rating,
          'date' => date('Y-m-d H:i:s')       
      )); 
     if($this->get_db->add_comment_rate($data,$rat_times+1,$new_rating))
      redirect('products?id='. $this->input->post('get'));
     else
      echo "rpuser";   
   } 
    
  }
  
  
  function last_id(){
      $sql = "SELECT id FROM tovar WHERE id = (SELECT MAX(id) FROM tovar)";
      $query = $this->db->query($sql);
      foreach($query->result() as $row)
        return $row->id;
  }
  
  
}
?>