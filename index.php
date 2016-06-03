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
    const TYPE_DOUBLE = 'double';
    const TYPE_FLOAT = 'float';
    const TYPE_INT = 'integer';

    /**
     * Configure the command line name, accepted argument, description
     */
    protected function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Checks if the input is an '.self::TYPE_INT.' or a '.self::TYPE_DOUBLE)
            ->addArgument(
                'check',
                InputArgument::REQUIRED,
                'Is the input an '.self::TYPE_INT.' or a '.self::TYPE_DOUBLE.'?'
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
            $text = self::TYPE_INT;
        } elseif ($this->isDouble($sanitizedInputValue)) {
            $text = self::TYPE_DOUBLE;
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
        return isInt($value);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function isFloat($value)
    {
        return isFloat($value);
    }

    /**
     * from: http://de2.php.net/manual/en/function.gettype.php,
     * "... double (for historical reasons "double" is returned in case of a float, and not simply "float")"
     *
     * @param $value
     *
     * @return bool
     */
    private function isDouble($value)
    {
        return $this->isFloat($value);
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