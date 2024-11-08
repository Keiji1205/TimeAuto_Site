var requests_btn = document.getElementById("requests");
var arenda_btn = document.getElementById("arenda");
var feedback_btn = document.getElementById("feedback");
var car_btn = document.getElementById("car");

var requests_div = document.getElementById("requests_div");

requests_btn.onclick = function(){
  requests_div.style.display="block";

  feedback_div.style.display="none";
  arenda_div.style.display="none";
  car_div.style.display="none";
}

var feedback_div = document.getElementById("feedback_div");

feedback_btn.onclick = function(){
  feedback_div.style.display="block";

  requests_div.style.display="none";
  arenda_div.style.display="none";
  car_div.style.display="none";
}

var arenda_div = document.getElementById("arenda_div");

arenda_btn.onclick = function(){
  arenda_div.style.display="block";

  requests_div.style.display="none";
  feedback_div.style.display="none";
  car_div.style.display="none";
}

var car_div = document.getElementById("car_div");

car_btn.onclick = function(){
  car_div.style.display="block";

  requests_div.style.display="none";
  feedback_div.style.display="none";
  arenda_div.style.display="none";
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

document.getElementById("delete_car").onclick = function() {
  const table = document.getElementById('carTable');
  const selectedRadio = table.querySelector('input[type="radio"]:checked');

  if (selectedRadio) {
      const row = selectedRadio.closest('tr'); // Получаем строку, содержащую выбранную радиокнопку
      const cells = row.querySelectorAll('td');

      // Сохраняем текущее значение для возможного восстановления
      const originalValues = Array.from(cells).map(cell => cell.textContent);

      cells.forEach((cell, index) => {
          if (index !== 0 && index !== cells.length - 1) { // Пропускаем первую и последнюю ячейку
              const textarea = document.createElement('textarea');
              textarea.value = cell.textContent; // Устанавливаем текущее значение
              textarea.style.width = '100%'; // Устанавливаем ширину
              textarea.style.height = 'auto'; // Автоматическая высота
              textarea.style.resize = 'vertical'; // Позволяем изменять высоту
              cell.innerHTML = ''; // Очищаем ячейку
              cell.appendChild(textarea); // Добавляем textarea в ячейку
          }
      });

      // Показываем кнопку "Подтвердить" и "Отмена"
      document.getElementById("confirm_edit").style.display = 'inline';
      document.getElementById("cancel_edit").style.display = 'inline';

      // Сохраняем оригинальные значения в атрибуте строки для использования при отмене
      row.setAttribute('data-original-values', JSON.stringify(originalValues));
  } else {
      alert('Пожалуйста, выберите автомобиль для редактирования.');
  }
}

// Обработчик для кнопки "Отмена"
document.getElementById("cancel_edit").onclick = function() {
  const table = document.getElementById('carTable');
  const selectedRadio = table.querySelector('input[type="radio"]:checked');

  if (selectedRadio) {
      const row = selectedRadio.closest('tr');
      const originalValues = JSON.parse(row.getAttribute('data-original-values'));

      const cells = row.querySelectorAll('td');
      cells.forEach((cell, index) => {
          if (index !== 0 && index !== cells.length - 1) { // Пропускаем первую и последнюю ячейку
              cell.innerHTML = originalValues[index]; // Восстанавливаем оригинальное значение
          }
      });

      // Скрываем кнопки "Подтвердить" и "Отмена"
      document.getElementById("confirm_edit").style.display = 'none';
      document.getElementById("cancel_edit").style.display = 'none';
  }
}

// Определяем соответствие колонок
const columnMapping = [
  'model',
  'car_brand',
  'type_body',
  'horsepower',
  'racing',
  'maximum_speed',
  'year_release',
  'mileage',
  'equipment',
  'price',
  'description',
  'salon',
  'difference',
  'body_description'
];

// Обработчик для кнопки "Подтвердить"
document.getElementById("confirm_edit").onclick = function() {
  const table = document.getElementById('carTable');
  const rows = table.querySelectorAll('tr');
  let data = [];

  for (let row of rows) {
      const radio = row.querySelector('input[type="radio"]:checked');
      
      if (radio) {
          const id = row.cells[0].textContent; // Получаем ID из первой ячейки
          const textareas = row.querySelectorAll('textarea'); // Получаем все textarea в строке
          
          let updatedRowData = { id: id }; // Объект для хранения обновленных данных
          
          textareas.forEach((textarea, index) => {
              if (columnMapping[index]) {
                  updatedRowData[columnMapping[index]] = textarea.value; // Сохраняем значения textarea с нормальными названиями колонок
              }
          });

          data.push(updatedRowData); // Добавляем объект в массив данных
      }
  }

  console.log(data);

  $.ajax({
      url: 'update_car.php',
      type: 'POST',
      data: { data: JSON.stringify(data) },
      success: function(response) {
          if (response == 1) {
              location.reload(true); 
          } else {
              alert('На сервере ошибка, попробуйте позже');
          }
      },
      error: function(error) {
          console.log('Ошибка на сервере:', error);
          alert('На сервере ошибка, попробуйте позже');
      }
  });
}