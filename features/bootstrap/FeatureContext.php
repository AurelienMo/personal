<?php

use Behat\MinkExtension\Context\MinkContext;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext extends MinkContext
{
    /**
     * @Given I am connected with user :identifier and password :password on page :uri with :btn
     *
     * @param string $identifier
     * @param string $password
     * @param string $uri
     * @param string $btn
     */
    public function iAmConnectedWithUserAndPassword(string $identifier, string $password, string $uri, string $btn)
    {
        $this->visit($uri);
        $this->fillField('login_username', $identifier);
        $this->fillField('login_password', $password);
        $this->pressButton($btn);
    }
}
