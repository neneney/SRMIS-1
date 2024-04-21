
var addStudentBtn = document.querySelector('#add-student-btn');
var admissionContainer = document.querySelector('#admissionContainer');
var editbtns = document.querySelectorAll('#edit-btn');
var editContainer = document.querySelector("#editContainer");
var viewbtns = document.querySelectorAll('#view-btn')
var viewPopup = document.querySelector('#viewPopup');

viewbtns.forEach(viewbtn => {
    viewbtn.addEventListener("click", e => {
        var ID = viewbtn.dataset.id;
        var firstName = viewbtn.dataset.firstname;
        var midName = viewbtn.dataset.midname;
        var surname = viewbtn.dataset.surname;
        var gender = viewbtn.dataset.gender;
        var birthdate = viewbtn.dataset.birthdate;
        var compAddress = viewbtn.dataset.compaddress;
        var motherName = viewbtn.dataset.mothername;
        var motherOccupation = viewbtn.dataset.motheroccupation;
        var fatherName = viewbtn.dataset.fathername;
        var fatherOccupation = viewbtn.dataset.fatheroccupation;
        var guardianName = viewbtn.dataset.guardianname;
        var guardianPhone = viewbtn.dataset.guardianphone;


        viewPopup.style.opacity = "1";
        viewPopup.style.visibility = "visible";

        document.getElementById('student_id').innerHTML = ID;
        document.getElementById('student_name').innerHTML = firstName + " " + midName + " " + surname;
        document.getElementById('student_address').innerHTML = compAddress;
        document.getElementById('student_gender').innerHTML = gender;
        document.getElementById('student_birthdate').innerHTML = birthdate;
        document.getElementById('mother_name').innerHTML = motherName;
        document.getElementById('mother_occu').innerHTML = motherOccupation;
        document.getElementById('father_name').innerHTML = fatherName;
        document.getElementById('father_occu').innerHTML = fatherOccupation;
        document.getElementById('guardian_name').innerHTML = guardianName;
        document.getElementById('guardian_phone').innerHTML = guardianPhone;
        e.stopPropagation();


    })
})

addStudentBtn.addEventListener("click", e => {
    toggleAdmissionForm();
    e.stopPropagation();
})

editbtns.forEach(editbtn => {
    editbtn.addEventListener("click", e => {
        var ID = editbtn.dataset.id;
        var firstName = editbtn.dataset.firstname;
        var midName = editbtn.dataset.midname;
        var surname = editbtn.dataset.surname;
        var gender = editbtn.dataset.gender;
        var birthdate = editbtn.dataset.birthdate;
        var compAddress = editbtn.dataset.compaddress;
        var motherName = editbtn.dataset.mothername;
        var motherOccupation = editbtn.dataset.motheroccupation;
        var fatherName = editbtn.dataset.fathername;
        var fatherOccupation = editbtn.dataset.fatheroccupation;
        var guardianName = editbtn.dataset.guardianname;
        var guardianPhone = editbtn.dataset.guardianphone;
        document.addEventListener('click', ev =>{
            if (!editContainer.contains(ev.target) && ![...editbtns].includes(ev.target)) {
                        closeEditContainer();
                    }
        })
        // Call toggleEditContainer with the extracted data
        editInfo(ID, firstName, midName, surname, gender, birthdate, compAddress, motherName, motherOccupation, fatherName, fatherOccupation, guardianName, guardianPhone);
        
        e.stopPropagation();
    });
});


function closeAdmissionForm(){
    var admissionForm = document.getElementById("admissionContainer");
    setTimeout(function() {
        admissionForm.style.opacity = "0";
        admissionForm.style.visibility = "hidden";
        // admissionForm.style.display = "none";
    }, 30);
}

function closeEditContainer(){
    var editContainer = document.getElementById("editContainer");
    setTimeout(function (){
        editContainer.style.opacity = "0";
        editContainer.style.visibility = "hidden";
        // admissionForm.style.display = "none";
    }, 30);
}

function toggleAdmissionForm() {
    closeV();
    closeEditContainer();
    var admissionForm = document.getElementById("admissionContainer");
    admissionForm.style.opacity = "1";
    admissionForm.style.visibility = "visible";
    

    var cancel = document.getElementById('cancel-btn');
    cancel.addEventListener('click', cancelClickListener);


    function cancelClickListener() {
        admissionForm.style.opacity = "0";
        setTimeout(function() {
            admissionForm.style.visibility = "hidden";
        }, 300); // Adjust the timeout duration if needed
        cancel.removeEventListener('click', cancelClickListener);
    }
    
   
}



function toggleEditContainer() {
    var editContainer = document.getElementById("editContainer");
    editContainer.style.opacity = "1";
    editContainer.style.visibility = "visible";

    var editcancel = document.getElementById('edit-cancel-btn');
    editcancel.addEventListener('click', cancelClickListener);

    function cancelClickListener() {
        editContainer.style.opacity = "0";
        setTimeout(function() {
            editContainer.style.visibility = "hidden";
        }, 300); // Adjust the timeout duration if needed
        editcancel.removeEventListener('click', cancelClickListener);
    }
    
}


function editInfo(studentID, firstName, middleName, lastName, gender, birthdate, address, motherName, motherOccupation, fatherName, fatherOccupation, guardianName, guardianPhone) {
    closeAdmissionForm();
    closeV();
    var header = document.getElementById('admission-header');
    document.querySelector("input[name='edit-ID']").readOnly = true;
    document.getElementsByName("edit-ID")[0].value = studentID;
    document.getElementsByName("edit-first-name")[0].value = firstName;
    document.getElementsByName("edit-middle-name")[0].value = middleName;
    document.getElementsByName("edit-last-name")[0].value = lastName;
    var genderRadio = document.querySelector("input[name='edit-gender'][value='" + gender + "']");
    if (genderRadio) {
        genderRadio.checked = true;
    } else {
        console.error("Gender radio button with value '" + gender + "' not found.");
    }
    document.getElementsByName("edit-birthdate")[0].value = birthdate;
    document.getElementsByName("edit-address")[0].value = address;
    document.getElementsByName("edit-mother-name")[0].value = motherName;
    document.getElementsByName("edit-mother-occupation")[0].value = motherOccupation;
    document.getElementsByName("edit-father-name")[0].value = fatherName;
    document.getElementsByName("edit-father-occupation")[0].value = fatherOccupation;
    document.getElementsByName("edit-guardian-name")[0].value = guardianName;
    document.getElementsByName("edit-guardian-phone")[0].value = guardianPhone;
    
    toggleEditContainer();
}




function closeV(){

    var viewPopup = document.getElementById('viewPopup')
    viewPopup.style.opacity = "0";
    viewPopup.style.visibility = "hidden";
    
}


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


    var viewbtns = document.querySelectorAll('#view-btn')
        var viewPopup = document.querySelector('#viewPopup');

        viewbtns.forEach(viewbtn => {
        viewbtn.addEventListener("click", e => {
        closeAdmissionForm();
        closeEditContainer();
        var ID = viewbtn.dataset.id;
        var firstName = viewbtn.dataset.firstname;
        var midName = viewbtn.dataset.midname;
        var surname = viewbtn.dataset.surname;
        var gender = viewbtn.dataset.gender;
        var birthdate = viewbtn.dataset.birthdate;
        var compAddress = viewbtn.dataset.compaddress;
        var motherName = viewbtn.dataset.mothername;
        var motherOccupation = viewbtn.dataset.motheroccupation;
        var fatherName = viewbtn.dataset.fathername;
        var fatherOccupation = viewbtn.dataset.fatheroccupation;
        var guardianName = viewbtn.dataset.guardianname;
        var guardianPhone = viewbtn.dataset.guardianphone;


        viewPopup.style.opacity = "1";
        viewPopup.style.visibility = "visible";

        document.getElementById('student_id').innerHTML = ID;
        document.getElementById('student_name').innerHTML = firstName + " " + midName + " " + surname;
        document.getElementById('student_address').innerHTML = compAddress;
        document.getElementById('student_gender').innerHTML = gender;
        document.getElementById('student_birthdate').innerHTML = birthdate;
        document.getElementById('mother_name').innerHTML = motherName;
        document.getElementById('mother_occu').innerHTML = motherOccupation;
        document.getElementById('father_name').innerHTML = fatherName;
        document.getElementById('father_occu').innerHTML = fatherOccupation;
        document.getElementById('guardian_name').innerHTML = guardianName;
        document.getElementById('guardian_phone').innerHTML = guardianPhone;
        e.stopPropagation();


    })
})

document.addEventListener("click", e => {
    if(!admissionContainer.contains(e.target) && e.target !== addStudentBtn){
        closeAdmissionForm();
    }
    if (!editContainer.contains(e.target) && ![...editbtns].includes(e.target)) {
        closeEditContainer();
    }
    if (!viewPopup.contains(e.target) && ![...viewbtns].includes(e.target)){
        closeV();
    }
})

const form = document.querySelector('.addForm');

    form.addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    const formData = new FormData(form);
    const inputValue = document.getElementById("guardian-phone").value;
    const alertMessage = document.querySelector('.alert');

    const studentID = document.getElementById("ID").value;
    const firstName = document.getElementById("first-name").value;
    const middleName = document.getElementById("middle-name").value;
    const lastName = document.getElementById("last-name").value;
    const gender = document.querySelector('input[name="gender"]:checked');
    const birthdate = document.getElementById("birthdate").value;
    const address = document.getElementById("address").value;
    const motherName = document.getElementById("mother-name").value;
    const motherOccupation = document.getElementById("mother-occupation").value;
    const fatherName = document.getElementById("father-name").value;
    const fatherOccupation = document.getElementById("father-occupation").value;
    const guardianName = document.getElementById("guardian-name").value;
    const guardianPhone = document.getElementById("guardian-phone").value;
    

    if (
    studentID === "" ||
    firstName === "" ||
    middleName === "" ||
    lastName === "" ||
    gender === null ||
    birthdate === "" ||
    address === "" ||
    motherName === "" ||
    motherOccupation === "" ||
    fatherName === "" ||
    fatherOccupation === "" ||
    guardianName === "" ||
    guardianPhone === ""
    ) {
        alertMessage.style.display = "flex";
        alertMessage.innerHTML = "Please fill in the required field";
    }
    else if (inputValue.length !== 11) {
        alertMessage.style.display = "flex";
        alertMessage.innerHTML = "Phone number must be 11 digits long";
        setTimeout(function() {
            alertMessage.style.display = "none";
        }, 2000); 
    } else {
        fetch('add_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Handle successful response
            alertMessage.style.display = "flex";
            alertMessage.style.backgroundColor = "#1B4D3E";
            alertMessage.innerHTML = "Student added successfully";
            setTimeout(function() {
                location.reload(); // Reload page after 800 milliseconds
            }, 800);
        })
        .catch(error => {
            // Handle error
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});




   