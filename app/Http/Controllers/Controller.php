<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="My Cool API",
 *    description="An API of cool stuffs",
 *    version="1.0.0",
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
