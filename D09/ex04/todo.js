$(document).ready(function(){
	$('#List-Add').click(add);
	refresh();
});

function add()
{
	$.get("insert.php?data=" + prompt("what would you like me to remind you of?", ""), function(data, status)
	{
		if (status == "success")
		{
			refresh();
			$('#ToDoList').html(data);
		}
	});
}

function del(id)
{
	$.get("delete.php?id=" + id, function(data, status)
	{
		if (status == "success")
			refresh();
	});
}

function refresh()
{
	$.get("select.php", function(data, status)
	{
		if (status == "success")
			$('#ToDoList').html(data);
	});
}