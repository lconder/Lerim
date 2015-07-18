<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelo extends CI_Model 
{
	function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
	}	

	public function login(){
		$usuario=$this->input->post('User');
		$password=$this->input->post('Password');

		$query=$this->db->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND password=SHA('$password')");
		if ($query->num_rows() == 0) 
		  $query=FALSE; 
	   return $query;
	}

	public function clientes()
	{
		$query=$this->db->query("SELECT * FROM clientes");
		if ($query->num_rows() == 0) 
		  $query=FALSE; 
	   return $query;
	}

	public function muestras(){

		$query=$this->db->query("SELECT id_muestra,muestras.nombre, tipos_muestras.nombre as tipo, muestras.fecha, muestras.hora, clientes.nombre as cliente FROM muestras, tipos_muestras, clientes WHERE muestras.tipo = tipos_muestras.id_tipo_muestra and muestras.cliente=clientes.id_cliente");
		if ($query->num_rows() == 0) 
		  $query=FALSE; 
	   return $query;
	}

	public function agregaCliente(){
		$cliente=array(
			'nombre'=>$this->input->post('nombre'),
			'representante'=>$this->input->post('representante'),
			'telefono'=>$this->input->post('telefono'),
			'direccion'=>$this->input->post('direccion'),
			'RFC'=>$this->input->post('rfc')
		);

		return $this->db->insert('clientes', $cliente);
	}

	public function agregaMuestra($muestra){
		return $this->db->insert('muestras', $muestra);
	}

	public function nuevaMuestra($id){
		$query=$this->db->query("SELECT id_tipo_muestra as id, nombre FROM tipos_muestras");
		if($query->num_rows()==0)
			$dataArray=false;
		else{
			$dataArray['tipos']=$query;
			$dataArray['id']=$id;
		}

		return $dataArray;
	}

	public function muestraBio($id)
	{
		$dataArray;
		$query=$this->db->query("SELECT * FROM clientes WHERE id_cliente=$id");

		if($query->num_rows()==0)
			$dataArray=false;
		else
		{
			$dataArray['cliente']=$query;
			$query=$this->db->query("SELECT id_muestra, muestras.nombre, tipos_muestras.nombre as tipo, hora, fecha FROM muestras JOIN tipos_muestras WHERE cliente=$id AND tipo=id_tipo_muestra");
			$dataArray['muestras']=$query;
		}
		return $dataArray;
	}

	public function buscaCliente($id){
		$query=$this->db->query("SELECT * FROM clientes WHERE id_cliente=$id");
		if ($query->num_rows() == 0) 
		  $query=FALSE; 
	   return $query;
	}

	public function actualizarCliente($id,$datos)
	{
		$this->db->where('id_cliente',$id);
		$this->db->update('clientes',$datos);
		return true;
	}

	public function cargaAnalisis($id){
		$dataArray;
		/*$this->db->select('id_tipo_analisis, tipos_analisis.nombre, descripcion');
		$this->db->from('muestras');
		$this->db->join('tipos_analisis','tipos_muestras=muestras.tipo');
		$this->db->join('analisis','analisis.tipo!=id_tipo_analisis AND analisis.muestra = id_muestra');
		$this->db->where('id_muestra',$id);
		$query = $this->db->get();*/
		$query = $this->db->query("SELECT id_tipo_analisis, tipos_analisis.nombre, descripcion FROM tipos_analisis,muestras WHERE tipos_muestras=muestras.tipo AND id_muestra=$id and id_tipo_analisis NOT IN (SELECT tipo FROM analisis WHERE muestra =$id)");
		$dataArray['analisis']=$query;
		$dataArray['id']=$id;
	   return $dataArray;
	}   
		//SELECT id_tipo_analisis, tipos_analisis.nombre, descripcion FROM tipos_analisis,muestras WHERE tipos_muestras=muestras.tipo AND id_muestra=4 and id_tipo_analisis NOT IN (select tipo from analisis where muestra =4)

	public function guardaAnalisis($id,$ids)
	{
		foreach($ids as $selected){
			$analisis=array(
				'muestra'=>$id,
				'tipo'=>$selected
			);
			$this->db->insert('analisis', $analisis);
		}
	}

	public function mostrarAnalisis($id)
	{
		$query = $this->db->query("SELECT nombre,id_tipo_analisis,tipo, muestra, descripcion,resultado,medida FROM analisis,tipos_analisis WHERE tipo = id_tipo_analisis AND muestra = $id");
		$dataArray['analisis']=$query;
		$dataArray['id']=$id;
	   return $dataArray;
	}

	public function actualizaAnalisis($id,$ids)
	{
		foreach($ids as $selected){

			$analisis=array(
				'resultado' => $this->input->post($selected)
			);
			$this->db->where('muestra',$id);
			$this->db->where('tipo',$selected);
			$this->db->update('analisis',$analisis);
		}
	}
}