$(function () {
    // When the user selects a year
    $("#year").on("change", function () {
        let selectedYear = $(this).val();

        $.ajax({
            url: "/teacher_dashboard/add_week_content/filter_weeks_by_year",
            method: "POST",
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            data: JSON.stringify({ year: selectedYear }),
            success: function (response) {
                console.log("Success:", response);

                let weekSelect = $("#week");
                weekSelect.empty().append('<option value="">Select Week</option>');
                $.each(response.weeks, function (index, week) {
                    weekSelect.append(`<option value="${week.id}">${week.week_number}</option>`);
                });

                let gradeSelect = $("#grade");
                gradeSelect.empty().append('<option value="">Select Grade</option>');
                $.each(response.grades, function (index, grade) {
                    gradeSelect.append(`<option value="${grade.grade_id}">${grade.grade_name}</option>`);
                });

                // Reset subjects since they depend on the selected grade
                $("#subject").empty().append('<option value="">Select Subject</option>');

                $(".form-group.hide").removeClass("hide");





                ////////////////////////////////
                $("#grade").on("change", function () {
                    let selectedGrade = $(this).val();
                    let selectedWeek = $("#week").val();
                    if (!selectedGrade) return; // Exit if no grade is selected
            
                    $.ajax({
                        url: "/teacher_dashboard/teacher_alter_week_content/filter_created_schedule_content",
                        method: "POST",
                        contentType: "application/json",
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        data: JSON.stringify({  grade: selectedGrade ,week:selectedWeek}),
                        success: function (response) {
                            console.log("Subjects Loaded:", response);
            
                            let subjectSelect = $("#subject");
                            subjectSelect.empty().append('<option value="">Select Subject</option>');
                            $.each(response.subjects, function (index, subject) {
                                subjectSelect.append(`<option value="${subject.subject_id}">${subject.name}</option>`);
                            });
                        },
                        error: function (xhr) {
                            console.log("Subjects Fetch Failed:", xhr.responseText);
                        }
                    });
                });


            },
            error: function (xhr) {
                console.log("Fail:", xhr.responseText);
            }
        });
    });


        let subjectSelect = $("#subject");
    
        subjectSelect.on("change", function () {
            let table_of_content = $("#table_of_content");
            table_of_content.removeClass("hide");
            $(".submit_button").removeClass("hide");
    
            let selectedSubjectId = $(this).val();
            let selectedWeek = $("#week").val();
            let selectedGrade = $("#grade").val();
    
            if (!selectedSubjectId || !selectedWeek || !selectedGrade) return;
    
            $.ajax({
                url: "/teacher_dashboard/teacher_alter_week_content/get_subject_content", 
                method: "POST",
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
                },
                data: JSON.stringify({
                    subject_id: selectedSubjectId,
                    week_id: selectedWeek,
                    grade_id: selectedGrade,
                }),
                success: function (response) {
                    console.log("Table Content Loaded:", response);
    
                    let subjectData = response; // Directly using the response object
    
                    if (subjectData) {
                        let days = ["monday", "tuesday", "wednesday", "thursday", "friday"];
    
                        days.forEach(day => {
                            $(`.${day}_lesson textarea`).val(subjectData[`${day}_lesson`] || "");
                            $(`.${day}_books_pages textarea`).val(subjectData[`${day}_books_pages`] || "");
                            $(`.${day}_homework textarea`).val(subjectData[`${day}_homework`] || "");
                            $(`.${day}_hw_due_date input`).val(subjectData[`${day}_hw_due_date`] || "");
                            $(`.${day}_notes textarea`).val(subjectData[`${day}_notes`] || "");
                        });
                    }
                    let form_of_data=$("#form_of_data");
                    form_of_data.attr("action", `/teacher_dashboard/teacher_alter_week_content/teacher_update_week_content/${selectedWeek}/${selectedSubjectId}/${selectedGrade}`);
                },
                error: function (xhr) {
                    console.log("Failed to Load Table Content:", xhr.responseText);
                },
            });
        });
    

    

    
});


