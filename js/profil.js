var scroll = 0
var nb_post_profil = 4
if($(".post").length < 4){
   
    nb_post_profil = $(".post").length 
}
var post_profil_w = 19

$(window).bind('mousewheel', function(event) {

    var margin_post = parseInt($('.nft a:not(a:first-of-type)').css('marginLeft'))

    if (event.originalEvent.wheelDelta >= 0) {
        /* console.log('Scroll up') */
        if (scroll != 0){
            scroll+=post_profil_w
            $('.post').css({'transform':`translateX(${scroll}vw)`})
        }
        
    }
    else {
        /* console.log('Scroll down') */
        if (scroll != -post_profil_w*($('.post').length-nb_post_profil)){
        scroll-=post_profil_w
        $('.post').css({'transform':`translateX(${scroll}vw)`})
        }
    }
})

$('#open_settings').click(function(){
    $('.settings').css({'display':'flex'})
    $('.settings #new_description').css({'display':'none'})
    $('.settings #new_pdp').css({'display':'none'})
    $('.settings #new_mdp').css({'display':'none'})
})

$('#annuler').click(function(){
    $('.settings').css({'display':'none'})
})

$('#deconnexion').click(function(){
    $.post('../functions/deconnection.php').done(function(){
        $(window).attr('location','');
    })
})

$('#change_description').click(function(){
    $('.settings .popup').css({'display':'none'})
    $('.settings #new_description').css({'display':'flex'})
})

$('.settings #new_description').submit(function(e){
    e.preventDefault()
    var description = $(this).find('textarea[name=description]').val()
    $.post('../functions/change_description.php',{
        description:description
    }).done(function(data){
        if(data != "ERROR"){
            $("#bio").text(data);
            $(this).css({'display':'none'})
            $('.settings .popup').css({'display':'flex'})
            $('.settings').css({'display':'none'})
        }
    })
})

$('#change_pdp').click(function(){
    $('.settings .popup').css({'display':'none'})
    $('.settings #new_pdp').css({'display':'flex'})
})

$('.settings .return').click(function(){
    $(this).parent().css({'display':'none'})
    $('.settings .popup').css({'display':'flex'})
})

var image_path = ""
$('#pdp').change(function(){

    if($('#pdp').get(0).files.length > 0){
        
        let image = new FormData();
        image.append('file', $('#pdp')[0].files[0]);
        image.append('image_path',image_path);
        
        $.ajax({
            url:'../functions/traitement_image.php',
            type:'POST',
            mimeTypes:"multipart/form-data",
            data:image,    
            async: true,
            cache: false,
            processData: false,
            contentType: false,
            error:function(error){
                alert(error);
            }
        }).done(function(data){
            
            
            if(data.substring(0, 10) == "../upload/"){
                
                image_path = data;
                $(".settings #plus").hide();
                $(".settings #new_pdp div").css({
                    "background-image":`url(${image_path})`
                    
                })
            }else{
                $(".settings #plus").show();
                $(".settings #new_pdp div").css({
                    "background-image":"none"
                })
                image_path="";
            }
        });
        
    }else{
        $(".settings #plus").show();
        $(".settings #new_pdp div").css({
            "background-image":"none"
        })
        $.post("../functions/traitement_image.php",{
            image_path:image_path,
        }).done(function(){
            image_path="";
        })
    }
})

$('.settings #new_pdp').submit(function(e){
    e.preventDefault()
    
    $.post('../functions/change_pdp.php',{
        pdp:image_path
    }).done(function(data){
        if(data != "ERROR"){
            $(this).css({'display':'none'})
            $('.settings .popup').css({'display':'flex'})
            $('.settings').css({'display':'none'}) 
            $("#photodp").attr("src",data)
        }
    })
})

$('#change_mdp').click(function(){
    $('.settings .popup').css({'display':'none'})
    $('.settings #new_mdp').css({'display':'flex'})
})

$('.settings #new_mdp').submit(function(e){
    e.preventDefault()
    var old_password = $(this).find('input[name=old_password]').val()
    var new_password = $(this).find('input[name=new_password]').val()
    var confirm_new_password = $(this).find('input[name=confirm_new_password]').val()
    $.post('../functions/change_mdp.php',{
        old_password:old_password,
        new_password:new_password,
        confirm_new_password:confirm_new_password
    }).done(function(data){
        if(data != "ERROR"){
           $(window).attr("location","../index.php");
        }

    })
})


$("#open_reports").click(function(){
    $(".bouton").toggleClass('open')
})