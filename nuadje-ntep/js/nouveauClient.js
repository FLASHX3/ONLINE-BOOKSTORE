var a  //verificateur de nom
var b  //verificateur de prenom
var c  //verificateur d'email
var d  //verificateur de password
var e  //verificateur de confirmateur de password
var f  //verifiacteur d'adresse
var g  //verificateur de d'adresse d'adresse de livraison

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

function verifNom(nom)
{
    var regex=/^[a-zA-Zéèêâôï -]{0,25}$/;
    var erreur=document.getElementById('errnom');

    if(nom.value=="")
    {
        surligne(nom,false);
        erreur.innerHTML="";
        a=false;
    }
    else
    {
        if(!regex.test(nom.value))
        {
            surligne(nom,true);
            erreur.innerHTML="nom invalide!";
            a=false;
        }
        else
        {
            surligne(nom,false);
            erreur.innerHTML="";
            a=true;
        }
    }
    return a;
}

function verifPrenom(prenom)
{
    var regex=/^[a-zA-Zéèêâôï -]{0,25}$/;
    var erreur=document.getElementById('errprenom');

    if(prenom.value=="")
    {
        surligne(prenom,false);
        erreur.innerHTML="";
        b=false;
    }
    else
    {
        if(!regex.test(prenom.value))
        {
            surligne(prenom,true);
            erreur.innerHTML="prenom invalide!";
            b=false;
        }
        else
        {
            surligne(prenom,false);
            erreur.innerHTML="";
            b=true;
        }
    }
    return b;
}

function verifEmail(email)
{
    regex=/^[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-z]{2,4}$/;
    var erreur=document.getElementById('erremail');

    if(email.value=="")
    {
        surligne(email,true);
        erreur.innerHTML="";
        c=false;
    }
    else
    {
        if (!regex.test(email.value))
        {
            surligne(email,true);
            erreur.innerHTML="email invalid!";
            c=false;
        }
        else
        {
            surligne(email,false);
            erreur.innerHTML="";
            c=true;
        }
    }
    return c;
}

function verifPassword(mdp)
{
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$/;
    var erreur=document.getElementById('errpass');
    
	if(mdp.value=="")
    {
		surligne(mdp,false);
        erreur.innerHTML="";
        d=false;
	}else
    {
		if(!regex.test(mdp.value))
		{
			d=false;
            erreur.innerHTML="mot de passe doit contenir 8 caractères minimum!";
			surligne(mdp,true);
		}
        else
        {
			d=true;
            erreur.innerHTML="";
			surligne(mdp,false);
		}
	}
	return d;
}

function verifConfPassword(cmdp)
{
	var test=verifPassword(document.getElementById('password'));
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$/;
    var erreur=document.getElementById('errecpass');

	if(cmdp.value==""){
		surligne(cmdp,false);
        erreur.innerHTML="";
        e=false;
	}
    else
    {
		if(regex.test(cmdp.value)){
			if(test){
				if(cmdp.value==document.getElementById('password').value)
				{
					e=true;
					surligne(cmdp,false);
                    erreur.innerHTML="";
				}else{
					e=false;
					surligne(cmdp,true);
                    erreur.innerHTML="les mots de passe ne sont pas identiques";
				}
			}else{
				e=false;
                document.getElementById('password').innerHTML="mot de passe invalide!";
				surligne(cmdp,true);
			}
		}else{
			e=false;
            erreur.innerHTML="mot de passe invalide!";
			surligne(cmdp,true);
		}
	}
	return e;
}

function verifAdresse(tel){
	var regex=/^6([-. ]?[0-9]{2}){4}$/;
    var erreur=document.getElementById('erradr');

    if (tel.value=="")
    {
        surligne(tel,false);
        erreur.innerHTML="";
        f=false;
    }
    else
    {
        if(!regex.test(tel.value))
        {
            f=false;
            erreur.innerHTML="Le numéro de téléphone est invalide!";
            surligne(tel,true);
        }
        else
        {
            f=true;
            erreur.innerHTML="";
            surligne(tel,false);
        }
    }
	return f;
}

function verifAdrLivr(ville){
	var regex=/^[a-zA-Z0-9éèêâôïç -]{1,38}$/;
    var erreur=document.getElementById('erradrlivr');

    if(ville.value=="")
    {
        surligne(ville,false);
        erreur.innerHTML="";
        g=false;
    }
    else{
        if(!regex.test(ville.value))
        {
            g=false;
            erreur.innerHTML="adresse de livraison invalide!";
            surligne(ville,true);
        }
        else{
            g=true;
            erreur.innerHTML="";
            surligne(ville,false);
        }
    }
	return g;
}

function verifForm(form)
{
    var nomOk=verifNom(form.nom);
    var prenomOk=verifPrenom(form.prenom);
    var emailOk=verifEmail(form.email);
    var passwordOk=verifPassword(form.password);
    var cpasswordOk=verifConfPassword(form.cpassword);
    var adresseOk=verifAdresse(form.adresse);
    var adrLivrOk=verifAdrLivr(form.adrLivr);

    if(nomOk && prenomOk && emailOk && passwordOk && cpasswordOk && adresseOk && adrLivrOk)
    {
        return true;
    }
    else
    {
        return false;
    }
}