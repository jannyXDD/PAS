
# Notes100
## Introduction

This project is a web-based notes management application developed using the Laravel framework.
Its main goal is to demonstrate the implementation of a CRUD system (Create, Read, Update, Delete), user authentication, and role-based access control in a structured and maintainable way.

The application allows authenticated users to manage their own notes, while administrators have access to additional management features.

## 🚀 Features


This project consists of a **Laravel Web Application**, a **REST API**, and an **Android Mobile Application**, all working together around a notes management system with authentication and role separation.


---


## 🌐 Web Application (Laravel)


### Authentication & Authorization
- User authentication (login & logout)
- Token-based authentication using Laravel Sanctum
- Role-based access control (Admin / Regular User)


### Notes Management
- Create notes
- Edit notes
- Delete notes
- View note details
- Notes are associated with authenticated users
- Support for pinned notes (displayed at the top)


### Admin Panel
- Admin-only access
- View all users
- View all notes from all users
- Delete notes created by any user
- Manage users (list & details)


### User Experience
- Responsive UI built with **Blade + Tailwind CSS**
- Clean dashboard layout
- Pagination for notes and users
- Search functionality (users / notes)
- Inline edit forms where applicable


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


## 📱 Android Application


The Android app consumes the Laravel API and mirrors the main web functionalities for a normal user on mobile.


### Authentication
- User **Login**
- User **Register**
- Secure token storage using a TokenManager
- Persistent session handling
- Logout functionality


### User Profile
- Fetch authenticated user data (`/me`)
- Update user profile information


### Notes
- Fetch and display notes in a RecyclerView
- Create new notes
- Edit existing notes
- Notes synced in real time with the API
- Adapter + ViewHolder pattern for efficient UI rendering


### Architecture & Structure
- Retrofit for API communication
- Clear separation of concerns:
- `ui/notes` – Notes screens
- `ui/user` – Authentication & profile
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


This roadmap describes the main development phases of the project, from initial setup to the final mobile integration, which we had to re-do.


---


### Phase 1 – Project Foundation
- Laravel project initialization
- Default authentication scaffolding setup
- Environment configuration (.env, database, migrations)
- Base project structure definition


---


### Phase 2 – Database & Models
- User model configuration
- Notes model creation
- Database migrations for notes
- Relationship setup between users and notes


---


### Phase 3 – Web Application Development
- Notes CRUD implementation (create, read, update, delete)
- User-based note ownership
- Notes listing and detail views
- Pinned notes functionality
- Pagination and search
- Admin dashboard creation
- Admin access control (role-based)


---


### Phase 4 – REST API Development
- API routes definition
- Authentication with Laravel Sanctum
- User registration endpoint
- User login endpoint
- Logout endpoint
- Protected routes using `auth:sanctum`
- Notes CRUD via API
- `/me` endpoint for authenticated user data


---


### Phase 5 – Android Application Development
- Android studio project setup
- Retrofit configuration
- API service definition
- Notes list (RecyclerView + Adapter)
- Create Note functionality
- Edit Note functionality
- Login and Register screens
- Token storage and session handling
- Profile screen with user data update
- Logout handling


---


### Phase 6 – Integration & Testing
- Web - API integration testing
- Android - API integration testing
- Postman testing for all endpoints
- Authentication flow validation
- Error handling improvements


---


### Phase 7 – UI & UX Improvements
- Web UI refinement with Tailwind CSS
- Mobile UI adjustments and layout consistency
- Usability improvements across platforms


---


### Phase 8 – Documentation & Delivery
- README documentation
- Feature listing
- Roadmap documentation
- Final project review and cleanup

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Authors

- João Daniel - [https://github.com/jannyXDD](https://github.com/jannyXDD)
- João Filipe - [https://github.com/IAmVoid13](https://github.com/IAmVoid13)
- Project Link: [https://github.com/jannyXDD/PAS](https://github.com/jannyXDD/PAS)
