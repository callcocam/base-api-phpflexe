<?php

namespace Flexe;

use Flexe\Middleware\CompanyMiddleware;
use Flexe\Middleware\CORSMiddleware;
use Flexe\Middleware\OptionsMiddleware;
use Flexe\Model\Tenant;
use Flexe\Providers\DBProvider;
use Flexe\Providers\ErrorHandlerProvider;
use Flexe\Tuupola\Middleware\JwtAuthentication;

class App
{
    /**
     * @var App
     */
    private static $application;

    private static $staticContainer;

    /**
     * Current version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Name application
     *
     * @var string
     */
    const NAME = 'FLEXE';

    protected $load;

    protected $app;

    protected $container;

    protected static $settings =[];

    /**
     * @return App
     */
    public static function getInstance() {
        return self::$application;
    }

    /**
     * Set application slim
     * @param App $application
     */
    public static function setInstance(App $application) {
        self::$application = $application;
    }

    /**
     * @return string
     */
    public static function getVersion() {
        return self::VERSION;
    }

    public static function getName() {
        return self::NAME;
    }

    public function __construct($settings = null)
    {
        $this->load = new Load(['Admin','Home','Obras']);

        self::$settings = $this->load->getConfig();

        $this->app = new \Slim\App([
            'settings'=>self::$settings
        ]);

        $this->container  = $this->app->getContainer();

       // $this->container  = ErrorHandlerProvider::register($this->container);

        $this->container  = DBProvider::register($this->container);

        $this->container["jwt"] = function ($c) {
            return new \StdClass;
        };

        $this->app->add(new CompanyMiddleware($this->container));

        $this->container['tenant'] = function ($c){

            return new Tenant();

        };

        /**
         * @Middleware Tratamento da / do Request
         * true - Adiciona a / no final da URL
         * false - Remove a / no final da URL
         */
        // $this->app->add(new TrailingSlash(false));
        /**
         * Token do nosso JWT
         */
        $this->container['secretkey'] = "secretloko";


        /**
         * Auth básica do JWT
         * Whitelist - Bloqueia tudo, e só libera os
         * itens dentro do "passthrough"
         */

//        $this->app->add(new JwtAuthentication([
//            "path" => ["/api", "/admin"],
//            "ignore" => ["/api/auth/token","/api/auth/login", "/api/auth", "/api/auth/forgot-password", "/api/auth/create"],
//            "relaxed" => ["http://localhost:4200","http://localhost:8080", "localhost.project-api-rest-base"],
//            "secret" => $this->container['secretkey']
//        ]));

        $this->app->add(new CORSMiddleware($this->container));

        $this->app->add(new OptionsMiddleware($this->container));

        $routes = $this->load->read('Route');

        if($routes):

            foreach ($routes as $key => $dependency):

                new $key($this->app);

            endforeach;

        endif;


        $modes = $this->load->read('Model');

        if($modes):

            foreach ($modes as $key => $dependency):

                $this->container[$dependency] = new $key;

            endforeach;

        endif;

        $tables = $this->load->read('Table');

        if($tables):

            foreach ($tables as $key => $dependency):

                $this->container[$dependency] = new $key;

            endforeach;

        endif;

        self::$staticContainer = $this->container;

    }

    public function run(){


        $this->app->run();
    }

     public static function getModulesInstall() {

        return self::$settings['path-config']['modules']['install'];
    }

     public static function getVendorInstall() {

        return self::$settings['path-config']['modules']['vendor'];
    }

    public function getDb(){

        //$this->container = DBProvider::register($this->app->getContainer());

        return $this->container['db'];

    }
}
