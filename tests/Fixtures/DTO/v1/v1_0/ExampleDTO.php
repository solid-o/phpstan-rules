<?php

declare(strict_types=1);

namespace Tests\Fixtures\DTO\v1\v1_0;

use Tests\Fixtures\DTO\Contracts\ExampleDTOInterface;

class ExampleDTO implements ExampleDTOInterface
{
    public function staticConstruction(): void
    {
        $obj = new static();
    }
}
