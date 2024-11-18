# API Endpoints

This document provides an overview of the API endpoints, detailing their purpose, HTTP methods, required parameters, and example responses.

## Base URL

All requests should be made to the following base URL:

```bash
http://localhost/api
```

## Endpoints

### 1. **Sign Up**

**Endpoint:** `/auth/register`  
**Method:** `POST`

**Request Parameters:**

| Parameter  | Type     | Required | Description                        |
|------------|----------|----------|------------------------------------|
| `name`    | `string` | Yes      | The name of the user. Must be a string. |
| `email`    | `string` | Yes      | The email address of the user. Must be a valid email format. |
| `password` | `string` | Yes      | The password of the user. Should meet security requirements (e.g., minimum length, complexity). |
| `password_confirmation` | `string` | Yes      | The confirmation of the password |

### 2. **Sign In**

**Endpoint:** `/auth/login`  
**Method:** `POST`

**Request Parameters:**

| Parameter  | Type     | Required | Description                        |
|------------|----------|----------|------------------------------------|
| `email`    | `string` | Yes      | The email address of the user. Must be a valid email format. |
| `password` | `string` | Yes      | The password of the user. Should meet security requirements (e.g., minimum length, complexity). |

### 3. **Lougout**

**Endpoint:** `/auth/logout`  
**Method:** `POST`

Log out the authenticated user.

All endpoints may be available via Postman: docs/postman.json