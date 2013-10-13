<?php

namespace B55\Bundle\YargBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class B55YargBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
