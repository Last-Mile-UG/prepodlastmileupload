<?php

// (Make sure to set dry_run to true if you're using development *.pem certificate, and false for production)

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => true,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => true,
        'apiKey' => 'My_ApiKey',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
