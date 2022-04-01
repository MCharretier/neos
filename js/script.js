let scene, camera, renderer, starGeo, star, stars;

const sizes = {
    width: window.innerWidth,
    height: window.innerHeight
};

function init(){
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(60, sizes.width / sizes.height, 1, 1000);
    camera.position.z = 1;
    camera.rotation.x = Math.PI/2;

    renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    $('div#webgl').append(renderer.domElement);

    starGeo = new THREE.Geometry();
    for (let i=0; i<6000; i++){
        star = new THREE.Vector3(
            Math.random() * 600 - 300,
            Math.random() * 600 - 300,
            Math.random() * 600 - 300
        );
        star.velocity = 0;
        star.acceleration = 0.02;
        starGeo.vertices.push(star);
    }
    let sprite = new THREE.TextureLoader().load('img/textures/star.png');
    let starMaterial = new THREE.PointsMaterial({
        color: 0xaaaaaa,
        size: 0.7,
        map: sprite
    });
    stars = new THREE.Points(starGeo, starMaterial);
    scene.add(stars);

    animate();
}


function animate(){

    starGeo.vertices.forEach(p => {
        p.velocity += p.acceleration;
        p.y -= p.velocity;
        
        if (p.y < -200) {
        p.y = 200;
        p.velocity = 0;
        }
    });
    starGeo.verticesNeedUpdate = true; 
    stars.rotation.y += 0.002;

    renderer.render(scene, camera);
    window.requestAnimationFrame(animate);
}

init();



/**
 * Responsive
 */
$(window).resize(function(){
    onWindowResize();
});

function onWindowResize() {

    sizes.width = window.innerWidth;
    sizes.height = window.innerHeight;

    camera.aspect = sizes.width / sizes.height;
    camera.updateProjectionMatrix();

    renderer.setSize( sizes.width, sizes.height );
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
}



$('.blob').click(function(){

    $('.logoaccueil img, .blob').css({'opacity':'0'});
    var that = $(this);
    setTimeout( function(){ $('.popup#'+that.data('form')).toggleClass('active') }, 500);
});

$('.btn2').click(function(){

    var that = $(this);
    var popup_id = '#'+that.parent().parent().attr('id');
    $(popup_id).toggleClass('active');
    if (popup_id == '#login'){
        $('#register').toggleClass('active');
    }
    else if (popup_id == '#register'){
        $('#login').toggleClass('active');
    }
});

$('.close-btn').click(function(){

    $('.popup#'+$(this).parent().attr('id')).toggleClass('active'); 
    setTimeout( function(){ $('.logoaccueil img, .blob').css({'opacity':'1'}) }, 1000);
});












/*
 * AJAX
 */



$("#form_register").submit(function(e){
    e.preventDefault();

    var nom =$(this).find("input[name=fullName]").val();
    var username =$(this).find("input[name=user]").val();
    var mail =$(this).find("input[name=email]").val();
    var password =$(this).find("input[name=password]").val();
    var confirm_password =$(this).find("input[name=confirm_password]").val();
    $.post("functions/register.php",{
        nom: nom,
        username:username,
        mail: mail,
        password: password,
        confirm_password: confirm_password
    },function(){
        $(".alert").remove();
    }).done(function(data){
        if (data === 'OK'){
            $(window).attr('location','templates/accueil.php')
        }
        else {
            $('#register form').prepend(data);
        }
        
    })
    $(this)[0].reset();
})

$("#form_login").submit(function(e){
    e.preventDefault();
    var mail =$(this).find("input[name=email]").val();
    var password =$(this).find("input[name=password]").val();

    $.post("functions/login.php",{
        mail: mail,
        password: password
    },function(){
        $(".alert").remove();
    }).done(function(data){
        if (data === 'OK'){
            $(window).attr('location','templates/accueil.php')
        }
        else {
            $('#login form').prepend(data);
        }  
    })
    $(this)[0].reset();
})