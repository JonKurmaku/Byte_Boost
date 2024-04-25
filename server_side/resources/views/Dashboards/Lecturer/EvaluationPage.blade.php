<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Evaluation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #000000, #00008B);
            color: white;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
           
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
           
        }

        th {
            background-color: #fffcfc;
            color: black;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }

        #popup {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            text-align: center;
            position: relative;
            color: black;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <h1>Final Assessment Evaluation</h1>
    <table id="evaluationTable">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Final Assessment</th>
                <th>Evaluation Requests</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Calculus</td>
                <td><button onclick="viewAssessment()">View</button></td>
                <td><button onclick="showPopup()">Evaluate</button></td>
            </tr>
        </tbody>
    </table>
    <button onclick="saveGrades()">Save Grades</button>

    <div id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <p>List of students requesting evaluation for Calculus will go here.</p>
        </div>
    </div>

    <script>
        function showPopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'flex';
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }

        function saveGrades() {
            alert('Grades saved!');
        }

        function viewAssessment() {
            alert('Assessment details for Calculus.');
        }
    </script>
</body>
</html>
