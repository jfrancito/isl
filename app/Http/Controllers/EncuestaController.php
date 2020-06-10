<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use View;
use Session;
use Hashids;
use App\PERPersona;
use App\WEBTrabajador;
use App\WEBEncuesta;
use App\WEBRespuestapersona;


class EncuestaController extends Controller
{

	public function actionInicioEncuesta(Request $request)
	{

		if($_POST)
		{
			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'dni' => 'required',
			], [
            	'dni.required' => 'El campo DNI es obligatorio',
        	]);

			/**********************************************************/
			
			$dni 	 				 		= 	strtoupper($request['dni']);
			$persona						=   WEBTrabajador::where('activo','=','1')->where('Dni','=',$dni)->first();

			if(count($persona)>0)
			{
				return Redirect::to('/realizar-encuesta/'.$dni);
			}else{
				return Redirect::back()->withInput()->with('errorbd', 'DNI incorrecto');
			}						    

		}else{
			return View::make('encuesta/ingreso');
		}

	}


	public function actionRealizarEncuesta($dni)
	{


		$persona				=   WEBTrabajador::where('activo','=','1')->where('Dni','=',$dni)->first();
		$persona_encuesta		=   WEBEncuesta::where('activo','=','1')->where('persona_id','=',$persona->Id)->first();


		$listapregunta 	= 	DB::table('WEB.tiporespuestas')
							->join('WEB.preguntas', 'WEB.tiporespuestas.id', '=', 'WEB.preguntas.tiporespuesta_id')
					   		->leftJoin('WEB.preguntarespuestas', function($leftJoin)
						        {
						            $leftJoin->on('WEB.preguntas.id', '=', 'WEB.preguntarespuestas.pregunta_id')
						            ->where('WEB.preguntarespuestas.activo', '=', 1);
						        })
					   		->leftJoin('WEB.respuestas', function($leftJoin)
						        {
						            $leftJoin->on('WEB.respuestas.id', '=', 'WEB.preguntarespuestas.respuesta_id')
						            ->where('WEB.respuestas.activo', '=', 1);
						        })
					   		->where('WEB.preguntas.activo', '=', 1)
					   		->orderBy('WEB.preguntas.numero', 'ASC')
					   		->select('WEB.preguntas.id','WEB.preguntas.numero','WEB.preguntarespuestas.id as IdPreguntaRespuesta','WEB.tiporespuestas.Descripcion as DescripcionTipo','WEB.preguntas.descripcion','WEB.respuestas.descripcion as DescripcionResp')
						    ->get();

		return View::make('encuesta/encuesta',
						  [
						   'listapregunta' 			=> $listapregunta,
						   'persona' 				=> $persona,
						   'persona_encuesta' 		=> $persona_encuesta,
						  ]
						 );

	}



	public function actionGuardarEncuestaTrabajador(Request $request){



		$xmle			=	explode('***', $request['xml']);
		$txtespecificar =	$request['txtespecificar'];
		$persona_id 	=	$request['persona_id'];
		$cont 			= 	0;
		$sw 			=   '0';
		$persona		=   WEBEncuesta::where('activo','=','1')->where('persona_id','=',$persona_id)->first();


		if(count($persona)>0){
			$sw 		= 	'1';
			print_r($sw);
			exit();
		}


		$id 					 	= 	$this->funciones->getCreateIdMaestra('WEB.encuestas');

		$encuesta 					=  	new WEBEncuesta;
		$encuesta->id 				=  	$id;
		$encuesta->persona_id 		=  	$persona_id;
		$encuesta->descripcion      = 	$txtespecificar;
		$encuesta->fecha_crea 		=  	$this->fecha_hora;
		$encuesta->usuario_crea 	=  	$persona_id;
		$encuesta->save();


			// radio y check
		for ($i = 0; $i < count($xmle)-1; $i++) {

			$separar 							= 	explode('&&&', $xmle[$i]);

			$idd 					 			= 	$this->funciones->getCreateIdMaestra('WEB.respuestapersonas');

			$detalle 							=  	new WEBRespuestapersona;
			$detalle->id 						=  	$idd;
			$detalle->encuesta_id 				=  	$id;
			$detalle->preguntarespuesta_id      = 	$separar[0];
			$detalle->fecha_crea 				=  	$this->fecha_hora;
			$detalle->usuario_crea 				=  	$persona_id;
			$detalle->save();

		}

		print_r($sw);
		exit();
			
	}


	public function actionTerminoEncuesta($dni)
	{

		$persona						=   WEBTrabajador::where('activo','=','1')->where('Dni','=',$dni)->first();

		return View::make('encuesta/terminoencuesta',
						  [
						   'persona' 		=> $persona
						  ]
						 );
	}





}
