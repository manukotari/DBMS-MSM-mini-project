let meetings = [];

// Function to store meetings in table format
function renderMeetings() {
    const meetingsBody = document.getElementById("meetingsBody");
    meetingsBody.innerHTML = ''; // Clear table body

    const today = new Date().toISOString().split('T')[0];  // Get current date

    meetings.forEach((meeting, index) => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${meeting.title}</td>
            <td>${meeting.desc}</td>
            <td>${meeting.date}</td>
            <td>${meeting.time}</td>
            <td>
                <button class="edit-btn" onclick="editMeeting(${index})">Edit</button>
                <button class="delete-btn" onclick="deleteMeeting(${index})">Delete</button>
            </td>
        `;

        meetingsBody.appendChild(row);
    });
}

// add meeting fun
document.getElementById("meetingForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const meetingTitle = document.getElementById("meetingBook").value;
    const meetingDesc = document.getElementById("meetingdesc").value;
    const meetingDate = document.getElementById("meetingDate").value;
    const meetingTime = document.getElementById("meetingTime").value;

    // Add the meeting to the array
    meetings.push({ title: meetingTitle, desc: meetingDesc, date: meetingDate, time: meetingTime });

    renderMeetings();  // Re-render meetings in the table
    this.reset();  // Reset the form fields
});

// Function to delete a meeting
function deleteMeeting(index) {
    meetings.splice(index, 1);  // Remove meeting from array
    renderMeetings();  // Re-render meetings
}

// Function to edit a meeting
function editMeeting(index) {
    const meeting = meetings[index];

    // Populate the form with the current values
    document.getElementById("meetingBook").value = meeting.title;
    document.getElementById("meetingdesc").value = meeting.desc;
    document.getElementById("meetingDate").value = meeting.date;
    document.getElementById("meetingTime").value = meeting.time;

    // Remove the current meeting so it can be updated
    meetings.splice(index, 1);
    renderMeetings();  // Re-render meetings
}

// Initial render (empty table)
renderMeetings();


const meetingForm = document.getElementById("meetingForm");
const meetingsBody = document.getElementById("meetingsBody");

meetingForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const meetingTitle = document.getElementById("meetingBook").value;
    const meetingDescription = document.getElementById("meetingdesc").value;
    const meetingDate = document.getElementById("meetingDate").value;
    const meetingTime = document.getElementById("meetingTime").value;

    const meetingRow = document.createElement("tr");
    meetingRow.innerHTML = `
        <td>${meetingTitle}</td>
        <td>${meetingDescription}</td>
        <td>${meetingDate}</td>
        <td>${meetingTime}</td>
        <td>
            <button class="edit-btn">Edit</button>
            <button class="delete-btn">Delete</button>
        </td>
    `;
    
    meetingsBody.appendChild(meetingRow);
    
    // Clear form inputs
    meetingForm.reset();

    // Add event listener for delete button
    const deleteButton = meetingRow.querySelector(".delete-btn");
    deleteButton.addEventListener("click", () => {
        const reason = prompt("Please provide a reason for canceling the meeting:");
        if (reason) {
            meetingsBody.removeChild(meetingRow);
            alert(`Meeting canceled for the following reason: ${reason}`);
        } else {
            alert("Cancelation reason is required to delete the meeting.");
        }
    });
});
