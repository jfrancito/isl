<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Biblioteca\Funcion;
use DateTime;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $funciones;
	public $inicio;
	public $fin;
	public function __construct()
	{
	    $this->funciones = new Funcion();
		$fecha = new DateTime();
		$fecha->modify('first day of this month');

		//fecha actual -7 dias
		$fechasiete = date('Y-m-j');
		$nuevafecha = strtotime ( '-7 day' , strtotime($fechasiete));
		$nuevafecha = date ('Y-m-j' , $nuevafecha);

		$this->fecha_menos_siete_dias 	= date_format(date_create($nuevafecha), 'Y-m-d');
		$this->inicio 					= date_format(date_create($fecha->format('Y-m-d')), 'Y-m-d');


		$this->fin 						= date_format(date_create(date('Y-m-d')), 'Y-m-d');
		$this->fecha_hora 				= date_format(date_create(date('Y-m-d')), 'Y-m-d H:m:s');

	}




}
