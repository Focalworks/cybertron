<?php

class UserModuleTest extends TestCase
{
    /**
     * Basic test to check if login screen is available.
     *
     * @return void
     */
    public function testLoginPageExist()
    {
        $this->visit('/user')
             ->see('Login');
    }

    /**
     * Check login error without any inputs.
     *
     * @return void
     */
    public function testLoginWithNoInputs()
    {
        $this->visit('/user')
             ->press('Login')
             ->seePageIs('/user')
             ->see('Something went wrong with the username and / or password');
    }

    /**
     * Checking login with only username filled.
     *
     * @return void
     */
    public function testLoginWithOnlyUsername()
    {
        $this->visit('/user')
             ->type('amitav.roy@focalworks.in', 'email')
             ->press('Login')
             ->seePageIs('/user')
             ->see('Something went wrong with the username and / or password');
    }

    /**
     * Check login functionality with wrong password.
     * @return void
     */
    public function testWithWrongPassword()
    {
        $this->visit('/user')
             ->type('amitav.roy@focalworks.in', 'email')
             ->type('secret', 'password')
             ->press('Login')
             ->seePageIs('/user')
             ->see('Something went wrong with the username and / or password');
    }

    public function testWithCorrectCredentials()
    {
        $this->visit('/user')
             ->type('amitav.roy@focalworks.in', 'email')
             ->type('pass', 'password')
             ->press('Login')
             ->see('You have logged in successfully')
             ->seePageIs('/user/dashboard');
    }
}
