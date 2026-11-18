<?php

namespace App\Http\Middleware;

use App\Support\HospitalDomain;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MapHospitalSubdomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());
        $path = '/'.ltrim($request->getPathInfo(), '/');

        if (HospitalDomain::isCentralHost($host)) {
            if (config('hospitals.redirect_legacy') && $request->isMethod('GET') && preg_match('#^/h/([A-Za-z0-9]+)(/.*)?$#', $path, $match)) {
                $suffix = $match[2] ?? '/';
                if ($suffix === '') {
                    $suffix = '/';
                }

                return redirect()->away(HospitalDomain::url($match[1], $suffix));
            }

            return $next($request);
        }

        $username = HospitalDomain::label($host);
        if ($username === null) {
            return $next($request);
        }

        if (HospitalDomain::isAssetPath($path)) {
            return $next($request);
        }

        if (! HospitalDomain::exists($username)) {
            abort(404);
        }

        if (preg_match('#^/h/'.preg_quote($username, '#').'(/.*)?$#i', $path, $match)) {
            $suffix = $match[1] ?? '/';
            if ($suffix === '') {
                $suffix = '/';
            }

            return redirect()->away(HospitalDomain::url($username, $suffix));
        }

        if (! HospitalDomain::isPublicPath($path)) {
            return $next($request);
        }

        $internal = '/h/'.$username.($path === '/' ? '' : $path);
        $query = $request->getQueryString();
        $server = $request->server->all();
        $server['REQUEST_URI'] = $internal.($query ? '?'.$query : '');
        $rewritten = $request->duplicate(null, null, null, null, null, $server);

        return $next($rewritten);
    }
}
