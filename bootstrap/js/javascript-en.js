/*limitar contenido en los elementos*/
function text_ellipsis(elemento, max_chars)
{
    limite_text = $(elemento).html();
    if (limite_text.length > max_chars)
    {
        limite = limite_text.substr(0, max_chars) + " ...";
        $(elemento).html(limite);
    }
}

$(function() {
    $("#button_registrarse").click(function() {
        form_registrarse();
    });

    $("#button_activar").click(function() {
        form_activar();
    });

    $("#button_recuperar_1").click(function() {
        form_recuperar_1();
    });

    $("#button_recuperar_2").click(function() {
        form_recuperar_2();
    });

    $("#button_nuevo_tema").click(function() {
        form_nuevo_tema();
    });

    $("#button_nuevo_comentario").click(function() {
        form_nuevo_comentario();
    });

    $("#button_contacto").click(function() {
        form_contacto();
    });

//Cambio de input
    $('#form_registrarse :input, #form_activar :input, #form_recuperar_1 :input, #form_recuperar_2 :input, #form_nuevo_tema :input, #form_nuevo_comentario :input').blur(function() {
        $(".text-error").html("");
    });
});

/*formulario registrarse*/
$(function() {
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
        $("#e_nick").html("Required").addClass("text-error");
        return;
    }

//nombre
    elemento = $("#nombre").val();
    var buscar = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/
    if (elemento == "")
    {
        $("#e_nombre").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 50)
    {
        $("#e_nombre").html("Only letters").addClass("text-error");
        return;
    }


//apellidos
    elemento = $("#apellidos").val();
    var buscar = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/
    if (elemento == "")
    {
        $("#e_apellidos").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 50)
    {
        $("#e_apellidos").html("Only letters").addClass("text-error");
        return;
    }

//email
    elemento = $("#email").val();
    var buscar = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/
    if (elemento == "")
    {
        $("#e_email").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 80)
    {
        $("#e_email").html("Incorrect email").addClass("text-error");
        return;
    }

//password
    elemento = $("#password").val();
    var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
    if (elemento == "")
    {
        $("#e_password").html("Required").addclass("text-error");
        return;
    }
    else if (!elemento.match(buscar))
    {
        $("#e_password").html("Numbers and letters").addClass("text-error");
        return;
    }
    else if (elemento.length < 8 || elemento.length > 16)
    {
        $("#e_password").html("Between 8 and 16 char").addClass("text-error");
        return;
    }

    elemento = $("#repetir_password").val();
    if (elemento != $("#password").val())
    {
        $("#e_repetir_password").html("Passwords do not match").addClass("text-error");
        return;
    }

    if (!$('#terminos').is(':checked'))
    {
        $("#e_terminos").html("Accept the terms").addClass("text-error");
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
        $("#e_email").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 80)
    {
        $("#e_email").html("Incorrect email").addClass("text-error");
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
        $("#e_password").html("Required").addclass("text-error");
        return;
    }
    else if (!elemento.match(buscar))
    {
        $("#e_password").html("Numbers and letters").addclass("text-error");
        return;
    }
    else if (elemento.length < 8 || elemento.length > 16)
    {
        $("#e_password").html("Between 8 and 16 char").addclass("text-error");
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
        $("#e_email").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 80)
    {
        $("#e_email").html("Incorrect email").addClass("text-error");
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
        $("#e_email").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 80)
    {
        $("#e_email").html("Incorrect email").addClass("text-error");
        return;
    }

//password
    elemento = $("#password").val();
    var buscar = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i
    if (elemento == "")
    {
        $("#e_password").html("Required").addclass("text-error");
        return;
    }
    else if (!elemento.match(buscar))
    {
        $("#e_password").html("Numbers and letters").addclass("text-error");
        return;
    }
    else if (elemento.length < 8 || elemento.length > 16)
    {
        $("#e_password").html("Between 8 and 16 char").addclass("text-error");
        return;
    }
//repetir password
    elemento = $("#repetir_password").val();
    if (elemento != $("#password").val())
    {
        $("#e_repetir_password").html("Passwords do not match").addClass("text-error");
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
        $("#e_titulo").html("Required").addClass("text-error");
        return;
    }
    else if (!elemento.match(buscar) || elemento.length > 100)
    {
        $("#e_titulo").html("char no valid").addClass("text-error");
        return;
    }

    var comentario = tinymce.activeEditor.getContent();
    if (comentario.length > 500 || comentario.length < 50)
    //if (document.getElementById("comentario").value.length > 500 || document.getElementById("comentario").value.length < 50)
    {
        comentario = comentario.substr(0, 500);
        //document.getElementById("comentario").value = document.getElementById("comentario").value.substr(0, 500);
        $("#e_comentario").text("no more than 500 or less than 50 char");
        return;
    }
    else
    {
        $("#form_nuevo_tema").submit();
    }
}

$(function() {

    $('#comentario').bind('input propertychange', function() {

        $("#e_comentario").text(this.value.length);

        if (this.value.length > 500) {
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

    $("#box_image .ok").click(function() {
        elemento = $("#imagen").val();
        buscar = /^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i
        if (!elemento.match(buscar) && elemento != "")
        {
            alert("Incorrect image");
            $("#label-imagen").text("");
            return;
        }
        else if (elemento.length > 150)
        {
            alert("Limit char");
            $("#label-imagen").text("");
            return;
        }
        else
        {
            if (elemento != "")
            {
                $("#_imagen").val(elemento);
                $("#label-imagen").text("IMAGE INCLUDED");
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

    $("#box_url .ok").click(function() {
        elemento = $("#url").val();
        buscar = /^(ht|f)tps?:\/\/\w+(.*)$/i
        if (!elemento.match(buscar) && elemento != "")
        {
            alert("Incorrect URL");
            $("#label-url").text("");
            return;
        }
        else if (elemento.length > 150)
        {
            alert("Limit char.");
            $("#label-imagen").text("");
            return;
        }
        else
        {
            if (elemento != "")
            {
                $("#_url").val(elemento);
                $("#label-url").text("URL INCLUDED");
            }
            if (elemento == "")
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
    var comentario = tinymce.activeEditor.getContent();
    if (comentario.length > 500 || comentario.length < 50)
    //if (document.getElementById("comentarioC").value.length > 500 || document.getElementById("comentarioC").value.length < 50)
    {
        comentario = comentario.substr(0, 500);
        //document.getElementById("comentarioC").value = document.getElementById("comentarioC").value.substr(0, 500);
        $("#e_comentarioC").text("no more than 500 or less than 50 char");
        return;
    }
    else
    {
        $("#form_nuevo_comentario").submit();
    }
}

$(function() {

    $('#comentarioC').bind('input propertychange', function() {

        $("#e_comentarioC").text(this.value.length);

        if (this.value.length > 500) {
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

    $("#box_imageC .ok").click(function() {
        elemento = $("#imagenC").val();
        buscar = /^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i
        if (!elemento.match(buscar) && elemento != "")
        {
            alert("Incorrect image");
            $("#label-imagenC").text("");
            return;
        }
        else if (elemento.length > 150)
        {
            alert("Limit char.");
            $("#label-imagen").text("");
            return;
        }
        else
        {
            if (elemento != "")
            {
                $("#_imagenC").val(elemento);
                $("#label-imagenC").text("IMAGE INCLUDED");
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

    $("#box_urlC .ok").click(function() {
        elemento = $("#urlC").val();
        buscar = /^(ht|f)tps?:\/\/\w+(.*)$/i
        if (!elemento.match(buscar) && elemento != "")
        {
            alert("URL incorrecta");
            $("#label-urlC").text("");
            return;
        }
        else if (elemento.length > 150)
        {
            alert("Limit char.");
            $("#label-imagen").text("");
            return;
        }
        else
        {
            if (elemento != "")
            {
                $("#_urlC").val(elemento);
                $("#label-urlC").text("URL INCLUDED");
            }
            if (elemento == "")
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
        $("#e_contacto").text("no more than 500 or less than 50 char");
        return;
    }
    else
    {
        $("#form_contacto").submit();
    }
}


$(function() {

    $('#contacto').bind('input propertychange', function() {

        $("#e_contacto").text(this.value.length);

        if (this.value.length > 250) {
            this.value = this.value.substr(0, 250);
            $("#e_contacto").text(this.value.length);
            return;
        }
    });
});
/* form contacto */