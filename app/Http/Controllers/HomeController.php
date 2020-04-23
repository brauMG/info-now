<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\NuevaActividad;
use Illuminate\Support\Facades\Mail;
use App\Areas;
use App\Compania;
use App\Actividad;
use App\Fase;
use App\Proyecto;
use App\Status;
use App\Enfoque;
use App\Trabajo;
use App\Indicador;
use App\RolRASIC;
use App\RolProyecto;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->Clave_Rol==1){
            return redirect('/Admin/Compania');
        }
        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        $RolProyectos=RolProyecto::where('Clave_Usuario',Auth::user()->Clave)
            ->get();
        $proyectos=[];
        foreach($RolProyectos as $rolProyecto){
            $proyecto=Proyecto::where('Clave',$rolProyecto->Clave_Proyecto)
            ->first();
            if(!in_array($proyecto,$proyectos)){
                array_push($proyectos,$proyecto);
            }
        }
        
        
        
        $fases=Fase::where('Activo', 1)
               ->orderBy('Orden', 'asc')
               ->get();
        $status=Status::all();
        $areas=Areas::all();
        $enfoques=Enfoque::all();
        $trabajos=Trabajo::all();
        $indicadores=Indicador::all();
        $rolRASIC=RolRASIC::all();
        return view('Admin.Home.index',['proyectos'=>$proyectos,'compania'=>$compania,'fases'=>$fases,'areas'=>$areas,'status'=>$status,'enfoques'=>$enfoques,'trabajos'=>$trabajos,'indicadores'=>$indicadores,'rolRASIC'=>$rolRASIC]);
    }
    public function selectCompany(Request $request){
        $compania=Compania::all();
        return view('Shared.SelectCompany',['companias'=>$compania]);
    }
    public function create(Request $request){        
        
        $actividad = new Actividad;        
        $actividad->Clave_Compania=$request->compania;
        $actividad->Clave_Proyecto = $request->proyecto;
        $actividad->Clave_Fase = $request->fase;
        $actividad->Descripcion = $request->descripcion;
        $actividad->FechaAccion = $request->fechaAccion;
        $actividad->Decision = $request->decision;
        $actividad->Clave_Status = $request->status;
        $actividad->Activo=true;
        $actividad->save();


        $users=[];
        /*if($request->usuarios!='-1'){
            foreach(explode(',', $request->usuarios) as $usuario){
                if(RolFase::where('Clave_Usuario',$usuario)->where('Clave_Proyecto','=',$proyecto->Clave_Fase)->count()>0){

                }else{
                    $RolProyecto=new RolProyecto;
                    $RolProyecto->Clave_Proyecto=$proyecto->Clave;
                    $RolProyecto->Clave_Usuario=$usuario;
                    $RolProyecto->Activo=true;
                    $RolProyecto->save();

                }
                                    
            }    
        }else{
           if(RolProyecto::where('Clave_Usuario',$request->usuarios)->where('Clave_Proyecto','=',$proyecto->Clave)->count()>0){

                }else{
                    $RolProyecto=new RolProyecto;
                    $RolProyecto->Clave_Proyecto=$proyecto->Clave;
                    $RolProyecto->Clave_Usuario=$request->usuarios;
                    $RolProyecto->Activo=true;
                    $RolProyecto->save();

                }
                                    
            
        }*/
        
        /*$obj =  array(
            'Nombre' =>'Cristian Santiago',
            'Reporte' =>[]
        );
        Mail::to("cristian.santiago.rosas@gmail.com")->send(new Email($obj));*/

        
        $RolProyectos=RolProyecto::where('Clave_Proyecto',$request->proyecto)
            ->where('Clave_Fase','=',$request->fase)
            ->orWhere('Clave_Fase','=','8')
            ->get();
        $Users=DB::table('Usuarios')
            ->leftJoin('Companias', 'Usuarios.Clave_Compania', '=', 'Companias.Clave')
            ->leftJoin('Areas','Usuarios.Clave_Area','=','Areas.Clave')
            ->leftJoin('Puestos','Usuarios.Clave_Puesto','=','Puestos.Clave')
            ->leftJoin('Roles','Usuarios.Clave_Rol','=','Roles.Clave')
            ->select('Usuarios.Clave','Companias.Clave as Clave_Compania','Companias.Descripcion as Compania','Usuarios.Iniciales','Usuarios.Nombres','Usuarios.Correo','Areas.Descripcion as Area','Puestos.Puesto as Puesto','Roles.Rol AS Rol','Usuarios.Nombres','Usuarios.UltimoLogin as UltimoLogin','Areas.FechaCreacion','Areas.Activo')
            ->where('Usuarios.Clave_Compania','=',Auth::user()->Clave_Compania)
            ->get();

        $compania=Compania::where('Clave',Auth::user()->Clave_Compania)->first();
        return view('Admin.Home.Usuarios',['usuarios'=>$Users,'rolesProyectos'=>$RolProyectos,'Clave_Proyecto'=>$request->proyecto,'Clave_Fase'=>$request->fase,'compania'=>$compania,'descripcion'=>$request->descripcion,'decision'=>$request->decision,'fechaAccion'=> $request->fechaAccion]);
    }
    public function DeleteUser(Request $request){
        return response()->json(['error'=>false]);
    }
    public function AddUser(Request $request){
        
        $rolPROYECTO = new RolProyecto;
        $rolPROYECTO->Clave_Proyecto = $request->proyecto;
        $rolPROYECTO->Clave_Fase = $request->fase;
        $rolPROYECTO->Clave_Rol_RASIC ='I';
        $rolPROYECTO->Clave_Usuario=$request->id;
        $rolPROYECTO->Activo=true;
        $rolPROYECTO->save();
        return response()->json(['error'=>false]);
    }
    public function send(Request $request){
        $rolesProyectos=RolProyecto::where('Clave_Proyecto',$request->proyecto)
            ->where('Clave_Fase','=',$request->fase)
            ->orWhere('Clave_Fase','=','8')
            ->get();
        foreach ($rolesProyectos as $rolProyecto) {
            $user=User::find($rolProyecto->Clave_Usuario);            
                $obj =  array(
                    'Nombre' =>$user->Nombres,
                    'Descripcion' =>$request->descripcion,
                    'ProximaActividad'=>$request->decision,
                    'FechaProximaRevision'=>$request->fechaAccion
                );        
                 $para      = $user->Correo;
                 //$para      = 'cristian.santiago.rosas@gmail.com';
                $titulo    = 'Nueva Actividad';
                $mensaje   = '
                    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Rapidoss</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- CSS Reset -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        *[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* What it does: A work-around for Gmail meddling in triggered links. */
        .x-gmail-data-detectors,
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesnt work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size youd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #005CA6 !important;
            border-color: #005CA6 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
        }

    </style>

</head>
<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #222222; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Favor de no reenviar este correo [Avenzo.mx] - Solicitud de cambio de contraseña
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <div style="max-width: 680px; margin: auto;" class="email-container">

            <!-- Email Body : BEGIN -->
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;">

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px;">
                                    <h1 style="padding-top: 10px; padding-bottom: 10px; font-size:25px;background-color:#16a5b8;color: white;width: 100%;">
                                        R A P I D O S S
                                    </h1>
                                    <h2 style="color: #555555;">Hola, '.$user->Nombres.'</h2>
                                    Se ha creado una nueva actividad.
                                    <hr></hr>
                                    <h4 style="text-align: left;color: #555555;">
                                        Descripci&oacute;n:                                        
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->descripcion.'
                                    </p>
                                    <h4 style="text-align: left;color: #555555;">
                                        Pr&oacute;xima Actividad:                                     
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->decision.'
                                    </p>
                                    <h4 style="text-align: left;color: #555555;">
                                        Fecha de pr&oacute;xima revisi&oacute;n:                               
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->fechaAccion.'
                                    </p>
                                    <p style="font-size:10px;background-color:#424242;color: white;width: 100%;height: 20px;">Este mensaje es informativo, favor de no contestar.</p>                       
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

                <!-- Background Image with Text : BEGIN -->
                <tr>
                    <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
                    <td background="http://avenzo.mx/Images/bg-5.jpg" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;background-attachment:fixed;background-repeat:no-repeat;">
                        <div>
                            <table role="presentation" aria-hidden="true" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:500px; margin: auto;">
                                <tr>
                                    <td valign="middle" style="text-align: center; padding: 40px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #ffffff;">
                                        <!--Recuerda Visitarnos en avenzo.mx-->                                     
                                    </td>
                                </tr>
                            </table>
                           
                        </div>                      
                    </td>
                </tr>    
            </table>
        </div>
    </center>
</body>
</html>
';
                $cabeceras = 'From: admin@info-now.app' . "\r\n" .
                    'Reply-To: admin@info-now.app' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $cabeceras .= 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


                mail($para, $titulo, $mensaje, $cabeceras);

                //Mail::to($user->Correo)->send(new NuevaActividad($obj));
            
        }

        $mensaje   = '
                    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Rapidoss</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- CSS Reset -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        *[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* What it does: A work-around for Gmail meddling in triggered links. */
        .x-gmail-data-detectors,
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesnt work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size youd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #005CA6 !important;
            border-color: #005CA6 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
        }

    </style>

</head>
<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #222222; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Favor de no reenviar este correo [Avenzo.mx] - Solicitud de cambio de contraseña
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <div style="max-width: 680px; margin: auto;" class="email-container">

            <!-- Email Body : BEGIN -->
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;">

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; line-height: 20px;">
                                    <h1 style="padding-top: 10px; padding-bottom: 10px; font-size:25px;background-color:#16a5b8;color: white;width: 100%;">
                                        R A P I D O S S
                                    </h1>
                                    <h2 style="color: #555555;">Hola, Administrador</h2>
                                    Se ha creado una nueva actividad.
                                    <hr></hr>
                                    <h4 style="text-align: left;color: #555555;">
                                        Descripci&oacute;n:                                        
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->descripcion.'
                                    </p>
                                    <h4 style="text-align: left;color: #555555;">
                                        Pr&oacute;xima Actividad:                                     
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->decision.'
                                    </p>
                                    <h4 style="text-align: left;color: #555555;">
                                        Fecha de pr&oacute;xima revisi&oacute;n:                               
                                    </h4>
                                    <p style="text-align: left;">
                                        '.$request->fechaAccion.'
                                    </p>
                                    <p style="font-size:10px;background-color:#424242;color: white;width: 100%;height: 20px;">Este mensaje es informativo, favor de no contestar.</p>                       
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

                <!-- Background Image with Text : BEGIN -->
                <tr>
                    <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
                    <td background="http://avenzo.mx/Images/bg-5.jpg" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;background-attachment:fixed;background-repeat:no-repeat;">
                        <div>
                            <table role="presentation" aria-hidden="true" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:500px; margin: auto;">
                                <tr>
                                    <td valign="middle" style="text-align: center; padding: 40px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #ffffff;">
                                        <!--Recuerda Visitarnos en avenzo.mx-->                                     
                                    </td>
                                </tr>
                            </table>
                           
                        </div>                      
                    </td>
                </tr>    
            </table>
        </div>
    </center>
</body>
</html>
';
                $para      = 'admin@info-now.app';
                $titulo    = 'Nueva Actividad';
                $cabeceras = 'From: admin@info-now.app' . "\r\n" .
                    'Reply-To: admin@info-now.app' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $cabeceras .= 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         mail($para, $titulo, $mensaje, $cabeceras);
        return response()->json(['error'=>false]);

    }
}
