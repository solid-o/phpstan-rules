<?php declare(strict_types=1);

use Solido\DtoManagement\InterfaceResolver\ResolverInterface;
use Tests\Fixtures\DTO\Contracts\ExampleDTOInterface;
use Tests\Fixtures\DTO\v1\v1_0\ExampleDTO;
use Tests\Fixtures\DTO\v1\v1_0\NonDTO;

use function PHPStan\Testing\assertType;

function (ResolverInterface $resolver) {
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve('stdClass'));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve(stdClass::class));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve('unknown'));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve(UnknownClass::class));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve(NonDTO::class));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve('Tests\DTO\v1\v1_0\NonDTO'));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve(ExampleDTO::class));
    assertType('T of object (method Solido\DtoManagement\InterfaceResolver\ResolverInterface::resolve(), parameter)', $resolver->resolve('Tests\DTO\v1\v1_0\ExampleDTO'));

    assertType('Tests\Fixtures\DTO\Contracts\ExampleDTOInterface', $resolver->resolve(ExampleDTOInterface::class));
    assertType('Tests\Fixtures\DTO\Contracts\ExampleDTOInterface', $resolver->resolve('Tests\Fixtures\DTO\Contracts\ExampleDTOInterface'));
};
