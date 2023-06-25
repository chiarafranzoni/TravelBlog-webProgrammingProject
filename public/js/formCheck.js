
function checkForm(event, entity_type){  // Creo una funzinoe per eseguire controlli sui campi delle form

  event.preventDefault();
  entity_name= $("#name");
  name_msg=$("#invalid-name");

  category_msg = $("#invalid-category");

  error= false;

  // Controllo che il NOME NON SIA VUOTO

  if (entity_name.val().trim() === "") {   // Se il titolo privato degli spazi è la stringa vuota  

    name_msg.html("Please, insert a name"); // Riempio con il testo lo span con id invalid-title
    entity_name.focus();  // Sposto l'attenzione su il campo errato
    error = true;

  } else {
      name_msg.html("");
  }



  // Controllo se i campo CATEGORY SIA selezionata
  
  selection= $("#category").find(":selected").text();
  
  if ( selection == "Category") {        //Punto al select con attributo multiple
    
      category_msg.html("Please, select a category");
      entity_name.focus();  // Sposto l'attenzione su il campo errato
    
      error = true;
  } else {
      category_msg.html("");
  }

  
    // AJAX

    if (!error) {

      if(entity_type == 'ATTRACTION')

          $.ajax('/ajaxFormCheckAttraction', {
              method: 'get',
              data: { title: title.val().trim() },
              success: function (result) {

                  if (result.found) {
                      title_msg.html("Title already exist");
                      error = true;
                  } else {

                      $("form[name=book]").submit();
                  }
              }

          });

    }
      
  

}
