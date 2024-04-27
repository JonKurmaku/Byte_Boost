document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });

 let currentStudentID;
 let currentLecturerID;
 let currentCourseID;

 //DELETE -- START

function deleteLecturerRecord(lecturerID) {
    var confirmation = confirm("Are you sure you want to delete this lecturer record?");
    if (confirmation) {
        console.log("Lecturer ID to be deleted: " + lecturerID);
        $.ajax({
            url: '/admin/dashboard/delete-lect/' + lecturerID,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(data) {
                console.log('Lecturer deleted successfully:', data);
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the DELETE request:', error);
                window.location.reload();
            }
        });
    }
}

function deleteStudentRecord(studentID) {
    var confirmation = confirm("Are you sure you want to delete this student record?");
    if (confirmation) {
        console.log("Student ID to be deleted: " + studentID);
        $.ajax({
            url: '/admin/dashboard/delete-std/' + studentID,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(data) {
                console.log('Student deleted successfully:', data);
                window.location.reload();

            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the DELETE request:', error);
                window.location.reload();
            }
        });
    }
}


function deleteCourseRecord(courseID) {
    var confirmation = confirm("Are you sure you want to delete this course record?");
    if (confirmation) {
        console.log("Course ID to be deleted: " + courseID);
        $.ajax({
            url: '/admin/dashboard/delete-course/' + courseID,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(data) {
                console.log('Course deleted successfully:', data);
                window.location.reload();

            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the DELETE request:', error);
                window.location.reload();
            }
        });
    }
}

//DELETE -- END



//DISPLAY POP-UPS
function showEditStudentForm(studentID) {
    var editStudentFormContainer = document.getElementById('editStudentFormContainer');
    editStudentFormContainer.style.display = 'block';
    currentStudentID=studentID;
}

function showEditLecturerForm(lecturerID) {
    var editLecturerFormContainer = document.getElementById('editLecturerFormContainer');
    editLecturerFormContainer.style.display = 'block';
    currentLecturerID=lecturerID;
}

function showEditCourseForm(courseID){
    var editLecturerFormContainer = document.getElementById('editCourseFormContainer');
    editLecturerFormContainer.style.display = 'block';
    currentCourseID=courseID;
}

//CLOSE POP-UPS
function closeEditStudentForm() {
    var editStudentFormContainer = document.getElementById('editStudentFormContainer');
    editStudentFormContainer.style.display = 'none';
}

function closeEditLecturerForm() {
    var editLecturerFormContainer = document.getElementById('editLecturerFormContainer');
    editLecturerFormContainer.style.display = 'none';
}

function closeEditCourseForm(){
    var editLecturerFormContainer = document.getElementById('editCourseFormContainer');
    editLecturerFormContainer.style.display = 'none';
}


//EDIT - START

document.getElementById('editStudentRecordForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const studentFirstname = document.getElementById('studentFirstname').value;
    const studentLastname = document.getElementById('studentLastname').value;
    const studentEmail = document.getElementById('studentEmail').value;
    const studentProgram = document.getElementById('studentProgram').value;

    const inputData = {
        studentID:currentStudentID,
        studentFirstname: studentFirstname,
        studentLastname: studentLastname,
        studentEmail: studentEmail,
        studentProgram: studentProgram
    };

    console.log(inputData)
    
    $.ajax({
        url: '/admin/dashboard/edit-std',
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: inputData,
        success: function(data) {
            console.log('Data updated successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
    closeEditStudentForm()
});


document.getElementById('editLecturerRecordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const lecturerFirstname = document.getElementById('lecturerFirstname').value;
    const lecturerLastname = document.getElementById('lecturerLastname').value;
    const lecturerEmail = document.getElementById('lecturerEmail').value;
    const lecturerDepartment = document.getElementById('lecturerDepartment').value;
    const lecturerSpecialization = document.getElementById('lecturerSpecialization').value;


    const inputData = {
        lecturerID:currentLecturerID,
        lecturerFirstname: lecturerFirstname,
        lecturerLastname: lecturerLastname,
        lecturerEmail:lecturerEmail,
        lecturerDepartment: lecturerDepartment,
        lecturerSpecialization: lecturerSpecialization
    };

    console.log(inputData)
    
    $.ajax({
        url: '/admin/dashboard/edit-lect',
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: inputData,
        success: function(data) {
            console.log('Data updated successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
    closeEditLecturerForm()
});

document.getElementById('editCourseRecordForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const courseName = document.getElementById('courseName').value;
    const courseMaxnumber = document.getElementById('courseMaxnumber').value;
   


    const inputData = {
        courseID:currentCourseID,
        courseName: courseName,
        courseMaxnumber: courseMaxnumber,
      
    };

    console.log(inputData)
    
    $.ajax({
        url: '/admin/dashboard/edit-course',
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: inputData,
        success: function(data) {
            console.log('Data updated successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });
});

