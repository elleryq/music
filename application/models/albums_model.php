<?php 
class albums_model extends MY_Model 
{
	function __construct()
    {
        // �I�s�ҫ�(Model)���غc���
        parent::__construct();
		$this->load->database();
    }
	
	public function get_top_selling_albums($p_count)	
	{				
		$sql = str_replace("{0}",$p_count,$this->get_albums_statement(constant("MYDB")));					
		$query  = $this->db->query($sql);
		return $query;		
		
		/*
		foreach ($query->result()  as $row)
		{
			//�S�Q�����W�n���j�p�g~
			echo $row->AlbumId;
		}
		*/
		//return $query->result();
		
		
	}
	
	public function find($p_id)
	{
		$this->db->select("a.*,b.Name,c.Name as ArtistName");
		$this->db->from("Albums a");
		$this->db->join("Genres b","a.GenreId = b.GenreId","left");
		$this->db->join("Artists c","a.ArtistId = c.ArtistId","left");
		$this->db->where('a.AlbumId', $p_id);
		$query = $this->db->get();
		return $query->result();
	}
}
/* End of file gene_model.php */
/* Location: application/models/gene_model.php */
