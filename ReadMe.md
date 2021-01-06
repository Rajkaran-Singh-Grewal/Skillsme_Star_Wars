## SkillsMe Star Wars
---
### Routes
* / : shows the index page where the voting can happen
* /logout : this route logouts out the user and removes them from the session. This than shows the index page
* /people :  This route adds all the characters from the https://swapi.dev/api/people to the database
* /signin : This route allows the user to signin and store the user email and id to the session
* /signup : This route allows the user to signup and store the credentials to the session
* /vote : This route allows the user to vote for their character once, the clients api is stored to the database thus only one vote per ip address can happen
* /vote/changeable : This route allows the user to vote and also change their vote for their favourite character. Same as /vote the vote is stored with the clients ip address
---
### Tasks Done
* Allow users to vote as a visitor
* Gather all characters from the given API, allow user to see and search before voting
* Allow user to signin/sign up before voting
* Prevent the same user voting twice, no matter they signed in or not
---