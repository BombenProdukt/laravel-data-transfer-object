<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use Illuminate\Database\Eloquent\Model;
use PreemStudio\DataTransferObject\AbstractDataTransferObject;
use PreemStudio\DataTransferObject\Normalizers\ClassNormalizer;
use Tests\Fixtures\User;

it('can serialize', function (): void {
    $dto = new class(['attribute' => \json_encode(['foo' => 'bar'])]) extends AbstractDataTransferObject
    {
        public function normalizers(): array
        {
            return [
                'attribute' => new ClassNormalizer(User::class),
            ];
        }
    };

    expect($dto->toArray()['attribute'])->toBeInstanceOf(User::class);
    expect($dto->toArray()['attribute'])->toBeInstanceOf(Model::class);
});

it('can deserialize', function (): void {
    $dto = new class(['attribute' => \json_encode(['foo' => 'bar'])]) extends AbstractDataTransferObject
    {
        public function normalizers(): array
        {
            return [
                'attribute' => new ClassNormalizer(User::class),
            ];
        }
    };

    expect($dto->attribute)->toBeInstanceOf(User::class);
    expect($dto->attribute)->toBeInstanceOf(Model::class);
});
