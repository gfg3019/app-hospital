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

    public function store(Request $request)
    {
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
}
