$(document).ready(function (){

    let edit = false;

    $('#task-result').hide();
    fetch_Tasks();

    $('#search').keyup(function(){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {search},
                success: function(response){
                    let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(tasks => {
                        template += `<li>
                                        ${tasks.name}
                                    </li>`;
                    });
                    
                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }
    });

    $('#task-form').submit(function(e){
        e.preventDefault();
        const postData = {
            id: $('#taskId').val(),
            name: $('#name').val(),
            description: $('#description').val()
        };

        let url = (edit==false)? 'task-add.php' : 'task-edit.php';        

        $.post(url, postData, function(response){
            console.log(response);
            fetch_Tasks();
            $('#task-form').trigger('reset');
        });
    });

    function fetch_Tasks(){
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response){
                let task = JSON.parse(response);
                let template = '';
                task.forEach(task => {
                    template += `<tr taskId="${task.id}">
                                    <td>${task.id}</td>
                                    <td>
                                        <a href='#' class="task-item">${task.name}</a>
                                    </td>
                                    <td>${task.description}</td>
                                    <td>
                                        <button class="task-delete btn btn-danger" >Delete</button>
                                    </td>
                                </tr>`;
                });
                $('#tasks').html(template);
            }
        });
    }

    $(document).on('click', '.task-delete', function() {
        if(confirm('Do you want to delete this task?')){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');
            $.post('task-delete.php', {id}, function(response){
                fetch_Tasks();
            });
        }
    });

    $(document).on('click', '.task-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId');
        $.post('task-single.php', {id}, function(response){
            let task = JSON.parse(response);
            $('#taskId').val(task.id);
            $('#name').val(task.name);
            $('#description').val(task.description);
            edit = true;
        });
    });

});