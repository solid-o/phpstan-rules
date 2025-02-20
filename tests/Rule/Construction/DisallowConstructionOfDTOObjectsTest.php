<?php

declare(strict_types=1);

namespace Tests\Rule\Construction;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Solido\PHPStan\DTOClassMapFactory;
use Solido\PHPStan\Rule\Construction\DisallowConstructionOfDTOObjects;
use Tests\Fixtures\DTO\Contracts\IgnoredInterface;

class DisallowConstructionOfDTOObjectsTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new DisallowConstructionOfDTOObjects(new DTOClassMapFactory([
            'Tests\Fixtures\DTO',
        ], [IgnoredInterface::class]), self::createReflectionProvider());
    }

    public function testShouldRaiseError(): void
    {
        $this->analyse([__DIR__.'/../../data/construction.php'], [[
            "Instantiation of class Tests\\Fixtures\\DTO\\v1\\v1_0\\ExampleDTO is disallowed\n    💡 Use the DTO resolver to create a new instance",
            10
        ]]);
    }
}
