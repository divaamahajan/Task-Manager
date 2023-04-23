"""
URL configuration for task_manager_prj project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.urls import path
from task_manager_app import views

urlpatterns = [
    path('', views.index, name='index'),
    path('index.html/', views.index, name='index'),
    path('login.php/', views.index, name='index'),
    path('createUser.php/', views.index, name='create_user'),
    path('forgotPassword.php/', views.index, name='forgot_password'),
    path('user/<str:username>/', views.user_view, name='user_view'),
    path('delete_task/<str:username>/<str:task_title>/', views.delete_task, name='delete_task'),
    path('add_task/<str:username>/', views.add_task, name='add_task'),
    path('modify_task/<str:username>/<str:task_title>/', views.modify_task, name='modify_task'),
]

