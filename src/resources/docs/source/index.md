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

#Choices management


<!-- START_60a80cc241c6a08926ae5cb62645ac8d -->
## List poll choices

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/aut/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/aut/choices"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    "http://localhost/api/v1/polls/autem/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"message":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/autem/choices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message": "sit"
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
    "http://localhost/api/v1/choices/at" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"message":"pariatur"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/at"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message": "pariatur"
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
    "http://localhost/api/v1/choices/quaerat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/quaerat"
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
    "http://localhost/api/v1/polls/temporibus/users/eaque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"choice_id":"quos"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/temporibus/users/eaque"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "choice_id": "quos"
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
    "http://localhost/api/v1/presentations/velit/users/atque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/velit/users/atque"
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
    "http://localhost/api/v1/presentations/vero/users/quasi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/vero/users/quasi"
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
    "http://localhost/api/v1/presentations/earum/users/voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"role":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/earum/users/voluptatem"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "role": "sit"
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
    -G "http://localhost/api/v1/presentations/beatae/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/beatae/polls"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    "http://localhost/api/v1/presentations/quidem/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"nam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/quidem/polls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "subject": "nam"
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
    -G "http://localhost/api/v1/polls/laudantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/laudantium"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    "http://localhost/api/v1/polls/atque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"qui"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/atque"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "subject": "qui"
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
    "http://localhost/api/v1/polls/mollitia" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/mollitia"
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
    -G "http://localhost/api/v1/polls/aut/results" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/aut/results"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    -G "http://localhost/api/v1/users/alias/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/alias/presentations"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    "http://localhost/api/v1/users/incidunt/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"aspernatur","date":"modi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/incidunt/presentations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "aspernatur",
    "date": "modi"
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
    -G "http://localhost/api/v1/presentations/consequuntur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/consequuntur"
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


> Example response (500):

```json
{
    "message": "Server Error"
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
    "http://localhost/api/v1/presentations/cumque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"sunt","date":"molestias"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/cumque"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "sunt",
    "date": "molestias"
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
    "http://localhost/api/v1/presentations/qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/qui"
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

<!-- START_4603721d3613a0fa6a1aa7c492fca225 -->
## Search for a presentation

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/prestations/search?keywords=debitis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/prestations/search"
);

let params = {
    "keywords": "debitis",
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



### HTTP Request
`GET api/v1/prestations/search`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `keywords` |  required  | Keywords to search

<!-- END_4603721d3613a0fa6a1aa7c492fca225 -->

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

#general


<!-- START_1a1bf5a3b78c8e2727d466dbb4ddd7e4 -->
## Send an email to the user with the reset password link

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/password/send-reset-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"dolor"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/send-reset-email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "dolor"
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
`POST api/v1/password/send-reset-email`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | email of the user who makes the request
    
<!-- END_1a1bf5a3b78c8e2727d466dbb4ddd7e4 -->

<!-- START_a62f1703e9fba891a3e20ff27854aac0 -->
## Change the password

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"voluptatibus","email":"voluptatem","password":"doloribus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "voluptatibus",
    "email": "voluptatem",
    "password": "doloribus"
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
`POST api/v1/password/reset`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | token to validate the request
        `email` | email |  required  | email of the user who wants to change is password
        `password` | string |  required  | the new password for the user
    
<!-- END_a62f1703e9fba891a3e20ff27854aac0 -->


