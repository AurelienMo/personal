@web
@web_homepage

Feature: As a user I need to be access home page & send contact form

  Scenario: [Success] Success Access homepage
    When I go to "/fr"
    Then the response status code should be 200

  Scenario: [Success] Success switch lang
    When I go to "/fr"
    And I follow "switch-language"
    Then I should be on "/en/"

  Scenario: [Error] Submit form contact with no field filled
    When I go to "/fr"
    And I press "Envoyer"
    Then I should be on "/fr/"
    And I should see "Le prénom est requis."
    And I should see "Le nom est requis."
    And I should see "L'adresse email est requise."
    And I should see "Le sujet est requis."
    And I should see "Le message est requis."

  Scenario: [Success] Submit form contact with all required datas
    When I go to "/fr"
    And I fill in "Prénom" with "John"
    And I fill in "Nom" with "Doe"
    And I fill in "Adresse email" with "johndoe@yopmail.com"
    And I fill in "Sujet" with "Demande information"
    And I fill in "Votre message" with "Test contenu de message"
    And I press "Envoyer"
    Then I should be on "/fr/"
    And a mail should have been sent to "contact@morvan.tech" with subject "Demande information"

