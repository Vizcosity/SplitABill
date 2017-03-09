$(document).ready(function(){

  // Handle login with JS.
  $('form').submit(function(event){

    event.preventDefault(); // Prevent default submission.

    var formData = $(this).serializeArray();

    var username = formData[0].value;
    var password = formData[1].value;

    // Send off details to server and await authentication.
    $.post('../modules/authenticate.php', {username: username, password: password, noRedirect: true}, function(response){

      // console.log(response);

      response = JSON.parse(response);

      if (!response.success) return incorrectDetailsHandler(response.reason);

      // Response must be successful at this point.
      // Redirect to the user's dashboard.
      window.location = "./dashboard.php?id="+response.id;

    });
  });
});


function incorrectDetailsHandler(message){
  $('p.error').text(message);

  // Shake the login box.
  $('div.login-box-wrap').effect('shake');
}
