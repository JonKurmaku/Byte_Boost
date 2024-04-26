function showStudents(course) {
    // Sample data for demonstration
    const students = {
        'Web Development': ['Alice Johnson', 'Bob Smith', 'Charlie Brown', 'David Wilson', 'Eva Green'],
        'Software Engineering': ['Frank Young', 'Grace Hall', 'Harry King'],
        'Machine Learning': ['Ivy Lee', 'Jack White', 'Kara Black', 'Liam Grey', 'Mia Hill', 'Nora Scott', 'Owen Morris', 'Paula Jones']
    };

    let studentList = students[course].join('<br>');

    // Create modal HTML
    let modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `<div class="modal-content"><span class="close">&times;</span><h2>${course} - Students</h2><p>${studentList}</p></div>`;
    document.body.appendChild(modal);

    // Display the modal
    modal.style.display = 'block';

    // Get the <span> element that closes the modal
    let close = modal.querySelector('.close');
    close.onclick = function() {
        modal.style.display = "none";
        modal.remove();
    }

    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            modal.remove();
        }
    }
}
