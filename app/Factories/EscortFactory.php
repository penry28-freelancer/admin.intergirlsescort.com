<?php

namespace App\Factories;

use App\Contracts\ValueObjectContract;
use App\ValueObject\EscortValueObject;

final class EscortFactory
{
    public static function make(array $attributes): ValueObjectContract
    {
        // dd(data_get($attributes, 'accountable')['name']);
        return new EscortValueObject(
            array_key_exists('id', $attributes) ?
                data_get($attributes, 'id') : 0,
            array_key_exists('accountable', $attributes) ?
                optional(data_get($attributes, 'accountable'))['name'] : '',
            array_key_exists('perex', $attributes) ?
                data_get($attributes, 'perex') : '',
            array_key_exists('sex', $attributes) ?
                data_get($attributes, 'sex') : '',
            array_key_exists('birt_year', $attributes) ?
                intval(data_get($attributes, 'birt_year')) : 0,
            array_key_exists('account_id', $attributes) ?
                data_get($attributes, 'account_id') : '',
            array_key_exists('reviews_count', $attributes) ?
                data_get($attributes, 'reviews_count') : '',
            array_key_exists('transactions_count', $attributes) ?
                data_get($attributes, 'transactions_count') : '',
            array_key_exists('is_independent', $attributes) ?
                data_get($attributes, 'is_independent') : false,
            array_key_exists('is_verified', $attributes) ?
                data_get($attributes, 'is_verified') : false,
            array_key_exists('is_new', $attributes) ?
                data_get($attributes, 'is_new') : false,
            array_key_exists('is_pornstar', $attributes) ?
                data_get($attributes, 'is_pornstar') : false,
            array_key_exists('is_vip', $attributes) ?
                data_get($attributes, 'is_vip') : false,
            array_key_exists('has_video', $attributes) ?
                data_get($attributes, 'has_video') : false,
            array_key_exists('has_review', $attributes) ?
                data_get($attributes, 'has_review') : false,
            array_key_exists('country_name', $attributes) ?
                data_get($attributes, 'country') : '',
            array_key_exists('languages', $attributes) ?
                data_get($attributes, 'languages') : [],
            array_key_exists('avatar', $attributes) ?
                data_get($attributes, 'avatar') : [],
            array_key_exists('country', $attributes) ?
                data_get($attributes, 'country') : [],
            array_key_exists('city', $attributes) ?
                data_get($attributes, 'city') : [],
            array_key_exists('accountable', $attributes) ?
                data_get($attributes, 'accountable') : [],
        );
    }
}
