---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Authentication

All routes that need authentication should contain a bearer token in the headers using the following synthax `Authorization: Bearer <token>`
ex: `Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiYTgwNjc1OWQzMzhjNzQ4NTZlNWI0ZGI5ZWRmOGE1ZGZjNDk0MDk2ODE1ZTQyY2I1NTYxOWU5NWE5ZDllOTJkNjQzMWI1NTRkMGRjY2YxYjkiLCJpYXQiOjE1ODcwNDY4MzIsIm5iZiI6MTU4NzA0NjgzMiwiZXhwIjoxNjE4NTgyODMyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.0APExixmcY8WB6-YFcwX9v73eGmDWUOIIy-7x7iI56fAkyli8CjvNfg7rxveNLFHWNhAwshl1LW6F1UbXaV_HIZ0kv-8WDR6eO2_5g-bRkxr-WBru0vlEbmpZAxAKyIWoFm3FQdcOXjONpQ2CUkyGSlkoAC9XQSNrkNs1smV2Pj2h3fxuU3mfoqWVZjEbV3dgN0GU4uXWvz1ioauz4uZvyMU3fW0d3V_H6vW4TjeOFDW3XtXln5fAt2wzkYTDf1h_IpQ8PF1GcsJaOL7PReehAI3cumQV1B8EYyzBlTvp7y3RMnP4T_clTCGCjFvuavkQZai29jBw7hbippRJc09sZSv4NvR6Y5MTZElJvDo3xHBApfLdp-V8-n2eqj8524F2NVP7T146K9Yv36fGoa-qNF5NWL7NINd7wAd45UL2mrJP2qq2WlnMlgonTrAhJTYQf2kh9zVbbdIEKCa_RgYBXcdPrDQYaHv1VqVt97TEq5_QpW5EOOf3xdMJ_3rq3vhlXtLEsHnwLMpsmxOejHP5VgCu3FvGGxCKC5ELMHCc5vPtePn5R7jm0-bqXQTHS8wz6UCP2Pd6k24oLLK7AHjDXumaepeNEynBQGcgWT7k2KXijfOjV1fvtLYjUzRljNOvOB3ztwsFCIdBFt8jaSphgCQ9MIbByX3-DKVXAbHX5Y `
<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Log the user in

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"username":"excepturi","password":"rerum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "excepturi",
    "password": "rerum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `username` | email |  required  | email of the user to connect
        `password` | string |  required  | the password related to the user
    
<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
## Create e new user account

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"fname":"pariatur","lname":"et","email":"est","password":"sunt"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "fname": "pariatur",
    "lname": "et",
    "email": "est",
    "password": "sunt"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `fname` | string |  required  | User's firstname
        `lname` | string |  required  | User's lastname
        `email` | email |  required  | User's email
        `password` | string |  required  | User's password
    
<!-- END_8ae5d428da27b2b014dc767c2f19a813 -->

<!-- START_fb2ae43e2e99ff4e90f22ba03801a735 -->
## Sign out the user from everywere

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/logout`


<!-- END_fb2ae43e2e99ff4e90f22ba03801a735 -->

#Choices management


<!-- START_60a80cc241c6a08926ae5cb62645ac8d -->
## List poll choices

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/et/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/et/choices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/polls/{poll}/choices`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | id of the poll

<!-- END_60a80cc241c6a08926ae5cb62645ac8d -->

<!-- START_db09c59fb04bf48a331584b8b60206e2 -->
## Create a poll choice

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/polls/molestiae/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"message":"esse"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/molestiae/choices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message": "esse"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/polls/{poll}/choices`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | id of the linked poll
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `message` | string |  required  | message corresponding to the choice
    
<!-- END_db09c59fb04bf48a331584b8b60206e2 -->

<!-- START_758ad1db5165188308a1821a01093f11 -->
## Update a poll choice

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/choices/voluptas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"message":"animi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/voluptas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message": "animi"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/choices/{choice}`

`PATCH api/v1/choices/{choice}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `choice` |  required  | Id of the choice to update
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `message` | string |  required  | message corresponding to the choice
    
<!-- END_758ad1db5165188308a1821a01093f11 -->

<!-- START_c22dacf56b4a031299a06e59ed170df3 -->
## Delete a poll choice

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/choices/earum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/earum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/choices/{choice}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `choice` |  required  | Id of the choice to delete

<!-- END_c22dacf56b4a031299a06e59ed170df3 -->

<!-- START_27624d5053a8a1828942ffdbefa7060b -->
## Make a user vote on a poll

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/polls/aperiam/users/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"choice_id":"odit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/aperiam/users/et"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "choice_id": "odit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/polls/{poll}/users/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id for the vote
    `user` |  required  | User id for the vote
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `choice_id` | id |  required  | Choice id for the choosed choice
    
<!-- END_27624d5053a8a1828942ffdbefa7060b -->

#Manage user inscriptions


<!-- START_00a8a2d92ea66058f2ebbb025926c160 -->
## Subscribe the user to the presentation.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/presentations/similique/users/ullam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/similique/users/ullam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/presentations/{presentation}/users/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id
    `user` |  required  | User id

<!-- END_00a8a2d92ea66058f2ebbb025926c160 -->

<!-- START_685f2ecf73859cc164ee26955f5e1d3f -->
## Unsubscribe the user to the presentation.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/presentations/reiciendis/users/placeat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/reiciendis/users/placeat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/presentations/{presentation}/users/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id
    `user` |  required  | User id

<!-- END_685f2ecf73859cc164ee26955f5e1d3f -->

#Manage user rights on presentations


<!-- START_5fc332ffa1a4754ae332fc6624663143 -->
## Change the user role related to the presentation.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/presentations/ut/users/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"role":"accusantium"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/ut/users/aut"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "role": "accusantium"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/presentations/{presentation}/users/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id
    `user` |  required  | User id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `role` | string |  required  | the role name
    
<!-- END_5fc332ffa1a4754ae332fc6624663143 -->

#Polls manaquement


<!-- START_ad26b667ae9655f59bf2bc3e243fbc7e -->
## List all polls related to the presentation.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/et/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/et/polls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/presentations/{presentation}/polls`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Id of the presentation

<!-- END_ad26b667ae9655f59bf2bc3e243fbc7e -->

<!-- START_114b4cd6c2190f90cea1f94d8629f2c2 -->
## Create a new poll

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/presentations/consequatur/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"tenetur"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/consequatur/polls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "subject": "tenetur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/presentations/{presentation}/polls`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Id of the presentation
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `subject` | string |  required  | Subject of the poll
    
<!-- END_114b4cd6c2190f90cea1f94d8629f2c2 -->

<!-- START_a84200ca56536cedf7fabb5f3be27df0 -->
## Show a poll

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/nam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/nam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/polls/{poll}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id

<!-- END_a84200ca56536cedf7fabb5f3be27df0 -->

<!-- START_b529b3a708df9723ccdb8049adaa88fc -->
## Update a poll

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/polls/ipsum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"et"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/ipsum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "subject": "et"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/polls/{poll}`

`PATCH api/v1/polls/{poll}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `subject` | string |  required  | Subject of the poll
    
<!-- END_b529b3a708df9723ccdb8049adaa88fc -->

<!-- START_ab79d9deec93a39e500fc2cf12c5e37b -->
## Delete a poll

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/polls/corrupti" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/corrupti"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/polls/{poll}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id

<!-- END_ab79d9deec93a39e500fc2cf12c5e37b -->

<!-- START_7abd806acbc93b7b7494d0b856bb04cd -->
## Change the status of a poll to published

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/polls/1/publish" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/1/publish"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/polls/{poll}/publish`


<!-- END_7abd806acbc93b7b7494d0b856bb04cd -->

<!-- START_fc03f8ead82e85626d1a3a1090521037 -->
## Show results of the poll

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/dolor/results" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/dolor/results"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/polls/{poll}/results`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id

<!-- END_fc03f8ead82e85626d1a3a1090521037 -->

#Presentations management


<!-- START_b88e9ba7b4015e12b6b73a5b328ee5ac -->
## List all presentations related to a user

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/quos/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/quos/presentations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/users/{user}/presentations`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  required  | User id

<!-- END_b88e9ba7b4015e12b6b73a5b328ee5ac -->

<!-- START_dd5197cce590c50f26c1c5a9e8321520 -->
## Create a presentation

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/alias/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"eaque","date":"eius"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/alias/presentations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "eaque",
    "date": "eius"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/users/{user}/presentations`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  required  | User id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | Title of the presentation
        `date` | datetime |  required  | Starting datetime for the presentation
    
<!-- END_dd5197cce590c50f26c1c5a9e8321520 -->

<!-- START_99e4970e762bcf0a5fc7f95c02ab551d -->
## Show a presentation

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/placeat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/placeat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/presentations/{presentation}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id

<!-- END_99e4970e762bcf0a5fc7f95c02ab551d -->

<!-- START_b599d7478d6ee66f1c179d456553b21c -->
## Update a presentation

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/presentations/autem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"dolores","date":"et"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/autem"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "dolores",
    "date": "et"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/presentations/{presentation}`

`PATCH api/v1/presentations/{presentation}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  optional  | optional Title of the presentation
        `date` | datetime |  optional  | optional Starting datetime for the presentation
    
<!-- END_b599d7478d6ee66f1c179d456553b21c -->

<!-- START_d75bb5a606d83d55cff58d40d188d6f7 -->
## Delete a presentation

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/presentations/labore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/labore"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/presentations/{presentation}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Presentation id

<!-- END_d75bb5a606d83d55cff58d40d188d6f7 -->

<!-- START_e96335a14a712c3589807d07a2b53adb -->
## Search for a presentation

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/search?keywords=nisi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/search"
);

let params = {
    "keywords": "nisi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/presentations/search`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `keywords` |  required  | Keywords to search

<!-- END_e96335a14a712c3589807d07a2b53adb -->

#User Management


<!-- START_296fac4bf818c99f6dd42a4a0eb56b58 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/users/{user}`

`PATCH api/v1/users/{user}`


<!-- END_296fac4bf818c99f6dd42a4a0eb56b58 -->


