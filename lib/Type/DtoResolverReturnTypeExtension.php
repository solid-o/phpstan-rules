<?php

declare(strict_types=1);

namespace Solido\PHPStan\Type;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Scalar\String_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use Solido\DtoManagement\InterfaceResolver\ResolverInterface;

use function count;

class DtoResolverReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function __construct(private ReflectionProvider $reflectionProvider)
    {
    }

    public function getClass(): string
    {
        return ResolverInterface::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'resolve';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $default = $methodReflection->getVariants()[0]->getReturnType();
        if (count($methodCall->args) === 0) {
            return $default;
        }

        $arg = $methodCall->args[0]->value;
        // Care only for ::class parameters, we can not guess types for random strings.
        if ($arg instanceof ClassConstFetch) {
            $value = $arg->class->name;
        } elseif ($arg instanceof String_) {
            $value = $arg->value;
        } else {
            return $default;
        }

        if (! $this->reflectionProvider->hasClass($value)) {
            return $default;
        }

        $classReflection = $this->reflectionProvider->getClass($value);
        if (! $classReflection->isInterface()) {
            return $default;
        }

        return new ObjectType($value, null, $classReflection);
    }
}
