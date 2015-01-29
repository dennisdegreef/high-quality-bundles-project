<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 15:23
 */

namespace Traditional\Bundle\UserBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('user:register')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('country', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $inputInterface, OutputInterface $outputInterface)
    {
        $command = new RegisterUser(
            $inputInterface->getArgument('email'),
            $inputInterface->getArgument('password'),
            $inputInterface->getArgument('country')
        );

        $this->getContainer()->get('command_bus')->handle($command);
    }
} 