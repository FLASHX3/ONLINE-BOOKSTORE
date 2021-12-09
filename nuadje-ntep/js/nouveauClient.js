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
    var regex=/^[a-zA-Zéèêâôï- ]{0,25}$/;

    if(nom.value=="")
    {
        surligne(nom,false);
        a=false;
    }
    else
    {
        if(!regex.test(nom.value))
        {
            surligne(nom,true);
            a=false;
        }
        else
        {
            surligne(nom,false);
            a=true;
        }
    }
    return a;
}

function verifPrenom(prenom)
{
    var regex=/^[a-zA-Zéèêâôï- ]{0,25}$/;

    if(prenom.value=="")
    {
        surligne(prenom,false);
        b=false;
    }
    else
    {
        if(!regex.test(prenom.value))
        {
            surligne(prenom,true);
            b=false;
        }
        else
        {
            surligne(prenom,false);
            b=true;
        }
    }
    return b;
}

function verifEmail(email)
{
    regex=/^[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-z]{2,4}$/;

    if(email.value=="")
    {
        surligne(email,true);
        c=false;
    }
    else
    {
        if (!regex.value(email.value))
        {
            surligne(email,true);
            c=false;
        }
        else
        {
            surligne(email,false);
            c=true;
        }
    }
    return c;
}

function verifPassword(mdp)
{
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8}$/;
    
	if(mdp.value=="")
    {
		surligne(mdp,false);
        d=false;
	}else
    {
		if(!regex.test(mdp.value))
		{
			d=false;
			surligne(mdp,true);
		}
        else
        {
			d=true;
			surligne(mdp,false);
		}
	}
	return d;
}

function verifConfPassword(cmdp)
{
	var test=verifPassword(document.getElementById('password'));
	var regex=/^[a-zA-Z0-9éèôâêîï.-_*@&$]{8}$/;
	if(cmdp.value==""){
		surligne(cmdp,false);
	}else{
		if(regex.test(cmdp.value)){
			if(test){
				if(cmdp.value==document.getElementById('password').value)
				{
					e=true;
					surligne(cmdp,false);
				}else{
					e=false;
					surligne(cmdp,true);
				}
			}else{
				e=false;
				surligne(cmdp,true);
			}
		}else{
			e=false;
			surligne(cmdp,true);
		}
	}
	return e;
}

function verifAdresse(tel){
	var regex=/^6([-. ]?[0-9]{2}){4}$/;

    if (tel.value=="")
    {
        surligne(tel,false);
        f=false;
    }
    else{
        if(!regex.test(tel.value))
        {
            f=false;
            surligne(tel,true);
        }
        else
        {
            f=true;
            surligne(tel,false);
        }
    }
	return f;
}

function verifAdrLivr(ville){
	var regex=/^[A-Z][a-zA-Z-éè ]{3,38}$/;

    if(ville.value=="")
    {
        surligne(ville,false);
        g=false;
    }
    else{
        if(!regex.test(ville.value))
        {
            g=false;
            surligne(ville,true);
        }
        else{
            g=true;
            surligne(ville,false);
        }
    }
	return g;
}