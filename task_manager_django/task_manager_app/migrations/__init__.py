from django.db import migrations, models

class Migration(migrations.Migration):
    operations = [
        migrations.AlterField(
            model_name='user_tasks',
            name='id',
            field=models.AutoField(primary_key=True, serialize=False, auto_created=True),
        ),
    ]
