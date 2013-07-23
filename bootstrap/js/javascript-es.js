/*limitar contenido en los elementos*/
function text_ellipsis(elemento, max_chars)
{
limite_text = $(elemento).html();
if (limite_text.length > max_chars)
{
limite = limite_text.substr(0, max_chars)+" ...";
$(elemento).html(limite);
}
}

$(function(){
$("#button_registrarse").click(function(){
form_registrarse();
});

$("#button_activar").click(function(){
form_activar();
});

$("#button_recuperar_1").click(function(){
form_recuperar_1();
});

$("#button_recuperar_2").click(function(){
form_recuperar_2();
});

$("#button_nuevo_tema").click(function(){
form_nuevo_tema();
});

$("#button_nuevo_comentario").click(function(){
form_nuevo_comentario();
});

$("#button_contacto").click(function(){
form_contacto();
});

//Cambio de input
$('#form_registrarse :input, #form_activar :input, #form_recuperar_1 :input, #form_recuperar_2 :input, #form_nuevo_tema :input, #form_nuevo_comentario :input').blur(function() {
$(".text-error").html("");
});
});

/*formulario registrarse*/
$(function(){
$('#nick').bind('input propertychange', function() {
$("#check_nick").val(this.value);
var url = "system/ajax/comprobar-nick.php"; // the script where you handle the form input.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_nick").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $("#e_nick").html(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
});
});

function form_registrarse()
{

//nick
elemento = $("#nick").val();
if (elemento == "")
{
$("#e_nick").html("Campo de texto obligatorio").addClass("text-error");
return;
}

//nombre
elemento = $("#nombre").val();
var buscar = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/
if (elemento == "")
{
$("#e_nombre").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 50)
{
$("#e_nombre").html("Sólo letras").addClass("text-error");
return;
}


//apellidos
elemento = $("#apellidos").val();
var buscar = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/
if (elemento == "")
{
$("#e_apellidos").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 50)
{
$("#e_apellidos").html("Sólo letras").addClass("text-error");
return;
}

//email
elemento = $("#email").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email").html("Email incorrecto").addClass("text-error");
return;
}

//password
elemento = $("#password").val();
var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
if (elemento == "")
{
$("#e_password").html("Campo de texto obligatorio").addclass("text-error");
return;
}
else if(!elemento.match(buscar))
{
$("#e_password").html("La contraseña debe contener números y letras").addClass("text-error");
return;
}
else if(elemento.length < 8 || elemento.length > 16)
{
$("#e_password").html("Entre 8 y 16 caracateres").addClass("text-error");
return;
}

elemento = $("#repetir_password").val();
if (elemento != $("#password").val())
{
$("#e_repetir_password").html("Las contraseñas no coinciden").addClass("text-error");
return;
}

if (!$('#terminos').is(':checked'))
{
$("#e_terminos").html("Tienes que aceptar los términos").addClass("text-error");
return;
}
else
{
$("#form_registrarse").submit();
}
}
/* form registrarse */


/* form activar cuenta */
function form_activar()
{
//email
elemento = $("#email").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email").html("Email incorrecto").addClass("text-error");
return;
}
else
{
$("#e_email").html("");
}

//password
elemento = $("#password").val();
var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
if (elemento == "")
{
$("#e_password").html("Campo de texto obligatorio").addclass("text-error");
return;
}
else if(!elemento.match(buscar))
{
$("#e_password").html("La contraseña debe contener números y letras").addclass("text-error");
return;
}
else if(elemento.length < 8 || elemento.length > 16)
{
$("#e_password").html("Entre 8 y 16 caracateres").addclass("text-error");
return;
}

else
{
$("#form_activar").submit();
}
}
/* form activar cuenta */

/* form recuperar password 1 */
function form_recuperar_1()
{
//email
elemento = $("#email").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email").html("Email incorrecto").addClass("text-error");
return;
}
else
{
$("#form_recuperar_1").submit();
}
}
/* form recuperar password 1 */

/* form recuperar password 2 */
function form_recuperar_2()
{
//email
elemento = $("#email").val();
var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
if (elemento == "")
{
$("#e_email").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 80)
{
$("#e_email").html("Email incorrecto").addClass("text-error");
return;
}

//password
elemento = $("#password").val();
var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
if (elemento == "")
{
$("#e_password").html("Campo de texto obligatorio").addclass("text-error");
return;
}
else if(!elemento.match(buscar))
{
$("#e_password").html("La contraseña debe contener números y letras").addclass("text-error");
return;
}
else if(elemento.length < 8 || elemento.length > 16)
{
$("#e_password").html("Entre 8 y 16 caracateres").addclass("text-error");
return;
}
//repetir password
elemento = $("#repetir_password").val();
if (elemento != $("#password").val())
{
$("#e_repetir_password").html("Las contraseñas no coinciden").addClass("text-error");
return;
}

else
{
$("#form_recuperar_2").submit();
}
}
/* form recuperar password 2 */

/* form nuevo tema */
function form_nuevo_tema()
{
//nombre
elemento = $("#titulo").val();
var buscar = /^[a-zA-Z0-9áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s\?\¿\¡\!\-\@]+$/
if (elemento == "")
{
$("#e_titulo").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 100)
{
$("#e_titulo").html("Hay caracteres no permitidos").addClass("text-error");
return;
}

if (document.getElementById("comentario").value.length > 500 || document.getElementById("comentario").value.length < 50)
{
	document.getElementById("comentario").value = document.getElementById("comentario").value.substr(0, 500);
       $("#e_comentario").text("No más de 500 caracteres ni menos de 50");
		return;
}
else
{
$("#form_nuevo_tema").submit();
}
}

$(function(){

$('#comentario').bind('input propertychange', function() {

$("#e_comentario").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_comentario").text(this.value.length);
		return;
      }
});

$("#add_image").click(function()
{
$("#box_image").css({display: "block"});
$("#box_url").css({display: "none"});
});

$("#add_url").click(function()
{
$("#box_url").css({display: "block"});
$("#box_image").css({display: "none"});
});

$("#box_image .ok").click(function(){
elemento = $("#imagen").val();
buscar = /^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i
if (!elemento.match(buscar) && elemento != "")
{
alert("Imagen incorrecta");
$("#label-imagen").text("");
return;
}
else if(elemento.length > 150)
{
alert("La url es demasiado larga, no permitido.");
$("#label-imagen").text("");
return;
}
else
{
if (elemento != "")
{
$("#_imagen").val(elemento);
$("#label-imagen").text("IMAGEN INCLUIDA");
}
if (elemento == "")
{
$("#_imagen").val("");
$("#label-imagen").text("");
}
}


$("#box_image").css({display: "none"});
$("#box_url").css({display: "none"});
});

$("#box_url .ok").click(function(){
elemento = $("#url").val();
buscar = /^(ht|f)tps?:\/\/\w+(.*)$/i
if (!elemento.match(buscar) && elemento != "")
{
alert("URL incorrecta");
$("#label-url").text("");
return;
}
else if(elemento.length > 150)
{
alert("La url es demasiado larga, no permitido.");
$("#label-imagen").text("");
return;
}
else
{
if (elemento != "")
{
$("#_url").val(elemento);
$("#label-url").text("URL INCLUIDA");
}
if(elemento == "")
{
$("#_url").val("");
$("#label-url").text("");
}
}


$("#box_image").css({display: "none"});
$("#box_url").css({display: "none"});
});

});

/* form nuevo tema */


/* form nuevo comentario */
function form_nuevo_comentario()
{
if (document.getElementById("comentarioC").value.length > 500 || document.getElementById("comentarioC").value.length < 50)
{
	document.getElementById("comentarioC").value = document.getElementById("comentarioC").value.substr(0, 500);
       $("#e_comentarioC").text("No más de 500 caracteres ni menos de 50");
		return;
}
else
{
$("#form_nuevo_comentario").submit();
}
}

$(function(){

$('#comentarioC').bind('input propertychange', function() {

$("#e_comentarioC").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_comentarioC").text(this.value.length);
		return;
      }
});

$("#add_imageC").click(function()
{
$("#box_imageC").css({display: "block"});
$("#box_urlC").css({display: "none"});
});

$("#add_urlC").click(function()
{
$("#box_urlC").css({display: "block"});
$("#box_imageC").css({display: "none"});
});

$("#box_imageC .ok").click(function(){
elemento = $("#imagenC").val();
buscar = /^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i
if (!elemento.match(buscar) && elemento != "")
{
alert("Imagen incorrecta");
$("#label-imagenC").text("");
return;
}
else if(elemento.length > 150)
{
alert("La url es demasiado larga, no permitido.");
$("#label-imagen").text("");
return;
}
else
{
if (elemento != "")
{
$("#_imagenC").val(elemento);
$("#label-imagenC").text("IMAGEN INCLUIDA");
}
if (elemento == "")
{
$("#_imagenC").val("");
$("#label-imagenC").text("");
}
}


$("#box_imageC").css({display: "none"});
$("#box_urlC").css({display: "none"});
});

$("#box_urlC .ok").click(function(){
elemento = $("#urlC").val();
buscar = /^(ht|f)tps?:\/\/\w+(.*)$/i
if (!elemento.match(buscar) && elemento != "")
{
alert("URL incorrecta");
$("#label-urlC").text("");
return;
}
else if(elemento.length > 150)
{
alert("La url es demasiado larga, no permitido.");
$("#label-imagen").text("");
return;
}
else
{
if (elemento != "")
{
$("#_urlC").val(elemento);
$("#label-urlC").text("URL INCLUIDA");
}
if(elemento == "")
{
$("#_urlC").val("");
$("#label-urlC").text("");
}
}

$("#box_imageC").css({display: "none"});
$("#box_urlC").css({display: "none"});
});

});

/* form nuevo tema */

/* form contacto */

function form_contacto()
{
if (document.getElementById("contacto").value.length > 250 || document.getElementById("contacto").value.length < 50)
{
	document.getElementById("contacto").value = document.getElementById("contacto").value.substr(0, 500);
       $("#e_contacto").text("No más de 250 caracteres ni menos de 50");
		return;
}
else
{
$("#form_contacto").submit();
}
}


$(function(){

$('#contacto').bind('input propertychange', function() {

$("#e_contacto").text(this.value.length);

if(this.value.length > 250){
		this.value = this.value.substr(0, 250);
        $("#e_contacto").text(this.value.length);
		return;
      }
});
});
/* form contacto */