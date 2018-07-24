

function displayUser(id, isFriend){
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    //clear member list
    var memberList = document.getElementById('member-list');
    memberList.innerHTML = "";
    
    userName.innerHTML = "<h1>"+usersNames[id]+"</h1>";
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + usersImages[id] + " alt=\"\"></p>";
    
    if(isFriend)
        userAdd.innerHTML = 
            "<form action=\""+ routeDeleteFriend.split('@split')[0] + usersIds[id] + "\" method=\"delete\">"+
                "<div class=\"col-xs-12 col-md-offset-3 col-md-6\" style=\"margin-top: 5px;\">"+
                    "<button class=\"btn btn-deletefriend btn-block\">Delete from Friend List</button>"+
                "</div>"+
            "</form>";
    else
        userAdd.innerHTML = 
            "<div class=\"col-xs-12 col-md-offset-3 col-md-6\" style=\"margin-top: 5px;\">"+
                "<a href=\""+ routeAddFriend.split('@split')[0] + usersIds[id] + "\" class=\"btn btn-block\"\" id=\"adf\">Add To Friend</a>"+
            "</div>";
}

function displayGroup(id, userNames){
    var limit = 4; //limit to display user name
    
    var userName = document.getElementById('user-name');
    var userImage = document.getElementById('user-image');
    var memberList = document.getElementById('member-list');
    var userAdd = document.getElementById('user-add');
    var userAddButton = document.getElementById('user-add-button');
    var userAddButtonMsg = document.getElementById('user-add-button-msg');
    
    //*-- creating DOM -*// 
    userName.innerHTML = 
        "<h1><a href=\""+routeShowGroup.split('@split')[0] + groupsIds[id]+"\">"+
            groupsNames[id]+
        "</a></h1>";
    
    userImage.innerHTML = "<p class=\"text-center\"><img style=\"width:250px;\" src=" + groupsImages[id] + " alt=\"\"></p>";
    
    var userNamesFormatted = JSON.parse(userNames);
    memberList.innerHTML = "";
    for(var i=0; i<userNamesFormatted.length; i++){
        memberList.innerHTML += '<span class=\"label label-name\">' + userNamesFormatted[i] + '</span> ';
        
        if( (i == limit-1) && (i+1 < userNamesFormatted.length) ){ //limit display
            memberList.innerHTML += 
                '<a href=\"'+routeShowGroup.split('@split')[0] + groupsIds[id]+'\">'+
                    '<span class=\"label label-warning\">+'+(userNamesFormatted.length-(i+1))+'</span>'+
                '</a>';
            break;
        }
    }
    memberList.innerHTML = "<div class=\"text-center\">" + memberList.innerHTML + "</div>";
    
    userAdd.innerHTML =
        "<div class=\"col-xs-12 col-md-offset-3 col-md-6\" style=\"margin-top: 10px;\">" +
            "<div class=\"col-xs-12 col-md-6 pt-05\">"+
                "<a href=\""+ routeEditGroup.split('@split')[0] + groupsIds[id] + routeEditGroup.split('@split')[1] + "\" class=\"btn btn-edit btn-block\">Edit</a>" +
            "</div>"+
            "<div class=\"col-xs-12 col-md-6 pt-05\">"+
                "<a href=\""+ routeScheduleWithGroup + "?groupId="+groupsIds[id]+"\" class=\"btn btn-edit btn-block\">Schedule</a>" +
            "</div>"+
        "</div>";
    
    console.log("hey: "+userAdd.innerHTML);
}