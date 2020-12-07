<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Eleccion;
use App\Models\Casilla;
use App\Models\Votocandidato;
use App\Models\Voto;

class VotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $casillas   = Casilla::all();
        $candidatos = Candidato::all();
        $elecciones = Eleccion::all();
        return view("voto/create",
        compact("casillas","candidatos","elecciones"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //print_r($_POST); exit;
        $evidencia = "";
        $request->validate([
            'eleccion_id' => 'required',
            'casilla_id'=>'required',
            'evidencia'=>'required|mimes:pdf|max:8192'
        ]);
        if ($request->hasFile('evidencia')) {
            $evidencia = $request->evidencia->getClientOriginalName() ;
            $request->evidencia->move(public_path('uploads'), $evidencia);

        }
        $data = ["eleccion_id"=>$request->eleccion_id,
                "casilla_id"=>$request->casilla_id,
                "evidencia"=>$evidencia
            ];
        //--- inserta en voto
        $voto = Voto::create($data);
        $id = $voto->id;
        //--- insertar en votoscandidatos
        $candidatos = array_filter(
            $_POST,
            function ($f)  {
                return ( substr($f,0,9)=="candidato");
            },
            ARRAY_FILTER_USE_KEY
        );
        foreach ($candidatos as $key => $value) { 
            $candidato_id = intval(substr($key, 10));
            $datavotocandidato = ["voto_id" =>intval($id),
                   "candidato_id" => $candidato_id,
                   "votos" => intval($value)
                ];
            Votocandidato::create($datavotocandidato);
        }
        echo "Guardado satisfactoriamente ...";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
