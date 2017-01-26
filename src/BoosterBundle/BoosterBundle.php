<?php

namespace BoosterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BoosterBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
