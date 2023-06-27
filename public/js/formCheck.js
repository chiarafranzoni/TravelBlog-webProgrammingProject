
function checkForm(event, entity_type){  // Creo una funzinoe per eseguire controlli sui campi delle form

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
street_msg=$("#invalid-street");

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

  
    // AJAX

    if (!error) {

        
        path='';
        form_name='';

      if(entity_type == 'ATTRACTION'){

        path='/ajaxFormCheckAttraction';  
        form_name='attraction';

      }else if(entity_type == 'HOUSING'){

        path='/';
        form_name='';

      }else if(entity_type == 'RESTAURANT'){

        path='/';
        form_name='';

      }

      console.log(path);


          $.ajax(path, {
              method: 'get',
              data: {  
                name: entity_name.val().trim(), 
                street_and_number: street.val().trim(),
                city: city.val().trim(),
                province: province.val().trim()
             },

             // dal metodo presente nel AttractionController, passo i dati che ho messo in data per fare controlli su qunto inserito nel datatbase
             // e in base al risultato che torna, controllo il campo found e se torna false, faccio il submit della form
              success: function (response) {

                if (response.found) {   

                    // AGGIUNGO A CIO CHE C'È GIA A DATABASE
                     console.log('presente')
                } else {

                    $("form[name="+form_name+"]").submit();
                }
              }

          });

    }
      
  

}
