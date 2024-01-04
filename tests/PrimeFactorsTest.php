<?php

use App\PrimeFactorService;
use PHPUnit\Framework\TestCase;

class PrimeFactorsTest extends TestCase
{
    /** @test * */
    public function it_should_throw_an_exception_when_input_is_not_an_integer(): void
    {
        $this->expectException(\Exception::class);

        // GIVEN
        $stringInput = "a";
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $primeFactorService->calculatePrimeFactors($stringInput);
    }

    /** @test * */
    public function it_should_throw_an_exception_when_input_is_null(): void
    {
        $this->expectException(\Exception::class);

        // GIVEN
        $nullInput = null;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $primeFactorService->calculatePrimeFactors($nullInput);
    }

    /** @test * */
    public function it_should_throw_an_exception_when_input_is_an_integer_negative(): void
    {
        $this->expectException(\Exception::class);

        // GIVEN
        $negativeInput = -1;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $primeFactorService->calculatePrimeFactors($negativeInput);
    }

    /** @test * */
    public function it_should_throw_an_exception_when_input_is_an_integer_equals_to_zero(): void
    {
        $this->expectException(\Exception::class);

        // GIVEN
        $zeroInput = 0;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $primeFactorService->calculatePrimeFactors($zeroInput);
    }

    /** @test * */
    public function it_should_throw_an_exception_with_a_feedback_message_when_input_is_not_valid(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(PrimeFactorService::INVALID_INPUT_FORMAT_MESSAGE);

        // GIVEN
        $invalidInput = 0;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $primeFactorService->calculatePrimeFactors($invalidInput);
    }

    /** @test * */
    public function it_should_return_an_array_when_input_is_valid(): void
    {
        // GIVEN
        $validInput = 8;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $result = $primeFactorService->calculatePrimeFactors($validInput);

        // THEN
        $this->assertIsArray($result);
    }

    /** @test * */
    public function it_should_return_an_empty_array_when_input_is_1(): void
    {
        // GIVEN
        $inputEqualsToOne = 1;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $result = $primeFactorService->calculatePrimeFactors($inputEqualsToOne);

        // THEN
        $this->assertSame([], $result);
    }

    /**
     * @test
     * @dataProvider primeNumberProvider
     */
    public function it_should_return_only_the_prime_number_if_the_input_is_a_prime_number($inputPrimeNumber): void
    {
        // GIVEN
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $result = $primeFactorService->calculatePrimeFactors($inputPrimeNumber);

        // THEN
        $this->assertSame([$inputPrimeNumber], $result);
    }


    public static function primeNumberProvider(): array
    {
        return [
            [2],
            [3],
            [5],
            [7],
            [11],
        ];
    }

    /**
     * @test
     */
    public function it_should_not_return_only_the_prime_number_if_the_input_is_not_a_prime_number_and_is_more_than_one(): void
    {
        // GIVEN
        $inputNotPrimeNumber = 4;
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $result = $primeFactorService->calculatePrimeFactors($inputNotPrimeNumber);

        // THEN
        $this->assertNotSame([$inputNotPrimeNumber], $result);
    }

    /**
     * @test
     * @dataProvider notPrimeNumberProvider
     */
    public function it_should_return_prime_factors_if_the_input_is_not_a_prime_number($inputNotPrimeNumber, $expectedResult): void
    {
        // GIVEN
        $primeFactorService = new PrimeFactorService();

        // WHEN
        $result = $primeFactorService->calculatePrimeFactors($inputNotPrimeNumber);

        // THEN
        $this->assertSame($expectedResult, $result);
    }

    public static function notPrimeNumberProvider(): array
    {
        return [
            [
                'input' => 6,
                'expectedResult' => [2,3]
            ],
        ];
    }
}