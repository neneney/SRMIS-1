var addbtn = document.getElementById('add-user-btn');
var addForm = document.getElementById("addContainer");
var editbtns = document.querySelectorAll('#edit-btn');
var editForms = document.getElementById('editContainer');

document.addEventListener("click", e => {
    if(!addForm.contains(e.target) && e.target !== addbtn){
        closeAddForm();
    }
    if(!editForms.contains(e.target) && ![...editbtns].includes(e.target)){
        closeEditForm();
    }
})

function closeEditForm(){
    editForms.style.accentColorvisibility = "hidden";
    editForms.style.opacity = "0";
}

function closeAddForm(){
    addForm.style.opacity = "0";
    addForm.style.visibility = "hidden";
}

addbtn.addEventListener('click', e => {
addForm.style.opacity = "1";
addForm.style.visibility = "visible";


var cancel = document.getElementById('cancel-btn');
cancel.addEventListener('click', cancelClickListener);


function cancelClickListener() {
    admissionForm.style.opacity = "0";
    setTimeout(function() {
        admissionForm.style.visibility = "hidden";
    }, 300);
    cancel.removeEventListener('click', cancelClickListener);
}
})

editbtns.forEach(editbtn => {
    editbtn.addEventListener('click', e =>{
        let editContainer = document.getElementById('editContainer');
        editContainer.style.visibility = "visible";
        editContainer.style.opacity = "1";

        
    var cancel = document.getElementById('edit-cancel-btn');
    cancel.addEventListener('click', cancelClickListener);


    function cancelClickListener() {
        editContainer.style.opacity = "0";
        setTimeout(function() {
            editContainer.style.visibility = "hidden";
        }, 300);
        cancel.removeEventListener('click', cancelClickListener);
    }

        let ID = editbtn.dataset.id;
        let fullname = editbtn.dataset.fullname;
        let username = editbtn.dataset.username;
        let status = editbtn.dataset.status;

        var defaultID = document.getElementById('edit-ID');
        defaultID.readOnly = true;
        defaultID.value = ID;
        document.getElementById('edit-full-name').value = fullname;
        document.getElementById('edit-username').value = username;
        document.getElementById('edit-status').innerHTML = status;
    })
})



const form = document.querySelector('.addForm');
form.addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    const formData = new FormData(form);
    const alertMessage = document.querySelector('.alert');

    const pass = document.querySelector('#password').value; 
    const confPass = document.querySelector('#confirm-pass').value; 

    if (pass !== confPass){
        alertMessage.style.display = "flex";
        alertMessage.style.backgroundColor = "#FF6347"; 
        alertMessage.innerHTML = "Password does not match";
        setTimeout(function() {
            alertMessage.style.display = "none";
        }, 2000); 
    } else {
        
        fetch('add_user.php', {
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
            if (data.includes('successfully')) {
                
                alertMessage.style.display = "flex";
                alertMessage.style.backgroundColor = "#1B4D3E";
                alertMessage.innerHTML = data; 
                setTimeout(function() {
                    location.reload(); 
                }, 800);
            } else {
                
                alertMessage.style.display = "flex";
                alertMessage.style.backgroundColor = "#FF6347"; 
                alertMessage.innerHTML = data; 
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});


const editForm = document.querySelector('.editForm');
editForm.addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    let formData = new FormData(editForm);
    let alertMessage = document.querySelectorAll('.alert');

    const pass = document.querySelector('#edit-password').value; 
    const confPass = document.querySelector('#edit-confirm-pass').value; 

    if (pass !== confPass){
        alertMessage[1].style.display = "flex";
        alertMessage[1].style.backgroundColor = "#FF6347"; 
        alertMessage[1].innerHTML = "Password does not match";
        setTimeout(function() {
            alertMessage.style.display = "none";
        }, 2000); 
    } else {
        
        fetch('edit_user.php', {
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
            if (data.includes('successfully')) {
                
                alertMessage[1].style.display = "flex";
                alertMessage[1].style.backgroundColor = "#1B4D3E";
                alertMessage[1].innerHTML = data; 
                setTimeout(function() {
                    location.reload(); 
                }, 800);
            } else {
                
                alertMessage[1].style.display = "flex";
                alertMessage[1].style.backgroundColor = "#FF6347"; 
                alertMessage[1].innerHTML = data; 
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});




function blockUser(userID) {
    // Confirm with the user before proceeding
    if (confirm("Are you sure you want to block/unblock this user?")) {
        // Create a FormData object to send data
        let formData = new FormData();
        formData.append('userID', userID); // Add userID to FormData object

        // Send an AJAX request to the server
        fetch('block_user.php', {
            method: 'POST',
            body: formData // Set the request body to the FormData object
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            // Handle errors (e.g., display an error message)
            alert('Error: Unable to block/unblock the user');
        });
    }
}

