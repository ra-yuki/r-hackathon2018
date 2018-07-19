function displayUser(id){
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    userName.innerHTML = usersNames[id];
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + usersImages[id] + " alt=\"\"></p>";
    userAdd.innerHTML = usersIds[id];
}

function displayGroup(id){
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    userName.innerHTML = groupsNames[id];
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + groupsImages[id] + " alt=\"\"></p>";
    userAdd.innerHTML = groupsIds[id];
}