<?php
namespace B55\YargBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAware;

use FOS\UserBundle\Doctrine\UserManager;

use B55\YargBundle\Entity\User;

class LoadUserData extends ContainerAware implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername('johndoe');
        $user->setEmail('john.doe@example.com');
        $user->setPlainPassword('password');
        $userManager->updateUser($user);

        $user2 = $userManager->createUser();
        $user2->setUsername('Raphael');
        $user2->setEmail('raphael@khaiat.org');
        $user2->setPlainPassword('password');
        $userManager->updateUser($user2);
    }
}
