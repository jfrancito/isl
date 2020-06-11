<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\WEBMaestro;
use App\WEBEncuesta;
use Mail;

class NotificacionEnfermera extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificacion:enfermera';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $fecha_actual                   =   date("Y-m-d");
        $fecha_manana                   =   date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
        $lista_encuesta                 =   WEBEncuesta::where('ind_enfermera','=',0)
                                            ->get();


        foreach($lista_encuesta as $item){

                // correos from(de)
            $emailfrom          =   WEBMaestro::where('codigoatributo','=','0001')->where('codigoestado','=','00001')->first();
            // correos principales y  copias
            $email              =   WEBMaestro::where('codigoatributo','=','0001')->where('codigoestado','=','00003')->first();


            $array              =   Array(
                'encuesta'          =>  $item
            );

            Mail::send('emails.notificaciondoctor', $array, function($message) use ($emailfrom,$email,$item)
            {

                $emailprincipal     = explode(",", $email->correoprincipal);
                //$emailprincipal     = explode(",", $email->correoprincipal);
        
                $message->from($emailfrom->correoprincipal, 'El Trabajador '.$item->trabajador->NombreCompleto.' presenta sintomas.');

                if($email->correocopia<>''){
                    $emailcopias        = explode(",", ltrim(rtrim($email->correocopia)));
                    $message->to($emailprincipal)->cc($emailcopias);
                }else{
                    $message->to($emailprincipal);                
                }
                $message->subject($email->descripcion);

            });

            $item->ind_enfermera       =   1;
            $item->save();
        }
                     
    }
}
