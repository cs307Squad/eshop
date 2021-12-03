var editHeaderBool = false;
var editSubHeaderBool = false;
var editPassageBool = false;

document.getElementById("editableHeader").style.display = "none";
document.getElementById("editableSubHeader").style.display = "none";
document.getElementById("editablePassage").style.display = "none";

function editHeader(){
    if(editHeaderBool == true){
        saveHeader();
        editHeaderBool = false;

    }else{
        var header = document.getElementById("header");
        var hText= document.getElementById("header").innerHTML;
        var headerEdit = document.getElementById("editableHeader");
        document.getElementById("headerEdit").innerHTML = "Save";
        headerEdit.value = hText;
        header.style.display = "none";
        headerEdit.style.display = "block";   
        editHeaderBool = true; 
    }
}

function saveHeader(){
    var header = document.getElementById("header");
    var hText= document.getElementById("header").innerHTML;
    var headerEdit = document.getElementById("editableHeader");
    document.getElementById("headerEdit").innerHTML = "Edit";
    header.innerHTML = headerEdit.value;
    headerEdit.style.display = "none";
    header.style.display = "block";
}

function editSubHeader(){
    if(editSubHeaderBool == true){
        saveSubheader();
        editSubHeaderBool = false;
    }else{
        var header = document.getElementById("subheader");
        var hText= document.getElementById("subheader").innerHTML;
        var headerEdit = document.getElementById("editableSubHeader");
        document.getElementById("subEdit").innerHTML = "Save";
        headerEdit.value = hText;
        header.style.display = "none";
        headerEdit.style.display = "block"; 
        editSubHeaderBool = true;   
    }
}

function saveSubheader(){
    var header = document.getElementById("subheader");
    var hText= document.getElementById("subheader").innerHTML;
    var headerEdit = document.getElementById("editableSubHeader");
    document.getElementById("subEdit").innerHTML = "Edit";
    header.innerHTML = headerEdit.value;
    headerEdit.style.display = "none";
    header.style.display = "block";
}


function editPassage(){
    
    if(editPassageBool == true){
        savePassage();
        editPassageBool = false;
    }else{
        var header = document.getElementById("passage");
        var hText= document.getElementById("passage").innerHTML;
        var headerEdit = document.getElementById("editablePassage");
        document.getElementById("passEdit").innerHTML = "Save";
        headerEdit.value = hText;
        header.style.display = "none";
        headerEdit.style.display = "block";    
        editPassageBool = true;
    }

}

function savePassage(){

        var header = document.getElementById("passage");
        var hText= document.getElementById("passage").innerHTML;
        var headerEdit = document.getElementById("editablePassage");
        document.getElementById("passEdit").innerHTML = "Edit";
        header.innerHTML = headerEdit.value;
        headerEdit.style.display = "none";
        header.style.display = "block";   
}
