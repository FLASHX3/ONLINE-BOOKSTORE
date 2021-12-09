var a  //verificateur de login
var b  //verificateur de mot de passe

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

function verifLogin(login)
{
    var erreur= document.getElementById('errlog');
    var regex=/^[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-z]{2,4}$/;

    if(login.value=="")
    {
		surligne(login,false);
		erreur.innerHTML="";
        a=false;
	}
    else
    {
        if(!regex.test(login.value))
        {
            surligne(login,true);
            a=false;
            erreur.innerHTML="email invalid!";
        }
        else{
            surligne(login,false);
            a=true;
            erreur.innerHTML="";
        }
    }
    return a;
}

function verifMdp(mdp)
{
    var erreur=document.getElementById('errmdp');
    var regex=/^[a-zA-Z0-9.-_*@&$]{8,16}$/;

    if(mdp.value=="")
    {
        surligne(mdp,false);
        erreur.innerHTML="";
        b=false;
    }
    else
    {
        if(!regex.test(mdp.value))
        {
            surligne(mdp,true);
            b=false;
            erreur.innerHTML="Mot de passe invalide!";
        }
        else
        {
            surligne(mdp,false);
            b=true;
            erreur.innerHTML="";
        }
    }
    return b;
}

function verifForm(form)
{
    var loginOk=verifLogin(form.login);
    var mdpOk=verifMdp(form.password);

    if(loginOk && mdpOk)
    {
        return true;
    }
    else
    {
        return false;
    }
}