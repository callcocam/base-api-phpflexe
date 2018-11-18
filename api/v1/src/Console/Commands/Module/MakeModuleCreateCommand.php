<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 31/10/2018
 * Time: 09:58
 */

namespace Flexe\Console\Commands\Module;


use Flexe\App;

class MakeModuleCreateCommand
{
    /**
     * @var string
     */
    private $moduleInstall;

    /**
     * @var string
     */
    private $name;

    /**
     * UtilsModuleCreateCommand constructor.
     * @param $moduleInstall
     * @param $name
     */
    public function __construct($moduleInstall, $name)
    {
        $this->moduleInstall = $moduleInstall;
        $this->name = $name;
    }
    public function createDirectories() {
        mkdir($this->moduleInstall . '/' . $this->name);

        mkdir($this->moduleInstall . '/' . $this->name . '/Controller', 0755, true);
        file_put_contents($this->moduleInstall . '/' . $this->name . '/Controller/.keepme', '');

        mkdir($this->moduleInstall . '/' . $this->name . '/Middleware',0755, true);
        file_put_contents($this->moduleInstall . '/' . $this->name . '/Middleware/.keepme', '');

        mkdir($this->moduleInstall . '/' . $this->name . '/Model',0755, true);
        file_put_contents($this->moduleInstall . '/' . $this->name . '/Model/.keepme', '');

        mkdir($this->moduleInstall . '/' . $this->name . '/Route', 0755, true);
        file_put_contents($this->moduleInstall . '/' . $this->name . '/Route/.keepme', '');

        mkdir($this->moduleInstall . '/' . $this->name . '/Table',0755, true);
        file_put_contents($this->moduleInstall . '/' . $this->name . '/Table/.keepme', '');

        return true;
    }

    public function generateStub() {
        $modelStub = file_get_contents(__DIR__ . '/snippets/module.model.snippets');

        $modelStub = str_replace('{{NAMESPACE-MODULE}}', 'App\\' . $this->name, $modelStub);
        $modelStub = str_replace('{{MODULE-NAME}}', $this->name, $modelStub);

        file_put_contents($this->moduleInstall . '/' . $this->name .  '/Module.php', $modelStub);

        $modelStub = file_get_contents(__DIR__ . '/snippets/abstractcontroller.model.snippets');

        $modelStub = str_replace('{{NAMESPACE-ABSTRACTCONTROLLER}}', 'App\\' . $this->name . '\\Controller', $modelStub);

        file_put_contents($this->moduleInstall . '/' . $this->name .  '/Controller/AbstractController.php', $modelStub);

        return 'App\\' . $this->name;
    }

    public function publishModule($namespaceModule) {

        $allModules =App::getModulesInstall();

        $modulePublishWrite = "";
        foreach ($allModules as $module) {
            $modulePublishWrite .= "\t" . $module . "::class," . PHP_EOL;
        }

        $modulePublishWrite .= "\t" . $namespaceModule . "\Module::class,";

        //$modelStub = file_get_contents(__DIR__ . '/snippets/modules.model.snippets');

    }
}