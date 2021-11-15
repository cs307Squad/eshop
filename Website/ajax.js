function getData(){


  var fd = new FormData();


  var title = document.getElementsByName('title')[0].value;


  var content = document.getElementsByName('option1')[0].value;

  var content2 = document.getElementsByName('option2')[0].value;

  var content3 = document.getElementsByName('option3')[0].value;

  var id = document.getElementsByName('id')[0].value;


  fd.append('title',title);


  fd.append('option1',content);
  fd.append('option2', content2);
  fd.append('option3', content3);
  fd.append('id',id);


  return fd;


}



function savePost(){


  try{


    var xhttp = new XMLHttpRequest();


  }


  catch(e){


    console.log(e);


  }


  var data = getData();


  xhttp.open('POST','autosave.php?save=true');


  xhttp.send(data);


  xhttp.onreadystatechange = function(){


    if(this.status == 200 && this.readyState == 4){


      if(data.get('id') == ""){


        document.getElementsByName('id')[0].value = this.responseText;


      }


      else{


        document.getElementById('message').innerHTML = this.responseText;


      }


      console.log(this.responseText);


    }


  }


}



setInterval(savePost,10000); //savePost will be called in every 10 seconds



JavaScript

Copy
