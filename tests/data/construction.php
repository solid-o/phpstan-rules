<?php

declare(strict_types=1);

use Tests\Fixtures\DTO\v1\v1_0\ExampleDTO;
use Tests\Fixtures\DTO\v1\v1_0\NonDTO;

$o = new stdClass();
$o = new NonDTO();
$o = new ExampleDTO();
