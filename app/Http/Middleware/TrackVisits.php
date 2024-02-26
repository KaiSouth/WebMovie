<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->session()->getId(); // Lấy ID của session hiện tại
        $ipAddress = $request->ip(); // Lấy địa chỉ IP của người dùng

        DB::table('visits')->updateOrInsert(
            ['session_id' => $sessionId],
            ['ip_address' => $ipAddress, 'visited_at' => now()]
        );

        return $next($request);
    }
}
