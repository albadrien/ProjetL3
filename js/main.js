function tabs(item) {

    
    var b = document.getElementsByClassName("profile");
    for (i=0; i<b.length; i++){
      b[i].style.display='none';
    }
    document.getElementById(item).style.display = 'block';
    
    var a =document.getElementsByClassName("catégorie")
    for (i=0; i<a.length; i++){
        a[i].classList.remove('active');
    }
    document.getElementById("catégorie"+item).classList.add('active');


}

