<?php

namespace App\ValueObject;

use App\Contracts\ValueObjectContract;

class EscortValueObject implements ValueObjectContract {
    private $_id;
    private $_name;
    private $_perex;
    private $_sex;
    private $_birt_year;
    private $_account_id;
    private $_reviews_count;
    private $_transactions_count;
    private $_is_independent;
    private $_is_verified;
    private $_is_new;
    private $_is_pornstar;
    private $_is_vip;
    private $_has_video;
    private $_has_review;
    private $_country_name;
    private $_languages;
    private $_avatar;
    private $_countries;
    private $_cities;
    private $_account;

    public function __construct(
        $id,
        $name,
        $perex,
        $sex,
        $birt_year,
        $account_id,
        $reviews_count,
        $transactions_count,
        $is_independent,
        $is_verified,
        $is_new,
        $is_pornstar,
        $is_vip,
        $has_video,
        $has_review,
        $country_name,
        $languages,
        $avatar,
        $countries,
        $cities,
        $account
    )
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_perex = $perex;
        $this->_sex = $sex;
        $this->_birt_year = $birt_year;
        $this->_account_id = $account_id;
        $this->_reviews_count = $reviews_count;
        $this->_transactions_count = $transactions_count;
        $this->_is_independent = $is_independent;
        $this->_is_verified = $is_verified;
        $this->_is_new = $is_new;
        $this->_is_pornstar = $is_pornstar;
        $this->_is_vip = $is_vip;
        $this->_has_video = $has_video;
        $this->_has_review = $has_review;
        $this->_country_name = $country_name;
        $this->_languages = $languages;
        $this->_avatar = $avatar;
        $this->_countries = $countries;
        $this->_cities = $cities;
        $this->_account = $account;
    }
    public function toArray(): array
    {
        return [
            'id'                    => $this->_id,
            'name'                  => $this->_name,
            'perex'                 => $this->_perex,
            'sex'                   => $this->_sex,
            'birt_year'             => $this->_birt_year,
            'account_id'            => $this->_account_id,
            'reviews_count'         => $this->_reviews_count,
            'transactions_count'    => $this->_transactions_count,
            'is_independent'        => $this->_is_independent,
            'is_verified'           => $this->_is_verified,
            'is_new'                => $this->_is_new,
            'is_pornstar'           => $this->_is_pornstar,
            'is_vip'                => $this->_is_vip,
            'has_video'             => $this->_has_video,
            'has_review'            => $this->_has_review,
            'country_name'          => $this->_country_name,
            'languages'             => $this->_languages,
            'avatar'                => $this->_avatar,
            'country'               => $this->_countries,
            'city'                  => $this->_cities,
            'account'               => $this->_account,
        ];
    }
}
