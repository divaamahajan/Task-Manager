# Task-Manager
## Introduction:
This is a task tracker web application that allows users to create tasks, edit and delete them, view all tasks, and sort them by title, status, and due date. Users can log in by entering their name and will only see their tasks. The app allows users to access their tasks from any device as the data is stored server-side.

## Features:

1. Create a task with a title, description, status (completed, in progress, etc.), and due date.
2. Edit and delete tasks.
3. View all tasks and sort by title, status, and due date.
4. Users can log in by entering their name and will only see their tasks.
5. Access tasks from any device as data is stored server-side.

## Technologies Used:

Our Task Tracker app is built using a combination of several technologies and languages, each playing a crucial role in making the app work seamlessly. Here are the details of the technologies we used and how they helped us in building the app:

1. **Django:** We used the Django web framework for building the core functionality of our Task Tracker app. Django provides a robust set of tools and features for developing web applications quickly and efficiently, including built-in authentication, database ORM, and URL routing. It allowed us to build our app logic quickly and make it more scalable.
2. **EC2 Instance:** We hosted our Django server, PHP pages, and MySQL database in the Amazon Elastic Compute Cloud (EC2) instance. EC2 provided us with a scalable computing capacity that helped us deploy and manage our app easily.
3. **Amazon RDS DB:** We used the Amazon Relational Database Service (RDS) to store our MySQL database. RDS provides a scalable and highly available database service in the cloud, which allowed us to store our data securely and access it quickly from anywhere.
4. **Python:** We used the Python programming language for the backend logic of our Task Tracker app. Python is a widely used and popular programming language that provides a vast standard library, which helped us in building the app logic quickly and efficiently.
5. **HTML, CSS, and JavaScript:** We used HTML, CSS, and JavaScript for building the frontend part of our Task Tracker app. HTML provides the structure of the web page, CSS adds styling to the HTML elements, and JavaScript adds interactivity and dynamic functionality to the app.
6. **PHP:** We used PHP for building the login and registration pages of our app. PHP is a server-side scripting language that is widely used for building dynamic web pages and applications. It allowed us to build the user authentication part of our app quickly and efficiently.

Overall, the combination of these technologies and languages helped us in building a robust and scalable Task Tracker app, with seamless functionality and user experience.

## Getting Started:
To use the task tracker app, you can directly go to the link [Task Tracker App](ec2-54-82-112-252.compute-1.amazonaws.com/login.php) to use this app from any device in your browser.

### Modifications require to run this app in local browser
- The user can clone the git repository, 
- create a .env file with SQLHOST, SQLUSER, SQLPWD, SQLDB, SQLPORT, DJANGOSECRETKEY
- remove cookies from html and php pages in [templates](https://github.com/divaamahajan/Task-Manager/tree/main/task_manager_django/task_manager_app/templates)
- in [views.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/views.py) file update return values of functions index, create_user,and forgot_password with user registration details- 
- install the required dependencies by running [shell script](https://github.com/divaamahajan/Task-Manager/blob/main/install_requirements.sh)
- run the [Django server](https://github.com/divaamahajan/Task-Manager#django-server-execution).

### Django Server execution
1. `source venv_tm/bin/activate` : Activate the virtual environment. This will activate the virtual environment and allow you to access all installed necessary packages for your Django app.
2. `python3 task_manager_django/manage.py runserver 8000` : run your Django app. This will start the Django development server and your app will be available at http://localhost:8000/. where localhost can be EC2 server if you execute this command in EC2 server

### Some important things to know about your Django app:
1. [app/models.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/models.py) is a file that contains the database models for your app. These models define the structure and behavior of the data stored in your database.
2. [app/forms.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/forms.py) is a file that contains the forms for your app. These forms allow users to input data and submit it to your app. Forms can also be used to validate user input and convert data into the correct format.
3. [app/views.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/views.py) is a file that contains the logic for handling incoming requests and generating responses. When a user makes a request to your app, the request is routed to a view function, which generates an HTTP response.
4. [prj/urls.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_prj/urls.py) is a file that defines the URL patterns for your app. These URL patterns determine how your app responds to incoming requests from a user's browser.
The app/templates folder is a directory that contains HTML templates for rendering the user interface of your app. These templates use a syntax that allows dynamic data to be inserted into the HTML, such as variables, loops, and conditional statements.
5. The database connectivity is defined in [prj/settings.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_prj/settings.py) file. You need to update the DATABASES constant with the proper ENGINE, HOST, USER, PASSWORD, NAME, and PORT to connect your app to the database.

### Example of app functioning
By following these steps, our Django app is able to route code from the user view page to the modify task page, retrieve and modify the necessary data from the database, and display the modified data to the user.
1. **User Task List Page:**

When a user logs in, all of their tasks are displayed on their user view page, which can be accessed by visiting "`user/<username>`". This page is rendered using HTML, CSS, JavaScript, and PHP and [user_view.html](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/templates/user_view.html).

2. **Modifying a Task:**
  
If a user wants to modify a task, they can click on the "Modify Task" button next to the task they want to modify. This button is created using HTML and JavaScript as `<button onclick="location.href='/modify_task/{{ username }}/{{ task.title }}'">Modify Task</button>` in  [user_view.html](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/templates/user_view.html) and a click on it, generates a link to the "`modify_task/<str:username>/<str:task_title>/`" view in this Django app.

3. **URL Routing:**

The URL pattern for the "`modify_task/<str:username>/<str:task_title>/`" view is defined in the project's [urls.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_prj/urls.py) file. When the link is clicked, the username and task title are passed as parameters in the URL as `path('modify_task/<str:username>/<str:task_title>/', views.modify_task, name='modify_task')`, which is then routed to the "`modify_task`" view function in [views.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/views.py) file.

4. **View Function:**

The "`modify_task`" view function in our app's [views.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/views.py) file is responsible for handling requests to modify a specific task. It first retrieves the user details `name = UserDetails.objects.filter(username=username).first()` and the task details ` task = UserTasks.objects.filter(username=username, title=task_title).first()` from the database using the username and task title parameters passed to the function.

5. **Forms:**

The "`TaskForm`" class in our app's [forms.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/forms.py) file is used to create a form that allows users to input the modified data for a task. This form includes fields for the task title, description, status, and due date.

6. **HTTP Methods:**

When a user submits the form with modified data, the "`POST`" method is used to send the data to the server. The view function checks for the "POST" method and, if it is detected, the modified data is saved to the database using the "`modify`" function of the "`TaskForm`" class in our app's [forms.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/forms.py) file.

7. **Templates:**

Finally, the modified task data is displayed to the user in the [modify_task.php](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/templates/modify_task.php) template, which is rendered by the "`modify_task`" view function in [views.py](https://github.com/divaamahajan/Task-Manager/blob/main/task_manager_django/task_manager_app/views.py) file. The template includes fields for the task title, description, status, and due date, as well as a submit button for the user to save the changes.

## Conclusion:
This task tracker app is a simple yet powerful tool for managing tasks. It allows users to keep track of their tasks and access them from any device. The app can be extended further by adding more features such as reminders, deadlines, and notifications.
