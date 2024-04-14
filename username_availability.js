$(document).ready(function() {

  $('#fname').on('input', function() {
    const name = $(this).val();

    // Generate the suggested username from the input name (you can customize the logic)
    const suggestedUsername = name.replace(/\s+/g, '').toLowerCase();

    // Update the suggestion element with the generated username
    $('#usernameSuggestion').text(suggestedUsername);

    // Check username availability in the database
    $.ajax({
      url: 'check_username.php',
      type: 'POST',
      data: { username: suggestedUsername },
      success: function(response) {
        if (response === 'available') {
          // Username is available, display suggestion as is
          $('#usernameSuggestion').text(suggestedUsername);
        } else {
          // Username is already taken, generate an alternative suggestion
          const alternativeSuggestion = suggestedUsername + Math.floor(Math.random() * 1000);
          $('#usernameSuggestion').text(alternativeSuggestion);
        }
      }
    });
  });

  $('#usernameInput').on('input', function() {
    const username = $(this).val();

    $.ajax({
      url: 'check_username.php',
      type: 'POST',
      data: { username: username },
      success: function(response) {
        if (response === 'available') {
          $('#usernameAvailabilityMessage').text('Username is available.');
        } else if (response === 'unavailable') {
          $('#usernameAvailabilityMessage').text('Username is already taken. Please Enter another');
        }
      }
    });
  });
});