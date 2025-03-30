$(function(){
    let exit_icon=$(".exit");
    let form=$(".adding_grade_form");
    let open_form_button=$(".add_grade_button");
    exit_icon.on("click",function(){
        form.hide();
    })
    open_form_button.on("click",function(){
        form.show();
    })
})