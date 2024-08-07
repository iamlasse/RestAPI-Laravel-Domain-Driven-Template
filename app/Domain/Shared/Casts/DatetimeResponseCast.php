<?php

namespace Domain\Shared\Casts;

use Carbon\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class DateTimeCast implements Cast, Transformer
{
    protected $defaultFormat = 'd m Y H:i:s';
    protected $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        $carbonDate = Carbon::createFromFormat($this->defaultFormat, $value);

        return $carbonDate->format('d') . ' ' .
            $this->bulan[$carbonDate->month] . ' ' .
            $carbonDate->format('Y H:i:s');
    }

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {
        if ($value instanceof Carbon) {
            return $value->format('d') . ' ' .
                $this->bulan[$value->month] . ' ' .
                $value->format('Y H:i:s');
        }

        return $value;
    }
}
