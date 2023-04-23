from django import forms
from .models import users_tasks
from django.db import transaction
from datetime import date
from django.core.exceptions import ValidationError

class TaskForm(forms.ModelForm):
    title = forms.CharField(max_length=255)
    description = forms.CharField(widget=forms.Textarea)
    status_choices = [
        ('assigned', 'Assigned'),
        ('in progress', 'In Progress'),
        ('completed', 'Completed'),
    ]
    status = forms.ChoiceField(choices=status_choices)
    due_date = forms.DateField(widget=forms.TextInput(attrs={'type': 'date'}))
    

    class Meta:
        model = users_tasks
        fields = ['title', 'description', 'status', 'due_date']
        widgets = {'due_date': forms.DateInput(attrs={'type': 'date'})}

    def __init__(self, *args, **kwargs):
        super(TaskForm, self).__init__(*args, **kwargs)
        self.fields['due_date'].initial = date.today()

    def clean(self):
        cleaned_data = super().clean()
        username = cleaned_data.get('username')
        title = cleaned_data.get('title')
        if users_tasks.objects.filter(username=username, title=title).exists():
            raise ValidationError('Task with this title already exists for this user')
        
        return cleaned_data
    
    def modify(self, username, title):
        # get the form data
        description = self.instance.description
        status = self.instance.status
        due_date = self.instance.due_date
        with transaction.atomic():
            # update the task object in the database
            users_tasks.objects.filter(username=username, title=title).update(
                description=description,
                title=title,
                status=status,
                due_date=due_date
            )
        return super().save(commit=True)


    def is_valid(self):
        # check if title already exists for this user
        username = self.instance.username
        title = self.instance.title
        if users_tasks.objects.filter(username=username, title=title).exists():
            self.add_error('title', 'Task with this title already exists for this user')
            return False
        return super().is_valid()

    def save(self, username, commit=True):
        task = super(TaskForm, self).save(commit=False)
        task.username = username
        if commit:
            task.save()
        return task