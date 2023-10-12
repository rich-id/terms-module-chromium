<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Tests\Resources\Fixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use RichCongress\RecurrentFixturesTestBundle\DataFixture\AbstractFixture;
use RichId\TermsModuleBundle\Domain\Entity\Terms;
use RichId\TermsModuleBundle\Domain\Entity\TermsVersion;

final class TermsVersionFixtures extends AbstractFixture implements DependentFixtureInterface
{
    protected function loadFixtures(): void
    {
        $terms1 = $this->getReference(Terms::class, '1');

        $this->createObject(
            TermsVersion::class,
            'v1-terms-1',
            [
                'version'   => 1,
                'isEnabled' => true,
                'title'     => 'Title Version 1',
                'content'   => 'Content Version 1',
                'terms'     => $terms1,
            ]
        );
    }

    public function getDependencies(): array
    {
        return [
            TermsFixtures::class,
        ];
    }
}
