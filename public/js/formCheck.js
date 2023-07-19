
function checkForm(event, entity_type, button){  // Creo una funzinoe per eseguire controlli sui campi delle form

  // Passo:
  // - entity_type: per distinguere tra ATTRACTION, RESTAURANT, HOUSING
  // - button: per distinguere tra Submit( per fare l'add) o Save( per fare l'edit) 

  event.preventDefault();   //Prevengo la funzione di default del bottone di submit

  error= false;

  

/** 
  *  Controllo che il NOME NON SIA VUOTO
  */ 

  entity_name= $("#name");
  name_msg=$("#invalid-name");
  var name_box = document.getElementById("name");

  if (entity_name.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    name_msg.html("Please, insert a name"); // Riempio con il testo lo span con id invalid-title
   
    name_box.style.borderWidth= "2px";
    name_box.style.borderColor="red";
    error = true;

  } else {
      name_msg.html("");
  }


/**
 *  Controllo se i campo CATEGORY SIA selezionata
 */
  
  category_msg = $("#invalid-category");
  
  var category_box = document.getElementById("category");
  
  category_selection= $("#category").find(":selected").text();
  
  if ( category_selection == "Category") {        //Punto al select con attributo multiple
    
      category_msg.html("Please, select a category");

      category_box.style.borderWidth= "2px";
      category_box.style.borderColor="red";
      error = true;
  } else {
      category_msg.html("");
  }

  /**
 *  Controllo se i campo PRICE sia selezionato
 */
  
  price_msg = $("#invalid-price");
  var price_box = document.getElementById("price");
  
  price_selection= $("#price").find(":selected").text();
  
  if ( price_selection == "Price") {        //Punto al select con attributo multiple
    
      price_msg.html("Please, select a price range");
      price_box.style.borderWidth= "2px";
      price_box.style.borderColor="red";

      error = true;
  } else {
      price_msg.html("");
  }


  
/** 
  *  Controllo che il DESCRIPTION non sia vuoto
  */ 

description= $("#description");
description_msg=$("#invalid-description");

var description_box = document.getElementById("description");

if (description.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    description_msg.html("Please, insert a description"); // Riempio con il testo lo span con id invalid-title
    description_box.style.borderWidth= "2px";
    description_box.style.borderColor="red";

    error = true;

  } else {
    description_msg.html("");
  }


  /** 
  *  Controllo che il campo STARS sia pieno e nel formato corretto
  */ 

stars= $("#stars");
stars_msg=$("#invalid-stars");
stars_value= stars.val().trim();

var stars_box = document.getElementById("stars");
if (stars_value ==="" || ![0,1,2,3,4,5].includes(parseInt(stars_value))) {   // Se il titolo privato degli spazi è la stringa vuota  

    if (stars_value === "") {
        stars_msg.html("Please, insert the stars"); // Riempio con il testo lo span con id invalid-title
    
    } else {
        stars_msg.html("Please, insert a whole number of stars between 0 and 5"); // Riempio con il testo lo span con id invalid-title
    
    }
    stars_box.style.borderWidth= "2px";
    stars_box.style.borderColor="red";

    error = true;

    
  }else {
    stars_msg.html("");
  }

    /** 
  *  Controllo che il campo STREET and NUMBER sia pieno 
  */ 

street= $("#street_and_number");
street_msg=$("#invalid-street_and_number");

var street_box = document.getElementById("street_and_number");

if (street.val().trim() ==="") {   // Se il titolo privato degli spazi è la stringa vuota  

    street_msg.html("Please, insert the street and the number"); // Riempio con il testo lo span con id invalid-title
    
    street_box.style.borderWidth= "2px";
    street_box.style.borderColor="red";

    error = true;

    
  }else {
    street_msg.html("");
  }

/** 
  *  Controllo che il campo CITY sia pieno 
  */ 

city= $("#city");
city_msg=$("#invalid-city");

var city_box = document.getElementById("city");

if (city.val().trim() ==="") {   // Se il titolo privato degli spazi è la stringa vuota  

    city_msg.html("Please, insert the city"); // Riempio con il testo lo span con id invalid-title
    
    city_box.style.borderWidth= "2px";
    city_box.style.borderColor="red";

    error = true;

    
  }else {
    city_msg.html("");
  }


/** 
  *  Controllo che il campo PROVINCE sia pieno 
  */ 

province= $("#province");
province_msg=$("#invalid-province");

var province_box = document.getElementById("province");

if (province.val().trim() ==="") {   // Se il titolo privato degli spazi è la stringa vuota  

    province_msg.html("Please, insert the province"); // Riempio con il testo lo span con id invalid-title
    
    province_box.style.borderWidth= "2px";
    province_box.style.borderColor="red";

    error = true;

    
  }else {
    province_msg.html("");
  }

  
  imageChanged=true;
  image=$('#image')[0].files[0];  // Controllo se l'immagine è cambiata per editare

  if(!image){

      imageChanged=false;
  }

  console.log(imageChanged)

  

    // AJAX

    if (!error) {

      if(button == 'Submit'){   // CREO UN ELEMENTO
        
            path='';
            form_name='';

          if(entity_type == 'ATTRACTION'){

            path='/ajaxFormCheckAttraction';  
            form_name='attraction';

          }else if(entity_type == 'HOUSING'){

            path='/ajaxFormCheckHousing';
            form_name='housing';

          }else if(entity_type == 'RESTAURANT'){

            path='/ajaxFormCheckRestaurant';
            form_name='restaurant';

          }

              $.ajax(path, {
                  method: 'get',
                  data: {  
                    name: entity_name.val().trim(), 
                    type: entity_type,
                    street_and_number: street.val().trim(),
                    city: city.val().trim(),
                    province: province.val().trim()
                },

                // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
                // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
                  success: function (response) {

                    if (response.found) {   

                        //Mostro un div per chiedere conferma all'utente

                        document.getElementById("elementForm").style.display= 'none';
                        document.getElementById("alreadyPresent").style.display=  'block';

                    } else {

                        $("form[name="+form_name+"]").submit();
                    }
                  }

              });

      }
      
      if(button == 'Save'){   // MODIFICO UN ELEMENTO //else{} dovrò trattare il caso dell'edit, con /ajaxAttractionEdit
      
        path='';
        form_name='';


      if(entity_type == 'ATTRACTION'){

        path='/api/ajaxEditAttractionNOImage';  
        form_name='attraction'

      }else if(entity_type == 'HOUSING'){

        path='/api/ajaxEditHousingNOImage';
        form_name='housing'

      }else if(entity_type == 'RESTAURANT'){

        path='/api/ajaxEditRestaurantNOImage';
        form_name='restaurant'

      }

        if(imageChanged){ // Se è cambiata l'immagine, faccio il sumbint della form di edit

          $("form[name="+form_name+"]").submit();

        }else{
              
          // Se l'immagine NON è cambiata => con ajax cambio tutto tranne quella
          
            id=document.getElementById('IDSpan').innerText;
            entity_name= $("#name").val().trim();
            category_selection= $("#category").find(":selected").text();
            price_selection= $("#price").find(":selected").text();
            description= $("#description").val().trim();
            link=$("#link").val().trim();
            stars= $("#stars").val().trim();
            public=$('#public').is(':checked');
            street= $("#street_and_number").val().trim();
            city= $("#city").val().trim();
            province= $("#province").val().trim();
            country= $("#country").val().trim();
            postcode= $("#postcode").val().trim();


            var fd = new FormData();

            fd.append('id', id)
            fd.append('entity_name',entity_name)
            fd.append('category',category_selection);
            fd.append('price',price_selection);
            fd.append('description',description);
            fd.append('link',link);
            fd.append('stars',stars);
            fd.append('public',public);
            fd.append('street_and_number',street);
            fd.append('city',city);
            fd.append('province',province);
            fd.append('country',country);
            fd.append('postcode',postcode);
            

            $.ajax(path, {
              method: 'post',
              data: fd, 
        
              enctype: 'multipart/form-data',
              contentType: false,
                    cache: false,
              processData:false,

              // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
              // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
                success: function (response) {

                  
                   window.location.href='/user/adventures';
                
                }

            });

        }

              



    }
  
  
}
}

function addProceed(entity_type){ // ElementName sarà restaurant, attraction o housing

  
  path='';

  if(entity_type == 'ATTRACTION'){

    path='/api/ajaxAttractionAddDescription';  

  }else if(entity_type == 'HOUSING'){

    path='/api/ajaxHousingAddDescription';

  }else if(entity_type == 'RESTAURANT'){

    path='/api/ajaxRestaurantAddDescription';

  }

 
  var fd = new FormData();
  

  entity_name= $("#name").val().trim();
  category_selection= $("#category").find(":selected").text();
  price_selection= $("#price").find(":selected").text();
  description= $("#description").val().trim();
  link=$("#link").val().trim();
  image=$('#image')[0].files[0];
  stars= $("#stars").val().trim();
  public=$('#public').is(':checked');
  street= $("#street_and_number").val().trim();
  city= $("#city").val().trim();
  province= $("#province").val().trim();

  fd.append('name',entity_name);
  fd.append('category',category_selection);
  fd.append('price',price_selection);
  fd.append('description',description);
  fd.append('link',link);
  fd.append('image',image);
  fd.append('stars',stars);
  fd.append('public',public);
  fd.append('street_and_number',street);
  fd.append('city',city);
  fd.append('province',province);





  $.ajax(path, {
    method: 'post',
    data: fd, 
  
    enctype: 'multipart/form-data',
    contentType: false,
          cache: false,
    processData:false,

  // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
  // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
    success: function (response) {

      if(entity_type == 'ATTRACTION'){
        window.location.href='/attraction';
      }
      else if(entity_type == 'HOUSING'){
        window.location.href='/housing';
      }
      else if(entity_type == 'RESTAURANT'){
        window.location.href='/restaurant';
      }
    }

});
    
}

function handleChange(event){ // Per togliere il bordo rosso dalle form


  event.target.style.borderWidth= "1px";
  event.target.style.borderColor="black";
  
  $('#invalid-'+event.target.id).html("");

}

function handleSelect(event){ // Per togliere il bordo rosso dalle form


  event.target.style.borderWidth= "1px";
  event.target.style.borderColor="black";
   
  $('#invalid-elements').html("");

}

function handleSelectTransportation(event){ // Per togliere il bordo rosso dalle form


  event.target.style.borderWidth= "1px";
  event.target.style.borderColor="black";
   
  $('#invalid-transportation').html("");

}


// PER INFO DELL'UTENTE

function checkPersonalInfo(user_mail){  // Verifico la form per l'edit del profilo

  error= false;

  firstname= $("#firstname");
  name_msg=$("#invalid-firstname");
  var name_box = document.getElementById("firstname");

  if (firstname.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    name_msg.html("Please, insert a name"); // Riempio con il testo lo span con id invalid-title
   
    name_box.style.borderWidth= "2px";
    name_box.style.borderColor="red";
    error = true;

  } else {
      name_msg.html("");
  }



  lastname= $("#lastname");
  lastname_msg=$("#invalid-lastname");
  var lastname_box = document.getElementById("lastname");

  if (lastname.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    lastname_msg.html("Please, insert a lastname"); // Riempio con il testo lo span con id invalid-title
   
    lastname_box.style.borderWidth= "2px";
    lastname_box.style.borderColor="red";
    error = true;

  } else {
      lastname_msg.html("");
  }


  email= $("#email");
  email_msg=$("#invalid-email");
  var   email_box = document.getElementById("email");

  if (email.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

      email_msg.html("Please, insert an email"); // Riempio con il testo lo span con id invalid-title
   
      email_box.style.borderWidth= "2px";
      email_box.style.borderColor="red";
    error = true;

  } else {
        email_msg.html("");
  }

  telephone= $("#telephone");
  telephone_msg=$("#invalid-telephone");
  var   telephone_box = document.getElementById("telephone");
  var regularExpression = new RegExp("^([0-9]+)$", "g"); 

  if (telephone.val().trim().match(regularExpression) || telephone.val().trim()==='') {   // Se il titolo privato degli spazi è la stringa vuota  

    telephone_msg.html("");
      

  } else {
    telephone_msg.html("Telephone number not valid, please use only number"); // Riempio con il testo lo span con id invalid-title
   
    telephone_box.style.borderWidth= "2px";
    telephone_box.style.borderColor="red";
    error = true;
  }

  
  password= $("#password");
  password_msg=$("#invalid-password");
  var   password_box = document.getElementById("password");

  if (password.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

      password_msg.html("Please, insert a password"); // Riempio con il testo lo span con id invalid-title
   
      password_box.style.borderWidth= "2px";
      password_box.style.borderColor="red";
    error = true;

  } else {
        password_msg.html("");
  }

  
  alert('Attention, if everything go well, you will be logged out. Log in again to see the result')


  if(!error){

    if(user_mail == email.val().trim()){  // SE non ho modificato la mail

      $.ajax('/api/ajaxEditProfileNOEmail', {
        method: 'post',
        data: {      
          firstname: firstname.val().trim(), 
          lastname: lastname.val().trim(),
          password: password.val().trim(),
      },
    
        success: function (response) {
    
          window.location.href='/user/logout';
        }
    
    });


    }else{

      $.ajax('/api/ajaxEditProfileWITHEmail', {
        method: 'post',
        data: {      
          firstname: firstname.val().trim(), 
          lastname: lastname.val().trim(),
          password: password.val().trim(),
          email: email.val().trim(),
          old_email: user_mail,
      },
    
        success: function (response) {
    
          if(response.found){ // Se trovo la mail
            
            email_msg.html("Attention, email already in use!"); // Riempio con il testo lo span con id invalid-title
   
            email_box.style.borderWidth= "2px";
            email_box.style.borderColor="red";
          }else{

            window.location.href='/user/logout';

          }
        }
    
    });


    }
  }
}

function checkAddress(event){ // Verifico la form per l'edit dell'address
  event.preventDefault();

  error= false;
  
  street_and_number= $("#street_and_number");
  street_and_number_msg=$("#invalid-street_and_number");
  var street_and_number_box = document.getElementById("street_and_number");

  if (street_and_number.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    street_and_number_msg.html("Please, insert a street and number"); // Riempio con il testo lo span con id invalid-title
   
    street_and_number_box.style.borderWidth= "2px";
    street_and_number_box.style.borderColor="red";
    error = true;

  } else {
      street_and_number_msg.html("");
  }


  
  city= $("#city");
  city_msg=$("#invalid-city");
  var city_box = document.getElementById("city");

  if (city.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    city_msg.html("Please, insert a city"); // Riempio con il testo lo span con id invalid-title
   
    city_box.style.borderWidth= "2px";
    city_box.style.borderColor="red";
    error = true;

  } else {
      city_msg.html("");
  }

  province= $("#province");
  province_msg=$("#invalid-province");
  var province_box = document.getElementById("province");

  if (province.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    province_msg.html("Please, insert a province"); // Riempio con il testo lo span con id invalid-title
   
    province_box.style.borderWidth= "2px";
    province_box.style.borderColor="red";
    error = true;

  } else {
      province_msg.html("");
  }

  if(!error){

    $("form[name='addressForm']").submit();

  }


}
   

function alreadySubscribed(logged){ // Verifico se l'utente è già loggato

  console.log(logged)

  if(logged==true){

    alert('Hey, it seems that you are already subscribed!')
  }else{
    window.location.href='/user/create';
  }


}


function checkSubscriptionForm(event){  // Controllo la form per l'iscrizione

  event.preventDefault();


    error= false;
  
    firstname= $("#firstname");
    name_msg=$("#invalid-firstname");
    var name_box = document.getElementById("firstname");
  
    if (firstname.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  
  
      name_msg.html("Please, insert a name"); // Riempio con il testo lo span con id invalid-title
     
      name_box.style.borderWidth= "2px";
      name_box.style.borderColor="red";
      error = true;
  
    } else {
        name_msg.html("");
    }
  
  
  
    lastname= $("#lastname");
    lastname_msg=$("#invalid-lastname");
    var lastname_box = document.getElementById("lastname");
  
    if (lastname.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  
  
      lastname_msg.html("Please, insert a lastname"); // Riempio con il testo lo span con id invalid-title
     
      lastname_box.style.borderWidth= "2px";
      lastname_box.style.borderColor="red";
      error = true;
  
    } else {
        lastname_msg.html("");
    }
  
  
    email= $("#email");
    email_msg=$("#invalid-email");
    var   email_box = document.getElementById("email");
  
    if (email.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  
  
        email_msg.html("Please, insert an email"); // Riempio con il testo lo span con id invalid-title
     
        email_box.style.borderWidth= "2px";
        email_box.style.borderColor="red";
      error = true;
  
    } else {
          email_msg.html("");
    }

    telephone= $("#telephone");
    telephone_msg=$("#invalid-telephone");
    var   telephone_box = document.getElementById("telephone");
    var regularExpression = new RegExp("^([0-9]+)$", "g"); 
  
    if (telephone.val().trim().match(regularExpression) || telephone.val().trim()==='') {   // Se il titolo privato degli spazi è la stringa vuota  
  
      telephone_msg.html("");
        
  
    } else {
      telephone_msg.html("Telephone number not valid, please use only number"); // Riempio con il testo lo span con id invalid-title
     
      telephone_box.style.borderWidth= "2px";
      telephone_box.style.borderColor="red";
      error = true;
    }
  
  
    
    password= $("#password");
    password_msg=$("#invalid-password");
    var   password_box = document.getElementById("password");
  
    if (password.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  
  
        password_msg.html("Please, insert a password"); // Riempio con il testo lo span con id invalid-title
     
        password_box.style.borderWidth= "2px";
        password_box.style.borderColor="red";
      error = true;
  
    } else {
          password_msg.html("");
    }


  street_and_number= $("#street_and_number");
  street_and_number_msg=$("#invalid-street_and_number");
  var street_and_number_box = document.getElementById("street_and_number");

  if (street_and_number.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    street_and_number_msg.html("Please, insert a street and number"); // Riempio con il testo lo span con id invalid-title
   
    street_and_number_box.style.borderWidth= "2px";
    street_and_number_box.style.borderColor="red";
    error = true;

  } else {
      street_and_number_msg.html("");
  }


  
  city= $("#city");
  city_msg=$("#invalid-city");
  var city_box = document.getElementById("city");

  if (city.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    city_msg.html("Please, insert a city"); // Riempio con il testo lo span con id invalid-title
   
    city_box.style.borderWidth= "2px";
    city_box.style.borderColor="red";
    error = true;

  } else {
      city_msg.html("");
  }

  province= $("#province");
  province_msg=$("#invalid-province");
  var province_box = document.getElementById("province");

  if (province.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    province_msg.html("Please, insert a province"); // Riempio con il testo lo span con id invalid-title
   
    province_box.style.borderWidth= "2px";
    province_box.style.borderColor="red";
    error = true;

  } else {
      province_msg.html("");
  }
  
  console.log(email.val().trim())
    
if(!error){

    $.ajax('/ajaxVerifySub', {
      method: 'get',
      data: {      
        email: email.val().trim(),
    },
  
      success: function (response) {
  
        console.log(response)
        
        if(response.found){ // Se trovo la mail
          
          email_msg.html("Attention, email already in use!"); // Riempio con il testo lo span con id invalid-title
 
          email_box.style.borderWidth= "2px";
          email_box.style.borderColor="red";
        }else{

          $("form[name='subscriptionForm']").submit();

        }
      }
  
  });


  }
    
}






/* TRAVEL */

function toggleAddStage(event){
  event.preventDefault()
  event.stopPropagation()
  $('#addStage').css('display', 'block');
  $('#toggle_stage').css('display','none');

  stages_msg=$("#invalid-stages");
  stages_msg.html("");

  return

}

function stageAddinAdd(event){
  

  event.preventDefault()
  event.stopPropagation()

  error=false;

  
  locationStage=$("#location").val().trim();  // NON USARE LOCATION: fa il redirect!!
  location_msg=$("#invalid-location");
  var location_box = document.getElementById("location");

  if (locationStage === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    location_msg.html("Please, insert a location"); // Riempio con il testo lo span con id invalid-title
   
    location_box.style.borderWidth= "2px";
    location_box.style.borderColor="red";
    error = true;

  } else {
      location_msg.html("");
  }

  nation=$("#nation").val().trim();
  nation_msg=$("#invalid-nation");
  var nation_box = document.getElementById("nation");

  if (nation === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    nation_msg.html("Please, insert a nation"); // Riempio con il testo lo span con id invalid-title
   
    nation_box.style.borderWidth= "2px";
    nation_box.style.borderColor="red";
    error = true;

  } else {
      nation_msg.html("");
  }

  // HOUSING
  housing_array=[];
  housings=$("#housing").find("input[type='checkbox']:checked");
 
  housings.each(function() {
    var checkboxValue = $(this).val();
    //Inserisco nell'array che poi memorizzerò gli id delle housing => faccio parseINt per trasformarli da stringhe in interi
    housing_array.push(parseInt(checkboxValue)); 
    
  });



  // RESTAURANT
  restaurant_array=[];
  restaurants=$("#restaurant").find("input[type='checkbox']:checked");

  restaurants.each(function() {
    var checkboxValue = $(this).val();
    restaurant_array.push(parseInt(checkboxValue));
  });


  // ATTRACTION
  attraction_array=[];
  attractions=$("#attraction").find("input[type='checkbox']:checked");

  attractions.each(function() {
    var checkboxValue = $(this).val();
    attraction_array.push(parseInt(checkboxValue));
  });

  // Controllo che ci sia almeno uno dei 3 inserito per la tappa

  
  element_msg=$("#invalid-elements");
  var housing_box= document.getElementById('multiSelectDropdown housing');
  var restaurant_box= document.getElementById('multiSelectDropdown restaurant');
  var attraction_box= document.getElementById('multiSelectDropdown attraction');
  
  if(housing_array.length == 0 && restaurant_array.length == 0 && attraction_array.length == 0){

    element_msg.html("Please, select at least one housing, attraction or restaurant");

    housing_box.style.borderWidth= "2px";
    housing_box.style.borderColor="red";
    restaurant_box.style.borderWidth= "2px";
    restaurant_box.style.borderColor="red";
    attraction_box.style.borderWidth= "2px";
    attraction_box.style.borderColor="red";
    error = true;

  }else{

    
    element_msg.html("");
  }
 
  if(!error){

    $.ajax('/api/ajaxAddStage', {
      method: 'post',
      data: {      
        location: locationStage,
        nation: nation,
        housing_array: JSON.stringify(housing_array),
        restaurant_array: JSON.stringify(restaurant_array),
        attraction_array: JSON.stringify(attraction_array),
    },
  
      success: function (response) {
  
        $('#stageExternalContainer').css('display','block');
        $('#stageContainer').css('display','block');

        // Creo dei paragrafi conteneti stage e il relativo id per poi aggiungerli alla form
        stage= $("<p id='"+response.id+"' > "+"<i class='bi bi-dot'></i>"+ locationStage + " </p>")

        $('#stageContainer').append(stage);


        // toggle delle parti
        $('#addStage').css('display', 'none');
        $('#toggle_stage').css('display','block');



        /* RESET DEI VALORI DELLA FORM*/
        document.getElementById("location").value = ""
        document.getElementById("nation").value = ""
      
        $('.form-check-input').prop('checked', false)
      }
  
  });
  }


  
}


function stageAddStage(event){ /* CONTROLLO I CAMPI DELLO STAGE */
  

  event.preventDefault()
  event.stopPropagation()

  error=false;

  
  locationStage=$("#location").val().trim();  // NON USARE LOCATION: fa il redirect!!
  location_msg=$("#invalid-location");
  var location_box = document.getElementById("location");

  if (locationStage === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    location_msg.html("Please, insert a location"); // Riempio con il testo lo span con id invalid-title
   
    location_box.style.borderWidth= "2px";
    location_box.style.borderColor="red";
    error = true;

  } else {
      location_msg.html("");
  }

  nation=$("#nation").val().trim();
  nation_msg=$("#invalid-nation");
  var nation_box = document.getElementById("nation");

  if (nation === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    nation_msg.html("Please, insert a nation"); // Riempio con il testo lo span con id invalid-title
   
    nation_box.style.borderWidth= "2px";
    nation_box.style.borderColor="red";
    error = true;

  } else {
      nation_msg.html("");
  }

  // HOUSING
  housing_array=[];
  housings=$("#housing").find("input[type='checkbox']:checked");
 
  housings.each(function() {
    var checkboxValue = $(this).val();
    //Inserisco nell'array che poi memorizzerò gli id delle housing => faccio parseINt per trasformarli da stringhe in interi
    housing_array.push(parseInt(checkboxValue)); 
    
  });



  // RESTAURANT
  restaurant_array=[];
  restaurants=$("#restaurant").find("input[type='checkbox']:checked");

  restaurants.each(function() {
    var checkboxValue = $(this).val();
    restaurant_array.push(parseInt(checkboxValue));
  });


  // ATTRACTION
  attraction_array=[];
  attractions=$("#attraction").find("input[type='checkbox']:checked");

  attractions.each(function() {
    var checkboxValue = $(this).val();
    attraction_array.push(parseInt(checkboxValue));
  });

  // Controllo che ci sia almeno uno dei 3 inserito per la tappa

  
  element_msg=$("#invalid-elements");
  var housing_box= document.getElementById('multiSelectDropdown housing');
  var restaurant_box= document.getElementById('multiSelectDropdown restaurant');
  var attraction_box= document.getElementById('multiSelectDropdown attraction');
  
  if(housing_array.length == 0 && restaurant_array.length == 0 && attraction_array.length == 0){

    element_msg.html("Please, select at least one housing, attraction or restaurant");

    housing_box.style.borderWidth= "2px";
    housing_box.style.borderColor="red";
    restaurant_box.style.borderWidth= "2px";
    restaurant_box.style.borderColor="red";
    attraction_box.style.borderWidth= "2px";
    attraction_box.style.borderColor="red";
    error = true;

  }else{

    
    element_msg.html("");
  }
 
  if(!error){

    $.ajax('/api/ajaxAddStage', {
      method: 'post',
      data: {      
        location: locationStage,
        nation: nation,
        housing_array: JSON.stringify(housing_array),
        restaurant_array: JSON.stringify(restaurant_array),
        attraction_array: JSON.stringify(attraction_array),
    },
  
      success: function (response) {
  
        $('#stageExternalContainer').css('display','block');
        $('#stageContainer').css('display','block');

        // Creo dei paragrafi conteneti stage e il relativo id per poi aggiungerli alla form
        stage= $("<p id='"+response.id+"' > "+"<i class='bi bi-dot'></i>"+ locationStage + " </p>")

        $('#stageContainer').append(stage);

        console.log(response.id)

        console.log(response.stageAdded)

        // aggiuno i bottoni per la modifca e la cancellazi9one anche ai nuovi stage che creo
        buttons=$(
        "<div style='font-size:15px; margin-top:-15px; margin-bottom:20px;'><button id='"+response.id+"' type='button' style='padding: 2px' class='btn btn-success' onclick='modifyStage("+JSON.stringify(response.stageAdded)+")'> Edit Stage</button><button id='"+response.id+"' type='button' style='padding: 2px' class='btn btn-danger' onclick='deleteStage("+JSON.stringify(response.stageAdded)+")'> Delete Stage</button></div>")

        $('#stageContainer').append(buttons);



        // toggle delle parti
        $('#addStage').css('display', 'none');
        $('#toggle_stage').css('display','block');



        /* RESET DEI VALORI DELLA FORM*/
        document.getElementById("location").value = ""
        document.getElementById("nation").value = ""
      
        $('.form-check-input').prop('checked', false)
      }
  
  });
  }


  
}


function checkAddTravel(event){   

  
  event.preventDefault()
  error=false;

  
  title=$("#title").val().trim();  // NON USARE LOCATION: fa il redirect!!
  title_msg=$("#invalid-title");
  var title_box = document.getElementById("title");

  if (title === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    title_msg.html("Please, insert a title"); // Riempio con il testo lo span con id invalid-title
   
    title_box.style.borderWidth= "2px";
    title_box.style.borderColor="red";
    error = true;

  } else {
      title_msg.html("");
  }

  duration= $("#duration").val().trim();
  duration_msg=$("#invalid-duration");
  var duration_box = document.getElementById("duration");
  var regularExpression = new RegExp("^([0-9]+)$", "g"); 

  if (!duration.match(regularExpression)) {   

    duration_msg.html("Please, insert only numbers"); // Riempio con il testo lo span con id invalid-title
   
    duration_box.style.borderWidth= "2px";
    duration_box.style.borderColor="red";
    error = true;
      

  }else if (duration === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    duration_msg.html("Please, insert a duration"); // Riempio con il testo lo span con id invalid-title
   
    duration_box.style.borderWidth= "2px";
    duration_box.style.borderColor="red";
    error = true;

  } else {
      duration_msg.html("");
  }


  transportation_array=[];
  
  transportation_msg=$("#invalid-transportation");
  var transportation_box = document.getElementById("multiSelectDropdown transportation");

  transportations=$("#transportation").find("input[type='checkbox']:checked");
  transportations.each(function() {
    var checkboxValue = $(this).val();
    transportation_array.push(checkboxValue);
  });
  
  if(transportation_array == 0){

    transportation_msg.html("Please, insert at least one transportation mean"); // Riempio con il testo lo span con id invalid-title
   
    transportation_box.style.borderWidth= "2px";
    transportation_box.style.borderColor="red";
    error = true;

  }else{
    transportation_msg.html("");
  }


  thumbnail=$('#thumbnail')[0].files[0]; 
  public=$('#public').is(':checked');

  stage_array=[];
  stages_msg=$("#invalid-stages");
  
  stages=$('#stageContainer >p')  // prendo tutti i figli diretti di stage container che sono tag p
  stages.each(function() {
    var checkboxValue = $(this).attr('id'); 
    stage_array.push(parseInt(checkboxValue));
  });

  if(stage_array == 0){

    stages_msg.html("Please, insert at least one stage"); // Riempio con il testo lo span con id invalid-title
   
    error = true;

  }else{
    stages_msg.html("");
  }



  if(!error){
    var fd = new FormData();
  

    fd.append('title',title);
    fd.append('duration',parseInt(duration));
    fd.append('transportation_array',JSON.stringify(transportation_array));
    fd.append('thumbnail',thumbnail);
    fd.append('public',public);
    fd.append('stage_array',JSON.stringify(stage_array));


    $.ajax('/api/ajaxAddTravel', {
      method: 'post',
      data: fd, 
    
      enctype: 'multipart/form-data',
      contentType: false,
            cache: false,
      processData:false,

    // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
    // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
      success: function (response) {
        
        window.location.href='/travel';
      }

    });
  }
}


function deleteStage(item){   //SI POTREBBE FARE UNA FINESTRA MODALE

  let text = "Are you sure you want to delete "+item.location+"?";
  if (!confirm(text)) {
    return
  }

 
  stageID=item.id;

  travelID=document.getElementById('travelIDSpan').innerText;

  stage_array=[];
  stages=$('#stageContainer >p')  // prendo tutti i figli diretti di stage container che sono tag p
  stages.each(function() {
    var checkboxValue = $(this).attr('id'); 
  
    if(checkboxValue != stageID){ // cReo un array con i soli id che NON voglio cancellare
      stage_array.push(parseInt(checkboxValue));
    }
  });

  
  $.ajax('/ajaxDeleteStage', {
    method: 'get',
    data: {      
      stageID: stageID,
      travelID: travelID,
      stage_array: JSON.stringify(stage_array),
  },

    success: function (response) {
        

        /* CANCELLO LO STAGE ELIMINATO*/
        stages=$('#stageContainer >p')  // prendo tutti i figli diretti di stage container che sono tag p
        stages.each(function() {
          var checkboxValue = $(this).attr('id'); 
          if(checkboxValue==stageID){
            $(this).html("")

          }
        });

        /* CANCELLO I BOTTONI DELLO STAGE*/
        buttons=$('#stageContainer button')  // prendo tutti i figli  di stage container che sono button e controllo qauli aveveno lo stesso id della cosa cancellata
        buttons.each(function() {
          var checkboxValue = $(this).attr('id'); 
          if(checkboxValue==stageID){
            $(this).css('display','none');
          }
        });

    }

});

}

function closeModify(event){

  event.preventDefault()
  event.stopPropagation()
  $('#editStage').css('display', 'none');
  $('#toggle_stage').css('display','block');

   /* RESET DEI VALORI DELLA FORM*/
   document.getElementById("location").value = ""
   document.getElementById("nation").value = ""
 
   $('.form-check-input').prop('checked', false)
}

function modifyStage(item){ // per mostrare nella form i valori dello stage
  
  $('#editStage').css('display', 'block');
  $('#toggle_stage').css('display','none');


  document.getElementById('locationEdit').value = item.location;
  document.getElementById('nationEdit').value = item.nation;
  document.getElementById('stageID').value = item.id;

  housings=$("#housingEdit").find("input[type='checkbox']");
  housings.each(function() {
    console.log(JSON.parse(item.housings))

    // Controllo se l'array di housing che appartengono alla tappa include quella particolare housing e la checco
    if(JSON.parse(item.housings?item.housings:'[]').includes(parseInt($(this).val()))){  // se ho housing lo uso, altrimenti uso l'array vuoto

      
      $(this).prop('checked', true)

    }
     
  });

  restaurants=$("#restaurantEdit").find("input[type='checkbox']");
  restaurants.each(function() {

    if(JSON.parse(item.restaurants?item.restaurants:'[]').includes(parseInt($(this).val()))){  // se ho housing lo uso, altrimenti uso l'array vuoto

      
      $(this).prop('checked', true)

    }
     
  });

  attractions=$("#attractionEdit").find("input[type='checkbox']");
  attractions.each(function() {

    if(JSON.parse(item.attractions?item.attractions:'[]').includes(parseInt($(this).val()))){  // se ho housing lo uso, altrimenti uso l'array vuoto

      
      $(this).prop('checked', true)

    }
     
  });
  
}

function stageModifyStage(event){   // MODIFICO i campi dello stage

  event.preventDefault()
  event.stopPropagation()

  error=false;

  
  locationStage=$("#locationEdit").val().trim();  // NON USARE LOCATION: fa il redirect!!
  location_msg=$("#invalid-locationEdit");
  var location_box = document.getElementById("locationEdit");

  if (locationStage === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    location_msg.html("Please, insert a location"); // Riempio con il testo lo span con id invalid-title
   
    location_box.style.borderWidth= "2px";
    location_box.style.borderColor="red";
    error = true;

  } else {
      location_msg.html("");
  }

  nation=$("#nationEdit").val().trim();
  nation_msg=$("#invalid-nationEdit");
  var nation_box = document.getElementById("nationEdit");

  if (nation === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    nation_msg.html("Please, insert a nation"); // Riempio con il testo lo span con id invalid-title
   
    nation_box.style.borderWidth= "2px";
    nation_box.style.borderColor="red";
    error = true;

  } else {
      nation_msg.html("");
  }

  // HOUSING
  housing_array=[];
  housings=$("#housingEdit").find("input[type='checkbox']:checked");
 
  housings.each(function() {
    var checkboxValue = $(this).val();
    //Inserisco nell'array che poi memorizzerò gli id delle housing => faccio parseINt per trasformarli da stringhe in interi
    housing_array.push(parseInt(checkboxValue)); 
    
  });



  // RESTAURANT
  restaurant_array=[];
  restaurants=$("#restaurantEdit").find("input[type='checkbox']:checked");

  restaurants.each(function() {
    var checkboxValue = $(this).val();
    restaurant_array.push(parseInt(checkboxValue));
  });


  // ATTRACTION
  attraction_array=[];
  attractions=$("#attractionEdit").find("input[type='checkbox']:checked");

  attractions.each(function() {
    var checkboxValue = $(this).val();
    attraction_array.push(parseInt(checkboxValue));
  });

  // Controllo che ci sia almeno uno dei 3 inserito per la tappa

  
  element_msg=$("#invalid-elementsEdit");
  var housing_box= document.getElementById('multiSelectDropdown housingEdit');
  var restaurant_box= document.getElementById('multiSelectDropdown restaurantEdit');
  var attraction_box= document.getElementById('multiSelectDropdown attractionEdit');
  
  if(housing_array.length == 0 && restaurant_array.length == 0 && attraction_array.length == 0){

    element_msg.html("Please, select at least one housing, attraction or restaurant");

    housing_box.style.borderWidth= "2px";
    housing_box.style.borderColor="red";
    restaurant_box.style.borderWidth= "2px";
    restaurant_box.style.borderColor="red";
    attraction_box.style.borderWidth= "2px";
    attraction_box.style.borderColor="red";
    error = true;

  }else{

    
    element_msg.html("");
  }

  stageID= $("#stageID").val();


  if(!error){

    $.ajax('/api/ajaxEditStage', {
      method: 'post',
      data: {      
        location: locationStage,
        nation: nation,
        housing_array: JSON.stringify(housing_array),
        restaurant_array: JSON.stringify(restaurant_array),
        attraction_array: JSON.stringify(attraction_array),
        stageID: stageID,
    },
  
      success: function (response) {
  
        // toggle delle parti
        $('#editStage').css('display', 'none');
        $('#toggle_stage').css('display','block');


         /* CAMBIO LA LOCATION: la aggiorno con i campi che ho inviato*/
          stages=$('#stageContainer >p')  // prendo tutti i figli diretti di stage container che sono tag p
          stages.each(function() {
            var checkboxValue = $(this).attr('id'); 
            if(checkboxValue==stageID){
              $(this).html("<p id='"+stageID+"' > "+"<i class='bi bi-dot'></i>"+ locationStage + " </p>")
            }
          });

      }
  
  });
  }

}


function checkEditTravel(event, travelID){  // AGGIUNGI STAGE_ARRAY E IMMAGINE

 
  event.preventDefault()
  error=false;

  
  title=$("#title").val().trim();  // NON USARE LOCATION: fa il redirect!!
  title_msg=$("#invalid-title");
  var title_box = document.getElementById("title");

  if (title === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    title_msg.html("Please, insert a title"); // Riempio con il testo lo span con id invalid-title
   
    title_box.style.borderWidth= "2px";
    title_box.style.borderColor="red";
    error = true;

  } else {
      title_msg.html("");
  }

  duration= $("#duration").val().trim();
  duration_msg=$("#invalid-duration");
  var duration_box = document.getElementById("duration");
  var regularExpression = new RegExp("^([0-9]+)$", "g"); 

  if (!duration.match(regularExpression)) {   

    duration_msg.html("Please, insert only numbers"); // Riempio con il testo lo span con id invalid-title
   
    duration_box.style.borderWidth= "2px";
    duration_box.style.borderColor="red";
    error = true;
      

  }else if (duration === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    duration_msg.html("Please, insert a duration"); // Riempio con il testo lo span con id invalid-title
   
    duration_box.style.borderWidth= "2px";
    duration_box.style.borderColor="red";
    error = true;

  } else {
      duration_msg.html("");
  }


  transportation_array=[];
  
  transportation_msg=$("#invalid-transportation");
  var transportation_box = document.getElementById("multiSelectDropdown transportation");

  transportations=$("#transportation").find("input[type='checkbox']:checked");
  transportations.each(function() {
    var checkboxValue = $(this).val();
    transportation_array.push(checkboxValue);
  });
  
  if(transportation_array == 0){

    transportation_msg.html("Please, insert at least one transportation mean"); // Riempio con il testo lo span con id invalid-title
   
    transportation_box.style.borderWidth= "2px";
    transportation_box.style.borderColor="red";
    error = true;

  }else{
    transportation_msg.html("");
  }



  stage_array=[];
  stages_msg=$("#invalid-stages");
  
  stages=$('#stageContainer >p')  // prendo tutti i figli diretti di stage container che sono tag p
  stages.each(function() {
    var checkboxValue = $(this).attr('id'); 

    // invio solo quelli con html non nullo => quelli che non ho eliminato

    if($(this).text() !=''){
      console.log(checkboxValue)
      stage_array.push(parseInt(checkboxValue));
    }
  });


  if(stage_array == 0){

    stages_msg.html("Please, insert at least one stage"); // Riempio con il testo lo span con id invalid-title
   
    error = true;

  }else{
    stages_msg.html("");
  }

  
  imageChanged=true;
  thumbnail=$('#thumbnail')[0].files[0]; 
  //oldImage= document.getElementById("oldImage").src;

  if(!thumbnail){

      imageChanged=false;
  }

  console.log(imageChanged)

  public=$('#public').is(':checked');


  if(!error){
    
    //fd.append('stage_array',JSON.stringify(stage_array));//fd.append('thumbnail',thumbnail);

    if(imageChanged){ // Se l'immagine è cambiata

        var fd = new FormData();
        
        fd.append('travelID',travelID)
        fd.append('title',title);
        fd.append('duration',parseInt(duration));
        fd.append('transportation_array',JSON.stringify(transportation_array));
        fd.append('public',public);
        fd.append('stage_array',JSON.stringify(stage_array));
        fd.append('thumbnail',thumbnail);


        $.ajax('/api/ajaxEditTravelWITHImage', {
          method: 'post',
          data: fd, 
        
          enctype: 'multipart/form-data',
          contentType: false,
                cache: false,
          processData:false,

        // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
        // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
          success: function (response) {
            
            window.location.href='/user/adventures';
          }

        });
    
    }else{  // NON CAMBIO L'IMMAGINE se NON è cambiata

      var fd = new FormData();
        
        fd.append('travelID',travelID)
        fd.append('title',title);
        fd.append('duration',parseInt(duration));
        fd.append('transportation_array',JSON.stringify(transportation_array));
        fd.append('public',public);
        fd.append('stage_array',JSON.stringify(stage_array));


        $.ajax('/api/ajaxEditTravelNOImage', {
          method: 'post',
          data: fd, 
        
          enctype: 'multipart/form-data',
          contentType: false,
                cache: false,
          processData:false,

        // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
        // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
          success: function (response) {
            
            window.location.href='/user/adventures';
          }

        });
      


    }
  }

}






