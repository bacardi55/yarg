@yarg @myyarg @cv @create
Feature: Create Cv
  In order to have a resume
  As a Yarg User
  I need to be able to create a Cv

  Background:
    Given there is no "User" in the database
    Given the following people exist:
      | username  | email               | pass     |
      | raphael   | raphael@khaiat.org  | password |
      | bacardi55 | admin@bacardi55.org | password |
    Given I am logged in as "raphael"
    Then I should be on "/en/my-yarg"

#  Scenario: I want to start a Cv
#    Then I should see a "yarg_add_cv" button
#    When I press "yarg_add_cv"
#    Then I should be on "/my-yarg/add/cv"
#    And I should see a create cv form
