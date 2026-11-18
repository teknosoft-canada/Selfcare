<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class HospitalDomain
{
    public static function baseDomain(): string
    {
        $domain = strtolower(trim((string) config('hospitals.base_domain')));

        return $domain !== '' ? $domain : 'selfcare.easybzi.com';
    }

    public static function isCentralHost(string $host): bool
    {
        $host = strtolower($host);
        $base = self::baseDomain();

        if (in_array($host, [$base, 'www.'.$base, 'localhost', '127.0.0.1'], true)) {
            return true;
        }

        $label = self::label($host);
        if ($label === null) {
            return true;
        }

        return in_array($label, config('hospitals.reserved', []), true);
    }

    public static function label(string $host): ?string
    {
        $host = strtolower($host);
        $base = self::baseDomain();
        $suffix = '.'.$base;

        if (! str_ends_with($host, $suffix)) {
            return null;
        }

        $label = substr($host, 0, -strlen($suffix));
        if ($label === '' || str_contains($label, '.')) {
            return null;
        }

        return $label;
    }

    public static function exists(string $username): bool
    {
        $username = strtolower($username);

        return Cache::remember('hospital-host:'.$username, 60, function () use ($username) {
            return User::query()
                ->whereRaw('lower(username) = ?', [$username])
                ->whereNotNull('hospital_name')
                ->exists();
        });
    }

    public static function forget(string $username): void
    {
        Cache::forget('hospital-host:'.strtolower($username));
    }

    public static function url(string $username, string $path = '/'): string
    {
        $username = strtolower($username);
        $path = '/'.ltrim($path, '/');
        $scheme = app()->environment('local') ? 'http' : 'https';
        $port = '';

        if ($scheme === 'http') {
            $requestPort = null;
            if (! app()->runningInConsole() && app()->bound('request')) {
                $requestPort = request()->getPort();
            }
            $requestPort = $requestPort ?: parse_url((string) config('app.url'), PHP_URL_PORT);
            if ($requestPort && ! in_array((int) $requestPort, [80, 443], true)) {
                $port = ':'.$requestPort;
            }
        }

        return $scheme.'://'.$username.'.'.self::baseDomain().$port.$path;
    }

    public static function isAssetPath(string $path): bool
    {
        return (bool) preg_match('#\.(css|js|map|png|jpe?g|gif|svg|webp|ico|woff2?|ttf|eot|json|txt|xml|webmanifest)$#i', $path)
            || str_starts_with($path, '/livewire')
            || str_starts_with($path, '/vendor/')
            || str_starts_with($path, '/storage/')
            || str_starts_with($path, '/build/');
    }

    public static function isPublicPath(string $path): bool
    {
        $path = rtrim($path, '/') ?: '/';

        if (preg_match('#^/(patient-details|doctor-details)/[^/]+$#', $path)) {
            return true;
        }

        $exact = ['/', '/send-enquiry', '/contact-us', '/about-us', '/appointment', '/appointment-form', '/our-services', '/our-doctors', '/terms-of-service', '/privacy-policy', '/working-hours', '/testimonial'];

        return in_array($path, $exact, true);
    }
}
