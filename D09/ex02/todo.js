var ft_list;
var cookie = new Array();
var hold = new Array();

window.onload = function() {
	this.document.querySelector("#submit").addEventListener("click", newI);
	ft_list = this.document.querySelector("#ft_list");
	var temp = getCookie("Todo");
	if (temp){
        if (temp.length > 0)
            cookie = JSON.parse(temp);
		cookie.forEach(function (e)
		{
			add(e);
		});
	}
}

function newI()
{
	var info = prompt("What would you like to do?", "");
	if (info)
		add(info);
}

function save()
{
    setCookie("Todo", JSON.stringify(hold), 999999999);
}

function add(info)
{
	var elem = document.createElement("div");
    elem.innerHTML = info;
    hold.push(info);
    elem.addEventListener("click", del);
    ft_list.insertBefore(elem, ft_list.firstChild);
    save();
}

function del()
{
    if (confirm("Are you done with '" + this.innerHTML + "'"))
    {
        var i = 0;
        for (Todo in hold)
        {
            if (hold[Todo] == this.innerHTML)
            {
                hold.splice(i, 1);
                break;
            }
            i++;
        }
        this.parentElement.removeChild(this);
        save();
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}