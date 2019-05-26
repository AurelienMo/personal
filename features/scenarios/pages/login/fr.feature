@web
@web_login

Feature: I need to be able to access login page

  Scenario: [Success] Access login page & check elements
    When I go to "/fr/login"
    Then I should see 3 "input" elements
    And I should see "Identifiant"
    And I should see "Mot de passe"
    And I should see "Se connecter"

  Scenario: [Fail] Fail login page
    When I am on "/fr/login"
    And I fill in "Identifiant" with ""
    And I fill in "Mot de passe" with ""
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And I should see "Identifiants invalides."

  Scenario: [Success] Succesful login with username
    Given I load following file "user.yml"
    When I am on "/fr/login"
    And I fill in "Identifiant" with "johndoe"
    And I fill in "Mot de passe" with "12345678"
    And I press "Se connecter"
    Then I should be on "/fr/"

  Scenario: [Success] Successful login with email
    Given I load following file "user.yml"
    When I am on "/fr/login"
    And I fill in "Identifiant" with "johndoe@yopmail.com"
    And I fill in "Mot de passe" with "12345678"
    And I press "Se connecter"
    Then I should be on "/fr/"

  Scenario: [Fail] Try to login with account locked
    Given I load following file "login/user.yml"
    When I am on "/fr/login"
    And I fill in "Identifiant" with "janedoe"
    And I fill in "Mot de passe" with "12345678"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And I should see "Votre compte est bloqué. Merci de contacter les administrateurs."

  Scenario: [Fail] Try to login with account not activated
    Given I load following file "login/user.yml"
    When I am on "/fr/login"
    And I fill in "Identifiant" with "foobar"
    And I fill in "Mot de passe" with "12345678"
    And I press "Se connecter"
    Then I should be on "/fr/login"
    And I should see "Votre compte n'est pas activé. Merci de vérifier vos mails ou d'effectuer une demande de mot de passe oublié."
