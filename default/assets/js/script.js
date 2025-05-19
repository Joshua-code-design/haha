$(document).ready(function() {
    // Calculate age when birthdate changes
    $('#birthdate').on('change', calculateAge);
    
    // Form submission handler
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault();
        
        // Hide any previous messages
        $('#successMessage, #errorMessage').hide();
        
        // Disable submit button to prevent multiple submissions
        $('button[type="submit"]').prop('disabled', true).html('Submitting... <i class="fas fa-spinner fa-spin"></i>');
        
        // Submit form via AJAX
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Show success message
                    $('#successText').text(response.message);
                    $('#successMessage').show();
                    
                    // Reset form
                    $('#registrationForm')[0].reset();
                    $('#age').val('');
                    
                    // Hide success message after 5 seconds
                    setTimeout(function() {
                        $('#successMessage').fadeOut();
                    }, 5000);
                } else {
                    // Show error message
                    $('#errorText').text(response.message);
                    $('#errorMessage').show();
                }
            },
            error: function(xhr, status, error) {
                // Show error message
                $('#errorText').text('An error occurred: ' + error);
                $('#errorMessage').show();
            },
            complete: function() {
                // Re-enable submit button
                $('button[type="submit"]').prop('disabled', false).html('Submit <i class="fas fa-paper-plane"></i>');
            }
        });
    });
});

// Calculate age from birthdate
function calculateAge() {
    const birthdate = $('#birthdate').val();
    if (birthdate) {
        const today = new Date();
        const birthDate = new Date(birthdate);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        $('#age').val(age);
    }
}


 // Mobile number validation to allow only numbers, spaces, and dashes
 document.getElementById('mobileNumber').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9\s-+()]/g, '');
});