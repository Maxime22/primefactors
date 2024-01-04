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

        $result = [];
        $currentNumberValue = $input;
        $currentDivisor = 2;
        while ($currentDivisor <= $currentNumberValue) {
            $isPrimeAndDivisible = $this->isPrimeNumber($currentDivisor) && $this->isDivisibleBy(
                    $currentNumberValue,
                    $currentDivisor
                );

            if ($isPrimeAndDivisible) {
                $result[] = $currentDivisor;
                $currentNumberValue = $currentNumberValue / $currentDivisor;
            } else {
                $currentDivisor++;
            }
        }

        return $result;
    }

    private function isPrimeNumber(int $number): bool
    {
        for ($i = 2; $i < $number; $i++) {
            if ($this->isDivisibleBy($number, $i)) {
                return false;
            }
        }
        return true;
    }

    private function isDivisibleBy(int $dividend, int $divisor): bool
    {
        return $dividend % $divisor === 0;
    }
}
