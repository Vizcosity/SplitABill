$(document).ready(function(){

  // Initialize the selection box.
  $('select').material_select();


  // Initialize the datepicker.
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });


  // On group select, add them all to the chip autocomplete!
  $('select').change(function(){

    var groupID = $(this).val();

    if (groupID == 'false') return $('.chips-autocomplete').material_chip({data: []});

    getUsersInGroup(groupID, function(users){

      if (!users) return;

      users = JSON.parse(users);

      // Go through the groups array, and add all of them to the autocomplete chip bar if they contains
      // the desired groupid.

      // Prepare the tag data.
      var tagArray = [];
      for (var i = 0; i < users.length; i++){
        tagArray[i] = {
          tag: users[i].name,
          image: (users[i].imageURL ? users[i].imageURL : 'https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/user-128.png'),
          id: users[i].id
        }
      }

      console.log(tagArray);

      // Fill in the tags automatically.
      $('.chips-autocomplete').material_chip({
        data: tagArray,
        placeholder: "Add Users"
      });

    });

  });

  // When constructing the chips / users that can be selected, a Post request needs to be made which grabs the
  // elements of all the aquainted users of the current user.
  var groups = getGroups();
  var tagArray = [];
  collectTagData(groups, tagArray, function(tags){

    // The tag objects have been created but need to be converted into 'autoCompleteTags';
    var autoCompleteTags = [];
    for (var i = 0; i < tags.length; i++){
      autoCompleteTags[tags[i].name] = {
        tag: tags[i].name,
        image: '',
        id: tags[i].id
      };
    }

    console.log(autoCompleteTags);

    // autoCompleteTags filled. Assign to the material chip autocomplete.
    $('.chips-autocomplete').material_chip({
      autocompleteData: autoCompleteTags
    });

  });

  // Handle form submission.
  $('form').submit(function(event){
    event.preventDefault();

    var rawData = $(this).serializeArray();

    var tagData = $('.chips-autocomplete').material_chip('data');

    var data = {};

    data['users'] = tagData;

    for (var i = 0; i < rawData.length; i++){
      data[rawData[i].name] = rawData[i].value;
    };

    console.log(rawData);

    // Once all information has been collected, send a post request.

    $.post("../modules/createBill.php", data, function(response){

      // if (response) window.location="./dashboard.php";

      console.log(response);

    });

  })

});


// Asynchronous defined function which grabs the users contained within a specific group.
function getUsersInGroup(id, callback){

    $.get("../modules/getUsersInGroup.php?groupID="+id, function(users){

    if (callback) return callback(users);

  });
}

// The values of the groups a user has is stored in the selection box on the page and this can be exploited.
function getGroups(){
  var output = [];
  var options = $('.group-select > option');

  for (var i = 0; i < options.length; i++){
    if (options[i].value == 'false') continue;
    output[i] = options[i].value;
  }

  return output;
}

// Takes in a group array and recursively collects all the users for each group and
// writes to an array of tags that is then passed into the callback.
function collectTagData(groupArray, tagArray, callback){

  var group = groupArray.shift();
  if (!group) return callback(tagArray);

  getUsersInGroup(group, function(users){

      users = JSON.parse(users);

      console.log(users);

      // Push all the users to the tagArray as tag objects.
      for (var i = 0; i < users.length; i++){
        tagArray.push(new Tag(users[i].name, (users[i].imageURL ? users[i].imageURL : ''), users[i].id));
      }

      // When completed, run collectTagData again recursively with the next group.
      collectTagData(groupArray, tagArray, callback);

  });

}

// Tag object constructor.
function Tag(name, image, id){
  this.name = name;
  this.image = image;
  this.id = id;
}
