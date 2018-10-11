var ft_list;
var cookie = [];

window.onload = function() {
	this.document.querySelector("#New").addEventListener("click", newI);
	ft_list = this.document.querySelector(".ft_list");
	var temp = document.cookie;
	if (temp){
		cookie = JSON.parse(temp);
		cookie.forEach(function (e)
		{
			add(e);
		});
	}
}

window.onunload = function() {
	var items = ft_list.children;
	var newCook = [];
	for (var i = 0; i < items.length; i++)
		newCookie.push(items[i].innerHTML);
	document.cookie = JSON.stringify(newCook);
}

function newI()
{
	var info = prompt("What would you like to do?", "");
	if (info)
		add(info);
}

function add(info)
{
	var elem = document.createElement("div");
	elem.innerHTML = info;
	elem.addEventListener("click", del);
	ft_list.insertBefore(elem, ft_list.firstChild);
}

function del()
{
	if (confirm("Purge the matrix??"))
		this.parentElement.removeChild(this);
}