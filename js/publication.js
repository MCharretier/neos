var image_path = "";

$('#file').change(function(){

        if($('#file').get(0).files.length > 0){
            
            let image = new FormData();
            image.append('file', $('#file')[0].files[0]);
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
                success:function(){
                    $(".alert").remove();

                },
                error:function(error){
                    alert(error);
                }
            }).done(function(data){
                
                
                if(data.substring(0, 10) == "../upload/"){
                    
                    image_path = data;
                    $(".import p, .import img, .import .fake").hide();
                    $(".import").css({
                        "background-image":`url(${image_path})`
                        
                    })
                }else{
                    $('form.cadre').append(data);
                    $(".import p, .import img, .import .fake").show();
                    $(".import").css({
                        "background-image":"none"
                    })
                    image_path="";
                }
            });
            
        }else{
            $(".import p, .import img, .import .fake").show();
            $(".import").css({
                "background-image":"none"
            })
            $.post("../functions/traitement_image.php",{
                image_path:image_path,
                success:function(success){
                    $(".alert").remove();
                }
            }).done(function(){
                image_path="";
            })
        }
    
    
});
$("#publication").submit(function(e){
    e.preventDefault();

    var title =$(this).find("input[name=name]").val();
    var hashtag =$(this).find("input[name=hashtag]").val();
    var description =$(this).find("input[name=description]").val();
    
    $.post("../functions/publication.php",{
        title: title,
        hashtag: hashtag,
        description:description,
        file: image_path,
    },function(){
        $(".alert").remove();
    }).done(function(data){
        if (data === 'OK'){
            $(window).attr('location','../templates/profil.php');
        }
        else {
            $('form.cadre').append(data);
        }
        
        
    })
    $(this)[0].reset();
})