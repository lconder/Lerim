<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('formatearMensaje'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
	function formatearMensaje($datos)
	{
		$mensaje = "<html><body> ";
 		$mensaje .= "Análisis Realizados: <br>";
 		foreach ($datos->result() as $row) 
 		{
 			$mensaje .=  htmlspecialchars($row->descripcion)."<br><p align='center'><strong>". htmlspecialchars($row->resultado)."&nbsp;". htmlspecialchars($row->medida);
 			$mensaje .= "<br>". htmlspecialchars($row->referencia)."</strong></p>";
 		}
 		$mensaje .= " </body></html>";
 		return $mensaje;
	}
}