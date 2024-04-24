document.addEventListener("DOMContentLoaded", function() {
    csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 });

fetchLecturers(); 

function fetchLecturers() {
    fetch('/student/dashboard/feedback-lecturers')
        .then(response => response.json())
        .then(data => {
            fillList(data); 
            displayLecturers(lecturersArray); 
        })
        .catch(error => console.error('Error fetching lecturers:', error));
}

//Search Engine
let lecturersArray=[]

function fillList(lecturers) {
    lecturersArray = lecturers;
}

const searchInput = document.getElementById('searchInput');
const lecturerList = document.getElementById('lecturerList');

searchInput.addEventListener('input', function() {
    const searchText = searchInput.value.toLowerCase();
    const filteredLecturers = lecturersArray.filter(lecturer => 
        lecturer.first_name.toLowerCase().includes(searchText) 
    );
    displayLecturers(filteredLecturers);
});

function displayLecturers(lecturers) {
    lecturerList.innerHTML = '';
    lecturers.forEach(lecturer => {
        const listItem = document.createElement('li');
        listItem.textContent = lecturer.first_name + " " + lecturer.last_name;
        listItem.addEventListener('click', function() {
            openPopupAndFetchCourses(lecturer.id);
        });
        lecturerList.appendChild(listItem);
    });
}
function openPopupAndFetchCourses(lecturerId) {
    openPopup();
    fetchLecturerCourses(lecturerId);
}

async function fetchLecturerCourses(lecturerId) {
    try {
        const popupLecturerList = document.getElementById('popupLecturerList');
        popupLecturerList.innerHTML = '';
        const response = await fetch(`/student/dashboard/feedback-courses/${lecturerId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch lecturer courses');
        }
        const courses = await response.json();
        displayCourses(courses);
    } catch (error) {
        console.error('Error fetching lecturer courses:', error);
    }
}

function displayCourses(courses) {
    const popupLecturerList = document.getElementById('popupLecturerList');
    popupLecturerList.innerHTML = '';
    courses.forEach(course => {
        const listItem = document.createElement('li');
        listItem.textContent = course.course_name; 
        

        const button = document.createElement('button');
        button.textContent = 'Select'; 
        button.style.marginLeft = '20px'; 
        button.onclick = function() {
            selectCourse(course.course_name,course.id);
        };
        
        listItem.appendChild(button);
        
        popupLecturerList.appendChild(listItem);
    });
}
let currentCourseId;
function selectCourse(courseName,courseId) {
    currentCourseId=courseId;
    console.log(currentCourseId);
    openPopupForm()

}

function openPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'block';
}

function closePopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}

//Search Engine - END

function openPopupForm() {
    const popup = document.getElementById('popup-form');
    popup.style.display = 'block';
}

function closePopupForm() {
    clearFormFields(); 
    const popup = document.getElementById('popup-form');
    popup.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating input[type="radio"]');
    
    stars.forEach((star, index) => {
        star.addEventListener('change', function() {
            stars.forEach(s => s.checked = false); 
            
            this.checked = true; 
            
            
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.nextElementSibling.style.color = '#ffcc00';
                } else {
                    s.nextElementSibling.style.color = '#aaa'; 
                }
            });

        });
    });
});

document.getElementById('rating-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const selectedStar = document.querySelector('.star-rating input[type="radio"]:checked');
    const selectedValue = selectedStar ? selectedStar.value : null; 
   
    const comment = document.getElementById("comment").value; 
    
    clearFormFields(); 
    closePopupForm(); 
    
    const feedbackData = {
        course_id: currentCourseId,
        rating: selectedValue,
        comment: comment
    };
    console.log(feedbackData);

    $.ajax({
        url: '/student/dashboard/send-feedback',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: feedbackData,
        success: function(data) {
            console.log('Data sent successfully:', data);
        },
        error: function(xhr, status, error) {
            console.error('There was a problem with the AJAX request:', error);
        }
    });

});

function clearFormFields() {
    document.getElementById("comment").value = ''; 
    const stars = document.querySelectorAll('.star-rating input[type="radio"]');
    stars.forEach(star => {
        star.checked = false; 
        star.nextElementSibling.style.color = '#aaa'; 
    });
}



