<!DOCTYPE html>
<html>
<body>
    <h2>Γεια σου, {{ $candidate->name }}!</h2>
    <p>Θα θέλαμε να σε ενημερώσουμε ότι η κατάσταση της αίτησής σου για τη θέση <strong>{{ $candidate->job->title }}</strong> άλλαξε σε:</p>
    
    <h3 style="color: #4f46e5;">
        @if($candidate->status == 'interview') Ραντεβού για Συνέντευξη 
        @elseif($candidate->status == 'hired') Πρόσληψη 
        @elseif($candidate->status == 'rejected') Απόρριψη 
        @endif
    </h3>

    <p>Θα επικοινωνήσουμε σύντομα μαζί σου για τα επόμενα βήματα.</p>
    <p>Φιλικά,<br>Η ομάδα του SmartRecruit</p>
</body>
</html>