

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


var send = document.getElementById("send");

$(document).on('keypress', '#name', function (event) {
    var regex = new RegExp("^[a-zA-Zа-яА-ЯЁё ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$(document).on('keypress', '#phone', function (event) {
  var regex = new RegExp("^[0-9+]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
      event.preventDefault();
      return false;
  }
});

$(document).ready(function() {
  $('#pasport_nomer').on('input', function() {
    let value = $(this).val();

    // Ограничение ввода 10 цифрами
    value = value.replace(/[^0-9]/g, ''); // Удаляем все нецифровые символы
    value = value.substring(0, 10); // Ограничиваем длину до 10 символов

    // Вставляем пробелы только один раз
    if (value.length >= 6) {
      value = value.replace(/(\d{2})(\d{2})/, '$1 $2 ');
    }

    $(this).val(value);
  });
});

$(document).ready(function() {
  $('#pasport_kod').on('input', function() {
    // Получаем значение input-поля
    let value = $(this).val();
    // Удаляем все символы, кроме цифр
    value = value.replace(/[^0-9]/g, '');
    // Добавляем дефис после третьей цифры
    value = value.replace(/(\d{3})(?=\d)/, '$1-');
    // Обновляем значение input-поля
    $(this).val(value);
  });
});


$(document).on('keypress', '#pasport_issued', function (event) {
  var regex = new RegExp("^[a-zA-Zа-яА-ЯЁё ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
      event.preventDefault();
      return false;
  }
});


var false_phone = document.getElementById("false-phone");
var false_name = document.getElementById("false-name");

send.onclick = function(){

  var phone = document.getElementsByName('phone')[0].value
  var re = /^\+?(7|8)?\s?\(?\d{3}\)?\s?\d{3}-?\s?\d{2}-?\s?\d{2}/; 
  var name = document.getElementsByName('name')[0].value

  var valid = re.test(phone);
    
        
  if (valid & name!=''){
    false_name.style.display = "none";
    false_phone.style.display = "none";
    let data = {
      'name': $('[name="name"]').val(),
      'phone': '8' + $('[name="phone"]').val().replace(/[^0-9]/g, '').slice(1) 
    }
    $.post('/api.php', data, function(response){
      if(response==1){
        modal.style.display = "none";
        modal_2.style.display = "block";
        console.log(data);
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
        modal.style.display = "none";
      }
  })
  }
  else{
    if(!valid){
      false_phone.style.display = "block";
    }
    else{
      false_phone.style.display = "none";
    }
    if(name==''){
    false_name.style.display = "block";
    }  
    else{
      false_name.style.display = "none";
    }
  }
}

// Get the modal
var modal_2 = document.getElementById("myModal-2");

// Get the <span> element that closes the modal
var span_2 = document.getElementsByClassName("close-2")[0];


// When the user clicks on <span> (x), close the modal
span_2.onclick = function() {
  modal_2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_2) {
    modal_2.style.display = "none";
  }
}



//аренда авто
var send_arenda = document.getElementById("send_arenda");
var false_phone_2 = document.getElementById("false_phone_2");
var false_name_2 = document.getElementById("false_name_2");
var pasport_nomer_text = document.getElementById("pasport_nomer_text");
var pasport_data_text = document.getElementById("pasport_data_text");
var pasport_kod_text = document.getElementById("pasport_kod_text");
var pasport_issued_text = document.getElementById("pasport_issued_text");

send_arenda.onclick = function(){

  var phone_arenda = document.getElementsByName('phone_arenda')[0].value
  var re = /^\+?(7|8)?\s?\(?\d{3}\)?\s?\d{3}-?\s?\d{2}-?\s?\d{2}/; 
  var name_arenda = document.getElementsByName('name_arenda')[0].value

  var pasport_nomer = document.getElementsByName('pasport_nomer')[0].value
  var pasport_data = document.getElementsByName('pasport_data')[0].value
  var pasport_kod = document.getElementsByName('pasport_kod')[0].value
  var pasport_issued = document.getElementsByName('pasport_issued')[0].value
 

  var valid = re.test(phone_arenda);
  
  var car = document.getElementById("car");
  var car = car.dataset.price;

  var yeat_release = document.getElementById("yeat_release");
  var yeat_release = yeat_release.dataset.price;

  var mileage = document.getElementById("mileage");
  var mileage = mileage.dataset.price;

  var equipment = document.getElementById("mileage");
  var equipment = equipment.dataset.price;

  var carPrice = document.getElementById("car-price");
  var carPrice = carPrice.dataset.price;

        
  if (
    valid && // Проверка телефона
    name_arenda !== '' && // Проверка имени
    pasport_nomer !== '' && // Проверка номера паспорта
    pasport_data !== '' && // Проверка даты выдачи паспорта
    pasport_kod !== '' && // Проверка кода подразделения
    pasport_issued !== '' // Проверка места выдачи паспорта
  ){
    false_name_2.style.display = "none";
    false_phone_2.style.display = "none";
    pasport_nomer_text.style.display = "none";
    pasport_data_text.style.display = "none";
    pasport_kod_text.style.display = "none";
    pasport_issued_text.style.display = "none";

    let date = {
      'name_arenda': $('[name="name_arenda"]').val(),
      'phone_arenda': '8' + $('[name="phone_arenda"]').val().replace(/[^0-9]/g, '').slice(1), 
      'pasport_nomer': $('[name="pasport_nomer"]').val(),
      'pasport_data': $('[name="pasport_data"]').val(),
      'pasport_kod': $('[name="pasport_kod"]').val(),
      'pasport_issued': $('[name="pasport_issued"]').val(),
      'car': document.querySelector('[id="car"]').dataset.price,
      'yeat_release': document.querySelector('[id="yeat_release"]').dataset.price, 
      'mileage': document.querySelector('[id="mileage"]').dataset.price,
      'equipment': document.querySelector('[id="equipment"]').dataset.price,
      'carPrice': document.querySelector('[id="car-price"]').dataset.price 
    }
    console.log(date);
    $.post('arenda.php', date, function(response){
      if(response==1){
        modal_2.style.display = "block";
        console.log(date);
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
        console.log('тревога');
        console.log(date);
      }
  })
  }
  else{
    if(!valid){
      false_phone_2.style.display = "block";
    }
    else{
      false_phone_2.style.display = "none";
    }
    if(name_arenda==''){
      false_name_2.style.display = "block";
    }  
    else{
      false_name_2.style.display = "none";
    }
     if(pasport_nomer==''){
      pasport_nomer_text.style.display = "block";
    }  
    else{
      pasport_nomer_text.style.display = "none";
    }
    if(pasport_data==''){
      pasport_data_text.style.display = "block";
    }  
    else{
      pasport_data_text.style.display = "none";
    }
    if(pasport_kod==''){
      pasport_kod_text.style.display = "block";
    }  
    else{
      pasport_kod_text.style.display = "none";
    }
    if(pasport_issued==''){
      pasport_issued_text.style.display = "block";
    }  
    else{
      pasport_issued_text.style.display = "none";
    }
  }
}


//Отзыв
var feedback_send = document.getElementById("feedback_send");

var false_phone_feedback = document.getElementById("false_phone_feedback");
var false_name_feedback = document.getElementById("false_name_feedback");
var feedback_input_text = document.getElementById("feedback_input_text");


feedback_send.onclick = function(){

  var phone_feedback = document.getElementsByName('phone_feedback')[0].value
  var re = /^\+?(7|8)?\s?\(?\d{3}\)?\s?\d{3}-?\s?\d{2}-?\s?\d{2}/; 
  var name_feedback = document.getElementsByName('name_feedback')[0].value

  var feedback_input = document.getElementsByName('feedback_input')[0].value
 
  var valid = re.test(phone_feedback);
  
  var car = document.getElementById("car");
  var car = car.dataset.price;

  var yeat_release = document.getElementById("yeat_release");
  var yeat_release = yeat_release.dataset.price;

  var mileage = document.getElementById("mileage");
  var mileage = mileage.dataset.price;

  var equipment = document.getElementById("mileage");
  var equipment = equipment.dataset.price;

  var carPrice = document.getElementById("car-price");
  var carPrice = carPrice.dataset.price;

  var id_auto = document.getElementById("id_auto");
  var id_auto = id_auto.dataset.price;

        
  if (
    valid && // Проверка телефона
    name_feedback !== '' && // Проверка имени
    feedback_input !== ''  // Проверка номера паспорта
  ){
    false_name_feedback.style.display = "none";
    false_phone_feedback.style.display = "none";
    feedback_input_text.style.display = "none";

    let date = {
      'name_feedback': $('[name="name_feedback"]').val(),
      'phone_feedback': '8' + $('[name="phone_feedback"]').val().replace(/[^0-9]/g, '').slice(1), 
      'feedback_input': $('[name="feedback_input"]').val(),

      'car': document.querySelector('[id="car"]').dataset.price,
      'yeat_release': document.querySelector('[id="yeat_release"]').dataset.price, 
      'mileage': document.querySelector('[id="mileage"]').dataset.price,
      'equipment': document.querySelector('[id="equipment"]').dataset.price,
      'carPrice': document.querySelector('[id="car-price"]').dataset.price,
      'id_auto': document.querySelector('[id="id_auto"]').dataset.price 
    }
    console.log(date);
    $.post('feedback.php', date, function(response){
      if(response==1){
        modal_2.style.display = "block";
        return false;
      }else{
        alert('На сервере ошибка, попробуйте позже')
      }
  })
  }
  else{
    if(!valid){
      false_phone_feedback.style.display = "block";
    }
    else{
      false_phone_feedback.style.display = "none";
    }
    if(name_feedback==''){
      false_name_feedback.style.display = "block";
    }  
    else{
      false_name_feedback.style.display = "none";
    }
     if(feedback_input==''){
      feedback_input_text.style.display = "block";
    }  
    else{
      feedback_input_text.style.display = "none";
    }
  }
}


const feedback_input = document.getElementById('feedback_input');
const countElement = document.getElementById('count');
const maxChars = 300; // Максимальное количество символов

feedback_input.addEventListener('input', function() {
  const currentChars = this.value.length;
  countElement.textContent = `${currentChars}/${maxChars}`;
});

feedback_input.addEventListener('input', function() {
  const currentChars = this.value.length;
  if (currentChars >= maxChars) {
    countElement.style.color = 'red'; // Красный цвет, если предел достигнут
  } else {
    countElement.style.color = 'black'; // Черный цвет по умолчанию
  }
  countElement.textContent = `${currentChars}/${maxChars}`;
});