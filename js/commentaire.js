
/* window.location.href */

$("#add").submit(function(e){
    e.preventDefault();
    var comment =$(this).find("input[name=comment]").val();
    var link = window.location.href;
      /* console.log(link); 
    console.log(comment); */
    $.post("../functions/commentaire.php",{
        comment: comment,
        link:link

    },function(){
        $(".alert").remove();
    }).done(function(data){    
        $(data).insertBefore( "#add" );
    });
    $(this)[0].reset();
    	

})