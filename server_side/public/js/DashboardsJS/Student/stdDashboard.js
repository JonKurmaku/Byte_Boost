
document.addEventListener("DOMContentLoaded", function() {
   csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
});


var modal = document.getElementById('edit-profile-modal');
var btn = document.getElementById("edit-profile-btn");

var span = document.getElementsByClassName("close")[0];

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

  document.getElementById("edit-profile-form").addEventListener("submit", function(event) {

    event.preventDefault(); 
    
    let _username = document.getElementById('new-username').value;
    let _password = document.getElementById('new-password').value;

    let newData ={
      n_username : _username,
      n_password : _password
    };

    console.log(newData);

    $.ajax({
      url: '/student/dashboard',
      method: 'PUT',
      headers: {
          'X-CSRF-TOKEN': csrfToken
      },
      data: newData,
      success: function(data) {
          console.log('Data updated successfully:', data);
      },
      error: function(xhr, status, error) {
          console.error('There was a problem with the AJAX request:', error);
      }
  });
  
    modal.style.display = "none";
 });