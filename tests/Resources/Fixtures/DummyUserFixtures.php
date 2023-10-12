<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Tests\Resources\Fixtures;

use RichCongress\RecurrentFixturesTestBundle\DataFixture\AbstractFixture;
use RichId\TermsModuleChromiumBundle\Tests\Resources\Entity\DummyUser;

final class DummyUserFixtures extends AbstractFixture
{
    public const USER = '1';

    protected function loadFixtures(): void
    {
        $this->createObject(
            DummyUser::class,
            self::USER,
            [
                'username' => 'my_user_1',
                'roles'    => ['ROLE_USER'],
            ]
        );
    }
}
