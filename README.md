# 📘 API Documentation

## 🛠️ Base URL

```
http://yourdomain.com/api
```

---

## 📌 Authentication Endpoints

### 🔐 Login

- **URL**: `/api/login`  
- **Method**: `POST`  
- **Auth Required**: ❌ No  

#### Body Parameters

| Parameter | Type   | Required | Description       |
|-----------|--------|----------|-------------------|
| email     | string | ✅       | User email        |
| password  | string | ✅       | User password     |

#### Response

```json
{
  "access_token": "token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

### 📝 Register

- **URL**: `/api/register`  
- **Method**: `POST`  
- **Auth Required**: ❌ No  

#### Body Parameters

| Parameter | Type   | Required | Description   |
|-----------|--------|----------|---------------|
| name      | string | ✅       | Full name     |
| email     | string | ✅       | Email         |
| password  | string | ✅       | Password      |

#### Response

```json
{
  "message": "User registered successfully"
}
```

---

## 🔐 Protected Endpoints (Require Token)

> Set Authorization header:
>
> ```
> Authorization: Bearer <token>
> ```

### 👤 Get Current User Info

- **URL**: `/api/me`  
- **Method**: `GET`  
- **Auth Required**: ✅ Yes  

#### Response

```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  ...
}
```

---

### 🚪 Logout

- **URL**: `/api/logout`  
- **Method**: `POST`  
- **Auth Required**: ✅ Yes  

#### Response

```json
{
  "message": "Successfully logged out"
}
```

---

### ♻️ Refresh Token

- **URL**: `/api/refresh`  
- **Method**: `POST`  
- **Auth Required**: ✅ Yes  

#### Response

```json
{
  "access_token": "new_token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

## 🛠️ Admin Endpoints (Require Admin Role)

> Require `auth:api` + `role:admin` middleware.

### 👥 Get All Users

- **URL**: `/api/users`  
- **Method**: `GET`  
- **Auth Required**: ✅ Yes (Admin only)  

#### Response

```json
[
  {
    "id": 1,
    "name": "Admin User",
    "email": "admin@example.com"
  },
  ...
]
```

---

### ➕ Create New User

- **URL**: `/api/users/store`  
- **Method**: `POST`  
- **Auth Required**: ✅ Yes (Admin only)  

#### Body Parameters

| Parameter | Type   | Required | Description                  |
|-----------|--------|----------|------------------------------|
| name      | string | ✅       | Full name                    |
| email     | string | ✅       | Email                        |
| password  | string | ✅       | Password                     |
| role      | string | ✅       | Role (e.g., user, admin)     |

#### Response

```json
{
  "message": "User created successfully"
}
```

---

### ✏️ Update User

- **URL**: `/api/users/update/{id}`  
- **Method**: `POST`  
- **Auth Required**: ✅ Yes (Admin only)  

#### Body Parameters

| Parameter | Type   | Required | Description               |
|-----------|--------|----------|---------------------------|
| name      | string | Optional | New full name             |
| email     | string | Optional | New email                 |
| password  | string | Optional | New password              |
| role      | string | Optional | New role (user/admin/etc) |

#### Response

```json
{
  "message": "User updated successfully"
}
```

---

### ❌ Delete User

- **URL**: `/api/users/delete/{id}`  
- **Method**: `POST`  
- **Auth Required**: ✅ Yes (Admin only)  

#### Response

```json
{
  "message": "User deleted successfully"
}
```

---

## 📢 Notes

- All protected routes require a valid **JWT token** in the `Authorization` header.
- Admin routes are protected with middleware: `auth:api` and `role:admin`.