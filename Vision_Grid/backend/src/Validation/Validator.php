<?php

namespace App\Validation;

use stdClass;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

abstract class Validator
{
    private bool $failed = false;

    private array $errors = [];

    public function __construct(protected readonly ValidatorInterface $validator) {}

    public function validate(array $input): void
    {
        $errors = $this->validator->validate($input, $this->constraints());

        if (count($errors) > 0) {
            $this->failed = true;

            foreach ($errors as $error) {
                $this->errors['errors'] = [
                    'field' => str_replace(['[', ']'], '', $error->getPropertyPath()),
                    'message' => $error->getMessage(),
                ];
            }
        }
    }

    public function isFailed(): bool
    {
        return $this->failed;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    protected abstract function constraints(): Assert\Collection;
}
