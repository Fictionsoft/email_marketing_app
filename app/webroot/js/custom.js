/**
 * Created by Fictionsoft on 3/16/15.
 */
/**
 * Created by bakar on 29/12/14.
 */
$(document).ready(function($){
    $('.video-container').hover(function(){

        $(this).find(".video-watch-section").fadeIn(500);

    },function(){
        $(this).find(".video-watch-section").fadeOut(500)
    })

});

// comple task
function completeTask( user_id, user_task_id,c) {
    $('#loader').show();
    $.post($('#base_url').val()+'completed_tasks/task_complete/'+ user_id +'/'+ user_task_id,function(data){
        if(data=='success'){
            $('#btn-xs'+c).removeClass('btn-disable');
            $('#btn-xs'+c).addClass('btn-success');

        }
        $('#loader').hide();
    });
}
