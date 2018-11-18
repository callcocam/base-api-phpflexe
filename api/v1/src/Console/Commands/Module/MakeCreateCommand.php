<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 31/10/2018
 * Time: 09:56
 */

namespace Flexe\Console\Commands\Module;

use Flexe\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeCreateCommand extends Command
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $app;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var InputInterface;
     */
    protected $input;

    /**
     * @var OutputInterface;
     */
    protected $output;

    /**
     * @var boolean
     */
    protected $stopProcess;

    /**
     * @var string
     */
    protected $moduleInstall;

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('up:create-make')

            // the short description shown while running "php bin/console list"
            ->setDescription('Create module completo')

            ->addArgument('name-module', InputArgument::REQUIRED, 'Name module is case-sensitive')

             ->addArgument('name-app', InputArgument::REQUIRED, 'Name app is case-sensitive')

             ->addArgument('route', InputArgument::REQUIRED, 'Name route is case-sensitive')

             ->addArgument('controller', InputArgument::REQUIRED, 'Name controller is case-sensitive')

            ->addArgument('name-table', InputArgument::REQUIRED, 'Name table is case-sensitive');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInputOutputInterface($input, $output)
            ->initializeAttributes()
            ->validateCommand()
            ->writeModule();
    }

    protected function setInputOutputInterface(InputInterface $input, OutputInterface $output) {

        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    protected function initializeAttributes() {

        $this->name = $this->input->getArgument('name-module');

        $this->app = $this->input->getArgument('name-app');

        $this->table = $this->input->getArgument('name-table');

        $this->route = $this->input->getArgument('route');

        $this->controller = $this->input->getArgument('controller');

        $this->moduleInstall = App::getVendorInstall();

        return $this;
    }

   protected function validateCommand() {
        $io = new SymfonyStyle($this->input, $this->output);

        if (is_dir(sprintf("%s/%s/Controller/%sController",$this->moduleInstall, $this->name, $this->app))) {
            $io->getErrorStyle()->error('Module controller exists!');
            $this->stopProcess = true;
            return $this;
        }

        if (is_dir(sprintf("%s/%s/Model/%sModel",$this->moduleInstall, $this->name, $this->app))) {
            $io->getErrorStyle()->error('Module model exists!');
            $this->stopProcess = true;
            return $this;
        }


        if (is_dir(sprintf("%s/%s/Route/%sRoute",$this->moduleInstall, $this->name, $this->app))) {
            $io->getErrorStyle()->error('Module route exists!');
            $this->stopProcess = true;
            return $this;
        }


        if (is_dir(sprintf("%s/%s/Table/%sTable",$this->moduleInstall, $this->name, $this->app))) {
            $io->getErrorStyle()->error('Module table exists!');
            $this->stopProcess = true;
            return $this;
        }

        return $this;
    }

  
    private function writeModule() {
      
      /**
      * Procura o command para criar o controller
      */
        $command = $this->getApplication()->find('up:create-controller');

        $arguments = [
            'command' => 'up:create-controller',
            'name-module' => $this->name,
            'name-controller' => $this->app,
            'verb' => 'Get'
        ];

        $input = new ArrayInput($arguments);

        $command->run($input,$this->output);

		/**
		* Procura o command para criar o model
		*/
        $command = $this->getApplication()->find('up:create-model');

        $arguments = [
            'command' => 'up:create-model',
            'name-module' => $this->name,
            'name-model' => $this->app,
            'name-table' => $this->table
        ];

        $input = new ArrayInput($arguments);
        
        $command->run($input,$this->output);

        /**
		* Procura o command para criar o route
		*/
        $command = $this->getApplication()->find('up:create-route');

        $arguments = [
            'command' 		=> 'up:create-route',
            'name-module' 	=> $this->name,
            'name-route' 	=> $this->app,
            'route' 		=> $this->route,
            'controller' 	=> $this->controller,
        ];

        $input = new ArrayInput($arguments);
        
        $command->run($input,$this->output);

        /**
		* Procura o command para criar o table
		*/
        $command = $this->getApplication()->find('up:create-table');

        $arguments = [
            'command' 		     => 'up:create-table',
            'name-module' 	     => $this->name,
            'name-table' 	     => $this->app,
            'name-controller' 	 => $this->controller,
        ];

        $input = new ArrayInput($arguments);
        
        $command->run($input,$this->output);



        return true;
    }
}