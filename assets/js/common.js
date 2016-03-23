function outputFormErrors(returnedErrorsArr, inputs) {
    var errors = new Array();

    // Append JSON error array keys to a new array object
    $.each(returnedErrorsArr, function(field) {
        errors.push(field);
    });

    var errorArray = [];

    $.each(inputs, function() {
        var field = this.id;

        // If the field name is in the errors array
        if ($.inArray(field, errors) !== -1) {
            // if it doesn't exist (meaning this was the first error for that input field)
            if($('#' + field + '_error').length == 0) {
                $('#error-message').removeClass('success hidden').addClass('error');
                errorArray.push('<li id="' + field + '_error">' + returnedErrorsArr[field] + '</li>');
            } else {
                $('#' + field + '_error').html(returnedErrorsArr[field]);
            }
        } else {
            $('#' + field + '_error').remove();
        }
    });

    $('ul#error-list').append(errorArray.join(''));
}

function refreshSelect(obj) {
    var val = $(obj).val();

    if (val != 0) {
        $('#entries').show();
    } else {
        $('#entries').hide();
    }
}

function checkQuest(form, formId) {
    var values = $(form).serialize();

    $.post(base_url + 'home/check-quest', values, function(data) {
        if (data.error) {
            var inputs = $('#'+ formId +' :text, :password, select, textarea, :hidden');
            outputFormErrors(data.fields, inputs);
        } else {
            $('#error-message').addClass('hidden');

            // if quest is found
            if (data.questCheck) {
                $('#response').html('You have completed this quest!');
            } else {
                var realmVal = $('#realm').val();
                var realm = $("#realm option[value='" + realmVal +"']").text();
                var alias = $('#alias').val();
                $('#response').html('This quest either does not exist or has not been completed by ' + alias + ' on ' + realm);
            }

            $('#response').show();

            //location.reload();
        }
    });

    return false;
}