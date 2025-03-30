document.addEventListener("DOMContentLoaded", function () {
    let startDateInput = document.getElementById("start_date");
    let endDateInput = document.getElementById("end_date");

    startDateInput.addEventListener("change", function () {
        let startDate = new Date(startDateInput.value);

        if (!isNaN(startDate.getTime())) { 
            let endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + 5); 

            let year = endDate.getFullYear();
            let month = String(endDate.getMonth() + 1).padStart(2, "0"); // Months are 0-based
            let day = String(endDate.getDate()).padStart(2, "0");

            endDateInput.value = `${year}-${month}-${day}`;
        }
    });
});
