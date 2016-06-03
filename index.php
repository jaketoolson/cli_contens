#!/usr/bin/env php
<?php
require_once 'bootstrap.php';
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckInputCommand
 */
class CheckIsIntOrDoubleCommand extends Command
{
    /**
     * Configure the command line name, accepted argument, description
     */
    protected function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Checks if the input is an integer or a float/double')
            ->addArgument(
                'check',
                InputArgument::REQUIRED,
                'Is the input an integer or a float/double?'
            );
    }

    /**
     * The main function called from the commandline automatically
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rawInputValue = $input->getArgument('check');
        $sanitizedInputValue = $this->sanitizeInput($rawInputValue);

        if ($this->isInt($sanitizedInputValue)) {
            $text = 'integer';
        } elseif ($this->isFloat($sanitizedInputValue)) {
            $text = 'float/double';
        } else {
            $text = gettype($sanitizedInputValue);
        }

        $output->writeln($rawInputValue .' is a(n) ' .$text);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function isInt($value)
    {
        return ctype_digit($value);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function isFloat($value)
    {
        return (string) (float) ($value) === (string) $value;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    private function sanitizeInput($value)
    {
        return trim($value);

        // TODO: This Allows for various types of input, not 100% tested but a viable sanitize method perhaps.
        // return filter_var(trim($value), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_SANITIZE_NUMBER_INT | FILTER_FLAG_ALLOW_THOUSAND);
    }
}

$application = new Application();
$application->add(new CheckIsIntOrDoubleCommand());
$application->run();