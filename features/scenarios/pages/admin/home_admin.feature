@admin

Feature: Check redirect to homepage if try to access admin with anonymous user

  Scenario: [Fail] Try to access admin with anonymous user
    When I go to "/fr/morvanadmin"
    Then I should be on "/fr/"
    And I should see "Vous devez être connecté."

  Scenario: [Fail] Try to access admin with anonymous user
    When I go to "/en/morvanadmin"
    Then I should be on "/en/"
    And I should see "You must be connected."

