$(document).ready(function(){


  $('form').submit(function(event){

    // console.log("Form sent!");

    event.preventDefault();

    var data = $(this).serializeArray();

    $.post("../modules/createUser.php", {
      name: data[0].value,
      username: data[1].value,
      password: data[2].value,
      confirm_password: data[3].value,
      email: data[4].value,
      noRedirect: true
    }, function(response){

      // console.log(response);

      response = JSON.parse(response);

      // Validate the request.
      if (!response.success) return incorrectDetailsHandler(response.reason);

      // If code execution reaches this point, registration was successful.
      window.location = "../pages/welcome.php?id="+response.id;

    });
  });
});

function incorrectDetailsHandler(message){
  $('p.error').text(message);

  // Shake the login box.
  $('div.register-box-wrap').effect('shake');
}
