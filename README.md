
# Notes100
## Introduction

This project is a web-based notes management application developed using the Laravel framework.
Its main goal is to demonstrate the implementation of a CRUD system (Create, Read, Update, Delete), user authentication, and role-based access control and content organization using folders in a structured way.

The application allows authenticated users to manage their own notes and optionally organizing them into folders while administrators have access to additional management features.

## 🚀 Features


This project consists of a **Laravel Web Application**, a **REST API**, and an **Android Mobile Application**, all working together around a notes management system with authentication and role separation.


---

## 🗄️ Database Design


<img width="803" height="764" alt="image" src="https://github.com/user-attachments/assets/88efe405-81ae-4d78-9e34-887302ab1b8c" />


---

## 🌐 Web Application (Laravel)


- **Authentication & authorization**
  - Login / logout
  - Role-based access (Admin / User)

- **Notes management**
  - Create, edit, delete and view notes
  - Pinned notes
  - Notes with or without folders

- **Folder management**
  - User folders
  - Assign notes to folders
  - View notes by folder

- **Admin dashboard**
  - User management
  - Global notes management

- **UI & UX**
  - Responsive interface (Blade + Tailwind CSS)
  - Dashboard layout
  - Search and pagination


---


## RESTful API 


- User registration endpoint
- User login endpoint
- Logout endpoint
- Authenticated `/me` endpoint
- CRUD operations for notes
- Token-based authentication for mobile and external clients
- Protected routes using `auth:sanctum`


---


## 🔌 API Usage Examples

Base URL: http://10.0.2.2:8000/api/


All protected endpoints require an **Authorization Bearer Token**.

## 🔐 Authentication

### Register
**POST** `/auth/register`

```json
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Login
**POST** `/auth/login`

```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

### Logout

Headers

```html
Authorization: Bearer {token}
```

### 👤 User
**GET** `/me`

Response
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "user@example.com"
}
```

**PUT** `me`
```json
{
  "name": "John Updated",
  "email": "updated@example.com"
}
```

### 📝 Notes
### Get all notes
**GET** `/notes`

### Get notes by folder
**GET** `/notes?folder_id=2`

### Get specific note
**GET** `/notes/{id}`

### Create a note
**POST** `/notes`

```json
{
  "title": "My Note",
  "content": "This is the note content",
  "is_pinned": true,
  "folder_id": 2
}
```

### Edit a note
**PUT** `/notes/{id}`

```json
{
  "title": "Updated title",
  "content": "Updated content",
  "is_pinned": false,
  "folder_id": null
}
```
### Get folders
**GET** `/folders`

```json
{
  "name": "Work"
}
```

### Create a folder
**POST** `/folders`

```json
{
  "name": "Work"
}
```



---

## 📱 Android Application


The Android app consumes the Laravel API and mirrors the main web functionalities for a regular user.


- **Authentication**
  - Login & register
  - Secure token storage
  - Persistent session handling
  - Logout


- **User profile**
  - Fetch authenticated user data (`/me`)
  - Update profile information


- **Notes**
  - Display notes in RecyclerView
  - Create and edit notes
  - Real-time sync with API
  - Adapter + ViewHolder pattern


- **Folders**
  - Fetch user folders
  - View notes by folder
  - Notes without folder remain visible
  - Separation between all notes and folder notes


- **Architecture**
  - Retrofit for API communication
  - Clear separation of concerns
  - `ui/notes` – Notes screens
  - `ui/user` – Auth & profile
  - `data` – API & token handling
  - `models` – Request/response models
  - `adapters` – RecyclerView logic

---


## 🧠 Technologies Used
- **Backend:**
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Sanctum](https://img.shields.io/badge/Sanctum-4F46E5?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)


- **Frontend (Web):**
![Blade](https://img.shields.io/badge/Blade-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)


- **Mobile:**
![Android](https://img.shields.io/badge/Android-Java-3DDC84?style=for-the-badge&logo=android&logoColor=white)
![Retrofit](https://img.shields.io/badge/Retrofit-48B983?style=for-the-badge)


- **API Communication:**
![REST](https://img.shields.io/badge/REST-000000?style=for-the-badge)
![JSON](https://img.shields.io/badge/JSON-000000?style=for-the-badge&logo=json&logoColor=white)


- **Authentication:**
![Token Based](https://img.shields.io/badge/Token--Based-Sanctum-4F46E5?style=for-the-badge)

## 🛣️ Project Roadmap

### 🔧 Backend (Laravel)
- [x] Base project structure
- [x] Authentication with Sanctum
- [x] User model
- [x] Folder model
- [x] Note model
- [x] Relationships (User → Folders → Notes)
- [x] Notes CRUD
- [x] Folders CRUD
- [x] Protected routes with middleware
- [x] API endpoints

### 🌐 Web Application
- [x] Notes management UI
- [x] Folder navigation
- [x] Pinned notes
- [x] Search & pagination
- [] Admin dashboard
- [] TailwindCSS styling

### 📱 Android Application
- [x] Project setup
- [x] Retrofit configuration
- [x] Authentication flow
- [x] Notes list (RecyclerView)
- [x] Folder navigation
- [x] Create & edit notes
- [x] Profile screen
- [x] Token persistence
- [x] Logout

### 🔗 Integration & Testing
- [x] Postman API tests
- [x] Web ↔ API integration
- [x] Android ↔ API integration
- [ ] Error handling improvements

### 📄 Documentation
- [ ] README final version
- [ ] API documentation

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Authors

- João Daniel - [https://github.com/jannyXDD](https://github.com/jannyXDD)
- João Filipe - [https://github.com/IAmVoid13](https://github.com/IAmVoid13)
Project Link: [https://github.com/jannyXDD/PAS](https://github.com/jannyXDD/PAS)
