<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Token;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $apiToken = $request->header('Authorization');
        $data = $request->all();
        if (!$apiToken) {
            return response()->json('Unauthorized', 401);
        } 

        // Remove 'Bearer ' from the token string
        $apiToken = str_replace('Bearer ', '', $apiToken);
        $token = Token::where('key', $apiToken)->first();
        
        try{
            $tokenDecrypt = Crypt::decryptString($apiToken);
            $tokenDBDecrypt = Crypt::decryptString($token->key);
        } catch(Exception $e){
            return response()->json('Unauthorized Key', 401);
        }
        
        if(!$token || $token->user != $data['user'] || $tokenDBDecrypt != $tokenDecrypt) {
            return response()->json('Unauthorized', 401);
        } 

        $request->token = $token;

        return $next($request);
    }
}
