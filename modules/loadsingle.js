/**
 * 
 */

function getDate( task ) {

    const options = {
        weekday: "long",
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        timeZone: "America/Los_Angeles"
    };

    let taskDate = new Date(task.date);
    let date = `<div class="task-date">Task created <time>${taskDate.toLocaleDateString("en-US", options)}</time></div>`;

    var modifiedDate = new Date(task.modified);
    let modified = '';
    // Set modified only if taskDate and modifiedDate are different:
    if ( task.date != task.modified ) {
        modified = `<div class="task-date">Task updated <time>${modifiedDate.toLocaleDateString("en-US", options)}</time></div>`
    }
    
    return date + modified;
}


const getSingleTask=(taskRoute,newTask)=>{
    if(newTask){
        montoreFormSubmit(newTask);
    }else{
        loader.style.display="block";
    }

}

export  default getSingleTask;
