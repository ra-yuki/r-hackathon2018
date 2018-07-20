var pollNum = 0;
var linkNum = new Array();
var pollDivId = "poll-";

function displayPolls(addVal){
    // exception handling
    if( (pollNum + addVal) < 0){
        pollNum = 0;
        return false;
    }
    
    pollNum += addVal;
    
    var ins = document.getElementById('inputs-poll');
    // create DOM
    var content = "<div class=\"col-xs-12\">";
    for(var i=0; i<pollNum; i++){
        content += 
            "<label>Poll title</label>" + 
            "<a href=\"#\" onclick=\"displayLinks(1, "
            +i+
            ")\" class=\"btn btn-success\">+</a> | <a href=\"#\" onclick=\"displayLinks(-1, "
            +i+
            ")\" class=\"btn btn-danger\">-</a>" + 
            "<div id=\""+pollDivId+i+"\"></div>" +
            "<br>"
        ;
    }
    content += "</div>";
    
    console.log("pollNum: "+pollNum);
    
    // render
    ins.innerHTML = content;
}

function displayLinks(addVal, pollId){
    // set val to var if not set
    if(isNaN(linkNum[pollId])) linkNum[pollId] = 0;
    
    // exception handling
    if( (linkNum[pollId] + addVal) < 0 ){ 
        linkNum[pollId] = 0; 
        return false;
    }
    
    linkNum[pollId] += addVal;
    
    var ins = document.getElementById(pollDivId+pollId);
    // create DOM
    var content = "<div class=\"form-group\">";
    for(var i=0; i<linkNum[pollId]; i++){
        content += 
            "<label>Link title</label>" + 
            "<br>"
        ;
    }
    content += "</div>";
    
    // render
    ins.innerHTML = content;
    
    console.log(linkNum);
}