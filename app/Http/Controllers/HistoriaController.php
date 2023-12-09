<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Historia;
use DataTables;
use DB;

class HistoriaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if( auth()->user()->tipo == 0){


            $usuario = \App\Models\Profesional::where('user_id', '=', auth()->user()->id)->get()->first();
            $historias = \App\Models\Historia::join('pacientes', 'pacientes.id', 'historias.id_paciente')
            ->join('profesionales', 'profesionales.id', 'historias.id_profesional')
            ->join('users', 'users.id', 'profesionales.user_id')
            ->select('historias.id', DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"), DB::raw("CONCAT(profesionales.nombre,' ', profesionales.apellidos) AS profesional"),
               'historias.consecutivo', 'historias.fecha', 'historias.hora', 'historias.estado', 'users.tipo', 'historias.firma'
            )
            ->where('profesionales.user_id', '=', auth()->user()->id)
            ->get();

        }
        else {
            $usuario = \App\Models\Paciente::where('user_id', '=', auth()->user()->id)->get()->first();
            
            
            $historias = \App\Models\Historia::join('pacientes', 'pacientes.id', 'historias.id_paciente')
            ->join('profesionales', 'profesionales.id', 'historias.id_profesional')
            ->join('users', 'users.id', 'pacientes.user_id')
            ->select('historias.id', DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"), DB::raw("CONCAT(profesionales.nombre,' ', profesionales.apellidos) AS profesional"),
                'historias.consecutivo', 'historias.fecha', 'historias.hora', 'historias.estado', 'users.tipo', 'historias.firma'
            )
            ->where('pacientes.user_id', '=', auth()->user()->id)
            ->get();
        }

        if ($request->ajax()) {
            return Datatables::of($historias)
                ->addIndexColumn()
                ->addColumn('estado', function($row){
                    if($row->estado == '1'){
                        $estadoButton = '<button type="button" class="edit btn btn-outline-danger btn-sm" onclick="cambiarestado('.$row->id.')">
                        Activa</button>';
                    }
                    else {
                        $estadoButton = '<button type="button" class="edit btn btn-outline-info btn-sm">
                        Atendida</button>';
                    }

                    $firmado = '<badge class="btn btn-success btn-sm">Firmada</badge>';
                    
                    if( $row->firma == 1 ){
                        return $estadoButton. ' '. $firmado;
                    }else {
                        return $estadoButton;
                    }
                    
            })
            ->addColumn('action', function($row){
                    $updateButton = '<a type="button" class="update btn btn-outline-warning btn-sm" href="/historias-edit/'.$row->id.' ">
                    Editar</a>';

                    $viewButton = '<a type="button" class="update btn btn-outline-info btn-sm" href="/historias-show/'.$row->id.' ">
                    Ver</a>';

                    $firmaButton = '<a type="button" class="update btn btn-outline-success btn-sm" data-toggle="modal" data-target="#firmar'.$row->id.'" onclick="firmar('.$row->id.')">
                    Firmar</a>

                    <div class="modal fade" id="firmar'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light">Firmar asistencia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/historias-firmar/'.$row->id.'">
                                    <div class="modal-body">
                                        ¿Estas seguro que quieres firmar esta historia como si hubieras asistido a la consulta?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Firmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';
                    
                    if($row->tipo == 1){
                        if($row->firma != 1){
                            return $viewButton.' '.$firmaButton;
                        }
                        else {
                            return $viewButton;
                        }
                    }
                    else {
                        return $viewButton.' '.$updateButton;
                    }
                
            })
            ->rawColumns(['action', 'estado'])
            ->make(true);
        }

        return view('historias.index', compact('usuario'));
    }

    public function store( Request $request ){
        $historia = \App\Models\Historia::create([
            'id_profesional' => auth()->user()->id,
            'id_paciente' => $request->id_paciente,
            'inf_relevante' => $request->info_relevante,
            'consecutivo' => $request->consecutivo,
            'estado' => 1,
            'inf_antecedentes' => $request->inf_antecedentes,
            'evolucion_final' => $request->evolucion,
            'concepto_profesional' => $request->concepto,
            'recomendaciones' => $request->recomendaciones,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);
        $historia->save();


        if( $request->hasFile('imagen')){
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/historias/'),$imageName);
            
            $historia->fill([
                'imagen' => $imageName
            ]);

            $historia->save();
        }

        return redirect('/historias');
    }

    public function show(Historia $historia){

        $paciente = \App\Models\Paciente::where('id', '=', $historia->id_paciente)->get()->first();
        $profesional = \App\Models\Profesional::where('id', '=', $historia->id_profesional)->get()->first();

        return view('historias.view', compact('historia', 'paciente', 'profesional'));
    }

    public function edit(Historia $historia){

        $paciente = \App\Models\Paciente::where('id', '=', $historia->id_paciente)->get()->first();
        $profesional = \App\Models\Profesional::where('id', '=', $historia->id_profesional)->get()->first();

        return view('historias.edit', compact('historia', 'paciente', 'profesional'));
    }

    public function update(Historia $historia, Request $request){
        $historia->fill([
            'inf_relevante' => $request->info_relevante,
            'inf_antecedentes' => $request->inf_antecedentes,
            'evolucion_final' => $request->evolucion,
            'concepto_profesional' => $request->concepto,
            'recomendaciones' => $request->recomendaciones,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);
        $historia->save();

        if( $request->hasFile('imagen')){
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/historias/'),$imageName);
            
            $historia->fill([
                'imagen' => $imageName
            ]);

            $historia->save();
        }

        $msg = 'La historia No. '. $historia->id.' ha sido actualizada';

        return redirect('/historias?msg='.$msg);
    }

    public function consecutivo(  ){
        $id = $_GET['id'];

        $users = \App\Models\User::where('num_identificacion', '=', $id)->where('tipo', '=', '1')->get()->first();

        

        if( $users == null ){
            echo "false";
        }
        else {
            $paciente = \App\Models\Paciente::where('user_id', '=', $users->id)->get()->first();


            $consecutivo =  \App\Models\Historia::select('historias.consecutivo', 'historias.id_paciente')
            ->where('historias.id_paciente', '=', $paciente->id)
            ->latest('consecutivo')->first();

            if( $consecutivo == null ){
                return $array = [
                    "consecutivo" => 1,
                    "id" => $consecutivo->id_paciente
                ];
            }
            else {
                return $array = [
                    "consecutivo" => $consecutivo->consecutivo + 1,
                    "id" => $consecutivo->id_paciente
                ];
            }
            // return $paciente;
        }
    }

    public function firmar(Historia $historia){
        $historia->fill([
            'firma' => 1,
        ]);
        $historia->save();

        return redirect('/historias');
    }

    public function apiObtenerHistorias(Request $request){
        $id = $request->usuario;

        $user = \App\Models\User::find($id);

        if($user->tipo == 0){
            $profesional = \App\Models\Profesional::where('user_id', '=', $id)->get()->first();

            $historias = \App\Models\Historia::join('pacientes', 'pacientes.id', 'historias.id_paciente')
            ->join('profesionales', 'profesionales.id', 'historias.id_profesional')
            ->select('historias.id', DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"), DB::raw("CONCAT(profesionales.nombre,' ', profesionales.apellidos) AS profesional"),
                'historias.consecutivo', 'historias.imagen', 'historias.fecha', 'historias.hora', 'historias.estado','historias.firma'
            )
            ->where('historias.id_profesional', '=', $profesional->id)
            ->get();

            return response()->json([
                'status' => true,
                'historias' => $historias
            ]);
        }
        else {

            $paciente = \App\Models\Paciente::where('user_id', '=', $id)->get()->first();

            $historias = \App\Models\Historia::join('pacientes', 'pacientes.id', 'historias.id_paciente')
            ->join('profesionales', 'profesionales.id', 'historias.id_profesional')
            ->select('historias.id', DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"), DB::raw("CONCAT(profesionales.nombre,' ', profesionales.apellidos) AS profesional"),
                'historias.consecutivo', 'historias.fecha', 'historias.imagen', 'historias.hora', 'historias.estado', 'historias.firma'
            )
            ->where('historias.id_paciente', '=', $paciente->id)
            ->get();

            return response()->json([
                'status' => true,
                'historias' => $historias
            ]);
        }
    }

    public function apiObtenerHistoria(Request $request){
        $id = $request->historia;

        $historia = \App\Models\Historia::join('pacientes', 'pacientes.id', 'historias.id_paciente')
        ->join('profesionales', 'profesionales.id', 'historias.id_profesional')
        ->select('historias.id', DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"), DB::raw("CONCAT(profesionales.nombre,' ', profesionales.apellidos) AS profesional"),
            'historias.consecutivo', 'historias.fecha', 'historias.imagen', 'historias.hora', 'historias.estado', 'historias.firma', 'historias.imagen','inf_relevante', 'inf_antecedentes', 'evolucion_final', 'concepto_profesional', 'recomendaciones'
            )
        ->where('historias.id', '=', $id)
        ->get();

        return response()->json([
            'status' => true,
            'historia' => $historia
        ]);
    }

    public function apiCrearHistoria(Request $request){
        $historia = \App\Models\Historia::create([
            'id_profesional' => $request->id_profesional,
            'id_paciente' => $request->id_paciente,
            'inf_relevante' => $request->inf_relevante,
            'consecutivo' => $request->consecutivo,
            'estado' => 1,
            'inf_antecedentes' => $request->inf_antecedentes,
            'evolucion_final' => $request->evolucion_final,
            'concepto_profesional' => $request->concepto_profesional,
            'recomendaciones' => $request->recomendaciones,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'firma' => 0
        ]);
        $historia->save();

        if( $request->hasFile('imagen')){
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/historias/'),$imageName);
            
            $historia->fill([
                'imagen' => $imageName
            ]);

            $historia->save();
        }

        return response()->json([
            'status' => true,
            'historias' => $historia
        ]);
        
    }

    public function apiUpdateHistoria(Request $request){
        $id = $request->historia;

        $historia = \App\Models\Historia::find($id);

        $historia->fill([
            'inf_relevante' => $request->inf_relevante,
            'inf_antecedentes' => $request->inf_antecedentes,
            'evolucion_final' => $request->evolucion_final,
            'concepto_profesional' => $request->concepto_profesional,
            'recomendaciones' => $request->recomendaciones,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);
        $historia->save();

        if( $request->hasFile('imagen')){
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/historias/'),$imageName);
            
            $historia->fill([
                'imagen' => $imageName
            ]);

            $historia->save();
        }

        return response()->json([
            'status' => true,
            'historias' => $historia
        ]);
        
    }

    public function apiObtenerConsecutivo( Request $request ){
        $id = $request->num_identificacion;

        $users = \App\Models\User::where('num_identificacion', '=', $id)->where('tipo', '=', '1')->get()->first();

        if( $users == null ){
            echo "false";
        }
        else {
            $paciente = \App\Models\Paciente::where('user_id', '=', $users->id)->get()->first();


            $consecutivo =  \App\Models\Historia::select('historias.consecutivo', 'historias.id_paciente')
            ->where('historias.id_paciente', '=', $paciente->id)
            ->latest('consecutivo')->first();

            if( $consecutivo == null ){
                return response()->json([
                    "consecutivo" => 1,
                    "id" => $consecutivo->id_paciente
                ]);
            }
            else {
                return response()->json([
                    "consecutivo" => $consecutivo->consecutivo + 1,
                    "id" => $consecutivo->id_paciente
                ]);
            }
        }
    }

    public function apiFirmarHistoria(Request $request){
        $id = $request->historia;

        $historia = Historia::find($id);

        $historia->fill([
            'firma' => 1,
        ]);
        $historia->save();

        return response()->json([
            'status' => true,
            'historia' => $historia
        ]);
    }

    public function apiObtenerPacientes(){
        $pacientes = \App\Models\Paciente::join('users', 'users.id', 'pacientes.user_id')
        ->select('pacientes.id', 'users.num_identificacion',  DB::raw("CONCAT(pacientes.nombre,' ', pacientes.apellidos) AS paciente"))
        ->get();
        return response()->json([
            'status' => true,
            'pacientes' => $pacientes,
        ]);
    }
}
