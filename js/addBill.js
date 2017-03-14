$(document).ready(function(){

  // Initialize the selection box.
  $('select').material_select();


  // When constructing the chips / users that can be selected, a Post request needs to be made which grabs the
  // elements of the users that can be added from the group.

    // Grab the ID of the user via a hidden input field.
    var userID = $('input[name="userID"]').val();

    // Make post request to the server requesting the details of the users within a group that can be added, then
    // constantly prefetch users that could be added when typing dynamically.
    getUsersInGroup(userID, function(users){


      users = JSON.parse(users);

      console.log(users);


      // Fill in the tag array.
      var tagArray = [];
      for (var i = 0; i < users.length; i++){
        console.log("Adding: " + users[i].name+" ["+users[i].username+"]");
        tagArray[i] = {
          tag: users[i].name+" ["+users[i].username+"]",
          image: 'https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/user-128.png',
          id: users[i].id
        }
      }

      // Prepare the data object which holds all the users from the group.

      // Users is the array of users that are contained within the group ID specified.
        // $('.chips').material_chip();
        //
        // $('.chips-initial').material_chip({
        //   data: tagArray,
        // });
        //
        // $('.chips-placeholder').material_chip({
        //   placeholder: 'Enter a tag',
        //   secondaryPlaceholder: '+Tag',
        // });

        var autoCompleteTagData = {};
        for (var i = 0; i < tagArray.length; i++){

          autoCompleteTagData[tagArray[i].tag] = {
            // Create a 'chip' object for every autocomplete suggestion.
            tag: tagArray[i].tag,
            image: 'https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/user-128.png',
            id: users[i].id
          }

          autoCompleteTagData[tagArray[i].tag] = 'https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/user-128.png';

        }

        console.log(autoCompleteTagData);

        $('.chips-autocomplete').material_chip({
          
          data: tagArray,
          autocompleteData: autoCompleteTagData

        });

    });

});


// Asynchronous defined function which grabs the users contained within a specific group.
function getUsersInGroup(id, callback){

    $.get("../modules/getUsersInGroup.php?groupID="+id, function(users){

    if (callback) return callback(users);

  });
}
