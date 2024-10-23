var btn = document.getElementById('send_password');
var username = document.getElementById('username');
var password = document.getElementById('password');

btn.onclick = function() {

  // Basic Input Validation
  if (username.value.trim() === '' || password.value.trim() === '') {
    alert('Please enter both username and password.');
    return;
  }

  // Create data object to send to the server
  let data = {
    'username': username.value,
    'password': password.value
  };

  console.log(data);
  

  // Send AJAX request
  $.post('password.php', data, function(response) {
    console.log(response); 

    // Parse response (assuming JSON format)
    response = JSON.parse(response);

    if (response.success) {
      // Redirect on successful login
      window.location.href = 'protected_page/index.php';
    } else {
      alert(response.message);
    }
  });
};