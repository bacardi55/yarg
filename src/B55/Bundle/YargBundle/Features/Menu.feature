@yarg @menu
Feature: Menu
  In order to navigate in yarg
  As a user (anonymous or yarg user)
  I need to see a menu

  Background:
    Given there is no "user" in the database
    Given the following people exist:
      | username  | email               | pass     |
      | raphael   | raphael@khaiat.org  | password |
    Given I am on "/"

  Scenario: Anonymous user can login
    Given I am an anonymous user
    Then I should see a menu link "Login" to "/login"

  Scenario: Logged in user can logout
    Given I am logged in as "raphael"
    Then I should see a menu link "Logout" to "/logout"

  Scenario: Logged in user see their Cv in the menu
    Given I am logged in as "raphael"
    Given I have a Cv "my CV"
    Then I should have my Cv "my CV" in the menu

  Scenario: Logged in user see their Cv in the menu
    Given I am logged in as "raphael"
    Given I have a Cv "my very long named CV"
    Then I should have my Cv "my very long named CV" in the menu

  Scenario: Logged in user can create a Cv from the menu
    Given I am logged in as "raphael"
    Then I should see a menu link "create_cv" to "/en/my-yarg/add/cv"

  Scenario: Logged in user can edit their profile from the menu
    Given I am logged in as "raphael"
    Then I should see a menu link "edit_profile" to "/en/profile/edit"

