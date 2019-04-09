<?php

return [
    'success' => [
        'error_code' => 0,
        'http_code' => 200,
        'message' => 'Success',
    ],

    40001 => [
    	'error_code' => 40001,
        'http_code' => 400,
        'message' => 'Bad Requests in User CRUD.'
    ],

    40002 => [
        'error_code' => 40002,
        'http_code' => 400,
        'message' => 'Validation Failed.'
    ],

    40401 => [
        'error_code' => 40401,
        'http_code' => 404,
        'message' => 'The request url is invalid.'
    ],

    50000 => [
        'error_code' => 50000,
        'http_code' => 500,
        'message' => 'Internal Error.'
    ],
];