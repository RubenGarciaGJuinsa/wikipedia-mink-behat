Feature: Scrap Wikipedia

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

  @stadistics
  Scenario: Get the number of articles in each language
    Given I am on "https://www.wikipedia.org/"

    Then I should see "English"
    When I follow "English"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Deutsch"
    When I follow "Deutsch"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Français"
    When I follow "Français"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Polski"
    When I follow "Polski"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Português"
    When I follow "Português"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Italiano"
    When I follow "Italiano"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Русский"
    When I follow "Русский"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    When I move backward one page
    Then I should see "Español"
    When I follow "Español"
    When I go to "wiki/Special:Statistics"
    Then I store the number of articles

    Then show the number of articles