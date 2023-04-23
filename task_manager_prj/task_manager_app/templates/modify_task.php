<html>
<head>
	<title>Modify Task for {{ form.instance.username }}</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
		}

		h1 {
			font-size: 24px;
			font-weight: bold;
			margin-bottom: 20px;
		}

		form {
			max-width: 500px;
			margin: auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background-color: #f2f2f2;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		input[readonly], select[disabled] {
			background-color: #f2f2f2;
			color: #888888;
			border: none;
		}

		input[type="text"],
		select,
		input[type="date"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
			font-family: Arial, sans-serif;
		}

		textarea {
			width: 100%;
			height: 150px;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
			font-family: Arial, sans-serif;
		}

		button[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			font-weight: bold;
			cursor: pointer;
			float: right;
		}

		button[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.cancel-button {
			background-color: #bbb;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			font-weight: bold;
			cursor: pointer;
			float: left;
		}

		.cancel-button:hover {
			background-color: #999;
		}

		.clearfix {
			clear: both;
		}
	</style>
</head>
<body>
	<script>
		// Split the cookie string into an array of individual cookies
		var cookies = document.cookie.split(';');
		var cookieExist = false;

		// Loop through the cookies and check if the name matches
		for (var i = 0; i < cookies.length; i++) {
			var cookie = cookies[i].trim();

			if (cookie.indexOf('username') == 0) {
				// The cookie exist, do something here
			        cookieExist = true;
			}
		}

		if (!cookieExist)
			window.location.replace("https://ec2-54-82-112-252.compute-1.amazonaws.com/login.php");
	</script>
     	<h1>Modify Task for {{ name }}</h1>
	<form method="POST">
		{% csrf_token %}
		<label for="{{ form.title.id_for_label }}">Title:</label>
		<input type="text" name="{{ form.title.name }}" value="{{ form.instance.title }}" readonly>
		<label for="{{ form.username.id_for_label }}">Username:</label>
		<input type="text" name="{{ form.username.name }}" value="{{ form.instance.username }}" readonly>
		<label for="{{ form.description.id_for_label }}">Description:</label>
		{{ form.description }}
		<label for="{{ form.status.id_for_label }}">Status:</label>
		{{ form.status }}
		<label for="{{ form.due_date.id_for_label }}">Due Date:</label>
		{{ form.due_date }}
		<div class="clearfix">
			<button type="submit">Save</button>
			<button type="button" class="cancel-button" onclick="location.href='/user/{{ form.instance.username }}'">Cancel</button>
		</div>
	</form>
</body>
</html>
