<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function generate(Request $request){
        $data = $request->all();
        $userToken = Token::where('user', $data['user'])->first();
        if($userToken){
            error_log($userToken);
            return response()->json([
                'token' => $userToken->key,
                'status' => true
            ],200);
        } else {
            error_log('new Token');
            $token = Str::random(29);

            $encrypt = Crypt::encryptString($token);
            
            $db = [
                'key' => $encrypt,
                'user' => $data['user']
            ];
            error_log($encrypt);
            Token::create($db);
            return response()->json([
                'token' => $encrypt,
                'status' => true
            ],200);
        }
        
    }
}
