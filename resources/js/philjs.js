$(document).ready(function()
{

	var options = { 
    beforeSend: function() 
    {
    	//$("#progress").show();
    	//clear everything
    	$("#registedloader").width('0%');
    	//$("#message").html("");
		//$("#percent").html("0%");
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    	$("#registedloader").width(percentComplete+'%');
    	//$("#percent").html(percentComplete+'%');

    
    },
    success: function() 
    {
        $("#registedloader").width('100%');
    	//$("#percent").html('100%');

    },
	complete: function(response) 
	{

		
		$("input").val("")
		$("select").val("0");
		$("textarea").val("");
		$("#uploadmsg").html(response.responseText);
		
	//	if($.trim(response.responseText)=='truephiuploaded'){
			location.reload(); 
		//}
		//alert($.trim(response.responseText));

		
	},
	error: function()
	{
		$("#message").html("<font color='red'> ERROR: unable to upload files</font>");

	}
     
}; 

$("#changephotoform").ajaxForm(options);

});

