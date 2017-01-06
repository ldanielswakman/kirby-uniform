<?php

use Uniform\Form;
use Uniform\Guards\CalcGuard;
use Uniform\Guards\HoneypotGuard;
use Uniform\Exceptions\Exception;

if (!function_exists('uniform_language')) {
    /**
     * Loads a Uniform language file.
     *
     * @param string $code Language code
     */
    function uniform_language($code)
    {
        $path = __DIR__.DS.'..'.DS.'languages'.DS.$code.'.php';

        try {
            include_once $path;
        } catch (ErrorException $e) {
            throw new Exception("Uniform does not have a translation for the language '$code'.");
        }
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate a CSRF token form field.
     *
     * @param string $token The CSRF token. If empty a new one will be generated.
     *
     * @return string
     */
    function csrf_field($token = null)
    {
        $token = $token ?: csrf();
        return '<input type="hidden" name="'.Form::CSRF_FIELD.'" value="'.$token.'">';
    }
}

if (!function_exists('honeypot_field')) {
    /**
     * Generate a honeypot form field.
     *
     * @param string $name Name of the honeypot field
     * @param string $class CSS class of the honeypot field
     *
     * @return string
     */
    function honeypot_field($name = null, $class = null)
    {
        $name = $name ?: HoneypotGuard::FIELD_NAME;
        $class = $class ?: 'uniform__potty';
        return '<input type="text" name="'.$name.'" class="'.$class.'">';
    }
}

if (!function_exists('uniform_captcha')) {
    /**
     * Generate a new calc guard result for a Uniform form.
     *
     * @return string Something like '4 plus 5'
     */
    function uniform_captcha()
    {
        list($a, $b) = [rand(0, 9), rand(0, 9)];
        s::set(CalcGuard::FLASH_KEY, $a + $b);

        return str::encode($a.' '.l::get('uniform-calc-plus').' '.$b);
    }
}

if (!function_exists('captcha_field')) {
    /**
     * Generate a calc guard form field.
     *
     * @param string $name Form field name
     * @param string $class Form field CSS class
     *
     * @return string
     */
    function captcha_field($name = null, $class = null)
    {
        $name = $name ?: CalcGuard::FIELD_NAME;
        $class = $class ?: 'uniform__captcha';
        return '<input type="number" name="'.$name.'" class="'.$class.'">';
    }
}
