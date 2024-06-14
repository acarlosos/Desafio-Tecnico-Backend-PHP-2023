<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

    /**
     * @OA\Info(
     *    title="Desafio Técnico Api",
     *    description = "Desafio Técnico Api",
     *    version="1.0.0",
     * )
     * @OA\Server(
     *      url= "http://desafio.teste/api",
     *      description="Local"
     *  )
     */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
