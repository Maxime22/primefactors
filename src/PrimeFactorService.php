<?php
declare(strict_types=1);

namespace App;

class PrimeFactorService
{
    public const INVALID_INPUT_FORMAT_MESSAGE = 'Your input is not a positive integer';

    /**
     * @throws \Exception
     */
    public function calculatePrimeFactors($input): array
    {
        if (!is_int($input) || $input <= 0) {
            throw new \Exception(self::INVALID_INPUT_FORMAT_MESSAGE);
        }
        if ($input === 1) {
            return [];
        }
        if ($this->isPrimeNumber($input)) {
            return [$input];
        }
        return [];
    }

    private function isPrimeNumber(int $input): bool
    {
        for ($i = 2; $i < $input; $i++) {
            if ($input % $i === 0) {
                return false;
            }
        }
        return true;
    }
}