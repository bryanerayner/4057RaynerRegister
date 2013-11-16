window.onload = function()
{
	el_deleteButton = document.querySelector("#btnDelete");


	el_deleteButton.onclick = function()
	{
		el_userTypes = document.querySelector("#usertypes");

		

		if (el_userTypes.selectedIndex == -1)
		{
	        return null;
	    }

	     



		if (!confirm("Are you sure you want to delete the " +el_userTypes.options[el_userTypes.selectedIndex].text + " user type?"))
			{
				return false;
			}
	}	
}