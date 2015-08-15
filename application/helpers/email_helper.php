<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('formatearMensaje'))
{
	function formatearMensaje($datos)
	{
		$trans = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
		unset($trans['<'],$trans['>']);
		$mensaje = "<html><body> ";
 		$mensaje .= "Análisis Realizados: <br>";
 		foreach ($datos->result() as $row) 
 		{
 			$mensaje .=  strtr($row->descripcion,$trans)."<br><p align='center'><strong>". htmlspecialchars($row->resultado)."&nbsp;". htmlspecialchars($row->medida);
 			$mensaje .= "<br>". htmlspecialchars($row->referencia)."</strong></p>";
 		}
 		$mensaje .= " </body></html>";
 		return $mensaje;
	}
}