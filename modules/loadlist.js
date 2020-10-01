import config from'./config.js';
//import getTaskList from '../../../../../../AppData/Local/Temp/Rar$DIa0.472/loadlist.js';
/**
 * 
 */

 const taskList=document.querySelector('.task-list ul');
 const loader=document.querySelector('.loader');
 const more= document.querySelector('.more');


 let pageCount=1;
 /**
  * 
  */

function getData(task){
    let date;
    let options={
        weekday:"long",
        year:"numeric",
        month:"short",
        day:"numeric",
        hour:"2-digit",
        minute:"2-digit",
        timeZone:"America/Los_Angeles"
    };
    if(!task.modified){
        let taskData= new Date(task.date);
        data='Tak created <time datetime="'+task.modified +'">'+taskData.toLocaleDateString("en-US",options)+'</time>';
    }else{
        let taskModified=new Date(task.modified);
        date='Task Updated <time datetime="'+task.modified+'">'+taskData.toLocaleDateString("en-US",options)+'</time>';

    }
    return date;
}


function morePostTrigger(){
    const observer=new IntersectionObserver(function(entries,self){
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                self.disconnect();
                pageCount++;


                //get new tasks
                getTaskList(`${config.taskRoot}?page=${pageCount}`);

            }
        });
    });
    observer.observe(document.querySelector('.more'));
}

/**
 * 
 */
function createTaskList(taskobjectlist){
    if(taskobjectlist.code !=undefined){
        console.info(`no more task loades becoaus ${taskobjectlist.code}.`);
        
    }else{
        taskobjectlist.forEach(taskObject=>{
            let completed=taskObject.task_status==='Completed'?'class="completed"':"";
            let navListItem =document.createElement('li');
            navListItem.innerHTML=`
            <a href="single.html/tas=${taskObject.id}" ${completed}>
            <h2 class="task-title">${taskObject.title.rendered}</h2>
            <div class="task-date">${getData(taskObject)} </div>
            <div class="task-status">${taskObject.task_status}</div>
            </a>`;
            taskList.append(navListItem);
        });
        more.style.display='block';
        morePostTrigger();
    }
    loader.style.display='none';

}


const getTaskList=(listRoute)=>{
    more.style.display="none";
    loader.style.display="block";
}
export default getTaskList;























































