/* Add here all your JS customizations */
//Specify page information: Navigation bar and active status
if(typeof pagename != 'undefined'){

	pagenameNoSpace = pagename.replace(' ','-');

	//modify title
	$('title').text(pagename+" | Quantum - Veira Web Application");

	//modify sidebar left status
	$("#"+pagenameNoSpace).addClass('nav-active').parent().closest('li').addClass('nav-expanded nav-active');

	//modify page name
	$(".pagename").text(pagename);

	//modify navi bar
	parentPagename = $("#"+pagenameNoSpace).parent().closest('li').children().first('span').text();
	if(parentPagename !='')
	{
		$("#navbar").html("<li><a href=''>"+parentPagename+"</a></li><li><a href=''>"+pagename+"</a></li>");
	}
	else
	{
		$("#navbar").html("<li><a href=''>"+pagename+"</a></li>");
	}

}
