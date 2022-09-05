<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Endereco;


class PacienteController extends Controller
{

    public static function store(Request $request)
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

            return response()->json($novoPaciente->with('endereco')->get(), 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($th->getMessage(), 403);
        }
    }

    public static function show(Request $request, $id){
        try
        {
            $paciente = Paciente::find($id);
            $result = $paciente->where('id', $id)->with('endereco')->get();
            return response()->json($result, 200);

        } catch (\Throwable $th)
        {
            return response()->json($th->getMessage(), 403);
        }
    }

    public static function showAll()
    {
        try
        {
            $paciente = Paciente::with('endereco')->get();
            return response()->json($paciente, 200);

        } catch (\Throwable $th)
        {
            return response()->json($th->getMessage(), 403);
        }
    }

    public static function updatePatiente(Request $request, $id)
    {
        /**
         * Primeiro eu vou pegar o id de endereco
         * Depois eu vou colocar os atributos de endereco
         * Vou chamar os atributos do objeto paciente
         * e vou atulizar todos eles
         */

        DB::beginTransaction();
        try {
            $endereco = Endereco::find($id);
            $endereco->fill([
                'logradouro'=> $request->logradouro,
                'numero' => $request->numero,
                'complemento'=> $request->complemento,
                'cep' => $request->cep,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
            ]);

            $paciente = Paciente::find($id);
            $paciente->fill([
                'endereco_id' => $endereco->id,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'data_nascimento' => $request->data_nascimento,
            ])->with('endereco')->first();
            $endereco->save();
            $paciente->save();
            DB::commit();
            return true;
        } catch (Throwable $th) {
            return response()->json($th->getMessage(), 403);
        }
    }

    public static function deletePatiente(Request $request, $id)
    {
        $endereco = Endereco::where('id', $id)->delete();
        $paciente = Paciente::where('id', $id)->delete();
    }
}
