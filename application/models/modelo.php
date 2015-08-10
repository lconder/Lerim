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

	public function muestras()
	{

		$query=$this->db->query("SELECT id_muestra,muestras.nombre, tipos_muestras.nombre as tipo, muestras.fecha, muestras.hora, clientes.nombre as cliente FROM muestras, tipos_muestras, clientes WHERE muestras.tipo = tipos_muestras.id_tipo_muestra and muestras.cliente=clientes.id_cliente ORDER BY muestras.fecha DESC");
		if ($query->num_rows() == 0) 
		  $query=FALSE; 
	   return $query;
	}

	public function agregaCliente()
	{
		$cliente=array(
			'nombre'=>$this->input->post('nombre'),
			'representante'=>$this->input->post('representante'),
			'telefono'=>$this->input->post('telefono'),
			'email'=>$this->input->post('email'),
			'direccion'=>$this->input->post('direccion'),
			'RFC'=>$this->input->post('rfc')
		);

		return $this->db->insert('clientes', $cliente);
	}

	public function agregaMuestra($muestra){
		return $this->db->insert('muestras', $muestra);
	}

	public function nuevaMuestra($id){
		$query=$this->db->query("SELECT id_tipo_muestra AS id, nombre FROM tipos_muestras WHERE nativo=1");
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
		if ($this->db->_error_message())
			return true;
		return false;
	}

	public function cargaAnalisis($id){
		$dataArray;
		$query = $this->db->query("SELECT id_tipo_analisis, tipos_analisis.nombre, descripcion FROM tipos_analisis,muestras WHERE tipos_muestras=muestras.tipo AND id_muestra=$id AND tipos_analisis.nativo=1 AND id_tipo_analisis NOT IN (SELECT tipo FROM analisis WHERE muestra =$id)");
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

	public function otroAnalisis($nombre,$descripcion,$unidad,$id_muestra)
	{
		
		$query = $this->db->query("SELECT tipo FROM muestras WHERE id_muestra=$id_muestra");
		$tipos_muestras;
		foreach($query->result() as $row)
	  	{
	  		$tipos_muestras=$row->tipo;
	  	}
		$analisis=array(
			'nombre'=> $nombre,
			'descripcion' => $descripcion,
			'medida' => $unidad,
			'nativo' => 0,
			'tipos_muestras' => $tipos_muestras
		);

		$this->db->insert('tipos_analisis', $analisis);

		$query = $this->db->query("SELECT id_tipo_analisis FROM tipos_analisis WHERE tipos_muestras=$tipos_muestras AND nombre='$nombre' AND descripcion='$descripcion' AND nativo=0  ORDER BY id_tipo_analisis DESC LIMIT 1");
		$j=0;
		foreach($query->result() as $row)
	  	{
	  		$j=$row->id_tipo_analisis;
	  	}

	  	return $j;
	}

	public function mostrarAnalisis($id)
	{
		$query = $this->db->query("SELECT nombre,id_tipo_analisis,tipo, muestra, descripcion,resultado,medida, referencia FROM analisis,tipos_analisis WHERE tipo = id_tipo_analisis AND muestra = $id");
		$dataArray['analisis']=$query;
		$dataArray['id']=$id;
	   return $dataArray;
	}

	public function actualizaAnalisis($id,$ids)
	{
		if(empty($ids))
			return;
		foreach($ids as $selected){

			$analisis=array(
				'resultado' => $this->input->post("resultado_".$selected),
				'referencia' => $this->input->post("ref_".$selected)
			);
			$this->db->where('muestra',$id);
			$this->db->where('tipo',$selected);
			$this->db->update('analisis',$analisis);
		}
	}

	public function agregarTipoMuestra($nombre)
	{
		$muestra=array(
			'nombre'=>$nombre,
			'nativo'=>0	
		);

		$this->db->insert('tipos_muestras', $muestra);

		$query = $this->db->query("SELECT id_tipo_muestra FROM tipos_muestras WHERE nombre='$nombre' AND nativo=0 LIMIT 1");
		
		foreach($query->result() as $row)
	  	{
	  		$query=$row->id_tipo_muestra;
	  	}
		return $query;
	}
}