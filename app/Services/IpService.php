<?php

declare(strict_types=1);

namespace App\Services;

use InvalidArgumentException;
use IPLib\Factory;

class IpService
{
    public function subnet(string $range): string
    {
        $rangeObject = Factory::parseRangeString($range);

        if ($rangeObject === null) {
            throw new InvalidArgumentException('Range is null');
        }

        $ipv4 = $rangeObject->getSubnetMask();
        if ($ipv4 === null) {
            throw new InvalidArgumentException('IPv4 is null');
        }

        return $ipv4->toString();
    }
}
