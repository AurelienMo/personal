@web
@web_login

Feature: I need to be able to access login page. EN Version

  Scenario: [Success] Access login page & check elements
    When I go to "/en/login"
    Then I should see 3 "input" elements
    And I should see "Identifier"
    And I should see "Password"
    And I should see "Login"

  Scenario: [Fail] Fail login page
    When I am on "/en/login"
    And I fill in "Identifier" with ""
    And I fill in "Password" with ""
    And I press "Login"
    Then I should be on "/en/login"
    And I should see "Bad credentials."

  Scenario: [Success] Succesful login with username
    Given I load following file "user.yml"
    When I am on "/en/login"
    And I fill in "Identifier" with "johndoe"
    And I fill in "Password" with "12345678"
    And I press "Login"
    Then I should be on "/en/"

  Scenario: [Success] Successful login with email
    Given I load following file "user.yml"
    When I am on "/en/login"
    And I fill in "Identifier" with "johndoe@yopmail.com"
    And I fill in "Password" with "12345678"
    And I press "Login"
    Then I should be on "/en/"

  Scenario: [Fail] Try to login with account locked
    Given I load following file "login/user.yml"
    When I am on "/en/login"
    And I fill in "Identifier" with "janedoe"
    And I fill in "Password" with "12345678"
    And I press "Login"
    Then I should be on "/en/login"
    And I should see "Your account is blocked. Please contact the administrators."

  Scenario: [Fail] Try to login with account not activated
    Given I load following file "login/user.yml"
    When I am on "/en/login"
    And I fill in "Identifier" with "foobar"
    And I fill in "Password" with "12345678"
    And I press "Login"
    Then I should be on "/en/login"
    And I should see "Your account is not activated. Please check your email or make a forgotten password request."
