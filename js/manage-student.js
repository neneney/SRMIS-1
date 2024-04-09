function toggleAdmissionForm() {
    var admissionForm = document.getElementById("admissionContainer");
    admissionForm.style.opacity = "1";
    admissionForm.style.visibility = "visible";
}
function closePopup(){
    var admissionForm = document.getElementById("admissionContainer")
    admissionForm.style.opacity = "0";
}

function editInfo(studentID, firstName, middleName, lastName, gender, birthdate, address, motherName, motherOccupation, fatherName, fatherOccupation, guardianName, guardianPhone) {
    var header = document.getElementById('admission-header');
    header.innerHTML = "Edit Information";
    document.querySelector("input[name='ID']").readOnly = true;
    document.getElementsByName("ID")[0].value = studentID;
    document.getElementsByName("first-name")[0].value = firstName;
    document.getElementsByName("middle-name")[0].value = middleName;
    document.getElementsByName("last-name")[0].value = lastName;
    var genderRadio = document.querySelector("input[name='gender'][value='" + gender + "']");
if (genderRadio) {
    genderRadio.checked = true;
} else {
    console.error("Gender radio button with value '" + gender + "' not found.");
}
    document.getElementsByName("birthdate")[0].value = birthdate;
    document.getElementsByName("address")[0].value = address;
    document.getElementsByName("mother-name")[0].value = motherName;
    document.getElementsByName("mother-occupation")[0].value = motherOccupation;
    document.getElementsByName("father-name")[0].value = fatherName;
    document.getElementsByName("father-occupation")[0].value = fatherOccupation;
    document.getElementsByName("guardian-name")[0].value = guardianName;
    document.getElementsByName("guardian-phone")[0].value = guardianPhone;
    document.querySelector(".submit-btn").addEventListener("click", submitForm);

    toggleAdmissionForm();
}

function openAddstudent(){
    var header = document.getElementById('admission-header');
    header.innerHTML = "Student Admission";
    toggleAdmissionForm();
}


function submitForm() {
    console.log("Submit button clicked");

    var form = document.querySelector('.addForm');
    
    // Check if the form is being used to add a new student or edit existing student information
    var studentID = document.getElementsByName("ID")[0].value;
    console.log("Student ID:", studentID);
    var action = studentID ? "update_student.php" : "add_student.php";
    console.log("Action:", action);
    
    // Collect form data
    var formData = new FormData(form);
    console.log("Form data:", formData);

    // Send form data to the appropriate PHP script using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle successful response
                console.log("Success response:", xhr.responseText);
                alert("Operation successful!");
                location.reload(); // Reload the page after successful submission
            } else {
                // Handle error response
                console.error("Error response:", xhr.status);
                alert("Error occurred. Please try again.");
            }
        }
    };
    xhr.send(formData);
}

    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.addForm');
    const submitButton = form.querySelector('.submit-btn');

    submitButton.addEventListener('click', function(event) {
        
        event.preventDefault();

        
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                
                form.reset();

                
                location.reload();
            } else {
                
                console.error('Error submitting form');
            }
        })
        .catch(error => console.error(error));
    });
});



const inputElements = document.querySelectorAll('input');


inputElements.forEach(function (inputElement) {
    inputElement.addEventListener('input', function () {
      
        let inputValue = this.value;

  
        let capitalizedValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);

       
        this.value = capitalizedValue;
    });
});
function deleteStudent(studentID) {
    if (confirm("Are you sure you want to delete this student?")) {
        var xhr = new XMLHttpRequest();

        
        xhr.open("GET", "delete-student.php?id=" + studentID, true);

        
        xhr.send();

        
        xhr.onload = function () {
            if (xhr.status == 200) {
                location.reload();
            } else {
                alert("Error deleting student record.");
            }
        };
    }
    }

