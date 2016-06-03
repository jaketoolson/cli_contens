<?php

/**
 * @param $value
 *
 * @return bool
 */
function isInt($value)
{
    return ctype_digit($value) || is_int($value) || false !== filter_var($value, FILTER_VALIDATE_INT);
}

/**
 * @param $value
 *
 * @return bool
 */
function isFloat($value)
{
    return (string) (float) ($value) === (string) $value || false !== filter_var($value, FILTER_VALIDATE_FLOAT);
}