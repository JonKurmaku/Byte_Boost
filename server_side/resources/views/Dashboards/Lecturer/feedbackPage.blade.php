
    <h1>Feedback for Courses</h1>
    @if ($feedback->isEmpty())
        <p>No feedback available.</p>
    @else
        <ul>
            @foreach ($feedback as $entry)
                <li>
                    
                    <strong>Course Name:</strong> {{ $entry->course->course_name }}
                    <br>
                    <strong>Rating:</strong> {{ $entry->rating }}
                    <br>
                    <strong>Comment:</strong> {{ $entry->comment }}
                    <br>
                    <strong>Sender ID:</strong> {{ $entry->student_id }}
                </li>
            @endforeach
        </ul>
    @endif
