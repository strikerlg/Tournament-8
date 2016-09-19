<?php

namespace Pstryk82\LeagueBundle\Generator;

class IdGenerator
{
    /**
     * @return string
     */
    public static function generate()
    {
        return uniqid();
    }
}
