<?php declare(strict_types=1);

namespace App\Utils;

class ExchangeRate
{
    public const EUR_CURRENCY = 'EUR';
    private const EXCHANGE_RATE_URL = 'https://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt';

    public static function getExchangeRate(string $currency): float
    {
        $string = file_get_contents(self::EXCHANGE_RATE_URL);
        return floatval(str_replace(',' ,'.' , substr($string, strpos($string, $currency . '|') + 4, 6)));
    }
}
