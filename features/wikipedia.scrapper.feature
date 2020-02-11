Feature: Get references from behat page un Wikipedia

  Scenario: Scrap references
    Given I am on "https://www.wikipedia.org/"
    Then I should see "English"
    When I follow "English"
    Then the url should match "/wiki/Main_Page"
    When I fill in "Search Wikipedia" with "behat (computer science)"
    When I press "Go"
    Then print current URL
    Then I should see "References"
    Then show references
