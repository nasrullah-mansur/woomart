<?php


# guard
const GUARD_ADMIN = 'admin';

const YES = 1;
const NO = 0;

#Category

const PARENT = 0;

#status

const STATUS_ACTIVE = 1;
const STATUS_INACTIVE = 0;
const STATUS_REQUEST = 5;
const ACTIVE = 1;

#orders

const ORDER_PENDING = 1;
const ORDER_PROCESSING = 2;
const ORDER_SHIPPED = 3;
const ORDER_DELIVERED = 4;
const ORDER_CANCELLED = 5;
const ORDER_RETURN = 6;
const ORDER_NOT_PAYMENT_YET = 7;
const ORDER_DELIVERED_FAILED = 8;


#Payment status

const PAYMENT_SUCCESS=1;
const PAYMENT_CANCELLED=2;
const PAYMENT_FAILED = 3;
const  PAYMENT_ERROR = 4;
const PAYMENT_PENDING = 5;


#coupon

const PERCENTAGE = 1;
const FIXED = 0;

const  GENERAL = 1;
const  USAGE_RESTRICTION = 2;
const USAGE_LIMITATION = 3;


# gender

const MALE = 1;
const FEMALE = 2;
const OTHER = 3;

#socila login

const EMAIL = 1;
const FACEBOOK = 2;
const GOOGLE = 3;
const TWITTER = 4;

#city

const KHULNA = 27;
