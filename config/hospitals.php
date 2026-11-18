<?php

return [

    /*
    | Hospital sites are served at {username}.{base_domain}.
    | Local: city.localhost:8000
    | Live:  city.selfcare.easybzi.com
    */
    'base_domain' => env('HOSPITAL_BASE_DOMAIN', 'selfcare.easybzi.com'),

    // Turn on after *.selfcare.easybzi.com DNS points at this server.
    'redirect_legacy' => env('HOSPITAL_SUBDOMAIN_REDIRECT', false),

    'reserved' => [
        'www', 'mail', 'office', 'area', 'selfcare', 'admin', 'api', 'app', 'cpanel', 'webmail', 'ftp',
        'ns1', 'ns2', 'autoconfig', 'autodiscover', 'localhost', 'selfcare',
    ],

    /*
    | Named public hospital routes => path on the hospital subdomain.
    | The first route parameter is always the hospital username.
    */
    'public_paths' => [
        'front' => '/',
        'send.enquiry' => '/send-enquiry',
        'contact' => '/contact-us',
        'aboutUs' => '/about-us',
        'appointment' => '/appointment',
        'appointment.post' => '/appointment-form',
        'our-services' => '/our-services',
        'our-doctors' => '/our-doctors',
        'terms-of-service' => '/terms-of-service',
        'privacy-policy' => '/privacy-policy',
        'working-hours' => '/working-hours',
        'testimonials' => '/testimonial',
        'patient.details' => '/patient-details/{uniqueCode}',
        'doctor.details' => '/doctor-details/{id}',
    ],

];
