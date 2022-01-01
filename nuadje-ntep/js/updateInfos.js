var a  //verificateur d'adresse
var b  //verificateur d'adresse de livraison
var c  //verificateur de mot de passe
var d  //verificateur du confirmateur de mot de passe

function surligne(champ,erreur)
{
	if(erreur)
	{
		champ.style.borderColor="red";
	}
	else
	{
		champ.style.borderColor="";
	}
}

function verifTel(tel)
{
    var regex=/^6([-. ]?[0-9]{2}){4}$/;
    var erreur= document.getElementById('errtel');

    if (tel.value=="")
    {
        surligne(tel,false);
        erreur.innerHTML="";
        a=false;
    }
    else
    {
        if(!regex.test(tel.value))
        {
            a=false;
            surligne(tel,true);
            erreur.innerHTML="le numéro doit commencer par 6 et contient 9 chiffres!";
        }
        else
        {
            a=true;
            surligne(tel,false);
            erreur.innerHTML="";
        }
    }
    return a;
}

function verifAdrLivr(ville){
	var regex=/^[a-zA-Z0-9éèêâôïç -]{1,38}$/;
    var erreur=document.getElementById('errville');

    if(ville.value=="")
    {
        surligne(ville,false);
        b=false;
        erreur.innerHTML="";
    }
    else{
        if(!regex.test(ville.value))
        {
            b=false;
            surligne(ville,true);
            erreur.innerHTML="adresse de livraison invalide!";
        }
        else{
            b=true;
            surligne(ville,false);
            erreur.innerHTML="";
        }
    }
	return b;
}

function verifPassword(mdp,v)
{
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$/;
    var erreur=document.getElementById('errpass');

    if(v==undefined)
    {
        var erreur=document.getElementById('errpass');
    }
    else
    {
        var erreur=document.getElementById('errnewpass');
    }
    
	if(mdp.value=="")
    {
		surligne(mdp,false);
        c=false;
        erreur.innerHTML="";
	}else
    {
		if(!regex.test(mdp.value))
		{
			c=false;
			surligne(mdp,true);
            erreur.innerHTML="le mot de passe doit être constitué de 8 à 16 caratères sans caractères spéciaux!";
		}
        else
        {
			c=true;
			surligne(mdp,false);
            erreur.innerHTML="";
		}
	}
	return c;
}

function confirmPassword(cmdp)
{
	var test=verifPassword(document.getElementById('newpassword'),1);
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$/;
    var erreur=document.getElementById('errcpass');
	if(cmdp.value==""){
		surligne(cmdp,false);
        d=false;
        erreur.innerHTML="";
	}
    else
    {
		if(regex.test(cmdp.value)){
			if(test){
				if(cmdp.value==document.getElementById('newpassword').value)
				{
					d=true;
					surligne(cmdp,false);
                    erreur.innerHTML="";
				}else{
					d=false;
					surligne(cmdp,true);
                    erreur.innerHTML="Les mots de passe ne sont pas identiques";
				}
			}else{
				d=false;
				surligne(cmdp,true);
                document.getElementById('errnewpass').innerHTML="le mot de passe doit être constitué de 8 à 16 caratères sans caractères spéciaux!";
			}
		}else{
			d=false;
			surligne(cmdp,true);
            erreur.innerHTML="le mot de passe doit être constitué de 8 à 16 caratères sans caractères spéciaux!";
		}
	}
	return d;
}

function verifForm(form)
{
    adresseOk=verifTel(form.adresse);
    adressLivraisonOk=verifAdrLivr(form.adrlivr);
    passwordOk=verifPassword(form.password);
    newpasswordOk=verifPassword(form.newpassword,1);
    confirmpasswordOk=confirmPassword(form.confpassword);

    if(adresseOk || adresseLivraisonOk || (passwordOk && newpasswordOk && confirmpasswordOk))
    {
        return true;
    }
    else
    {
        return false;
    }
}