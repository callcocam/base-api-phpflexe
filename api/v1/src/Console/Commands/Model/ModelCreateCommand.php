<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 14:14
 */

namespace Flexe\Console\Commands\Model;


use Flexe\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ModelCreateCommand extends Command
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
    protected $nameModel;
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

    protected $collumns = "";

    protected function configure()
    {

        $this
            // the name of the command (the part after "bin/console")
            ->setName('up:create-model')
            // the short description shown while running "php bin/console list"
            ->setDescription('Create model')

            ->addArgument('name-module', InputArgument::REQUIRED, 'Name module is case-sensitive')

            ->addArgument('name-model', InputArgument::REQUIRED, 'Name model is case-sensitive')

            ->addArgument('name-table', InputArgument::REQUIRED, 'Name table is case-sensitive');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInputOutputInterface($input, $output)
            ->initializeAttributes()
            ->validateCommand()
            ->setColumns()
            ->writeModel();
    }

    protected function setColumns(){

        $app = new App();

        $db = $app->getDb();

        $collumns = $db::select(sprintf("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = '%s'",strtolower($this->nameTable)));

        $fillables = [];

        if($collumns):

            foreach ($collumns as $collumn):

                $fillables[$collumn->COLUMN_NAME] = $collumn->COLUMN_NAME;

            endforeach;

            $this->collumns = sprintf("'%s'",implode("','",$fillables));
        endif;

        return $this;
    }

    protected function setInputOutputInterface(InputInterface $input, OutputInterface $output) {

        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    protected function initializeAttributes() {

        $arrayModule = $this->getModuleData($this->input->getArgument('name-module'));

        $this->nameModel = $this->input->getArgument('name-model');

        $this->nameTable = $this->input->getArgument('name-table');

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
                $arrayReturn['path-write-module'] = $module::getModels();
                $arrayReturn['name-space-module'] = sprintf( '%s\Model',$module::getNamespace());
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

        if (file_exists(sprintf( '%s/%sModel.php',$this->pathWriteModule, $this->nameModel ))) {
            $this->stopProcess = true;
            $io->getErrorStyle()->error('Model already exists');
            return $this;
        }

        return $this;
    }



    protected function writeModel() {

        if ($this->stopProcess)
            return false;

        $io = new SymfonyStyle($this->input, $this->output);
        $modelStub = file_get_contents(__DIR__ . '/snippets/model.model.snippets');

        $modelStub = str_replace('{{MODEL-NAME}}', $this->nameModel, $modelStub);
        $modelStub = str_replace('{{NAMESPACE-MODEL}}', $this->nameSpaceModule, $modelStub);
        $modelStub = str_replace('{{NAME-MODULE}}', $this->moduleName, $modelStub);
        $modelStub = str_replace('{{NAME-TABLE}}', strtolower($this->nameTable), $modelStub);
        $modelStub = str_replace('{{FILLABLE}}', strtolower($this->collumns), $modelStub);

        $controller = sprintf( '%s/%sModel.php',$this->pathWriteModule, $this->nameModel);

        file_put_contents($controller, $modelStub);

        $io->success('Model successfully created');

        return true;
    }
}