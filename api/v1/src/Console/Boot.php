<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 30/10/2018
 * Time: 13:51
 */

namespace Flexe\Console;

use Flexe\Console\Commands\Model\ModelCreateCommand;
use Flexe\Console\Commands\Module\ModuleCreateCommand;
use Flexe\Console\Commands\Routing\ControllerCreateCommand;
use Flexe\Console\Commands\Routing\MethodControllerCommand;
use Flexe\Console\Commands\Routing\RouteCreateCommand;
use Flexe\Console\Commands\Table\TableCreateCommand;
use Flexe\Console\Commands\Module\MakeCreateCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class Boot
{
    private static $commandList = [
        ControllerCreateCommand::class,
        MethodControllerCommand::class,
        ModelCreateCommand::class,
        TableCreateCommand::class,
        RouteCreateCommand::class,
        ModuleCreateCommand::class,
        MakeCreateCommand::class
    ];

    /**
     * @var Application
     */
    private static $application;

    /**
     * @param Application $application
     */
    public static function setApplication(Application $application)
    {
        self::$application = $application;
    }

    public static function bootCommand() {
        foreach (self::$commandList as $command) {
            self::$application->add(new $command);
        }
    }

    public static function registryCommand(Command $command) {
        self::$commandList[] = $command;
    }
}