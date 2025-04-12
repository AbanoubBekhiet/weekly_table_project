$(function() {
    let update_teacher_form = $("#update_teacher_form");
    let overlay = $(".overlay");

    $("body").on("click", "#update_teacher_button", function(e) {
        e.preventDefault();

        const teacherId = $(e.target).data("id");

        update_teacher_form.attr("action", `/admin_dashboard/update_teacher/${teacherId}`);

        overlay.removeClass("hidden").addClass("show");
        update_teacher_form.show();  

    });

    overlay.on("click", function(e) {
        if ($(e.target).is(".overlay")) {
            overlay.addClass("hidden").removeClass("show");
            update_teacher_form.hide();  
        }
    });

    $("body").on("click", ".exit", function(e) {
        overlay.addClass("hidden").removeClass("show");
        update_teacher_form.hide();  
    });
    $("body").on("click", "#delete_teacher_button", function(e) {
        e.preventDefault();
        $(".warning").show();

        $("body").on("click", ".Cancel", function() {
            $(".warning").hide();
        });
        $("body").on("click", ".Delete", function() {
            $("#delete_form").submit();
        });
    });





    ///////////////////////

$(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    function generateTeacherTableRows(filteredTeachers) {
        const $tbody = $("table tbody");
        $tbody.empty();

        filteredTeachers.forEach((teacher, index) => {
            let gradeSpans = "";
            teacher.grades.forEach(grade => {
                gradeSpans += `<span style="background-color:#ffb606;padding:3px;margin:2px;display:inline-block">${grade}</span>`;
            });

            let subjectSpans = "";
            teacher.subjects.forEach(subject => {
                subjectSpans += `<span style="background-color:#ffb606;padding:3px;margin:2px;display:inline-block">${subject}</span>`;
            });

            const $row = $(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${teacher.name}</td>
                    <td>${teacher.email}</td>
                    <td>${teacher.password_not_hashed}</td>
                    <td>${gradeSpans}</td>
                    <td>${subjectSpans}</td>
                    <td id="td_of_forms">
                        <form action="delete_teacher/${teacher.id}" method="POST" id="delete_form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input   data-id="${ teacher.id }" id="delete_teacher_button" type="submit" value="Delete" style="background-color:red;color:white;border:none;padding:5px 10px;border-radius:3px;">
                        </form>
                        <form action="admin_dashboard/update_teacher/${teacher.id}" method="POST" style="margin-top:5px">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input  data-id="${ teacher.id }" id="update_teacher_button" type="submit" value="Update" style="background-color:green;color:white;border:none;padding:5px 10px;border-radius:3px;">
                        </form>
                    </td>
                </tr>
            `);

            $tbody.append($row);
        });
    }

    function filterTeachers(query) {
        return teachers.filter(teacher =>
            teacher.name.toLowerCase().includes(query.toLowerCase()) ||
            teacher.email.toLowerCase().includes(query.toLowerCase())
        );
    }

    generateTeacherTableRows(teachers);

    $("#search").on("input", function() {
        const query = $(this).val();
        const filtered = filterTeachers(query);
        generateTeacherTableRows(filtered);
    });
});



});
