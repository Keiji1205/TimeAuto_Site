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
        alert('На сервере ошибка')
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





