
<div style="background:red; color:white; padding:5px; font-size:10px; width:100px;" data-target="{{ $session->time }}" data-id="{{ $session->id }}" class="countdown"></div>
<script>
    function updateCountdown(element) {
        var targetDateTime = element.getAttribute('data-target');
        var targetDate = new Date(targetDateTime);
        var id = element.getAttribute('data-id');

        var currentDate = new Date();
        var remainingTime = targetDate - currentDate;
        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        element.innerHTML = "Time Remaining: " + days + " days, " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds";
    }

    var countdownElements = document.querySelectorAll('.countdown');
    countdownElements.forEach(function(element) {
        updateCountdown(element);
        setInterval(function() {
            updateCountdown(element);
        }, 1000);
    });
</script>
