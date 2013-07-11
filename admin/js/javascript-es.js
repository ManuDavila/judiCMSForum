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
$("#button_sesion").click(function(){
form_sesion();
});

$("#button_recuperar_1").click(function(){
form_recuperar_1();
});

$("#button_recuperar_2").click(function(){
form_recuperar_2();
});

$("#button_nuevo_indice").click(function(){
form_nuevo_indice();
});

$("#button_editar_indice").click(function(){
form_editar_indice();
});

$("#button_nuevo_subindice").click(function(){
form_nuevo_subindice();
});

$("#button_editar_subindice").click(function(){
form_editar_subindice();
});


//Cambio de input
$('#form_sesion :input, #form_recuperar_1 :input, #form_recuperar_2 :input, #form_nuevo_indice :input, #form_editar_indice :input, #form_nuevo_subindice :input, #form_editar_subindice :input').blur(function() {
$(".text-error").html("");
});
});

//Formulario de sesi�n
function form_sesion()
{
//email
elemento = $("#admin").val();
var buscar = /^[0-9a-zA-Z������������������������_]+$/
if (elemento == "")
{
$("#e_admin").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar) || elemento.length > 50 || elemento.length < 3)
{
$("#e_admin").html("No v�lido").addClass("text-error");
return;
}
elemento = $("#password").val();
var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
if (elemento == "")
{
$("#e_password").html("Campo de texto obligatorio").addclass("text-error");
return;
}
else if(!elemento.match(buscar))
{
$("#e_password").html("La contrase�a debe contener n�meros y letras").addclass("text-error");
return;
}
else if(elemento.length < 8 || elemento.length > 16)
{
$("#e_password").html("Entre 8 y 16 caracateres").addclass("text-error");
return;
}
else
{
$("#form_sesion").submit();
}
}


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
$("#e_password").html("La contrase�a debe contener n�meros y letras").addclass("text-error");
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
$("#e_repetir_password").html("Las contrase�as no coinciden").addClass("text-error");
return;
}
else
{
$("#form_recuperar_2").submit();
}
}
/* form recuperar password 2 */


/* form nuevo indice*/
function form_nuevo_indice()
{
elemento = $("#titulo").val();
if (elemento.length < 3 || elemento.length > 100)
{
$("#e_titulo").html("No menos de 3 caracteres ni m�s de 100").addClass("text-error");
return;
}

elemento = $("#descripcion").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_descripcion").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}

elemento = $("#keywords").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_keywords").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}
else
{
$("#form_nuevo_indice").submit();
}
}
$(function(){
$('#descripcion').bind('input propertychange', function() {

$("#e_descripcion").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_descripcion").text(this.value.length);
		return;
      }
});
});
/* form nuevo indice*/

/* form editar indice*/
function form_editar_indice()
{
elemento = $("#titulo").val();
if (elemento.length < 3 || elemento.length > 100)
{
$("#e_titulo").html("No menos de 3 caracteres ni m�s de 100").addClass("text-error");
return;
}

elemento = $("#descripcion").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_descripcion").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}

elemento = $("#keywords").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_keywords").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}
else
{
$("#form_editar_indice").submit();
}
}
$(function(){
$('#descripcion').bind('input propertychange', function() {

$("#e_descripcion").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_descripcion").text(this.value.length);
		return;
      }
});
});
/* form nuevo indice*/

/* botones eliminar y editar elementos */

	$(function(){
	$("#editar").click(function(){
	$("#form_editar").html("");
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	window.location.href = "index.php?action=editar-indice&id_categoria="+$(this).val();
	return false;
	}
	});
	});
	
		$("#eliminar").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_eliminar").append("<input type='hidden' name='item_a_eliminar["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_eliminar").submit();
	});
	});

/* botones eliminar y editar elementos */

/* form nuevo indice*/
function form_nuevo_subindice()
{
elemento = $("#titulo").val();
if (elemento.length < 3 || elemento.length > 100)
{
$("#e_titulo").html("No menos de 3 caracteres ni m�s de 100").addClass("text-error");
return;
}

elemento = $("#descripcion").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_descripcion").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}

elemento = $("#keywords").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_keywords").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}
else
{
$("#form_nuevo_subindice").submit();
}
}
$(function(){
$('#descripcion').bind('input propertychange', function() {

$("#e_descripcion").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_descripcion").text(this.value.length);
		return;
      }
});
});
/* form nuevo indice*/

/* form editar indice*/
function form_editar_subindice()
{
elemento = $("#titulo").val();
if (elemento.length < 3 || elemento.length > 100)
{
$("#e_titulo").html("No menos de 3 caracteres ni m�s de 100").addClass("text-error");
return;
}

elemento = $("#descripcion").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_descripcion").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}

elemento = $("#keywords").val();
if (elemento.length < 5 || elemento.length > 500)
{
$("#e_keywords").html("No menos de 5 caracteres ni m�s de 500").addClass("text-error");
return;
}
else
{
$("#form_editar_subindice").submit();
}
}
$(function(){
$('#descripcion').bind('input propertychange', function() {

$("#e_descripcion").text(this.value.length);

if(this.value.length > 500){
		this.value = this.value.substr(0, 500);
        $("#e_descripcion").text(this.value.length);
		return;
      }
});
});
/* form nuevo indice*/

/* botones eliminar y editar elementos */

	$(function(){
	$("#editar_sub").click(function(){
	$("#form_editar_sub").html("");
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	window.location.href = "index.php?action=editar-subindice&id_subcategoria="+$(this).val();
	return false;
	}
	});
	});
	
		$("#eliminar_sub").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_eliminar_sub").append("<input type='hidden' name='item_a_eliminar["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_eliminar_sub").submit();
	});
	});

/* botones eliminar y editar elementos */

/*form eliminar, abrir y cerrar temas */
$(function(){
		$("#eliminar_temas").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_eliminar_temas").append("<input type='hidden' name='item_a_eliminar["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_eliminar_temas").submit();
	});
	
			$("#cerrar_temas").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_cerrar_temas").append("<input type='hidden' name='item_a_cerrar["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_cerrar_temas").submit();
	});
	
	$("#abrir_temas").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_abrir_temas").append("<input type='hidden' name='item_a_abrir["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_abrir_temas").submit();
	});
	});
/*form eliminar, abrir y cerrar temas */


/*form administrar mensajes */
$(function(){	
				$("#btn_eliminar_mensaje").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_eliminar_mensaje").append("<input type='hidden' name='item_eliminar_mensaje["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_eliminar_mensaje").submit();
	});
});
/*form administrar mensajes */

/*usuarios*/
$(function()
{
$("#btn_id_usuario").click(function()
{
form_id_usuario();
});

desmarcar = function(){
elemento = $(":input[name='usuarios']");
elemento.prop("checked", false);
}

marcar = function(){
elemento = $(":input[name='usuarios']");
elemento.prop("checked", true);
}

$("#enviarEmail_usuarios").click(function()
{
usuarios = "";
$(":input[name='usuarios']").each(function(index)
{
if ($(this).is(":checked")){
usuarios += $(":input[name='email_usuarios["+index+"]']").attr("value")+",";
}
});
users_email = usuarios.substring(0, usuarios.length - 1);
document.getElementById("destinatarios").value = users_email;
});

$("#importar_emails").click(function(){
document.getElementById("destinatarios").value = document.getElementById("todos_emails").value;
});

$("#limpiar_emails").click(function(){
document.getElementById("destinatarios").value = "";
});

$("#ayuda_emails").tooltip();

		$("#eliminar_usuarios").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_eliminar_usuarios").append("<input type='hidden' name='item_eliminar_usuarios["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_eliminar_usuarios").submit();
	});
	
			$("#bloquearIP_usuarios").click(function(){
	$(":checkbox").each(function(index)
	{
	if ($(this).is(":checked") == true)
	{
	$("#form_bloquearIP_usuarios").append("<input type='hidden' name='item_bloquearIP_usuarios["+index+"]' value='"+$(this).val()+"'>");
	}
	});
	$("#form_bloquearIP_usuarios").submit();
	});
	
});

function form_id_usuario()
{
elemento = $("#id_usuario").val();
//codigo
var buscar = /^[0-9]+$/
if (elemento == "")
{
$("#e_id_usuario").html("Campo de texto obligatorio").addClass("text-error");
return;
}
else if(!elemento.match(buscar))
{
$("#e_id_usuario").html("Error s�lo n�meros").addClass("text-error");
return;
}
else
{
$("#form_id_usuario").submit();
}
}
/*usuarios*/


/* estad�sticas */
$(function(){
	$('#visitas_desde, #visitas_hasta').datepicker({
				format: 'dd-mm-yyyy',
				weekStart: 1
			});
});

function fechas()
{
elemento = $("#visitas_desde").val();
buscar = /^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/
if (!elemento.match(buscar))
{
alert("Error en el formato de fecha");
return;
}

elemento = $("#visitas_hasta").val();
buscar = /^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/
if (!elemento.match(buscar))
{
alert("Error en el formato de fecha");
return;
}
else
{
$("#form_fecha").submit();
}
}
/* estad�sticas */