<?php

namespace B55\Bundle\YargBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\RawMinkContext;

use Behat\Behat\Context\Step;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use B55\Bundle\YargBundle\Entity\Cv;

//
// Require 3rd-party libraries here:
//
//require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends RawMinkContext
                  implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^there is no "([^"]*)" in the database$/
     */
    public function thereIsNoUserInTheDatabase($entityName)
    {
        $entities = $this->kernel->getContainer()->get('doctrine')
            ->getRepository('B55YargBundle:' . $entityName)->findAll();
        foreach ($entities as $eachEntity) {
            $this->kernel->getContainer()->get('doctrine')->getManager()
                ->remove($eachEntity);
        }

        $this->kernel->getContainer()->get('doctrine')->getManager()->flush();

    }

    /** @Given /the following people exist:/ */
    public function thePeopleExist(TableNode $table)
    {
        $userManager = $this->kernel->getContainer()->get('fos_user.user_manager');
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $user = $userManager->createUser();
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPlainPassword($row['pass']);
            $user->setEnabled(true);
            $user->setCreated(new \Datetime());
            $user->setUpdated(new \Datetime());

            $userManager->updateUser($user);
        }
    }

    /**
     * @Given /^I am an anonymous user$/
     */
    public function iAmAnAnonymousUser()
    {
        $this->getSession()->visit($this->kernel->getContainer()->get('router')->generate('fos_user_security_logout'));

        assertEquals(
            'anon.',
            $this->kernel->getContainer()->get('security.context')->getToken()->getUser()
        );
    }

    /**
     * @Given /^I am logged in as "([^"]*)"$/
     */
    public function IamLoggedInAs($arg1)
    {
        return array(
            new Step\When('I am on "/login"'),
            new Step\When('I fill "Username" with "raphael"'),
            new Step\When('I fill "Password" with "password"'),
            new Step\When('I press "Login"'),
            new Step\Then('I am authenticated as "raphael"')
        );
    }

    /**
     * @Then /^I should be on "([^"]*)"$/
     */
    public function iShouldBeOn($arg1)
    {
        assertEquals(
            $this->getSession()->getCurrentUrl(),
            $this->kernel->getContainer()->get('router')
                ->generate('yarg_myyarg', array(), true)

        );
    }

    /**
     * @When /^I am on "([^"]*)"$/
     */
    public function iAmOn($arg1)
    {
        $this->getSession()->visit(
            $this->kernel->getContainer()->get('router')
                ->generate('fos_user_security_login', array('_locale' => 'en'))
        );
    }

    /**
     * @When /^I fill "([^"]*)" with "([^"]*)"$/
     */
    public function iFillWith($arg1, $arg2)
    {
        $this->getSession()->getPage()->fillField($arg1, $arg2);
    }

    /**
     * @When /^I press "([^"]*)"$/
     */
    public function iPress($arg1)
    {
        $this->getSession()->getPage()->pressButton($arg1);
    }

    /**
     * @Then /^I am authenticated as "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($arg1)
    {
        $user = $this->kernel->getContainer()->get('security.context')->getToken()->getUser();
        assertEquals($user->getUsername(), $arg1);
    }

    /**
     * @Given /^I have no Cv$/
     */
    public function userHasNoCv()
    {
        $user = $this->kernel->getContainer()->get('security.context')->getToken()->getUser();

        $entities = $this->kernel->getContainer()->get('doctrine')
            ->getRepository('B55YargBundle:Cv')->findByUser($user);

        foreach ($entities as $eachEntity) {
            $this->kernel->getContainer()->get('doctrine')->getManager()
                ->remove($eachEntity);
        }

        $this->kernel->getContainer()->get('doctrine')->getManager()->flush();
        // Reload the page to reload with new entity.
        $this->getSession()->reload();
    }

    /**
     * @Given /^I have a Cv "([^"]*)"$/
     */
    public function iHaveACv($arg1)
    {
        $user = $this->kernel->getContainer()->get('security.context')
            ->getToken()->getUser();

        $cv = new Cv();
        $cv->setTitle($arg1);
        $cv->setUser($user);
        $cv->setCreated(new \Datetime());
        $cv->setUpdated(new \Datetime());

        $manager = $this->kernel->getContainer()->get('doctrine')->getManager();
        $manager = $manager->persist($cv);

        $this->kernel->getContainer()->get('doctrine')->getManager()->flush();

        // Reload the page to reload with new entity.
        $this->getSession()->reload();
    }

    /**
     * @Given /^I have the following Cv:$/
     */
    public function iHaveTheFollowingCv(TableNode $table)
    {
        foreach ($table->getHash() as $cv) {
            $this->iHaveACv($cv['title']);
        }
    }

    /**
     * @Then /^I see no cv$/
     */
    public function iSeeNoCv()
    {
        $page = $this->getSession()->getPage();
        $trans = $this->kernel->getContainer()->get('translator');
        assertContains($trans->trans('yarg.my_yarg.no_cv'), $page->getContent());
    }

    /**
     * @Then /^I see my Cv "([^"]*)"$/
     */
    public function iSeeMyCv($arg1)
    {
        assertContains(
            $arg1,
            $this->getSession()->getPage()->find('css','ul.yarg_cv_list')->getText()
        );
    }

    /**
     * @Then /^I see "([^"]*)" CV$/
     */
    public function iSeeCv($arg1)
    {
        assertEquals(
          $arg1,
          count($this->getSession()->getPage()
              ->findAll('css','ul.yarg_cv_list > li')
          )
        );
    }

    /**
     * @Then /^I should see a menu link "([^"]*)" to "([^"]*)"$/
     */
    public function iShouldSeeAMenuLinkTo($arg1, $arg2)
    {

        $link = $this->getSession()->getPage()->findById('yarg_menu')
            ->findLink($arg1);

        assertRegExp(
            '#' . $arg2 . '$#',
            $link->getAttribute('href')
        );
    }

    /**
     * @Then /^I should have my Cv "([^"]*)" in the menu$/
     */
    public function iShouldHaveMyCvInTheMenu($arg1)
    {
        $menu = $this->getSession()->getPage()->findById('yarg_menu');

        assertContains(substr($arg1, 0, 10), $menu->getText());
    }
    /**
     * @Then /^I should see a "([^"]*)" button$/
     */
    public function iShouldSeeAButton($arg1)
    {
        $button = $this->getSession()->getPage()->findById($arg1)->getAttribute('href');
        assertEquals(
            $this->kernel->getContainer()->get('router')->generate('yarg_myyarg_new_cv'),
            $button
        );
    }

    /**
     * @Given /^I should see a create cv form$/
     */
    public function iShouldSeeACreateCvForm()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I open my Cv "([^"]*)"$/
     */
    public function iOpenMyCv($arg1)
    {
        $link = $this->getSession()->getPage()->find('css', 'ul.yarg_cv_list')->findLink($arg1);
        $href = $link->getAttribute('href');
        $link->click();

        assertRegExp(
            '#' . $href . "$#",
            $this->getSession()->getCurrentUrl()
        );
    }
}
