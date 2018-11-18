<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 11:32
 */

namespace App\Admin\Controller;


use Firebase\JWT\JWT;
use Flexe\Tuupola\Base62;

class AuthController extends AbstractController
{

    protected $model = 'AuthModel';

    protected $controller = "auth";

    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param array $arqs
     * @return mixed
     * @throws \Exception
     */
    public function token( $request, $response, $arqs = []){

        /* Here generate and return JWT to the client. */
        //$valid_scopes = ["read", "write", "delete"]

        $requested_scopes = $request->getParsedBody() ?: [];

        $now = new \DateTime();
        $future = new \DateTime("+60 minutes");
        $server = $request->getServerParams();
        $jti = (new Base62)->encode(random_bytes(16));
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti
        ];
        $secret = $this->container['secretkey'];
        $token = JWT::encode($payload, $secret, "HS256");
        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();
        return $response->withStatus(201)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param array $arqs
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function login( $request, $response, $arqs = []){

        $data = $request->getParsedBody() ?: [];

        if (strtoupper($request->getMethod()) ==="POST"):

            if(!isset($data['email'])):
                return $response->withStatus(401)
                    ->withHeader("Content-Type", "application/json")
                    ->withJson([
                        'result'=>false,
                        'error'=>'Email não informado'
                    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            endif;

            if(!isset($data['password'])):
                return $response->withStatus(401)
                    ->withHeader("Content-Type", "application/json")
                    ->withJson([
                        'result'=>false,
                        'error'=>'Senha não informado'
                    ]);
            endif;

            $model = $this->container->get($this->model);

            $model->createAdminUserIfNotExists($this->tenant);

            $auth = $model->authenticate($data['email'], $data['password']);

            if($auth):

                return $response->withStatus(200)
                    ->withHeader("Content-Type", "application/json; charset=UTF-8")
                    ->withJson(array_merge([
                        'result'=>$model->getCode(),
                        'error'=>$model->getResult()
                    ],$model->getToken($this->container['secretkey'])));

            endif;

        endif;

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->withJson([]);

    }

    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param array $arqs
     * @return mixed
     * @throws \Exception
     */
    public function register( $request, $response, $arqs = []){

    }

    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param array $arqs
     * @return mixed
     * @throws \Exception
     */
    public function forgot( $request, $response, $arqs = []){

    }

}