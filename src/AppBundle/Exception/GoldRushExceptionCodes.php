<?php
/**
 * Created by PhpStorm.
 * User: pkowerzanow
 * Date: 06.02.2017
 * Time: 22:11
 */

namespace AppBundle\Exception;


class GoldRushExceptionCodes
{
    const GOLD_RUSH_SERVICE_ERROR = 12000;
    const SOURCE_DATA_ERROR = 12001;

    private static $exceptionMessages = [
        self::GOLD_RUSH_SERVICE_ERROR => 'gold_rush_error',
        self::SOURCE_DATA_ERROR => 'source_data_error',
    ];

    /**
     * @param int $code
     * @return string
     */
    public static function getMessage($code)
    {
        if (in_array($code, self::$exceptionMessages)) {

            return self::$exceptionMessages[$code];
        }

        return self::$exceptionMessages[self::GOLD_RUSH_SERVICE_ERROR];
    }
}