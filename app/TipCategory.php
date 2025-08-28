<?php

namespace App;

enum TipCategory: string
{
    case CROP_CULTIVATION = 'crop_cultivation';
    case PEST_MANAGEMENT = 'pest_management';
    case SOIL_CARE = 'soil_care';
    case IRRIGATION = 'irrigation';
    case FERTILIZER = 'fertilizer';
    case HARVESTING = 'harvesting';
    case LIVESTOCK = 'livestock';
    case WEATHER = 'weather';

    public function label(): string
    {
        return match($this) {
            self::CROP_CULTIVATION => 'Crop Cultivation',
            self::PEST_MANAGEMENT => 'Pest Management',
            self::SOIL_CARE => 'Soil Care',
            self::IRRIGATION => 'Irrigation',
            self::FERTILIZER => 'Fertilizer',
            self::HARVESTING => 'Harvesting',
            self::LIVESTOCK => 'Livestock',
            self::WEATHER => 'Weather',
        };
    }

    public function labelBangla(): string
    {
        return match($this) {
            self::CROP_CULTIVATION => 'ফসল চাষাবাদ',
            self::PEST_MANAGEMENT => 'কীটপতঙ্গ ব্যবস্থাপনা',
            self::SOIL_CARE => 'মাটির যত্ন',
            self::IRRIGATION => 'সেচ ব্যবস্থা',
            self::FERTILIZER => 'সার প্রয়োগ',
            self::HARVESTING => 'ফসল সংগ্রহ',
            self::LIVESTOCK => 'পশুপালন',
            self::WEATHER => 'আবহাওয়া',
        };
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->labelBangla();
        }
        return $options;
    }
}
