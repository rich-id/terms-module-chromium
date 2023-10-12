<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Tests\Resources\Fixtures;

use RichCongress\RecurrentFixturesTestBundle\DataFixture\AbstractFixture;
use RichId\TermsModuleBundle\Domain\Entity\Terms;

final class TermsFixtures extends AbstractFixture
{
    protected function loadFixtures(): void
    {
        $this->createObject(
            Terms::class,
            '1',
            [
                'slug'                  => 'terms-1',
                'name'                  => 'Terms 1',
                'isPublished'           => true,
                'isDepublicationLocked' => true,
            ]
        );
    }
}
