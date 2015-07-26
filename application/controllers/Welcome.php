<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('modelo');
		$this->load->helper('url');
	}


	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
			
	}

	public function login(){

		if($this->modelo->login())
		{
			$datos['clientes']=$this->modelo->clientes();
			$this->load->view('header');
			$this->load->view('barra');
			$this->load->view('inicio',$datos);
			$this->load->view('footer');
		}
		else
		{
			$datos['error']=true;
			$this->load->view('header');
			$this->load->view('login',$datos);
			$this->load->view('footer');
		}
	}

	public function clientes(){
		$datos['clientes']=$this->modelo->clientes();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('inicio',$datos);
		$this->load->view('footer');
	}

	public function muestras(){
		$datos['muestras']=$this->modelo->muestras();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('muestras',$datos);
		$this->load->view('footer');
	}

	public function nuevoCliente(){
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('nuevoCliente');
		$this->load->view('footer');
	}

	public function agregaMuestra(){
		$muestra=array(
			'nombre'=>$this->input->post('nombre'),
			'fecha'=>$this->input->post('fecha'),
			'hora'=>$this->input->post('hora'),
			'tipo'=>$this->input->post('tipo'),
			'cliente'=>$this->input->post('cliente')
		);
		$this->modelo->agregaMuestra($muestra);
		$bio=$this->modelo->muestraBio($this->input->post('cliente'));
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('cliente',$bio);
		$this->load->view('footer');
	}

	public function agregaCliente(){
		$this->modelo->agregaCliente();
		$this->clientes();
	}

	public function BIO()
	{
		$id=$this->uri->segment(3);
		$bio=$this->modelo->muestraBio($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('cliente',$bio);
		$this->load->view('footer');
	}

	public function nuevaMuestra()
	{
		$id=$this->uri->segment(3);
		$datos=$this->modelo->nuevaMuestra($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('nuevaMuestra',$datos);
		$this->load->view('footer');
	}

	public function editarCliente()
	{
		$id=$this->uri->segment(3);
		$datos['cliente']=$this->modelo->buscaCliente($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('editarCliente',$datos);
		$this->load->view('footer');
	}

	public function actualizaCliente(){
		$datos = array
		(
			'nombre' => $this->input->post('nombre'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'representante' => $this->input->post('representante'),
			'RFC' => $this->input->post('rfc')
		);
		$id=$this->input->post('id');
		$this->modelo->actualizarCliente($id,$datos);
		$bio=$this->modelo->muestraBio($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('cliente',$bio);
		$this->load->view('footer');
	}

	public function Analisis()
	{
		$id=$this->uri->segment(3);
		$datos=$this->modelo->mostrarAnalisis($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('Analisis',$datos);
		$this->load->view('footer');
	}

	public function guardarAnalisis()
	{	
		$id=$this->input->post('id');
		$ids=$this->input->post('ids');
		
		$this->load->view('header');
		$this->load->view('barra');
		if($ids !== false)
			$this->modelo->guardaAnalisis($id,$ids);
		$datos=$this->modelo->mostrarAnalisis($id);
		$this->load->view('Analisis',$datos);
		$this->load->view('footer');
		
	}

	public function posiblesAnalisis()
	{
		$id=$this->uri->segment(3);
		$datos=$this->modelo->cargaAnalisis($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('posiblesAnalisis',$datos);
		$this->load->view('footer');
	}
	
	public function actualizarAnalisis()
	{
		$id=$this->input->post('id');
		$ids=$this->input->post('ids');
		$this->load->view('header');
		$this->load->view('barra');	
		$this->modelo->actualizaAnalisis($id,$ids);
		$datos=$this->modelo->mostrarAnalisis($id);
		$this->load->view('Analisis',$datos);
		$this->load->view('footer');
	}
}
