<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

    /**
     * @OA\Info(
     *    title="Desafio Técnico - Backend PHP 2023",
     *    description = "Desafio Técnico - Backend PHP 2023",
     *    version="1.0.0",
     *     @OA\Contact(
     *          email="acarlos.os@hotmail.com"
     *     ),
     *     @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *  @OA\Server(
     *      url="http://desafio.teste/api",
     *      description="local",
     *  )
     */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
