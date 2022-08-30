<?php

namespace App\Service;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use App\Core\Env;

class LoadEnvironmentVariables
{
    /**
     * The directory containing the environment file.
     *
     * @var string
     */
    protected string $filePath;

    /**
     * The name of the environment file.
     *
     * @var string|null
     */
    protected ?string $fileName;

    /**
     * Create a new loads environment variables instance.
     *
     * @param string $path
     * @param string|null $name
     * @return void
     */
    public function __construct(string $path, string $name = null)
    {
        $this->filePath = $path;
        $this->fileName = $name;
    }

    /**
     * Setup the environment variables.
     *
     * If no environment file exists, we continue silently.
     *
     * @return void
     */
    public function bootstrap()
    {
        try {
            $this->createDotenv()->safeLoad();
        } catch (InvalidFileException $e) {
            $this->writeErrorAndDie([
                'The environment file is invalid!',
                $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a Dotenv instance.
     *
     * @return Dotenv
     */
    protected function createDotenv(): Dotenv
    {
        return Dotenv::create(
            Env::getRepository(),
            $this->filePath,
            $this->fileName
        );
    }

    /**
     * Write the error information to the screen and exit.
     *
     * @param  string[]  $errors
     * @return void
     */
    protected function writeErrorAndDie(array $errors): void
    {
        foreach ($errors as $error) {
            printf("%s\n", $error);
        }

        exit(1);
    }
}