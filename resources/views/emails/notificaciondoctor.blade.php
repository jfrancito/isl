<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />

        <style>

            body{

            }
            .banner{
                margin: 0 auto;
                text-align: center;
                width: 700px;               
            }
            p{
                margin-bottom: 0px;
                margin-top: 0px;
                font-style: italic;
                text-align: left;
            }
            .titulo{
                margin-bottom: 3px;
                margin-top: 3px;
                font-weight: bold;
            }
            .titulo a{
                color: #000000;
                font-size: 0.8em;
            }
            .jefatura{
                margin-bottom: 6px;
                margin-top: 3px;               
            }
            .subtitulo{
                margin-top: 3px;
                font-weight: bold;
                font-size: 0.8em;
            }
            h1{
                text-decoration:underline;
                margin-bottom: 8px;
            }

        </style>


    </head>


    <body>
        <section>
            <div class='banner'>
                <h1>NOTIFICACION DE ENCUESTA</h1>
                <h3>{{$encuesta->trabajador->NombreCompleto}} presenta sintomas de covid-19</h3>
                <table  bgcolor="#f6f6f6" >
                    <tr>

                        <td width='188'>
                            <p class='titulo'><a href="http://10.1.50.2:8080/isl//detalle-encuesta-trabajador/{{$encuesta_id}}">Ver encuesta si esta dentro del trabajo</a></p>  
                        </td>
                        
                        <td width='188'>
                            <p class='titulo'><a href="http://216.244.171.14:8080/isl//detalle-encuesta-trabajador/{{$encuesta_id}}">Ver encuesta si esta fuera del trabajo</a></p>  
                        </td>
                    </tr>
                </table>
            </div>            
        </section>
    </body>

</html>


