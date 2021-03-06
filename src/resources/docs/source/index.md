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

All routes that need authentication should contain a bearer token in the headers
using the following synthax:<br>
`Authorization: Bearer <token>`
<!-- START_1a1bf5a3b78c8e2727d466dbb4ddd7e4 -->
## Send an email to the user with the reset password link

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/password/send-reset-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"email":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/send-reset-email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "sit"
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
    -H "Authorization: Bearer {token}" \
    -d '{"token":"quia","email":"repudiandae","password":"tempore"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "token": "quia",
    "email": "repudiandae",
    "password": "tempore"
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

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Log the user in

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"email":"sunt","password":"maxime"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "sunt",
    "password": "maxime"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMWEyOTg1ZDM0ZTliYTliMGViODFkYmQyY2MwOWNlZGIzMDE4NDA4OGEwNTA2YmM4MWI3NjJlZWFhYTgzYmJlMWNkZDhhMGFhNWMwZjI2MDYiLCJpYXQiOjE1ODc4MjAzODMsIm5iZiI6MTU4NzgyMDM4MywiZXhwIjoxNjE5MzU2MzgzLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.UQ46-D8C1FIzjOq4JC1BU9260-yG4jE35i0XnhmHQFF6v96m98k8L6wH86TD_rPJqi-izbG7SBVO2PJSbJDHJd8qLvhzv6jy38UpjeP_EUngvFfoyIgbRyZ7prGA1Ni4IqDxh0LcdJRXi15hvjQAzdVfOlwl8HFce_ns4miwPRkF7QJrLP51fz001dapxtXXqGwm7-a0w-jqujUaj70_Xfa4UG80_DDLB8yqZOod_OfSMjOrUsYi-7DQcyh0M63FAhZG5KJOX32Nb0uE4PQ98bytP-ClQ-OiIe6zF7QYbe8wGm10XlWNdXp8LUEuq2Zwo7xaDvR8KDZ4xhaYS9I4c_T0azeip18xFoa1jhvLR6T0_iShcxz3Wkjx7XMY_GCjQ4ZyxZoL8upASjWqS0aThTlxnEAW9Vp1nk990jMYp-nMMr_ESOgwJTiGhiqnMygskSCBc739BCAuHXhH_Ex0tWy2lH8ZthEzg9PmcH27wjyGiRGg2MqhfhUBs9HnQN8QiOvFGIlvXOhz40BkP9javiak7EOZifZo1STUa1jmCfxPF4ke1ztFm6Y-ZvDs-457x_LjrMbHUuDuZgf5u6vkGv89ymnzx01KenfUFAfWBAGNja_1W5YrdLYiTGHyFUuUr8tVJ1BfdM4rzu7nT5ebtldd-XoGJu15Zb-wgPAIX9k",
    "refresh_token": "def50200f88f1503408341326939955bf81039402f1b0a3beb6f57510c68ab17fe30c185697149d8d47469d635a27abc295690094d7064d2b98e4c2e53e375ad61545c25875201cb22c454eae60dae16c79e0bdfd81004eab93444d63971e8011647700fd4044f2b8064c4b060a3b0f57ff40176b565ed4b40c2724748840a4fbcf58f721334a525ea8cc59a40c7f781db4c11b958ded4ccacbf9d3a741c3756cbf64af2fded936560d8bcee1b24e821b6394c90426b52a8adab0df480abc4a496498366854250fe100b659acba9104e9d3a90183d7295896f8e8a816967619b3ec6d6d9a37d4a73a131e3fdf54f218ef80be881f71cfce4aab798fcd4df944cf125691e9c0b115127e80a92717f7e9a18ae0d61a9b70846c9d810dfd993ad1eb4c5a3c6077dcbcbcc7544f3d4fc85212ebc87f3efb9060c567e839c2205b1f4d8e54a6df3c10d5240f14d8f60a07aa6f83fdcef5719a04fd9c48d76a6b490fc09a5"
}
```

### HTTP Request
`POST api/v1/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | email of the user to connect
        `password` | string |  required  | the password related to the user
    
<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->
<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
## Create a new user account

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"fname":"inventore","lname":"eveniet","email":"modi","password":"provident"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "fname": "inventore",
    "lname": "eveniet",
    "email": "modi",
    "password": "provident"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMWEyOTg1ZDM0ZTliYTliMGViODFkYmQyY2MwOWNlZGIzMDE4NDA4OGEwNTA2YmM4MWI3NjJlZWFhYTgzYmJlMWNkZDhhMGFhNWMwZjI2MDYiLCJpYXQiOjE1ODc4MjAzODMsIm5iZiI6MTU4NzgyMDM4MywiZXhwIjoxNjE5MzU2MzgzLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.UQ46-D8C1FIzjOq4JC1BU9260-yG4jE35i0XnhmHQFF6v96m98k8L6wH86TD_rPJqi-izbG7SBVO2PJSbJDHJd8qLvhzv6jy38UpjeP_EUngvFfoyIgbRyZ7prGA1Ni4IqDxh0LcdJRXi15hvjQAzdVfOlwl8HFce_ns4miwPRkF7QJrLP51fz001dapxtXXqGwm7-a0w-jqujUaj70_Xfa4UG80_DDLB8yqZOod_OfSMjOrUsYi-7DQcyh0M63FAhZG5KJOX32Nb0uE4PQ98bytP-ClQ-OiIe6zF7QYbe8wGm10XlWNdXp8LUEuq2Zwo7xaDvR8KDZ4xhaYS9I4c_T0azeip18xFoa1jhvLR6T0_iShcxz3Wkjx7XMY_GCjQ4ZyxZoL8upASjWqS0aThTlxnEAW9Vp1nk990jMYp-nMMr_ESOgwJTiGhiqnMygskSCBc739BCAuHXhH_Ex0tWy2lH8ZthEzg9PmcH27wjyGiRGg2MqhfhUBs9HnQN8QiOvFGIlvXOhz40BkP9javiak7EOZifZo1STUa1jmCfxPF4ke1ztFm6Y-ZvDs-457x_LjrMbHUuDuZgf5u6vkGv89ymnzx01KenfUFAfWBAGNja_1W5YrdLYiTGHyFUuUr8tVJ1BfdM4rzu7nT5ebtldd-XoGJu15Zb-wgPAIX9k",
    "refresh_token": "def50200f88f1503408341326939955bf81039402f1b0a3beb6f57510c68ab17fe30c185697149d8d47469d635a27abc295690094d7064d2b98e4c2e53e375ad61545c25875201cb22c454eae60dae16c79e0bdfd81004eab93444d63971e8011647700fd4044f2b8064c4b060a3b0f57ff40176b565ed4b40c2724748840a4fbcf58f721334a525ea8cc59a40c7f781db4c11b958ded4ccacbf9d3a741c3756cbf64af2fded936560d8bcee1b24e821b6394c90426b52a8adab0df480abc4a496498366854250fe100b659acba9104e9d3a90183d7295896f8e8a816967619b3ec6d6d9a37d4a73a131e3fdf54f218ef80be881f71cfce4aab798fcd4df944cf125691e9c0b115127e80a92717f7e9a18ae0d61a9b70846c9d810dfd993ad1eb4c5a3c6077dcbcbcc7544f3d4fc85212ebc87f3efb9060c567e839c2205b1f4d8e54a6df3c10d5240f14d8f60a07aa6f83fdcef5719a04fd9c48d76a6b490fc09a5"
}
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
<!-- START_d58be746f29144cb8a66c4e189fcb1e1 -->
## Return the current authenticated information

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 11,
    "fname": "Fizz",
    "lname": "Buzz",
    "email": "fizz.buzz@example.com"
}
```

### HTTP Request
`GET api/v1/me`


<!-- END_d58be746f29144cb8a66c4e189fcb1e1 -->

<!-- START_fb2ae43e2e99ff4e90f22ba03801a735 -->
## Sign out the user from everywere

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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


<!-- START_db09c59fb04bf48a331584b8b60206e2 -->
## Create a poll choice

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/polls/nulla/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"message":"nobis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/nulla/choices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "message": "nobis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 3,
    "message": "Leeroy Jenkins",
    "poll_id": 2
}
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
<!-- START_c22dacf56b4a031299a06e59ed170df3 -->
## Delete a poll choice

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/choices/facilis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/facilis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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

<!-- START_60a80cc241c6a08926ae5cb62645ac8d -->
## List poll choices

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/cum/choices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/cum/choices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "message": "Trump",
        "poll_id": 2
    },
    {
        "id": 2,
        "message": "Obama",
        "poll_id": 2
    },
    {
        "id": 3,
        "message": "Leeroy Jenkins",
        "poll_id": 2
    }
]
```

### HTTP Request
`GET api/v1/polls/{poll}/choices`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | id of the poll

<!-- END_60a80cc241c6a08926ae5cb62645ac8d -->
<!-- START_758ad1db5165188308a1821a01093f11 -->
## Update a poll choice

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/choices/quod" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"message":"repellat"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/choices/quod"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "message": "repellat"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 3,
    "message": "Leeroy Jenkins",
    "poll_id": 2
}
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

<!-- START_27624d5053a8a1828942ffdbefa7060b -->
## Make a user vote on a poll

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/polls/quaerat/users/consequatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"choice_id":"ipsum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/quaerat/users/consequatur"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "choice_id": "ipsum"
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/presentations/et/users/quibusdam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/et/users/quibusdam"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/presentations/sunt/users/voluptas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/sunt/users/voluptas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/presentations/dolor/users/voluptate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"role":"sed"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/dolor/users/voluptate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "role": "sed"
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


<!-- START_114b4cd6c2190f90cea1f94d8629f2c2 -->
## Create a new poll

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/presentations/quis/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"subject":"consequatur"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/quis/polls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "subject": "consequatur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "subject": "Qui est le meilleur président",
    "status": "draft",
    "presentation_id": 4
}
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

<!-- START_ad26b667ae9655f59bf2bc3e243fbc7e -->
## List all polls related to the presentation.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/reiciendis/polls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/reiciendis/polls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "subject": "Prof.",
        "status": "Texas",
        "presentation_id": 1
    },
    {
        "id": 2,
        "subject": "Qui est le meilleur président",
        "status": "draft",
        "presentation_id": 4
    }
]
```

### HTTP Request
`GET api/v1/presentations/{presentation}/polls`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `presentation` |  required  | Id of the presentation

<!-- END_ad26b667ae9655f59bf2bc3e243fbc7e -->

<!-- START_a84200ca56536cedf7fabb5f3be27df0 -->
## Show a poll

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/velit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/velit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "subject": "Qui est le meilleur président",
    "status": "draft",
    "presentation_id": 4
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/polls/hic" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"subject":"fugit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/hic"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "subject": "fugit"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "subject": "Qui est le meilleur président",
    "status": "draft",
    "presentation_id": 4
}
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

<!-- START_7abd806acbc93b7b7494d0b856bb04cd -->
## Change the status of a poll to published

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/polls/1/publish" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/1/publish"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 2,
    "subject": "Qui est le meilleur président",
    "status": "draft",
    "presentation_id": 4
}
```

### HTTP Request
`PUT api/v1/polls/{poll}/publish`


<!-- END_7abd806acbc93b7b7494d0b856bb04cd -->

<!-- START_fc03f8ead82e85626d1a3a1090521037 -->
## Show results of the poll

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/polls/officiis/results" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/polls/officiis/results"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "choice_id": 1,
        "votes": 13
    },
    {
        "choice_id": 2,
        "votes": 25
    },
    {
        "choice_id": 3,
        "votes": 2
    }
]
```

### HTTP Request
`GET api/v1/polls/{poll}/results`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `poll` |  required  | Poll id

<!-- END_fc03f8ead82e85626d1a3a1090521037 -->

#Presentations management


<!-- START_e96335a14a712c3589807d07a2b53adb -->
## Search for a presentation

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/search?keywords=ab" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/search"
);

let params = {
    "keywords": "ab",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 5,
        "title": "Quel est la place de la communication au sein de notre société",
        "date": "2010-04-02 12:23",
        "conference_id": 3
    },
    {
        "id": 20,
        "title": "Est-ce que les lions sont végétariens",
        "date": "2010-02-02 17:00",
        "conference_id": 3
    },
    {
        "id": 37,
        "title": "Quel est le vrai rôle des moustiques dans l'écosystème",
        "date": "2010-03-02 10:15",
        "conference_id": 3
    }
]
```

### HTTP Request
`GET api/v1/presentations/search`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `keywords` |  required  | Keywords to search

<!-- END_e96335a14a712c3589807d07a2b53adb -->

<!-- START_b88e9ba7b4015e12b6b73a5b328ee5ac -->
## List all presentations related to a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users/qui/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/qui/presentations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 5,
        "title": "Quel est la place de la communication au sein de notre société",
        "date": "2010-04-02 12:23",
        "conference_id": 3
    },
    {
        "id": 20,
        "title": "Est-ce que les lions sont végétariens",
        "date": "2010-02-02 17:00",
        "conference_id": 3
    },
    {
        "id": 37,
        "title": "Quel est le vrai rôle des moustiques dans l'écosystème",
        "date": "2010-03-02 10:15",
        "conference_id": 3
    }
]
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/users/inventore/presentations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"numquam","date":"velit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/inventore/presentations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "numquam",
    "date": "velit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 5,
    "title": "Quel est la place de la communication au sein de notre société",
    "date": "2010-04-02 12:23",
    "conference_id": 3
}
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/presentations/perferendis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/perferendis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 5,
    "title": "Quel est la place de la communication au sein de notre société",
    "date": "2010-04-02 12:23",
    "conference_id": 3
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/presentations/itaque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"title":"molestias","date":"quaerat"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/itaque"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "title": "molestias",
    "date": "quaerat"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 5,
    "title": "Quel est la place de la communication au sein de notre société",
    "date": "2010-04-02 12:23",
    "conference_id": 3
}
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

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/presentations/excepturi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/presentations/excepturi"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
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

#User Management


<!-- START_296fac4bf818c99f6dd42a4a0eb56b58 -->
## Update the specified resource in storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 11,
    "fname": "Fizz",
    "lname": "Buzz",
    "email": "fizz.buzz@example.com"
}
```

### HTTP Request
`PUT api/v1/users/{user}`

`PATCH api/v1/users/{user}`


<!-- END_296fac4bf818c99f6dd42a4a0eb56b58 -->


