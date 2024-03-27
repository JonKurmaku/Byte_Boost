document.addEventListener("DOMContentLoaded", function() {
    fetchLecturers();
});

function fetchLecturers() {
    setTimeout(function() {
        const lecturers = ["Lecturer A", "Lecturer B", "Lecturer C", "Lecturer D"];
        fillDropdown(lecturers);
    }, 1000);
}

function fillDropdown(lecturers) {
    const selectDropdown = document.getElementById("lecturerSelect");
    selectDropdown.innerHTML = ""; 
    lecturers.forEach(function(lecturer) {
        const option = document.createElement("option");
        option.text = lecturer;
        option.value = lecturer;
        selectDropdown.appendChild(option);
    });
}

function showPopup() {
    const popup = document.getElementById("popup");
    popup.style.display = "block";
}

function closePopup() {
    const popup = document.getElementById("popup");
    popup.style.display = "none";
}

function searchLecturers() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toUpperCase();
    const ul = document.getElementById("lecturerList");
    const li = ul.getElementsByTagName("li");

    for (let i = 0; i < li.length; i++) {
        const a = li[i].getElementsByTagName("a")[0];
        const txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
