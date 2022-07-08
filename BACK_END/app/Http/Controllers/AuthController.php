<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function update(Request $request)
    {
        $input = [
            'id' => $request->id,
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'cpf' => $request->cpf,
            'pis' => $request->pis,
            'pais' => $request->pais,
            'cep' => $request->cep,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $user = User::find($input['id']);
        $user->fill($input);
        $user->save();
        if($user){
            return true;
        }
    }

    public function register(Request $request)
    {
        $input = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'cpf' => 'required|string|max:255|unique:users',
            'pis' => 'required|string|max:255|unique:users',
            'pais' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|integer',
            'complemento' => 'nullable|string|max:255',
        ]);
 
        $cpf_numeros = preg_replace('/[^0-9]/', '', $input['cpf']);

        $pis_numeros = preg_replace('/[^0-9]/', '', $input['pis']);

        $cep_numero = preg_replace('/[^0-9]/', '', $input['cpf']);

        return User::create([
            'nome' => $input['nome'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cpf' => $cpf_numeros,
            'pis' => $pis_numeros,
            'pais' => $input['pais'],
            'cep' => $cep_numero,
            'estado' => $input['estado'],
            'cidade' => $input['cidade'],
            'bairro' => $input['bairro'],
            'rua' => $input['rua'],
            'numero' => $input['numero'],
            'complemento' => $input['complemento'],
        ]);
    }


    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        if(strpos($input['email'], '@') === false) {
            $metodo_validacao = 'cpf';
            $credencial_validacao = preg_replace('/[^0-9]/', '', $input['email']);
        }else{
            $metodo_validacao = 'email';
            $credencial_validacao = $input['email'];
        }

        $credentials = [
            $metodo_validacao => $credencial_validacao,
            'password' => $input['password'],
        ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();
        if($user){
            return true;
        }
    }

    public function user()
    {
        return auth()->user();
    }
}
