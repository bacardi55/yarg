<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //Symfony:
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            // Doctrine:
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            // Sensio:
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            // FOS:
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            // JMS:
            new JMS\SerializerBundle\JMSSerializerBundle(),
            // BC:
            new Bc\Bundle\BootstrapBundle\BcBootstrapBundle(),
            // Stof:
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            // B55:
            new B55\Bundle\YargBundle\B55YargBundle(),
            new B55\Bundle\YargWebSiteBundle\B55YargWebSiteBundle(),
            new B55\Bundle\YargAPIBundle\B55YargAPIBundle(),
            new B55\Bundle\YargAdminBundle\B55YargAdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
