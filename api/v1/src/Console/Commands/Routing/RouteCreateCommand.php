<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 16:03
 */

namespace Flexe\Console\Commands\Routing;

use Flexe\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RouteCreateCommand extends Command
{
    /**
     * @var string
     */
    protected $pathWriteModule;

    /**
     * @var string
     */
    protected $nameSpaceModule;

    /**
     * @var \stdClass
     */
    private $metaModule;

    /**
     * @var string
     */
    protected $nameRoute;

    /**
     * @var boolean
     */
    protected $stopProcess;

    /**
     * @var string
     */
    protected $verb;

    /**
     * @var InputInterface;
     */
    protected $input;

    /**
     * @var OutputInterface;
     */
    protected $output;

    /**
     * @var string
     */
    protected $moduleName;

    protected $route;

    protected $controller;

    protected function configure()
    {

        $this
            // the name of the command (the part after "bin/console")
            ->setName('up:create-route')
            // the short description shown while running "php bin/console list"
            ->setDescription('Create route')

            ->addArgument('name-module', InputArgument::REQUIRED, 'Name module is case-sensitive')

            ->addArgument('name-route', InputArgument::REQUIRED, 'Name route is case-sensitive')

            ->addArgument('route', InputArgument::REQUIRED, 'route is case-sensitive')

            ->addArgument('controller', InputArgument::REQUIRED, 'Name controller is case-sensitive')

        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInputOutputInterface($input, $output)
            ->initializeAttributes()
            ->validateCommand()
            ->writeRoute();
    }

    protected function setInputOutputInterface(InputInterface $input, OutputInterface $output) {

        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    protected function initializeAttributes() {

        $arrayModule = $this->getModuleData($this->input->getArgument('name-module'));

        $this->nameRoute = $this->input->getArgument('name-route');
        $this->route = $this->input->getArgument('route');
        $this->controller = $this->input->getArgument('controller');

        if (count($arrayModule) != 0) {
            $this->pathWriteModule = $arrayModule['path-write-module'];
            $this->nameSpaceModule = $arrayModule['name-space-module'];
            $this->moduleName = $arrayModule['module-name'];
        }

        $this->stopProcess = false;
        return $this;
    }

    /**
     * @param $moduleName
     * @return mixed
     */
    protected function getModuleData($moduleName) {

        $arrayReturn = [];

        $listModules = App::getModulesInstall();

        foreach ($listModules as $module) {
            if (strtoupper($module::NAME) == strtoupper($moduleName)) {
                $arrayReturn['path-write-module'] = $module::getRoutes();
                $arrayReturn['name-space-module'] = sprintf( '%s\Route',$module::getNamespace());
                $arrayReturn['module-name'] = $module::NAME;
                $this->metaModule = $module;
                break;
            }
        }

        return $arrayReturn;
    }

    protected function validateCommand() {

        $io = new SymfonyStyle($this->input, $this->output);

        if (!$this->pathWriteModule or !$this->nameSpaceModule) {
            $io->getErrorStyle()->error('Module not found');

            $this->stopProcess = true;
            return $this;
        }

        if (file_exists(sprintf( '%s/%sRoute.php',$this->pathWriteModule, $this->nameRoute ))) {
            $this->stopProcess = true;
            $io->getErrorStyle()->error('Route already exists');
            return $this;
        }

        return $this;
    }



    protected function writeRoute() {

        if ($this->stopProcess)
            return false;

        $io = new SymfonyStyle($this->input, $this->output);
        $routeStub = file_get_contents(__DIR__ . '/snippets/route.model.snippets');

        $routeStub = str_replace('{{ROUTE-NAME}}', $this->nameRoute, $routeStub);
        $routeStub = str_replace('{{NAMESPACE-ROUTE}}', $this->nameSpaceModule, $routeStub);
        $routeStub = str_replace('{{NAME-MODULE}}', $this->moduleName, $routeStub);
        $routeStub = str_replace('{{ROUTE}}', strtolower($this->route), $routeStub);
        $routeStub = str_replace('{{CONTROLLER}}', strtolower($this->controller), $routeStub);

        $controller = sprintf( '%s/%sRoute.php',$this->pathWriteModule, $this->nameRoute);

        file_put_contents($controller, $routeStub);

        $io->success('Route successfully created');

        return true;
    }
}