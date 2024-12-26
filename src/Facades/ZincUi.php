<?php

namespace ArifBudimanAr\ZincUi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArifBudimanAr\ZincUi\ZincUi
 */
class ZincUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ArifBudimanAr\ZincUi\ZincUi::class;
    }
}
