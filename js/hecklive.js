/************************************************\

    FUNCTIONS

\************************************************/
function slideInMenu(){
	$("body").toggleClass("open");
    $("#pusher").toggleClass("open");
    $(".navbar").toggleClass("open");
}
function clickInMenu(href){
    //$("#container").toggleClass("open");
    //$(".navbar").toggleClass("open");

    var animationOut = "pt-page-rotateLeftSideFirst";
    var animationIn = "pt-page-moveFromRight";
    $("#innerPusher").addClass(animationOut);


    $("#main").fadeOut(function(){
        //$("#main").load(href);  OLD FUNCTION
        var target = "#main section."+href;
        //alert (target);
        $("#main section.heckliveSection").css("display","none");
        $(target).css("display","block");
        $("#main").fadeIn("slow",function(){
            var height = $(window).height();
            $("#chatWrapper").css("height",height-80);
        });
    });

    setTimeout(function() {
        $("#innerPusher").removeClass(animationOut);
        $("#innerPusher").addClass(animationIn);
    }, 500);

}
function validate(formData,jqForm){
    //alert("test");
    var form = jqForm[0];
    if (!form.header.value || !form.subHeader.value) {
        alert('Please enter a value for header and subheader');
        return false;
    }
}
function refreshChat(){

    //var menuId = $( "ul.nav" ).first().attr( "id" );
    var request = $.ajax({
        url: "refresh.php",
        //type: "POST",
        //data: { id : menuId },
        dataType: "html"
        });

    request.done(function(html) {
        $(".refresh").html(html);
        var objDiv = document.getElementById("chatWrapper");
        objDiv.scrollTop = objDiv.scrollHeight;
    });

    request.fail(function() {
        //alert( "REFRESH failed: ");
    });
}
/************************************************\

    jQUERY

\************************************************/
$(document).ready(function() {
    $("#main section.newsfeed").css("display","block");
    var height = $(window).height();
    var width = $(window).width();
    $("#wrapper").css("height",height);
    $("#wrapper").css("width",width);
    $("#pusher").css("height",height);
    $("#chatWrapper").css("height",height-100);

    $(window).resize(function(){
            var height = $(window).height();
            $("#pusher").css("height",height);
            var width = $(window).width();
            $("#wrapper").css("height",height);
            $("#wrapper").css("width",width);
            $("#chatWrapper").css("height",height-100);
    });




    $(".list-group-item span").click(function(){
        var href = $(this).attr("data-href");
        //MENU Highlighting in Red
        if (href === "newsfeed"){
            //alert("newsfeed");
            $("#main section.newsfeed").load("newsfeed.php");
        }
        if (href === "newPost"){
            $("#newPost").load("newPost.php",function(){
                var newArticleOptions = {
                    target:     "#message",
                    url:        "php/db/insertIntoDB.php",
                    type:       "POST",
                    beforeSubmit: validate
                };
                $("#insertArticleIntoDBForm").ajaxForm(newArticleOptions);
            });
        }
        if (href === "editPost"){
            $("#editPost").load("newPost.php?id=1",function(){
                var newArticleOptions = {
                    target:     "#message",
                    url:        "php/db/insertIntoDB.php",
                    type:       "POST",
                    beforeSubmit: validate
                };
                $("#insertArticleIntoDBForm").ajaxForm(newArticleOptions);
            });
        }

        $(".list-group-item span").parent().removeClass("active");
        $(this).parent().addClass("active");
        //calling function to load content
        clickInMenu(href);
    });

    $("#main").on("submit","#chatForm",function(){
        //alert("TEST");
        var message = $("#textb").val();
        var user = $("#texta").val();
        var request = $.ajax({
            url: "save.php",
            type: "POST",
            data: { sender : user, text : message },
            dataType: "html"
        });

        request.done(function() {
            refreshChat();
        });

        request.fail(function() {
            //alert( "Request failed: ");
        });
        $("#textb").val("");
        refreshChat();
        return false;
    });

    $("body").on("click","span.addImageFormField",function(){
        var imageFormField = '<div class="image well"><input type="hidden" name="imageOrder[]" value="newUpload"><input type="file" class="form-control" name="images[]" id="images"><div class="imageControlButtons"><span class="btn btn-default fa fa-trash-o removeImage"></span><span class="btn btn-default fa fa-chevron-up switchOrderUp"></span><span class="btn btn-default fa fa-chevron-down switchOrderDown"></span></div></div>';
        //$(".imageContainer").append(imageFormField);
        $(imageFormField).appendTo(".imageContainer").slideDown();
    });


    $("body").on("click","span.removeImage",function(){
        $(this).parent().parent().slideUp().fadeOut(function(){
            $(this).remove();
        });
    });
    $("body").on("click","span.switchOrderUp",function(){
        var image = $(this).parent().parent();
        var newPosition = $(this).parent().parent().prev();

        $(image).slideUp(function(){
            $(image).insertBefore(newPosition);
            $(image).slideDown();
        });

    });
    $("body").on("click","span.switchOrderDown",function(){
        var image = $(this).parent().parent();
        var newPosition = $(this).parent().parent().next();

        $(image).slideUp(function(){
            $(image).insertAfter(newPosition);
            $(image).slideDown();
        });
    });

/************************************************\

    DATABASE OPERATIONS

\************************************************/


    $("body").on("click","span.editAnExistingPostButton",function(){
        var id = $(this).attr("data-id");
        //alert(id);
        clickInMenu("newPost");
        $("#newPost").load("newPost.php?id="+id,function(){
            var newArticleOptions = {
                target:     "#message",
                url:        "php/db/insertIntoDB.php",
                type:       "POST",
                beforeSubmit: validate
            };
            $("#insertArticleIntoDBForm").ajaxForm(newArticleOptions);
        });
    });

    $("body").on("click","span.deleteAnExistingPostButton",function(){
        var id = $(this).attr("data-id");
        
        $("#deleteButton").attr("data-id",id);
        
        $('#modal').modal({
			keyboard: true
        });
    });
    
    $("body").on("click","#deleteButton",function(){
		var id = $(this).attr("data-id");
		var postID = "#postID"+id;
		$("section.newsfeed").fadeOut("fast",function(){
			$.ajax({
	          type: "POST",
	          url: "php/db/deleteFromDB.php",
			  data: { id: id }
			  })
			.done(function() {
	            $("#main section.newsfeed").load("newsfeed.php").fadeIn("fast");
				$('#modal').modal('hide');
	        });
		});
    });
    
    $("body").on("change","input[type=file]",function(){
	   alert("test");
    });

/************************************************\

    TIME BASED FUNCTIONS

\************************************************/

    setInterval(function(){
        //refreshChat();
    }, 2000);
});