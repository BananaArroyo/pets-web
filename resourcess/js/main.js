if (typeof(Storage) !== "undefined") {
    var current = localStorage.recent;
    if (current) {
        // contenido de atras
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        } // Quitar las clases activas 
        var tablink = document.getElementsByClassName("tablink");
        for (i = 0; i < tablink.length; i++) {
            tablink[i].classList.remove("active");
        } // mostrar el contenido apropiado +agregar la propiedad a la tab
        if (current == "link1")
            document.getElementById("signin").style.display = "block";
        else
            document.getElementById("signup").style.display = "block";
        document.getElementById(current).classList.add("active");
    }
}

function openTab(evt, choice) {
    // ocultar todo el contenido
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    } // Remover las clases activas
    var tablink = document.getElementsByClassName("tablink");
    for (i = 0; i < tablink.length; i++) {
        tablink[i].classList.remove("active");
    } // Mostrar el contenido + agregar la clase activa apropiada tab
    document.getElementById(choice).style.display = "block";
    evt.currentTarget.classList.add("active");
    // Save
    if (typeof(Storage) !== "undefined") {
        localStorage.recent = evt.currentTarget.getAttribute('id');
    }
}

function validateLogin() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var useremail = document.getElementById("loginuseremail").value;
    var userpass = document.getElementById("loginuserpass").value;
    var result = true;
    if (useremail == "") {
        required[0].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    } else if (!validateEmail(useremail)) {
        required[0].innerHTML = "Invilo formato de correo.";
        result = false;
    }
    if (userpass == "") {
        required[1].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    }
    return result;
}

function validateRegister() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var userfirstname = document.getElementById("userfirstname").value;
    var userlastname = document.getElementById("userlastname").value;
    var userpass = document.getElementById("userpass").value;
    var userpassconfirm = document.getElementById("userpassconfirm").value;
    var useremail = document.getElementById("useremail").value;
    var usergender = document.getElementsByClassName("usergender");
    var result = true;
    if (userfirstname == "") {
        required[2].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    }
    if (userlastname == "") {
        required[3].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    }
    if (userpass == "") {
        required[5].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    }
    if (userpassconfirm == "") {
        required[6].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    }
    if (userpass != "" && userpassconfirm != "" && userpass != userpassconfirm) {
        required[5].innerHTML = "Los Passwords no coinceiden .";
        required[6].innerHTML = "Los Passwords no coinciden .";
        result = false;
    }
    if (useremail == "") {
        required[7].innerHTML = "Este campo no puede estar vacio.";
        result = false;
    } else if (!validateEmail(useremail)) {
        required[7].innerHTML = "Corro invalido.";
        result = false;
    }
    if (!usergender[0].checked && !usergender[1].checked) {
        required[8].innerHTML = "Debes generar tu numero.";
        result = false;
    }
    return result;
}

function clearRequiredFields() {
    var required = document.getElementsByClassName("REQUERIDO");
    for (i = 0; i < required.length; i++) {
        required[i].innerHTML = "";
    }
}

function validateEmail(email) {
    var emailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\"[^\s@]+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email.match(emailformat))
        return false;
    return true;
}

/* Email Format
 -----------------> Start <-------------------------------
Matching the beginning of a regular expression --->      /^
 -------------------> Local Part <---------------------------
Doesn't Start with a Special Character --->      [^<>()[\]\\.,;:\s@\"]+
Start with any Character Else --->   (\.[^<>()[\]\\.,;:\s@\"]+)*
Or Anything between Quotes ---->     |(\"\S+\")
 -------------------> Domain <---------------------------
IP Address May be surrounded by squared brackets ---->   (\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])
Or Words and Hyphen included(provided it's not the first or last character) Followed by at least 1 dot then a word (Can be Repeated) Followed by the last word, it must contain 3 characters at most ([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})
 -------------------> End <---------------------------
Matching the end of a regular expression ---> $/
*/

/* ---------------------------> RegExp Reference <-------------------------------
// All regular expressions start and end with forward slashes.
^ Matches the beginning of the string or line
$ Matches the end of the string or line
* Matches the previous character 0 or more times.
? Matches the previous character 0 or 1 time.
+ Matches the previous character 1 or more times.
\ Indicates that the next character is special and not to be interpreted literally.
[] Indicates range of characters
[^] Any character Not in between brackets.
\s whitespace character
n{x,y} Matches a string that contains a sequence of x to y n's
n{x,} Matches a string that contains a sequence of at least x n's
. Any single character
*/