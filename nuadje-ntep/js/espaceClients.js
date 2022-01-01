function ouvre_popup(page)
{
    window.open(page,"nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=500");
}

function fermer()
{
    var div=document.getElementById('popup');
    div.style.display="none";
}