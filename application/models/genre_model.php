<?php 
class genre_model extends CI_Model 
{
	function __construct()
    {
        // �I�s�ҫ�(Model)���غc���
        parent::__construct();
		$this->load->database();
    }
	
	function get_list()
	{
		//�ܼƦW�����result = ="
		$this->db->select('GenreId');
		$this->db->select('Name');
		$query  = $this->db->get("Genres");
		/*
		foreach ($query ->result()  as $row)
		{
			//�S�Q�����W�n���j�p�g~
			echo $row->Name;
		}
		*/		
		return $query->result_array() ;
	}
}
/* End of file gene_model.php */
/* Location: application/models/gene_model.php */
