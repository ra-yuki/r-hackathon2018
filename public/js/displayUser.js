function displayUser(id, isFriend){
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    userName.innerHTML = usersNames[id];
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + usersImages[id] + " alt=\"\"></p>";
    
    if(isFriend)
        userAdd.innerHTML = 
            "<form action=\""+ routeDeleteFriend.split('@split')[0] + usersIds[id] + "\" method=\"delete\">"+
                "<button class=\"btn btn-danger\">Delete From Friend</button>"+
            "</form>";
    else
        userAdd.innerHTML = "<a href=\""+ routeAddFriend.split('@split')[0] + usersIds[id] + "\" class=\"btn btn-default\">Add To Friend</a>";
}

function displayGroup(id, userNames){
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    userName.innerHTML = groupsNames[id];
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + groupsImages[id] + " alt=\"\"></p>";
    
    var userNamesFormatted = JSON.parse(userNames);
    userAdd.innerHTML = "";
    for(var i=0; i<userNamesFormatted.length; i++){
        userAdd.innerHTML += '<span class=\"badge\">' + userNamesFormatted[i] + '</span> ';
    }
    userAdd.innerHTML = "<div class=\"text-center\">" + userAdd.innerHTML + "</div>";
    
    console.log(userAdd.innerHTML);
}