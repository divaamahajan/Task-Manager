from django.db import models

# Create your models here.

class users_tasks(models.Model):
    username = models.CharField(max_length=255)
    title = models.CharField(max_length=255)
    description = models.TextField()
    status = models.CharField(max_length=20)
    due_date = models.DateField()

    class Meta:
        db_table = 'users_tasks'
        app_label = 'task_manager_app'

    def __str__(self):
        return self.title
    

class user_details(models.Model):
    username = models.CharField(max_length=255)
    full_name = models.CharField(max_length=255)
    class Meta:
        db_table = 'user_details'
        app_label = 'task_manager_app'

    def __str__(self):
        return self.full_name

