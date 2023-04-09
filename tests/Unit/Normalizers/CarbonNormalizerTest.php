<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use Carbon\Carbon;
use PreemStudio\DataTransferObject\AbstractDataTransferObject;
use PreemStudio\DataTransferObject\Normalizers\CarbonNormalizer;

it('can serialize', function (): void {
    $dto = new class(['attribute' => '01.01.2023 12:00']) extends AbstractDataTransferObject
    {
        public function normalizers(): array
        {
            return [
                'attribute' => new CarbonNormalizer(),
            ];
        }
    };

    expect($dto->toArray())->toBe([
        'attribute' => 'Sun Jan 01 2023 12:00:00 GMT+0000',
    ]);
});

it('can deserialize', function (): void {
    $dto = new class(['attribute' => '01.01.2023 12:00']) extends AbstractDataTransferObject
    {
        public function normalizers(): array
        {
            return [
                'attribute' => new CarbonNormalizer(),
            ];
        }
    };

    expect($dto->attribute)->toBeInstanceOf(Carbon::class);
});
