<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 14:14
 */

namespace Flexe\Console\Commands\Table;


use Flexe\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TableCreateCommand extends Command
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
    protected $nameTable;

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

    protected function configure()
    {

        $this
            // the name of the command (the part after "bin/console")
            ->setName('up:create-table')
            // the short description shown while running "php bin/console list"
            ->setDescription('Create table')

            ->addArgument('name-module', InputArgument::REQUIRED, 'Name module is case-sensitive')

            ->addArgument('name-controller', InputArgument::REQUIRED, 'Name controller is case-sensitive')

            ->addArgument('name-table', InputArgument::REQUIRED, 'Name table is case-sensitive');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInputOutputInterface($input, $output)
            ->initializeAttributes()
            ->validateCommand()
            ->writeTable();
    }

    protected function setInputOutputInterface(InputInterface $input, OutputInterface $output) {

        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    protected function initializeAttributes() {

        $arrayModule = $this->getModuleData($this->input->getArgument('name-module'));

        $this->nameTable = $this->input->getArgument('name-table');
		
		$this->nameController = $this->input->getArgument('name-controller');

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
                $arrayReturn['path-write-module'] = $module::getTables();
                $arrayReturn['name-space-module'] = sprintf( '%s\Table',$module::getNamespace());
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

        if (file_exists(sprintf( '%s/%sTable.php',$this->pathWriteModule, $this->nameTable ))) {
            $this->stopProcess = true;
            $io->getErrorStyle()->error('Table already exists');
            return $this;
        }

        return $this;
    }



    protected function writeTable() {

        if ($this->stopProcess)
            return false;

        $io = new SymfonyStyle($this->input, $this->output);
        $tableStub = file_get_contents(__DIR__ . '/snippets/table.model.snippets');

        $tableStub = str_replace('{{TABLE-NAME}}', $this->nameTable, $tableStub);
        $tableStub = str_replace('{{NAMESPACE-TABLE}}', $this->nameSpaceModule, $tableStub);
        $tableStub = str_replace('{{NAME-MODULE}}', $this->moduleName, $tableStub);
        $tableStub = str_replace('{{NAME-TABLE}}', strtolower($this->nameTable), $tableStub);
		$tableStub = str_replace('{{ROUTE-NAME}}', strtolower($this->moduleName), $tableStub);
        $tableStub = str_replace('{{CONTROLLER}}', strtolower($this->nameController), $tableStub);
		
        $controller = sprintf( '%s/%sTable.php',$this->pathWriteModule, $this->nameTable);

        file_put_contents($controller, $tableStub);

        $io->success('Table successfully created');

        return true;
    }
}