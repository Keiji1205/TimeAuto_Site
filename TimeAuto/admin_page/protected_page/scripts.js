var requests_btn = document.getElementById("requests");
var arenda_btn = document.getElementById("arenda");
var feedback_btn = document.getElementById("feedback");

var requests_div = document.getElementById("requests_div");

requests_btn.onclick = function(){
  requests_div.style.display="block";

  feedback_div.style.display="none";
  arenda_div.style.display="none";
}

var feedback_div = document.getElementById("feedback_div");

feedback.onclick = function(){
  feedback_div.style.display="block";

  requests_div.style.display="none";
  arenda_div.style.display="none";
}

var arenda_div = document.getElementById("arenda_div");

arenda.onclick = function(){
  arenda_div.style.display="block";

  requests_div.style.display="none";
  feedback_div.style.display="none";
}



var delete_requests = document.getElementById("delete_requests");

delete_requests.onclick = function(){

  const table = document.getElementById('requestTable');
  const rows = table.querySelectorAll('tr');
  let data = [];

  for (let row of rows) {
    const cells = row.querySelectorAll('td');
    const checkbox = row.querySelector('input[type="checkbox"]');

    if (checkbox && checkbox.checked) { 
      // Проверка на наличие ячеек в строке
      if (cells.length > 0) { 
        const id = cells[0].textContent ? cells[0].textContent : ''; 

        data.push(id);
      }
    }
  }
  console.log(data); 

  $.ajax({
    url: 'delete_requests.php',
    type: 'POST',
    data: { data: JSON.stringify(data) },
    success: function(response){
      if(response == 1){
        location.reload(true); 
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
      }
    },
    error: function(error){
      console.log('Ошибка на сервере:', error);
      alert('На сервере ошибка, попробуйте позже');
    }
  });
}

var delete_feedback = document.getElementById("delete_feedback");

delete_feedback.onclick = function(){

  const table = document.getElementById('feedbackTable');
  const rows = table.querySelectorAll('tr');
  let data = [];

  for (let row of rows) {
    const cells = row.querySelectorAll('td');
    const checkbox = row.querySelector('input[type="checkbox"]');

    if (checkbox && checkbox.checked) { 
      // Проверка на наличие ячеек в строке
      if (cells.length > 0) { 
        const id = cells[0].textContent ? cells[0].textContent : ''; 

        data.push(id);
      }
    }
  }
  console.log(data); 

  $.ajax({
    url: 'delete_feedback.php',
    type: 'POST',
    data: { data: JSON.stringify(data) },
    success: function(response){
      if(response == 1){
        location.reload(true); 
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
      }
    },
    error: function(error){
      console.log('Ошибка на сервере:', error);
      alert('На сервере ошибка, попробуйте позже');
    }
  });
}


var delete_arenda = document.getElementById("delete_arenda");

delete_arenda.onclick = function(){

  const table = document.getElementById('arendaTable');
  const rows = table.querySelectorAll('tr');
  let data = [];

  for (let row of rows) {
    const cells = row.querySelectorAll('td');
    const checkbox = row.querySelector('input[type="checkbox"]');

    if (checkbox && checkbox.checked) { 
      // Проверка на наличие ячеек в строке
      if (cells.length > 0) { 
        const id = cells[0].textContent ? cells[0].textContent : ''; 

        data.push(id);
      }
    }
  }
  console.log(data); 

  $.ajax({
    url: 'delete_arenda.php',
    type: 'POST',
    data: { data: JSON.stringify(data) },
    success: function(response){
      if(response == 1){
        location.reload(true); 
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
      }
    },
    error: function(error){
      console.log('Ошибка на сервере:', error);
      alert('На сервере ошибка, попробуйте позже');
    }
  });
}

