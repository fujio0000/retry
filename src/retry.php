<?php

namespace igorw;

class FailingTooHardException extends \Exception {}

function retry($retries, callable $fn, $sleepSec = 0)
{
    beginning:
    try {
        return $fn();
    } catch (\Exception $e) {
        if (!$retries) {
            throw new FailingTooHardException('', 0, $e);
        }
        $retries--;
        sleep($sleepSec);
        goto beginning;
    }
}
