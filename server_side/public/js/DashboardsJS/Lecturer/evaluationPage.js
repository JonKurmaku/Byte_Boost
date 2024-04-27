document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
});

function processData(fetchedData, courseId) {
    console.log("Fetched data:" + fetchedData);
    var studentTable = document.getElementById('studentTable');
    var tbody = document.getElementById('studentList');
    tbody.innerHTML = '';

    fetchedData.students.forEach(function(student) {
        var tr = document.createElement('tr');

        var tdId = document.createElement('td');
        tdId.textContent = student.id;
        tr.appendChild(tdId);

        var tdName = document.createElement('td');
        tdName.textContent = student.username;
        tr.appendChild(tdName);

        var tdFeedback = document.createElement('td');
        var finalAssessment = fetchedData.finalAssessments.find(function(assessment) {
            return assessment.student_id === student.id;
        });
        if (finalAssessment) {
            var feedbackText = '';
            for (var i = 1; i <= 5; i++) {
                feedbackText += `<br> Answer ` + i + `: ` + finalAssessment['answer_' + i] + ` <br>`;
            }
            tdFeedback.innerHTML = feedbackText;
        } else {
            tdFeedback.innerHTML = 'No feedback available';
        }
        tr.appendChild(tdFeedback);

        var evaluateBtn = document.createElement('td');
        evaluateBtn.innerHTML = `<button onclick="evaluateStudent(${student.id},'${student.username}','${courseId}')">Evaluate</button>`

        tr.appendChild(evaluateBtn);
        tbody.appendChild(tr);
    });
}

function openPopup(courseId) {
    var popup = document.getElementById('popup');
    popup.style.display = 'block';
    fetch('/final-assessment/students/' + courseId)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            processData(data, courseId)
        })
        .catch(function(error) {
            console.error('Error fetching student list:', error);
        });
}

function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}

function closePopupForm() {
    var popup = document.getElementById('popup-form');
    popup.style.display = 'none';
}

function saveGrades() {
    alert('Grades saved!');
}

function viewAssessment(courseId) {
    alert("Assessment details for " + courseId + ".");
}

function evaluateStudent(studentID, studentUsername, courseId) {
    console.log(studentID);
    var popup = document.getElementById('popup-form');
    popup.style.display = 'block';

    let studentHeader = document.getElementById('studentHeader');
    if (!studentHeader) {
        studentHeader = document.createElement('p');
        studentHeader.id = 'studentHeader';
        document.getElementById('popup-form-content').appendChild(studentHeader);
    }
    studentHeader.innerHTML = `Student to be evaluated: ${studentID} ${studentUsername} for course with Id: ${courseId}`;

    var evaluationForm = document.getElementById("evaluationForm");
    evaluationForm.addEventListener("submit", function submitEvaluationForm(event) {
        event.preventDefault();
        
        var selectedValue = document.querySelector('input[name="evaluation"]:checked').value;
        console.log("Student Name:"+studentUsername+" Student Id:"+studentID+" Selected value:", selectedValue + "Course Id:"+courseId);
        
        let newData = {
            studentID : studentID,
            selectedValue:selectedValue,
            courseID:courseId
        }
        $.ajax({
            url: '/final-assesment/lecturer/evaluate',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: newData,
            success: function(data) {
                console.log('Data sent successfully:', data);
                popup.style.display = 'none'; 
                evaluationForm.removeEventListener("submit", submitEvaluationForm); 
            },
            error: function(xhr, status, error) {
                console.error('There was a problem with the AJAX request:', error);
            }
        });
    });
}
