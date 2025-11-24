🚀 Simple Laravel CRUD Blog

A basic web application built with the Laravel framework to demonstrate core CRUD (Create, Read, Update, Delete) operations and user authentication. This project serves as a foundational learning exercise in coupling controller logic, Eloquent ORM, and Blade templating.

✨ Features

This application implements the following core functionalities:

Authentication & User Management

    Registration: New users can create an account with a unique name and email, and a securely hashed password.

    Login/Logout: Users can log in and out, establishing a secure, session-based context.

    Session Security: Implements CSRF protection and Session Fixation prevention during login.

Post Management (CRUD)

    Create: Logged-in users can create new posts (title and body).

    Read: Users can view a list of all posts they have created.

    Update: Only the post owner can access the edit screen and update the post content.

    Delete: Only the post owner can delete their posts.

    Security: All user input is sanitized using strip_tags() to prevent Cross-Site Scripting (XSS) attacks.

💻 Tech Stack

    Backend Framework: PHP 8.x, Laravel 10/11

    Database: MySQL (or any database supported by Eloquent)

    ORM: Eloquent (Used for all database interactions and relationships)

    Templating: Blade (Used for all views)

🛠️ Installation and Setup

Follow these steps to get a local copy of the project running.

Prerequisites

    PHP (8.1+)

    Composer

    A database server (MySQL recommended)


Models & Relationships

    User Model: Extends Authenticatable. Defines the One-to-Many relationship to Post via userCoolPosts().

    Post Model: Defines the Many-to-One relationship to User via user().


✍🏻Author
Himanshu Singh