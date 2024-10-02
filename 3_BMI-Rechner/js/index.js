
function validateDate(date){
    let today = new Date();
    today.setHours(0,0,0,0);

    let userDate = new Date(date.value);
    userDate.setHours(0,0,0,0);

    if(userDate <= today){
        date.classList.add("is-valid");
        date.classList.remove("is-invalid");
    } else {
        date.classList.add("is-invalid");
        date.classList.remove("is-valid");
    }

}