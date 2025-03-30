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
                $(".submit_button").removeClass("hide");
            },
            error: function (xhr) {
                console.log("Fail:", xhr.responseText);
            }
        });
    });

    // When the user selects a grade, fetch subjects
    $("#grade").on("change", function () {
        let selectedGrade = $(this).val();

        if (!selectedGrade) return; // Exit if no grade is selected

        $.ajax({
            url: "/teacher_dashboard/add_week_content/filter_weeks_by_grade",
            method: "POST",
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            data: JSON.stringify({  grade: selectedGrade }),
            success: function (response) {
                console.log("Subjects Loaded:", response);

                let subjectSelect = $("#subject");
                subjectSelect.empty().append('<option value="">Select Subject</option>');
                $.each(response.subjects, function (index, subject) {
                    subjectSelect.append(`<option value="${subject.subject_id}">${subject.subject_name}</option>`);
                });


                ////////////////////////open table of content

                let table_of_content=$("#table_of_content");
                table_of_content.removeClass("hide");

                


            },
            error: function (xhr) {
                console.log("Subjects Fetch Failed:", xhr.responseText);
            }
        });
    });
});
