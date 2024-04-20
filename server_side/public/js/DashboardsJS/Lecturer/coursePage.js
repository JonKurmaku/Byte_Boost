function addnewCourse(){
    var modal = document.getElementById('add-course-modal');
    var btn = document.getElementsByClassName("btn add-btn")[0];
    
    var span = document.getElementsByClassName("close")[1];
    
      btn.onclick = function() {
        modal.style.display = "block";
      }
    
      span.onclick = function() {
        modal.style.display = "none";
      }
    
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }


      document.getElementById("add-course-form").addEventListener("submit", function(event) {
 
        event.preventDefault(); 
        
        let _courseID = document.getElementById('course-id').value;
        let _courseName = document.getElementById('course-name').value;
        let _maxStd = document.getElementById('max-std').value;
        
        let newData ={
          course_id : _courseID,
          course_name : _courseName,
          max_students : _maxStd
        };
    
        console.log(newData);
    
        $.ajax({
          url: '/lecturer/dashboard/add-courses',
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          data: newData,
          success: function(data) {
              console.log('Data sent successfully:', data);
          },
          error: function(xhr, status, error) {
              console.error('There was a problem with the AJAX request:', error);
          }
      });
      
        modal.style.display = "none";
        window.location.reload();   

     });
   



    }

    function deleteCourse(course_id) {
      course_id = String(course_id);
      console.log(course_id);
  
      $.ajax({
          url: '/lecturer/dashboard/courses/' + course_id,
          method: 'DELETE',
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          success: function(data) {
              console.log('Course deleted successfully:', data);
          },
          error: function(xhr, status, error) {
              console.error('There was a problem with the DELETE request:', error);
          }
      });
   window.location.reload();   
  }