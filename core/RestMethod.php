<?php


namespace app\extensions\restmodel\core;


final class RestMethod {
	const GET = 'GET';
	const POST = 'POST';
	const PATCH = 'PATCH';
	const PUT = 'PUT';
	const DELETE = 'DELETE';

	private function __construct() { /* disable instantiation */ }
}