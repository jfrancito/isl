<?php
namespace App\Biblioteca;
use PDO;
use DB,Hashids,Session,Redirect;
use App\WEBRolOpcion,App\WEBRol,App\User,App\CMPTipoPago,App\PEROcupacionTrabajador;


class Funcion{


	public function data_ocupacion_trabajador() {

		$ocupaciontrabajador 	= 	PEROcupacionTrabajador::where('IdTrabajador','=',Session::get('usuario')->IdTrabajador)
									->where('Activo','=',1)
									->where('Principal','=',1)
									->first();

		return $ocupaciontrabajador;

	}




	public function data_tipo_pago($id) {

		$tipopago 	= 	CMPTipoPago::where('Id','=',$id)->first();

		return $tipopago;

	}


	public function listar_todo_o_solo_area($proceso_id) {

	    $vacio 						=   "";
	    $tipooperacion 				=   '';
	    $proceso_id 				=   $proceso_id;//'1CH000000050';//1CH000000025
	    $sw 						= 	0;

	    /*Lista para seleccionar solititud*/
		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC SGD.Isp_TrabajadorSeguridad_Listar ?,?,?');
        $stmt->bindParam(1, $tipooperacion ,PDO::PARAM_STR);
        $stmt->bindParam(2, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(3, $proceso_id ,PDO::PARAM_STR);
        $stmt->execute();

		while ($row = $stmt->fetch(2)) {
			if($row['IdTrabajador'] == Session::get('usuario')->IdTrabajador){
				$sw 	= 	1;
			}
		}

	  	return $sw;

	 }


	public function trabajador_seguridad($trabajador_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $idmoneda 					=   'CERO';
	    $cero 						=   0;
	    $nombreproceso 				=   'APROBAR ORDENES DE COMPRA';
	    $idtipoordencompra 			=   '1PK000000001';
	    $opcionfecha 				=   'FO';
		$fecha_infinita 			=  	'1901-01-01';


		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC SGD.Isp_TrabajadorSeguridad_Listar ?,?,?,?,?,?,?,?');

        $stmt->bindParam(1, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(2, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(3, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(4, $trabajador_id ,PDO::PARAM_STR);

        $stmt->bindParam(5, $cero ,PDO::PARAM_STR);
        $stmt->bindParam(6, $activo ,PDO::PARAM_STR);
        $stmt->bindParam(7, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(8, $nombreproceso ,PDO::PARAM_STR);

        $stmt->execute();

        $trabajador = $stmt->fetch(2);
        return $trabajador;

	}



	public function lista_orden_compra_servicios($orden_compra_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $cero 						=   0;
		$fecha_infinita 			=  	'1901-01-01';
		$tipo_persona_empresa 		=  	-1;


		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC CMP.ISP_OrdenCompraServicio_Listar ?,?,?,?,?,?,?,?,?,?,?,?');

        $stmt->bindParam(1, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(2, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(3, $orden_compra_id ,PDO::PARAM_STR);
        $stmt->bindParam(4, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(5, $activo ,PDO::PARAM_STR);
        $stmt->bindParam(6, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(7, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(8, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(9, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(10, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(11, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(12, $nulo ,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;

	}

	public function lista_orden_compra_material($orden_compra_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $cero 						=   0;
		$fecha_infinita 			=  	'1901-01-01';
		$tipo_persona_empresa 		=  	-1;


		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC CMP.Isp_OrdenCompraMaterial_Listar ?,?,?,?,?,?');

        $stmt->bindParam(1, $tipooperacion ,PDO::PARAM_STR);
        $stmt->bindParam(2, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(3, $orden_compra_id ,PDO::PARAM_STR);
        $stmt->bindParam(4, $activo ,PDO::PARAM_STR);

        $stmt->bindParam(5, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(6, $nulo ,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;

	}


	public function proveedor($proveedor_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $cero 						=   0;
		$fecha_infinita 			=  	'1901-01-01';
		$tipo_persona_empresa 		=  	-1;


		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC STD.Isp_Proveedor_Listar ?,?,?,?,?,?,?');

        $stmt->bindParam(1, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(2, $proveedor_id ,PDO::PARAM_STR);
        $stmt->bindParam(3, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(4, $nulo ,PDO::PARAM_STR);

        $stmt->bindParam(5, $tipo_persona_empresa ,PDO::PARAM_STR);
        $stmt->bindParam(6, $activo ,PDO::PARAM_STR);
        $stmt->bindParam(7, $cero ,PDO::PARAM_STR);
        $stmt->execute();

        $proveedor = $stmt->fetch(2);
        return $proveedor;



	}



	public function orden_compra($orden_compra_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $idmoneda 					=   'CERO';
	    $cero 						=   0;
	    $idestadoorden 				=   '1CH000000001';
	    $idtipoordencompra 			=   '1PK000000001';
	    $opcionfecha 				=   'FO';
		$fecha_infinita 			=  	'1901-01-01';


		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC CMP.Isp_OrdenCompra_Listar ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?');

        $stmt->bindParam(1, $tipooperacion ,PDO::PARAM_STR);
        $stmt->bindParam(2, $orden_compra_id ,PDO::PARAM_STR);
        $stmt->bindParam(3, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(4, $activo ,PDO::PARAM_STR);

        $stmt->bindParam(5, $idmoneda ,PDO::PARAM_STR);
        $stmt->bindParam(6, $idmoneda ,PDO::PARAM_STR);
        $stmt->bindParam(7, $idmoneda ,PDO::PARAM_STR);
        $stmt->bindParam(8, $idmoneda ,PDO::PARAM_STR);

        $stmt->bindParam(9, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(10, $fecha_infinita ,PDO::PARAM_STR);
        $stmt->bindParam(11, $fecha_infinita ,PDO::PARAM_STR);
        $stmt->bindParam(12, $nulo ,PDO::PARAM_STR);

        $stmt->bindParam(13, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(14, $cero ,PDO::PARAM_STR);
        $stmt->bindParam(15, $cero ,PDO::PARAM_STR);
        $stmt->bindParam(16, $nulo ,PDO::PARAM_STR);
        $stmt->execute();

        $ordencompra = $stmt->fetch(2);
        return $ordencompra;


	}




	public function lista_orden_compra($fechainicio,$fechafin,$idtipoordencompra,$area_id) {


	    $vacio 						=   "";
	    $nulo 						=   Null;
	    $tipooperacion 				=   '1';
	    $activo 					=   1;
	    $idmoneda 					=   'CERO';
	    $cero 						=   0;
	    $idestadoorden 				=   '1CH000000001';
	    $idtipoordencompra 			=   $idtipoordencompra;
	    $opcionfecha 				=   'FO';

    	/*Lista para seleccionar solititud*/
		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC CMP.Isp_OrdenCompra_Listar_web ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?');

        $stmt->bindParam(1, $tipooperacion ,PDO::PARAM_STR);
        $stmt->bindParam(2, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(3, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(4, $activo ,PDO::PARAM_STR);

        $stmt->bindParam(5, $idmoneda ,PDO::PARAM_STR);
        $stmt->bindParam(6, $nulo ,PDO::PARAM_STR);
        $stmt->bindParam(7, $idestadoorden ,PDO::PARAM_STR);
        $stmt->bindParam(8, $nulo ,PDO::PARAM_STR);

        $stmt->bindParam(9, $opcionfecha ,PDO::PARAM_STR);
        $stmt->bindParam(10, $fechainicio ,PDO::PARAM_STR);
        $stmt->bindParam(11, $fechafin ,PDO::PARAM_STR);
        $stmt->bindParam(12, $idtipoordencompra ,PDO::PARAM_STR);

        $stmt->bindParam(13, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(14, $cero ,PDO::PARAM_STR);
        $stmt->bindParam(15, $cero ,PDO::PARAM_STR);
        $stmt->bindParam(16, $area_id ,PDO::PARAM_STR);

        $stmt->execute();

        $listaordencompra = $stmt;
        return $listaordencompra;

	}


	public function permiso_aprobacion_requerimiento($proceso_id) {

	    $vacio 						=   "";
	    $tipooperacion 				=   '';
	    $proceso_id 				=   $proceso_id;//'1CH000000050';//1CH000000025
	    $sw 						= 	0;

	    /*Lista para seleccionar solititud*/
		$stmt = DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC SGD.Isp_TrabajadorSeguridad_Listar ?,?,?');
        $stmt->bindParam(1, $tipooperacion ,PDO::PARAM_STR);
        $stmt->bindParam(2, $vacio ,PDO::PARAM_STR);
        $stmt->bindParam(3, $proceso_id ,PDO::PARAM_STR);
        $stmt->execute();


		while ($row = $stmt->fetch(2)) {
			if($row['IdTrabajador'] == Session::get('usuario')->IdTrabajador){
				$sw 	= 	1;
			}
		}

	  	if($sw == 0 or is_null(Session::get('usuario')->IdTrabajador)){
	  		return Redirect::back()->withInput()->with('errorurl', 'No tiene autorización para aprobación de requerimiento');
	  	}
	  	return true;

	 }



	public function que_rol_que_tiene_usuario($idusuario) {

		$nombre_rol 	= 	'-';
		$usuario 		= 	User::where('usuarioisl_id','=',$idusuario)->first();

		if(count($usuario)>0){
			$rol 		= 	WEBRol::where('id','=',$usuario->rol_id)->first();
			$nombre_rol =   $rol->nombre;
		}

		return $nombre_rol;
	}


	public function getUrl($idopcion,$accion) {

	  	//decodificar variable
	  	$decidopcion = Hashids::decode($idopcion);
	  	//ver si viene con letras la cadena codificada
	  	if(count($decidopcion)==0){ 
	  		return Redirect::back()->withInput()->with('errorurl', 'Indices de la url con errores'); 
	  	}

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($decidopcion[0], 8, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo

	  	// hemos hecho eso porque ahora el prefijo va hacer fijo en todas las empresas que 1CIX
		//$prefijo = Local::where('activo', '=', 1)->first();
		//$idopcioncompleta = $prefijo->prefijoLocal.$idopcioncompleta;
		$idopcioncompleta = '1CIX'.$idopcioncompleta;

	  	// ver si la opcion existe
	  	$opcion =  WEBRolOpcion::where('opcion_id', '=',$idopcioncompleta)
	  			   ->where('rol_id', '=',Session::get('usuario')->rol_id)
	  			   ->where($accion, '=',1)
	  			   ->first();

	  	if(count($opcion)<=0){
	  		return Redirect::back()->withInput()->with('errorurl', 'No tiene autorización para '.$accion.' aquí');
	  	}
	  	return 'true';

	 }


	public function decodificar($id) {

	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}
	  	return $iddeco[0];

	}


	public function getCreateIdMaestra($tabla) {

  		$id="";

  		// maximo valor de la tabla referente
		$id = DB::table($tabla)
        ->select(DB::raw('max(SUBSTRING(id,5,8)) as id'))
        ->get();

        //conversion a string y suma uno para el siguiente id
        $idsuma = (int)$id[0]->id + 1;

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($idsuma, 8, "0", STR_PAD_LEFT);

	  	//concatenar prefijo
		$prefijo = $this->prefijomaestra();

		$idopcioncompleta = $prefijo.$idopcioncompleta;

  		return $idopcioncompleta;	

	}

	public function prefijomaestra() {

		$prefijo = '1CIX';
	  	return $prefijo;
	}


	public function decodificarmaestra($id) {

	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}
	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($iddeco[0], 8, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo

		//$prefijo = Local::where('activo', '=', 1)->first();

		// apunta ahi en tu cuaderno porque esto solo va a permitir decodifcar  cuando sea el contrato del locl en donde estas del resto no 
		//¿cuando sea el contrato del local?
		$prefijo = $this->prefijomaestra();
		$idopcioncompleta = $prefijo.$idopcioncompleta;
	  	return $idopcioncompleta;

	}


}

