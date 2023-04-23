from task_manager_app.models import users_tasks as UserTasks, user_details as UserDetails
from django.shortcuts import render, redirect
from .models import users_tasks as UserTasks, user_details as UserDetails
from .forms import TaskForm
from django.db import transaction
from django.http import HttpResponseRedirect

def index(request):
    print(f"index:  {request}")
    path = request.path_info
    print(f"path = ",path)  # '/createUser.php/'
    if not path or path == 'index.html' or path == 'index.php':
        path = 'login.php'
    return HttpResponseRedirect(f'https://ec2-54-82-112-252.compute-1.amazonaws.com{path}')

def create_user(request):
    print(f"create user  : {request}")
    return HttpResponseRedirect('https://ec2-54-82-112-252.compute-1.amazonaws.com/createUser.php')

def forgot_password(request):
    return HttpResponseRedirect('https://ec2-54-82-112-252.compute-1.amazonaws.com/forgotPassword.php')

def user_view(request, username):
    name = UserDetails.objects.filter(username=username).first()
    user_tasks = UserTasks.objects.filter(username=username)
    context = {'username': username, 'name':name, 'user_tasks': user_tasks}
    return render(request, 'user_view.html', context)

def delete_task(request, username, task_title):
    task = UserTasks.objects.filter(username=username, title=task_title).first()
    if task:
        if request.method == 'POST':
            task.delete()
            return redirect('user_view', username=username)
        return render(request, 'confirm_delete.html', {'task': task})
    return redirect('user_view', username=username)

from django.contrib import messages

def add_task(request, username):
    name = UserDetails.objects.filter(username=username).first()
    if request.method == 'POST':
        form = TaskForm(request.POST)
        if form.is_valid():
            task = form.save(username, commit=False)
            task.username = username
            # Check if a task with the same title and username exists
            if UserTasks.objects.filter(username=username, title=task.title).exists():
                messages.error(request, 'A task with this title already exists for this user.')
            else:
                task.save()
                messages.success(request, 'Task added successfully.')
                return redirect('user_view', username=username)
    else:
        form = TaskForm(initial={'username': username})
    context = {'name':name, 'form': form}
    return render(request, 'add_task.html', context)



def modify_task(request, username, task_title):
    name = UserDetails.objects.filter(username=username).first()
    task = UserTasks.objects.filter(username=username, title=task_title).first()
    if request.method == 'POST':
        form = TaskForm(request.POST, instance=task)
        with transaction.atomic():
            form.modify(username=username, title=task_title)
        return redirect('user_view', username=username)
    else:
        form = TaskForm(instance=task)
    context = {'name':name, 'form': form}
    return render(request, 'modify_task.php', context)