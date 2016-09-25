<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends CI_Model {
	public function ambil_semua_data(){
		return $this->db->get('data_node');
	}
	public function ambil_data($nama_node){
		return $this->db->get_where('data_node',$nama_node);
	}

	public function simpan_data($nama_node,$x,$y,$z){
		$data=array('nama_node' => $nama_node,
					'posisi_x'=>$x,
					'posisi_y'=>$y,
					'konsentrasi_gas'=>$z );
		$this->db->insert('data_node',$data);
	}
	public function hapus_all_data(){
		return $this->db->empty_table('data_node');
	}
}
