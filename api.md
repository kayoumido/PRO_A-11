# API
All API routes are prefixed with the his version ex: `https://monsite.com/api/vx/resource`

## Authentication
| VERB | route  | params | description |
| :--- | :----  | :----- | :---------- |
| POST | login      | email, password | Authenticate a user |
| POST | logout     | | logout a user |
| POST | register   | firstname, lastname, email, password, password_confirm | create a new user |
| POST | password/email | email | request a password reset link |
| POST | password/reset/{token} | new_password, new_password_confirmation | change password |

## User management
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| PUT  | user/{user} | email, firstname, lastname | update user data |

## Presentation management
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| GET  | user/{user}/presentations | | show all presentations related to a user |
| GET  | presentations/search | name | show all presentations corresponding to the name (inside a conférence) |
| GET  | presentation/{presentation} | | show presentation details |
| POST | presentation | title, date | create a presentation |
| PUT  | presentation/{presentation} | title, date | update presentation data |
| DELETE | presentation/{presentation} | | delete a presentation |

## Presentation inscriptions
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| POST | presentation/{presentation}/user/{user} | token | add a user to a presentation verifying the token |
| DELETE | presentation/{presentation}/user/{user} | | remove user from presentation |

## Manage user rights on presentations
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| PUT  | presentation/{presentation}/user/{user} | role | change the user role to a spécific presentation |

## Poll management
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| POST | presentation/{presentation}/poll | subject, choices | create a new poll to the presentation |
| GET  | presentation/{presentation}/polls | | get all polls from a presentation |
| PUT  | poll/{poll} | subject, choices | update a poll |
| DELETE | poll/{poll} | | delete a poll |
| PUT  | poll/{poll}/publish | | publish a poll |
| GET  | poll/{poll}/results | | get all answers to the poll |
| POST | poll/{poll}/user/{user} | choice | add an answer to the poll |

## Questions management
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| GET  | presentation/{presentation}/questions | | show all questions related with presentation |
| POST | presentation/{presentation}/question | question | create a question
| PUT  | question/{question} | question | update a question |
| DELETE | question/{question} | | delete a question |
| POST | question/{question}/user/{user}/upvote | | upvote a question |
| PUT  | question/{question}/validate | | validate a question |

## Questions Moderation
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| POST | question/{question}/user/{user}/report | reason | report a question by a user |
| PUT  | question/{question}/disable | | disable a question |
| PUT  | question/{question}/enable | | enable a question |
| PUT  | presentation/{presentation}/user/{user}/disable | until_date | disable a user |
| PUT  | presentation/{presentation}/user/{user}/enable | | enable a user |

## Conferences
| VERB | route | params | description |
| :--- | :---- | :----- | :---------- |
| POST | conference | name, date | create a conference |
| PUT  | conference/{conference} | name, date | update a conference |
| GET  | conference/{conference} | | show conference details |
| DELETE | conference/{conference} | | delete conference |
| POST | conference/{conference}/user/{user} | token | add user to a conference |
| PUT | conference/{conference}/user/{user} | role | change role of user in a conference |
| DELETE | conference/{conference}/user/{user} | | remove user from a conference |