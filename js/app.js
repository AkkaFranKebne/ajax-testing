$(document).ready(function(){
    
    //load website delay
    
        $('section').hide();
        $('header').hide();

        $(window).on("load", function() {
		setTimeout(function() {
			  $('body').removeClass('loading');
              $('header').fadeIn("slow");	$('section').fadeIn("slow");			  
		}, 8000);
	});
    
    
       //login
    
    var loginForm = $('.message');
    loginForm.hide();
    
    
    var login = $('.login');
    
    login.on('click', function(){
        loginForm.fadeToggle();
        
        
    });
    
    function isLogged(){
        if ($(".welcome").find('a').attr('href') === 'index.php?wyloguj=tak') {
            console.log("zalogowany");
            login.text("Logged in");
        }
        else {
            login.text("Login");
            $('.greetings').addClass('floatingLogin');
        }
    }
    
    isLogged();
    

    
    
    
    
    

    
   // api key:  api_key=3Dwb5JkMsUjIueylI7NzLIGOas2Pn30LCSRsDPOl 
    
    //example url: https://api.nasa.gov/planetary/apod?api_key=3Dwb5JkMsUjIueylI7NzLIGOas2Pn30LCSRsDPOl
    
    //astronomy picture of the day GET https://api.nasa.gov/planetary/apod?api_key=3Dwb5JkMsUjIueylI7NzLIGOas2Pn30LCSRsDPOl
    
    //mars photos  https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?sol=1000&api_key=DEMO_KEY
    
    //introduction
    var introductionUrl = 'https://api.nasa.gov/planetary/apod?api_key=3Dwb5JkMsUjIueylI7NzLIGOas2Pn30LCSRsDPOl';
    
    
    
    //load data
    
    function loadDataIntroduction(){
        $.ajax({
            url: introductionUrl
        }).done(function(response){
            renderDataIntroduction(response);
        }).fail(function(error){
            console.log(error);
        })
    }
    
    loadDataIntroduction();
    
    //render data
    function renderDataIntroduction(response){
        //console.log(response.url);
        //console.log($('#introduction'));
        $('#introduction').css('background-image', 'url('+response.url+')');
    }
    
    //gallery
    
    var galleryUrl = 'https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?sol=1000&api_key=3Dwb5JkMsUjIueylI7NzLIGOas2Pn30LCSRsDPOl';
    
    //load data
    
       function loadDataGallery(){
        $.ajax({
            url: galleryUrl
        }).done(function(response){
            renderExtraPhoto(response.photos);
        }).fail(function(error){
            console.log(error);
        })
    }
    
    loadDataGallery();
    
    
    //renderData - po kawalku
    
    var numberOfGeneratedPictures = 0;
    
    
    function renderExtraPhoto(response){
        $.each(response, function(index, value){
            if (index >= numberOfGeneratedPictures) {
                $('img').eq(index).attr('src', value.img_src);
            }
        });
    }
    
    
    
    //extra images
    
    var button = $('button');
    

    button.on('click', function(){

        console.log(numberOfGeneratedPictures);
        $('.invisible').removeClass('invisible');
        
        var extraImg = $('<picture><img  class="invisible" src="#" alt="Mars" height="300px" width="400px"></picture>');
        extraImg.appendTo($('.container')).clone().appendTo($('.container')).clone().appendTo($('.container')).clone().appendTo($('.container')).clone().appendTo($('.container')).clone().appendTo($('.container'));
        
        loadDataGallery();
        numberOfGeneratedPictures += 6;  //krok w ladowaniu danych
        
    });
    
 
    
    
});