var ft_list;
var cookie = new Array();

$(document).ready(function(){
	$('#New').click(newI);
	var temp = document.cookie;
    ft_list = $('.ft_list');
	$('.ft_list div').click(del);
	if (temp){
		cookie = JSON.parse(temp);
		cookie.forEach(function (e)
		{
			add(e);
		});
	}
})

function save() {
	var items = ft_list.children();
	var newCook = [];
	for (var i = 0; i < items.length; i++)
		newCook.push(items[i].innerHTML);
	document.cookie = JSON.stringify(newCook);
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
	ft_list.prepend($('<div>' + info + '</div>').click(del));
}

function del()
{
	if (confirm("Purge the matrix??"))
		this.remove();
}