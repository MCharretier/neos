console.log("ok")
$("#recherche").keyup(function(e){
    e.preventDefault();
    var recherche = $(this).val();
    $.post("../functions/traitement_recherche.php",{
        recherche: recherche
    },function(){
        $(".alert").remove();
    }).done(function(data){ 
        $(".result").remove()
        if(data!="ERROR"){
            
            data = data.split("@&#")
            for(var i=0; i<data.length;i++){
                var user=data[i].split("#&@")
                $(".liste").append('<a class="result" href="../templates/profil.php?id='+user[2]+'"><img src="'+user[1]+'" alt="Photo de '+user[0]+'">'+user[0]+'</a>')
            }
        }
    });
});

