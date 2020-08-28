$(document).ready(function(){

	// when add to list button clicked 
	
	 $(".add-task").click(function(){	
        var item = $(".input-task").val();
        
			if( !item ) {
                alert('Invalid Input');
            }
                $.ajax({
                        type: 'POST',
                        url: $(this).data('url'),
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            'name': item,
                            'status' :0,
                        },
                        success: function(data) {
                             $(".input-task").val('');
                            appendTasks(data);
                        },     
                           
                    }).fail(function (jqXHR, textStatus, error) {
                        // Handle error here
                        alert(jqXHR.responseText);
                    });
    		
			
    });
	
	// when we want to add task as done, from css i hide the <a>Mark as Done go to style file line 41, here i add class done.
	$(document).on( 'click', '.done-action', function() {
		$.ajax({
            type: 'PUT',
            url: $(this).data('url'),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                'status':1,
            },
            success: function() {
               	$(this).parent().parent('li').addClass('done');
            },
        });	
                    
	  $(this).parent().parent('li').addClass('done');
	});    
	
	// when delete button clicked
	$(document).on( 'click','.delete-action', function() {

        $.ajax({
                        type: 'DELETE',
                        url: $(this).data('url'),
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {},
                        success: function() {
                        
                           $(this).parent().parent('li').fadeOut();
                        },
                    });
                    

		$(this).parent().parent('li').fadeOut(); // hide the row list ( li) from front page
	});   

	function appendTasks(data){
		$(".todo-items").append('<li class="list-group-item border-top-0 border-right-0 border-left-0 mb-1">'+
								'<div class="float-left task-text"> '+ data.task.name +' </div>'+
								'<div class="float-right action" id = "'+data.task.id+'"><a href ="#" data-url="tasks/'+ data.task.id +'/edit" class="done-action">Mark as Done </a>|<a href ="#" data-url="tasks/'+ data.task.id +'" class="delete-action"> Delete</a></div></li>');
	}
});