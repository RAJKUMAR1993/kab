<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Newsevents extends CI_Controller{

	

	public function details($id){
		$data["ne"] = $this->db->get_where("tbl_news",["news_id"=>$id])->row();
		$data['recentne'] = $this->db->where("is_deleted",'0')->order_by('news_id', 'DESC')->limit(4)->get("tbl_news")->result();
        $data['newscnt'] = $this->db->where("is_deleted",'0')->where("type",'news')->get("tbl_news")->num_rows();
        $data['eventscnt'] = $this->db->where("is_deleted",'0')->where("type",'event')->get("tbl_news")->num_rows();
        $data['necategories'] = $this->db->where("status",'Active')->get("tbl_news_events_categories")->result();
		$this->load->view("front/newsevents/newsandevents-details",$data);
		
	}

	
	//New Exhibitors
	public function list($num="")
	{
		$type = ($this->input->post("type")) ? $this->input->post("type") : '';
		$category_id = ($this->input->post("category_id")) ? $this->input->post("category_id") : '';
		$recordPerPage = 5;
		if ($num != "") {
            $pageno = $num;
        } else {
            $pageno = 1;
        }
        $offset = ($pageno-1) * $recordPerPage;
        $sql = "SELECT tbl_news.*, tbl_news_events_categories.category_name FROM tbl_news LEFT JOIN tbl_news_events_categories ON tbl_news_events_categories.id=tbl_news.category_id";

        $sql .= " WHERE tbl_news.is_deleted='0'";
        if($type){
        	$sql .= " and tbl_news.type='".$type."'";
        }
        if($category_id){
        	$sql .= " and tbl_news.category_id='".$category_id."'";
        }

        $sql .= " and tbl_news_events_categories.status='Active' order by tbl_news.news_id desc";
       
		$recordCount = $this->db->query($sql)->num_rows();
		$sql .= " LIMIT $offset, $recordPerPage";
      	$empRecord = $this->db->query($sql)->result();
		$config['base_url'] = base_url().'front/newsevents/list';
      	$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-link currentpage active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();       
        $data['newsevn'] = $empRecord;
        $data['recentne'] = $this->db->where("is_deleted",'0')->order_by('news_id', 'DESC')->limit(4)->get("tbl_news")->result();
        //$data['newscnt'] = $this->db->where("is_deleted",'0')->where("type",'news')->get("tbl_news")->num_rows();
        //$data['eventscnt'] = $this->db->where("is_deleted",'0')->where("type",'event')->get("tbl_news")->num_rows();
        $newscnt = "SELECT * FROM tbl_news WHERE is_deleted='0' AND type='news'";
        $eventscnt = "SELECT * FROM tbl_news WHERE is_deleted='0' AND type='event'";
        if($category_id!=''){
        	$ctq = " AND category_id='".$category_id."'";
        	$newscnt = $newscnt.$ctq;
        	$eventscnt = $eventscnt.$ctq;
        }
        $data['newscnt'] = $this->db->query($newscnt)->num_rows();
        $data['eventscnt'] = $this->db->query($eventscnt)->num_rows();
        $data['necategories'] = $this->db->where("status",'Active')->get("tbl_news_events_categories")->result();
        $data['category_id'] = $category_id;
        $data['type'] = $type;
		
		$this->load->view('front/newsevents/newsandevents',$data);
	}

	public function search(){
		$search_query = (isset($_POST['query'])) ? $_POST['query'] : '';
		$sql = "SELECT * FROM tbl_news WHERE is_deleted=0 LIMIT 0, 10";
		$notmsg = "";
		if ($search_query!='') {
			if($search_query != ""){
				$notmsg = "<p style='color:red'><b>".$_POST['query']."</b> search item not found...</p>";
				$sql = "SELECT * FROM tbl_news WHERE is_deleted=0 and title LIKE '$search_query%' LIMIT 0, 10";
			}
				
		}
		$query = $this->db->query($sql)->result();
		if(!empty($query)){
			$msg = '';
			foreach($query as $ne){				
				$msg .= '<article class="blog wow fadeIn"><div class="row no-gutters"><div class="col-lg-7"><figure><a href="'.base_url().'detail/'.$ne->news_id.'/view"><img src="';
				if($ne->image){
				$msg .=  base_url().$ne->image ;
				} else { 
					$msg .= 'http://via.placeholder.com/500x333/ccc/fff/news_home_1.jpg';
					}
					$msg .=  '" alt="">
										<div class="preview"><span>Read more</span></div>
					  
				</a>
				</figure>
				</div>


<div class="col-lg-5">
								<div class="post_info">
									<small>'. date('d M.Y',strtotime($ne->created_date)).'</small>
									<h3><a href="'.base_url().'detail/'.$ne->news_id.'/view">'. $ne->title.'</a></h3>
									<p>'.substr($ne->message,0, 300).'</p>
									<ul>
										<li>
											<div class="thumb"><img src="http://via.placeholder.com/80x80/ccc/fff/thumb_blog.jpg" alt=""></div>'.$ne->createdby.'
										</li>
										<li><i class="icon_tag"></i>'.$ne->type.'</li>
									</ul>
								</div>
							</div>


				</div></article>';
			}
			echo $msg;					
		}else{
			 echo $notmsg;
		}
	}
	
}
