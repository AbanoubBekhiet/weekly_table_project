$(document).ready(function () {
    // Fetch weeks when a year is selected
    $("#year").change(function () {
        var year = $(this).val();
        if (year) {
            $.ajax({
                url: "admin_all_tables/filter_tables_by_years",
                method: "POST",
                data: { year: year },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    $("#week").empty().append('<option value="">Select Week</option>');
                    $.each(response, function (index, week) {
                        $("#week").append('<option value="' + week.id + '">' + week.week_number + '</option>');
                    });
                    $(".form-group.hide").removeClass("hide");
                },
                error: function (xhr) {
                    console.log("Error fetching weeks:", xhr.responseText);
                }
            });
        }
    });

    // Fetch grades when a week is selected and generate forms
    $("#week").change(function () {
        var week_id = $(this).val();
        if (week_id) {
            $.ajax({
                url: "admin_all_tables/filter_tables_by_weeks",
                method: "POST",
                data: { week_id: week_id },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    $(".grades").empty(); 
                    var csrfToken = $('meta[name="csrf-token"]').attr("content");
                
                    $.each(response, function (index, grade) {
                        var formHtml = `
                            <form action="admin_all_tables/table_of_content/${week_id}/${grade.id}" method="POST" class="grade-form" style="border: 1px solid #ddd; padding: 10px; margin: 10px; border-radius: 5px;">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <h4>Grade: ${grade.name}</h4>
                                <button type="submit">View table</button>
                            </form>
                        `;
                        $(".grades").append(formHtml);
                    });
                },
                error: function (xhr) {
                    console.log("Error fetching grades:", xhr.responseText);
                }
            });
        }
    });
});