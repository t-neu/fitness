<?php
// src/AppBundle/UserBundle/Entity/User.php

namespace AppBundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }        
}

