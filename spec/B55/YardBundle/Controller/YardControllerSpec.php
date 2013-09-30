<?php

namespace spec\B55\YardBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YardControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('B55\YardBundle\Controller\YardController');
    }
}
