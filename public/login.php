

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../src/login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .alert {
		display: none;
		justify-content: center;
		align-items: center;
    text-align: center;
		background-color:rgb(204, 45, 45);;
    color: white;
		font-weight: 700;
		margin-top: 20px;
    height: 40px;
		border-radius: 5px;
		font-size: 17px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="login_check.php" method="post" id="loginForm">
      <h1>Login</h1>
	 
        <p class="alert"></p>
      
      <div class="input-box">
        <input name="username" type="text" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
    <input id="pass" name="password" type="password" placeholder="Password" required>
    <i id="show" style="font-size: 23px;" class='bx bx-show'></i>
    <i id="hide" class='bx bx-hide' style="display:none; font-size: 23px;"></i>
      </div>
    <input type="submit" value="Submit" class="btn">
  </form>
</div>



<script>
    var show = document.getElementById('show');
    var hide = document.getElementById('hide'); 

    show.addEventListener('click', e => { 
        let pass = document.getElementById('pass');
        pass.type = 'text';
        show.style.display = 'none';
        hide.style.display = ''; 
        e.stopPropagation();
    })

    hide.addEventListener('click', e => { 
        let pass = document.getElementById('pass');
        pass.type = 'password';
        hide.style.display = 'none';
        show.style.display = '';
        e.stopPropagation();
    })

    const loginForm = document.querySelector('#loginForm');
    loginForm.addEventListener('submit', function(event) {
    event.preventDefault(); 

    let formData = new FormData(loginForm);
    let alertMessage = document.querySelector('.alert');

 
    fetch('login_check.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        
        if (data.status === 'blocked') {
            alertMessage.style.display = 'flex';
            alertMessage.innerHTML = 'Your account is blocked. <br>Please contact the administrator.';
        } else if (data.status === 'success') {
            window.location.href = 'dashboard.php';
        } else if (data.status === 'incorrect_password') {
            alertMessage.style.display = 'flex';
            alertMessage.innerHTML = 'Incorrect username or password.';
        } else if (data.status === 'user_not_found') {
            alertMessage.style.display = 'flex';
            alertMessage.innerHTML = 'User not found.';
        } else {
            alertMessage.style.display = 'flex';
            alertMessage.innerHTML = 'An error occurred. Please try again later.';
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      
    });
});

</script>
</body>
</html>