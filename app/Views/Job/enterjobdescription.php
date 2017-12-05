<!DOCTYPE html>
<html>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 30%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<body>

<h3>Enter Job Description</h3>
<table align="center" width="30%" border="0">
<div>
  <form action="/action_page.php">
    
    <label for="jobtitle">Job Title</label>
    <input type="text" id="job_title" name="firstname" placeholder="Your Job Title..">

    <label for="startdate">Start Date</label>
    <input type="text" id="start_date" name="StartDate" placeholder="Start Date..">
    
    <label for="enddate">End Date</label>
    <input type="text" id="end_date" name="StartDate" placeholder="End Date..">
    
    <label for="hours">No.of working hours</label>
    <input type="text" id="working_hours" name="StartDate" placeholder="Number of working hours..">
    
    <label for="payrate">Pay per hour</label>
    <input type="text" id="pay" name="Payrate" placeholder="Pay/hour..">

<label for="time">Time</label>
    <input type="text" id="time" name="Time" placeholder="Time to start the work..">
    
    <label for="location">Address of location</label>
    <input type="text" id="address" name="address" placeholder="Address..">
    
    <label for="description">Job Description</label>
    <input type="text" id="job_description" name="jobdescription" placeholder="Give your job description..">
    
    <input type="submit" value="POST" >

  </form>
</div>
</table>
</body>
</html>
