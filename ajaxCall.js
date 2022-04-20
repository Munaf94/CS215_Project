
  document.getElementsByTagName("input");
  var x =  document.getElementsByTagName("input");
  for(i=0;i<x.length;i++)
  {
    //var ButtonElement = x[i];
    if(x[i].type != 'submit') 
    {
      continue;
    }
    else
    {
    if(x[i].name == 'likes' || x[i].name == 'dislikes') {
      x[i].addEventListener("click",send_ajax_request,false);

    
    }
  }
  }


  