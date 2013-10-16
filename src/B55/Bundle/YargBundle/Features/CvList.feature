@yarg @myyarg @cv @see
Feature: CV list
  In order to see my CV
  As a Yarg User
  I need to access my cv list

  Background:
    Given there is no "User" in the database
    Given the following people exist:
      | username  | email               | pass     |
      | raphael   | raphael@khaiat.org  | password |
      | bacardi55 | admin@bacardi55.org | password |
    Given I am logged in as "raphael"
    Then I should be on "/en/my-yarg"

  Scenario: I want to see no Cv
    Given I have no Cv
    Then I see no cv

  Scenario: I want to see my Cv
    Given I have a Cv "raphael CV"
    Then I see my Cv "raphael CV"

  Scenario: I want to see "2" Cv
    Given I have the following Cv:
      | title        |
      | raphael CV 1 |
      | raphael CV 2 |
    Then I see "2" CV

  Scenario: I want to see my cv "raphael CV" details
    Given I have a Cv "raphael CV"
    Then I open my Cv "raphael CV"
    Then I am on "/en/my-yarg/raphael-cv"
