<?php

namespace App\Http\Responses;

use Illuminate\Http\Exceptions\HttpResponseException;

class HttpResponse
{
	/**
	 * @param array $data
	 * @param string|null $message
	 * @return \Illuminate\Http\JsonResponse
	 */
	public static function success(array $data = null, string $message = null)
	{
		$config = config('response')['success'];
		$response = response()->json([
			'status' => $config['error_code'],
			'message' => $message ?: $config['message'],
			'data' => $data,
			'time' => date('Y-m-d H:i:s')
		], $config['http_code']);
		return $response;
	}

    /**
     * @param string $errorKey
     * @param array|null $data
     * @param String|null $message
     * @return HttpResponseException
     */
	public static function fail(string $errorKey, array $data = null, String $message = null)
	{
		$config = config('response')[$errorKey];
		$response = response()->json([
			'status' => $config['error_code'],
			'message' => !is_null($message) ? $message : $config['message'],
			'data' => $data,
			'time' => date('Y-m-d H:i:s')
		], $config['http_code']);
		return new HttpResponseException($response);
	}
}