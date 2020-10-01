import config from './config';

var urlParms= new URLSearchParams(windows.location.search);
const taskId=urlParms.get('task');
console.info("Task ID ,", taskID);


function generateFormData(newTask){
    let formData;
    if(newTask){
        formData={
            "status":"private",
            "title":document.querySelector('inpute[name=title]').value,
            "content":document.querySelector('textarea[name=description]').value,
            "cmb2": {
                "taskbook_rest_metabox": {
                    "taskbook_prediction": document.querySelector( 'textarea[name=prediction]' ).value,
                    "taskbook_pre_level": document.querySelector( 'input[name=pre-level]:checked' ).value
                }
			}
        };
    }else{
        formData = {
			"cmb2": {
                "taskbook_rest_metabox": {
                    "taskbook_outcome": document.querySelector( 'textarea[name=outcome]' ).value,
                    "taskbook_post_level": document.querySelector('input[name=post-level]:checked' ).value
                }
			}
		};   
    }
    console.log(formData)
    return formData;

}

function submitTask( newTask ){
    let formData=generateFormData(newTask);

    let requestRoute=config.taskRoot;
    if(!newTask){
        requestRoute=requestRoute+taskId;
    }
}

const monitorFormSubmit=(newTask)=>{
    const taskForm=document .querySelector('#task-form');
    if(taskForm){
        taskForm.addEventListener('submit',(event)=>{
            event.preventDefault();
            console.log(event);
            submitTask( newTask );
        });
    }
}