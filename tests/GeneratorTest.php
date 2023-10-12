<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Tests;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\TermsModuleBundle\Domain\Entity\TermsVersionSignature;
use RichId\TermsModuleChromiumBundle\Infrastructure\Pdf\TermsVersionSignaturePdfChromiumGenerator;
use RichId\TermsModuleChromiumBundle\Tests\Resources\Entity\DummyUser;

/**
 * @covers \RichId\TermsModuleChromiumBundle\Infrastructure\Pdf\TermsVersionSignaturePdfChromiumGenerator
 * @TestConfig("fixtures")
 */
final class GeneratorTest extends TestCase
{
    /** @var TermsVersionSignaturePdfChromiumGenerator */
    public $generator;

    public function testGeneratorWithoutEditor(): void
    {
        $signature = $this->getReference(TermsVersionSignature::class, 'u42-signature-v1-terms-1');

        $output = ($this->generator)($signature);

        self::assertNotEmpty($output);
    }

    public function testGeneratorWithEditor(): void
    {
        $signature = $this->getReference(TermsVersionSignature::class, 'u42-signature-v1-terms-1');

        $output = ($this->generator)($signature, $this->getReference(DummyUser::class, '1'));

        self::assertNotEmpty($output);
    }
}
