# PHP-MySQL-Blog-CRUD
 A centralized repository for team members to submit their blog projects demonstrating their backend skills with PHP and MySql, fostering collaboration and showcasing their individual contributions.

## Title: Build a Simple Blog with PHP and MySQL

### Task: 
Implement a blog application that allows users to create, read, update, and delete blog posts. The blog should be built using PHP and MySQL, incorporating CRUD (Create, Read, Update, Delete) functionality.

### User Story 1: User Registration (User is the owner of the blog)
As a user, I want to be able to create an account on the blog platform so that I can access all the features and interact with the blog.

#### Acceptance Criteria:
- User should be able to navigate to the registration page.
- User should see input fields for username, email, and password.
- User should be able to submit the registration form.
- Upon successful registration, the user should be redirected to the login page.

### User Story 2: User Login
As a registered user, I want to be able to log in to the blog platform so that I can access my account and perform various actions.

#### Acceptance Criteria:
- User should be able to navigate to the login page.
- User should see input fields for email and password.
- User should be able to submit the login form.
- Upon successful login, the user should be redirected to the blog homepage.

### User Story 3: Create a Blog Post
As a logged-in user, I want to be able to create a new blog post, allowing me to share my thoughts and experiences with others.

#### Acceptance Criteria:
- User should see a "Create Post" button or link on the blog homepage or navigation menu.
- User should be directed to a page where they can input a title, blog image, and content for the new blog post.
- User should be able to submit the form to create the post.
- After successful submission, the user should be redirected to the newly created blog post.

### User Story 4: View Blog Posts
As a visitor or logged-in user, I want to be able to view existing blog posts so that I can read and engage with the content.

#### Acceptance Criteria:
- User should see a list of blog posts on the blog homepage.
- Each blog post should display the title, image, author, date, and a summary or excerpt of the content.
- User should be able to click on a blog post to view the full content on a separate page.

### User Story 5: Update and Delete Blog Posts
As a logged-in user, I want to be able to edit or delete my own blog posts, giving me control over the content I have published.

#### Acceptance Criteria:
- User should see an "Edit" button or link next to their own blog posts.
- User should be directed to a page where they can modify the title and content of the blog post.
- User should be able to submit the form to update the post.
- User should see a confirmation prompt before deleting a blog post.
- After successful update or deletion, the user should be redirected to the updated blog post or the blog homepage, respectively.


Note: Use any frontend technologies you want to create user view. They are two ways of connecting to database, either using PDO or MySQLI function. PDO is considered better because it has the same syntax for connecting to different databases like MySQL, PostgreSQL etc but MySQLI function is used to connect only MySQL database.
