
/* Funzione per fare il toggle della password da visibile a no e cambiare l'icona dell'occhio*/ 

function passwordToggle() {
    var x = document.getElementById("password");
    var e = document.getElementById("eye");
    if (x.type === "password") {
      x.type = "text";                  // rendo la password visibile
      e.classList="bi bi-eye-slash";    // barro l'occhio
    } else {
      x.type = "password";              // rendo la password INVISIBILE
      e.classList="bi bi-eye";          // TOLGO la barra all'occhio  
    }
  }