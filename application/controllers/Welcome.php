<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('modelo');
		$this->load->helper('url');
		$this->load->library('session');
	}


	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
			
	}

	public function login()
	{
		$datasession = array(
				'login' => $this->input->post('User'),
             	'logueado' => true,
             	'urlAntigua' => '',
             	'urlActual' => uri_string()
			);
		if($this->modelo->login())
		{
			$this->session->set_userdata($datasession);
			redirect("Welcome/clientes");
		}
		else
		{
			$datos['error']=true;
			$this->load->view('header');
			$this->load->view('login',$datos);
			$this->load->view('footer');
		}
	}

	public function clientes()
	{
		$this->revisarSesion();
		$this->backButton();
		$datos['clientes']=$this->modelo->clientes();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('inicio',$datos);
		$this->load->view('footer');
	}

	public function muestras()
	{
		$this->revisarSesion();
		$this->backButton();
		$datos['muestras']=$this->modelo->muestras();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('muestras',$datos);
		$this->load->view('footer');
	}

	public function nuevoCliente()
	{
		$this->revisarSesion();
		$this->backButton();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('nuevoCliente');
		$this->load->view('footer');
	}

	public function agregaMuestra()
	{
		$this->revisarSesion();
		$tipo=$this->input->post('tipo');
		if($tipo == 0)
		{
			$nuevoNombre=$this->input->post('nuevoTipo');
			$tipo=$this->modelo->agregarTipoMuestra($nuevoNombre);
		}

		$muestra=array(
			'nombre'=>$this->input->post('nombre'),
			'fecha'=>$this->input->post('fecha'),
			'hora'=>$this->input->post('hora'),
			'tipo'=>$tipo,
			'cliente'=>$this->input->post('cliente')
		);
		$this->modelo->agregaMuestra($muestra);
		redirect("Welcome/bio/".$this->input->post('cliente'));
	}

	public function agregaCliente()
	{
		$this->revisarSesion();
		$this->modelo->agregaCliente();
		redirect("Welcome/clientes");
	}

	public function BIO()
	{
		$this->revisarSesion();
		$this->backButton();
		$id=$this->uri->segment(3);
		$bio=$this->modelo->muestraBio($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('cliente',$bio);
		$this->load->view('footer');
	}

	public function nuevaMuestra()
	{
		$this->revisarSesion();
		$this->backButton();
		$id=$this->uri->segment(3);
		$datos=$this->modelo->nuevaMuestra($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('nuevaMuestra',$datos);
		$this->load->view('footer');
	}

	public function editarCliente()
	{
		$this->revisarSesion();
		$this->backButton();
		$id=$this->uri->segment(3);
		$datos['cliente']=$this->modelo->buscaCliente($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('editarCliente',$datos);
		$this->load->view('footer');
	}

	public function actualizaCliente()
	{
		$this->revisarSesion();
		$datos = array
		(
			'nombre' => $this->input->post('nombre'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'representante' => $this->input->post('representante'),
			'email' => $this->input->post('email'),
			'RFC' => $this->input->post('rfc')
		);
		$id=$this->input->post('id');
		$this->modelo->actualizarCliente($id,$datos);
		redirect("Welcome/bio/".$id);
	}

	public function Analisis()
	{
		$this->revisarSesion();
		$this->backButton();
		$id=$this->uri->segment(3);
		$datos=$this->modelo->mostrarAnalisis($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('Analisis',$datos);
		$this->load->view('footer');
	}

	public function guardarAnalisis()
	{	
		$this->revisarSesion();
		$ids=$this->input->post('ids');
		$id=$this->input->post('id');
		for($i=0;$i<count($ids);$i++)
		{
			if($ids[$i]==="0")
			{
				$nombre=$this->input->post('nuevoNombre');
				$descripcion=$this->input->post('nuevaDescripcion');
				$unidad=$this->input->post('nuevaUnidad');
				$j=$this->modelo->otroAnalisis($nombre,$descripcion,$unidad,$id);
				$ids[$i]=$j;
			}
		}
		if($ids !== false)
			$this->modelo->guardaAnalisis($id,$ids);
		redirect("Welcome/Analisis/".$id);
	}

	public function posiblesAnalisis()
	{
		$this->revisarSesion();
		$this->backButton();
		$id=$this->uri->segment(3);
		$datos=$this->modelo->cargaAnalisis($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('posiblesAnalisis',$datos);
		$this->load->view('footer');
	}
	
	public function actualizarAnalisis()
	{
		$this->revisarSesion();
		$id=$this->input->post('id');
		$ids=$this->input->post('ids');
		$this->modelo->actualizaAnalisis($id,$ids);
		redirect("Welcome/Analisis/".$id);
	}

	public function revisarSesion()
	{
		if (!$this->session->userdata('login'))
            redirect('Welcome','refresh');
	}

	    public function cerrarsesion()
    {
        $datasession=array('login'=>'','logueado'=>'');
        $this->session->unset_userdata($datasession);
        $this->session->sess_destroy();
        redirect('Welcome','refresh');
    }

    public function backButton()
    {
    	$this->session->set_userdata('urlAntigua',$this->session->userdata('urlActual'));
		$this->session->set_userdata('urlActual',uri_string()); 
    }

}
