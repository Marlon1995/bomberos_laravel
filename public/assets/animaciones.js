var msgCounter=0;
//
function ErrorMsg(ErrorText) {
    $('#MsgAlerta').empty();
    msgCounter++;
    var IdErrorMsg = 'IdErrorMsg'+msgCounter;
    var txt = " <center>\n" +
        "                    <div id = "+IdErrorMsg+" class='Error'    align='left'>\n" +
        "                        <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>\n" +
        "                        <strong>Alerta!</strong>\n" + ErrorText +
        "                    </div>\n" +
        "        </center><br>";
    $('#MsgAlerta').append(txt);
    setInterval(function() {
        $('#'+IdErrorMsg).hide();
    }, 5000)
    return txt;
}
function ExitoMsg(ErrorText) {
    $('#MsgAlerta').empty();
    msgCounter++;
    var IdErrorMsg = 'ExitoMsg'+msgCounter;
    var txt = " <center>\n" +
        "                    <div id = "+IdErrorMsg+" class='Exito'    align='left'>\n" +
        "                        <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>\n" +
        "                        <strong>Alerta!</strong>\n" + ErrorText +
        "                    </div>\n" +
        "        </center><br>";
    $('#MsgAlerta').append(txt);
    setInterval(function() {
        $('#'+IdErrorMsg).hide();
    }, 5000)
    return txt;
}
function fn_cargando() {
    //mostrar el div
    var value = 4;
    var testObj = document.getElementById( "darkBack" );
    testObj.style.display = 'block';
    testObj.style.height = document.getElementsByTagName('body')[0].scrollHeight + 5;
    testObj.style.opacity = value/10;
    testObj.style.filter = 'alpha(opacity=' + value*10 + ')';
    var testObj = document.getElementById( "whiteBackWait" );
    testObj.style.display = 'block';
}
function fn_terminar(){
    document.getElementById('darkBack').style.display='none';
    document.getElementById('whiteBackWait').style.display='none';
}

function fn_aceptaNum(evt) {
    tecla = (document.all) ? evt.keyCode : evt.which;
    if (tecla == 8 || tecla == 0) {
        return true;
    }
    patron = /[\d.]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function fn_eliminaEspacios(lc_cadena) {
    // Funcion equivalente a trim en PHP
    var x = 0, y = lc_cadena.length - 1;
    while (lc_cadena.charAt(x) == " ")
        x++;
    while (lc_cadena.charAt(y) == " ")
        y--;
    return lc_cadena.substr(x, y - x + 1);
}

function fn_aceptaNum_Rec(evt) {
    var nav4 = window.Event ? true : false;
    // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 45 && key <= 57 && key != 47));
}

function fn_numeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8 || tecla == 0) {
        return true;
    }
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function fn_numerosEnter(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8 || tecla == 0) {
        return true;
    } else if (tecla == 13) {
        return true;
    }
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function fn_ip(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8 || tecla == 0)
    {
        return true;
    }
    patron = /[\d.]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function fn_Albatetico( event ) {
    if(event.shiftKey)
        event.preventDefault();
    if (event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39)
        if($(this).val().length >= 200)
            event.preventDefault();
    if (event.keyCode < 48 || event.keyCode > 57)
        if (event.keyCode < 65 || event.keyCode > 90)
            if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 110 && event.keyCode !=190 )
                event.preventDefault();

}



function enter_numeros_iva(myfield,e)
{

    if (window.event) keycode = window.event.keyCode;
    var neta;
    var iva;
    var compensacionL;
    var venta_cero=0;
    var bruto;
    var aux;
    var tipo=document.getElementById("tipo_impuesto").value;
    var comp=document.getElementById("compensacion").value;

    if(tipo == 1){
        venta_cero=document.getElementById("lc_venta_cero").value;
        if(comp == 1){
            bruto = myfield.value;
            if(venta_cero == bruto){
                neta = myfield.value/1;
                iva = 0/1;
            }
            else{
                neta=(myfield.value- venta_cero)/document.getElementById("diva12").value;
                iva=neta* document.getElementById("miva").value;
            }
        }else{
            neta=(myfield.value- venta_cero)/document.getElementById("diva").value;
            iva=neta* document.getElementById("miva").value;

        }
    }else{
        if(comp  == 1){
            neta=myfield.value/document.getElementById("diva12").value;
        }
        else{
            neta=myfield.value/document.getElementById("diva").value;
        }
        iva=neta* document.getElementById("miva").value;
    }

    //----------compensacion valor-------
    if(comp  == 1 && venta_cero != bruto){
        aux=0;
        aux=neta+iva;
        compensacionL=myfield.value-aux-venta_cero;
        document.getElementById("lc_compensacion").value=compensacionL.toFixed(2);
    }
    //----------------*----------------
    document.getElementById("lc_venta_neta").value=neta.toFixed(2);
    document.getElementById("lc_iva").value=iva.toFixed(2);




    if(event.keyCode!=13) return;
    for(var i=0;i<f.length;i++)
    {
        if(field.name==f.item(i).name)
        {
            next=i+1;
            found=true
            break;
        }
    }
    while(found)
    {
        if( f.item(next).disabled==false && f.item(next).type!='hidden')
        {
            f.item(next).focus();
            break;
        }
        else
        {
            if(next<f.length-1)
                next=next+1;
            else
                break;
        }
    }



    return false;
}



function enter_numeros(myfield,e)
{
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;

    if (keycode == 13)
    {
        myfield.form.submit();
        return false;
    }
    if (!((event.keyCode>=48) && (event.keyCode<=57))) {
        event.keyCode=0;
    }
}


function fn_tab(form,field)
{
//alert(1);
    var next=0, found=false
    var f=form
    if(event.keyCode!=13) return;
    for(var i=0;i<f.length;i++)
    {
        if(field.name==f.item(i).name)
        {
            next=i+1;
            found=true
            break;
        }
    }
    while(found)
    {
        if( f.item(next).disabled==false && f.item(next).type!='hidden')
        {
            f.item(next).focus();
            break;
        }
        else
        {
            if(next<f.length-1)
                next=next+1;
            else
                break;
        }
    }
}

function enter(myfield,e)
{
    var keycode;
    if (window.event)
        keycode = window.event.keyCode;
    else
    if (e)
        keycode = e.which;
    else
        return true;

    if (keycode == 13)
    {
        myfield.form.submit();
        return false;
    }else
        return true;

}




function maximoCaracteresInput(e, max) {
    if(e.key.length === 1){
        if($(this).val().length < max && !isNaN(parseFloat(e.key))){
            $(this).val($(this).val() + e.key);
        }
        return false;
    }
}


function fn_aceptaLETRAS(e) {
    tecla = (document.all)?e.keyCode:e.which;
    if (tecla==8) return true;
    //patron = /\w/;
    patron =/[\/ A-Za-z]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}