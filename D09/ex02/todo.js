var ft_list;
var cookie = new Array();

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

window.onunload = function() 
{
	save();
}

function save() {
	var items = ft_list.children;
	var newCook = [];
	for (var i = 0; i < items.length; i++)
		newCook.push(items[i].innerHTML);
	document.cookie = "ToDo="+ JSON.stringify(newCook) + "; expires=Thu, 18 Dec 3000 12:00:00 UTC; path=/";
}

function newI()
{
	var info = prompt("What would you like to do?", "");
	if (info)
		add(info);
	save();
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