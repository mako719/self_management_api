<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
class AuthenticateAPIRequest
{
    public function handle(Request $request, Closure $next)
    {
        // リクエストからsecret keyを取得
        $secretKey = $request->bearerToken();
        // configから登録したsecret keyを取得
        $registeredSecretKey = Config::get('app.api_secret_key');
        // secret keyが一致しない場合はエラーレスポンスを返す
        if ($secretKey !== $registeredSecretKey) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return $next($request);
    }
}
