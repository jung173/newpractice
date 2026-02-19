<?php

namespace App\Rules;

class ProductRegex
{
    public const PRODUCT_NAME = '/^[a-zA-Z0-9ぁ-んァ-ン一-龥ー\-\/\&\+]+$/u';

    public const COMMENT = '/^[0-9a-zA-Zぁ-んァ-ヶ一-龥ー\s]+$/u';

    public const NUMBER = '/^[0-9]+$/';
}