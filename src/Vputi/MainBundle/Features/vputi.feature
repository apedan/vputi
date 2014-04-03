Feature: Album
  In order to
  As authorized user
  I need to be able manage albums and photos

@insulated @javascript @api
Scenario: Enter site view page as user which has access to it
  Given I am on homepage
  Then I should see "Поехали!"
  When I go to "/ru/login"
  Then I should see "Имя пользователя:"
  When I fill in "username" with "apedan"
  And I fill in "password" with "1723104"
  And I press "Войти"
  Then I should see "Вы вошли как apedan"

