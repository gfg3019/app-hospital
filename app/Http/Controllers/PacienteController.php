<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Endereco;


class PacienteController extends Controller
{

    //protected $modelPaciente = Paciente::class;

    public static function exibirPacientes()
    {
        //return Paciente::showPacientes();
    }

    public static function store(Request $request)
    {
        $request->validate([
            'logradouro' => 'required',
            'numero' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'endereco_id' => 'required',
            'nome' => 'required',
            'sexo' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'data_nascimento' => 'required',
        ],[
            'required' => 'O campo preciza ser preenchido'
        ]);


        DB::beginTransaction();
        try {
            $novoEndereco = Endereco::create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => isset($request->complemento) ? $request->complemento : '',
                'cep' => $request->cep,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
            ]);

            if(!$novoEndereco instanceof Endereco){
                throw new Exception('O novo endereco não pode ser cadastrado.');
            }

            $novoPaciente = Paciente::create([
                'endereco_id' => $novoEndereco->id,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'data_nascimento' => $request->data_nascimento,
            ])->with('endereco')->first();

            DB::commit();

            return response()->json($novoPaciente, 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($th->getMessage(), 403);
        }
    }

    public static function show(Request $request, $id){
        $paciente = Paciente::find($id);
        $result = $paciente->where('id', $id);

        return response()->json($result->with(['endereco', function($query){
            $query->select('id','logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'uf');
        }])->get(), 200);
    }
}
