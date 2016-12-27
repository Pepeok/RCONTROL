//********************************************************************************************************************************************
//valida rut
    function revisarDigito(componente)
    {   
       var crut =  componente
       largo = crut.length;   
       if ( largo < 2 )   
       {      
          return false;   
       }   
       if ( largo > 2 )      
          rut = crut.substring(0, largo - 1);   
       else      
       rut = crut.charAt(0);   
       dv = crut.charAt(largo-1);   
       
       if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')   
       {      
          return false;   
       }      

       if ( rut == null || dv == null )
          return 0   

       var dvr = '0'   
       suma = 0   
       mul  = 2   

       for (i= rut.length -1 ; i >= 0; i--)   
       {   
          suma = suma + rut.charAt(i) * mul      
          if (mul == 7)         
             mul = 2      
          else             
             mul++   
       }   
       res = suma % 11   
       if (res==1)      
          dvr = 'k'   
       else if (res==0)      
          dvr = '0'   
       else   
       {      
          dvi = 11-res      
          dvr = dvi + ""   
       }
       if ( dvr != dv)   
       {      
          return false   
       }

       return true
    }

function esrut(rut) {
    document.form2.dv_func.value = " ";//limpio el valor del campo dv

    if (rut == 0) {
        document.form2.rut_func.focus();//me posiciono en el campo nuevamente
        document.form2.dv_func.value = " ";//limpio el valor del campo dv
    } else {
        if (GetDigVer(rut) == false) {
            alert("El RUT " + rut + " no es válido");
            document.form2.dv_func.value = " ";//limpio el valor del campo dv
            document.form2.rut_func.value = " ";//limpio el valor del campo rut
            document.form2.rut_func.focus();//me posiciono en el campo nuevamente
        } else {
          var  dv =document.getElementById('dv_func').value;
          var rut=document.getElementById('rut_func').value;
            var color = (color == "#ffffff")? "red" : "#ffffff";
            var rutcompleto=(rut+"-"+dv);
            
           if (validarut(rut,dv)==false){
                document.getElementById('rut_func').style.background='red'; 
               document.getElementById('botones').style.display = 'none'; 
           }else{
               document.getElementById('botones').style.display = 'block';
           }
            
        }
    }
}
//-------------------------------------------------------------------------------------------------------//        
   
	
	function LTrim(str){
		for(var i=0;str.charAt(i)==" ";i++);
		return str.substring(i,str.length);
	}
function RTrim(str) {
    for (var i = str.length - 1; str.charAt(i) == " "; i--)
        ;
    return str.substring(0, i + 1);
}
function Trim(str) {
    return LTrim(RTrim(str));
}
// esta funcion necesita de Ltrim, Rtrim y Trim para funcionar
function GetDigVer(RutSolo) {
    var once = 11;
    var largo = 0;
    var suma = 0;
    var resto = 0;
    var fin = 0;
    var dig = 0;
    var largo = Trim(RutSolo).length;
    var multiplo = 2;

    while (largo != 0) {
        dig = RutSolo.substr(largo - 1, 1);
        ShowLargo = largo
        ShowDig = dig;
        largo = largo - 1;
        suma = suma + (dig * multiplo);
        ShowSuma = suma
        ShowMultiplo = multiplo
        multiplo = multiplo + 1;
        if (multiplo > 7) {
            multiplo = 2;
        }
    }

    resto = suma - (Math.floor(suma / once) * once);//esto entrega el el equivalente a suma mod 11, o fmod(suma,once)
    fin = once - resto;

    if (fin == 10) {
        digver = "K";
    } else {
        if (fin == 11) {
            digver = 0;
        } else {
            digver = fin;
            
        }
    }
    document.getElementById('dv_func').value = digver;

    return true;
}



// Valida el rut con su cadena completa "XXXXXXXX-X"
function validaRut(rut) {
    alert(rut);
    var rexp = new RegExp(/^([0-9])+\-([kK0-9])+$/);
    if (rut.match(rexp)) {
        var RUT = rut.split("-");
        var elRut = RUT[0].split('');
        var factor = 2;
        var suma = 0;
        var dv;
        for (i = (elRut.length - 1); i >= 0; i--) {
            factor = factor > 7 ? 2 : factor;
            suma += parseInt(elRut[i]) * parseInt(factor++);
        }
        dv = 11 - (suma % 11);
        if (dv == 11) {
            dv = 0;
        } else if (dv == 10) {
            dv = "k";
        }

        if (dv == RUT[1].toLowerCase()) {
            alert("El rut es válido!!");
            return true;
        } else {
            alert("El rut es incorrecto");
            return false;
        }
    } else {
        alert("Formato incorrecto");
        return false;
    }
}
	
	
	function poneptos(rut){
		limite = rut.length-1;
		indice = 0;
		nuevoRut = '';
		rutConPuntos = '';
		for (i = limite; i >= 0; i--){
			indice ++;
			if (indice == 3){
				nuevoRut = nuevoRut.concat(rut.substr(i,1),'.');
				indice = 0;
			} else{
				nuevoRut = nuevoRut.concat(rut.substr(i,1));
			}
		}
		limiteConPuntos = nuevoRut.length-1;
		for (i = limiteConPuntos; i >= 0; i--){
			rutConPuntos = rutConPuntos.concat(nuevoRut.substr(i,1));
		}
		if (rutConPuntos.substr(0,1) == '.'){
			rutConPuntos = rutConPuntos.substr(1) 
		}
		return rutConPuntos;
	}
	
	
	function alertUser(r){
		document.getElementById('txt_alert').innerHTML = 'Copiado al ' + r;
	}
        
        
        



function vaciar(control) 
{ 
control.value=''; 
document.getElementById('rut_func').style.background='';  
document.getElementById('botones').style.display = 'block';
} 

function validarut(ruti,dvi){
 var rut = ruti+"-"+dvi;
 if (rut.length<9)
     return(false)
  i1=rut.indexOf("-");
  dv=rut.substr(i1+1);
  dv=dv.toUpperCase();
  nu=rut.substr(0,i1);
 
  cnt=0;
  suma=0;
  for (i=nu.length-1; i>=0; i--)
  {
    dig=nu.substr(i,1);
    fc=cnt+2;
    suma += parseInt(dig)*fc;
    cnt=(cnt+1) % 6;
   }
  dvok=11-(suma%11);
  if (dvok==11) dvokstr="0";
  if (dvok==10) dvokstr="K";
  if ((dvok!=11) && (dvok!=10)) dvokstr=""+dvok;
 
  if (dvokstr==dv)
     return(true);
  else
     return(false);
}