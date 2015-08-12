<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('modelo');
		$this->load->helper(array('url','email_helper'));
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
		$this->backButton();
		$datos['clientes']=$this->modelo->clientes();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('inicio',$datos);
		$this->load->view('footer');
	}

	public function muestras()
	{
		$this->backButton();
		$datos['muestras']=$this->modelo->muestras();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('muestras',$datos);
		$this->load->view('footer');
	}

	public function nuevoCliente()
	{
		$this->backButton();
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('nuevoCliente');
		$this->load->view('footer');
	}

	public function agregaMuestra()
	{
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
		if($this->modelo->agregaCliente())
			redirect("Welcome/clientes");
		redirect("Welcome/nuevoCliente");
	}

	public function BIO()
	{
		$this->backButton();
		$id=$this->uri->segment(3);
		$bio=$this->modelo->muestraBio($id);
		$this->load->view('header');
		$this->load->view('barra');
		$this->load->view('cliente',$bio);
		$this->load->view('footer');
	}

	public function enviarEmail()
	{
		$id = $this->uri->segment(3);
		$config = Array(
	    	'protocol' => 'smtp',
		    'smtp_host' => 'relay-hosting.secureserver.net',
		    'smtp_port' => 25,
		    'smtp_user' => 'labftejeda', 
		    'smtp_pass' => 'Ad1smale3', 
		    'mailtype' => 'html',
		    'charset' => 'iso-8859-1',
		    'wordwrap' => TRUE);

	    $CI =& get_instance();        
	    $CI->load->library('email',$config);
	    $CI->email->set_newline("\r\n");
	    $CI->email->from('contacto@lerim.com.mx', 'Lerim');
	    $CI->email->to($this->modelo->obtenerEmail($id));
	    $CI->email->subject("Resultados de ".$this->modelo->nombreMuestra($id));
	    $datos = $this->modelo->mostrarAnalisis($id);
	    $CI->email->message(formatearMensaje($datos['analisis']));
	    $CI->email->send();
	    redirect("Welcome/muestras");
	}

	public function nuevaMuestra()
	{
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
		
		$id=$this->input->post('id');
		$ids=$this->input->post('ids');
		$this->modelo->actualizaAnalisis($id,$ids);
		redirect("Welcome/muestras");
	}

	public function cerrarsesion()
    {
        $datasession=array('login'=>'','logueado'=>'');
        $this->session->unset_userdata($datasession);
        $this->session->sess_destroy();
        redirect('Welcome/login','refresh');
    }

    public function backButton()
    {
    	$this->session->set_userdata('urlAntigua',$this->session->userdata('urlActual'));
		$this->session->set_userdata('urlActual',uri_string()); 
    }

}
