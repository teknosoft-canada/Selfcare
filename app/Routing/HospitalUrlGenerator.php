<?php

namespace App\Routing;

use App\Support\HospitalDomain;
use Illuminate\Routing\UrlGenerator;

class HospitalUrlGenerator extends UrlGenerator
{
    public function route($name, $parameters = [], $absolute = true)
    {
        $map = config('hospitals.public_paths', []);
        if (! isset($map[$name])) {
            return parent::route($name, $parameters, $absolute);
        }

        $parameters = is_array($parameters) ? $parameters : [$parameters];
        $username = $parameters['username'] ?? null;
        $positional = [];
        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                $positional[] = $value;
            }
        }

        if (! is_string($username) || $username === '') {
            $username = array_shift($positional);
        }

        if (! is_string($username) || $username === '') {
            return parent::route($name, $parameters, $absolute);
        }

        $path = $map[$name];
        if (preg_match_all('/\{([^}]+)\}/', $path, $slots)) {
            foreach ($slots[1] as $index => $slot) {
                $value = $parameters[$slot] ?? ($positional[$index] ?? null);
                if ($value !== null) {
                    $path = str_replace('{'.$slot.'}', rawurlencode((string) $value), $path);
                }
            }
        }

        return HospitalDomain::url($username, $path);
    }
}
