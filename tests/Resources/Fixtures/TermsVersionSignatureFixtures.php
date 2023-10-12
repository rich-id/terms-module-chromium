<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Tests\Resources\Fixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use RichCongress\RecurrentFixturesTestBundle\DataFixture\AbstractFixture;
use RichId\TermsModuleBundle\Domain\Entity\TermsVersion;
use RichId\TermsModuleBundle\Domain\Entity\TermsVersionSignature;

final class TermsVersionSignatureFixtures extends AbstractFixture implements DependentFixtureInterface
{
    protected function loadFixtures(): void
    {
        $termsVersion1 = $this->getReference(TermsVersion::class, 'v1-terms-1');

        $this->createObject(
            TermsVersionSignature::class,
            'u42-signature-v1-terms-1',
            [
                'date'              => new \DateTime(),
                'subjectType'       => 'user',
                'subjectIdentifier' => '42',
                'subjectName'       => 'Mr John SMITH',
                'version'           => $termsVersion1,
            ]
        );
    }

    public function getDependencies(): array
    {
        return [
            TermsVersionFixtures::class,
        ];
    }
}
