let myTimeout;
$('#editor').on('input',
    function(event) {
        event.preventDefault();

        clearTimeout(myTimeout);

        var formData = {
            content: $(this).html(),
            docId: $(this).data('doc-id'),
            saveReq: 1
        };

        myTimeout = setTimeout(function() {
            $.ajax(
                {
                    type: 'POST',
                    url: '../core/handleForms.php',
                    data: formData,
                    success: function(data) {
                        switch (data) {
                            case 'Success':
                                console.log(formData.content);
                                break;
                        
                            default:
                                console.log('aaaaaaaaaaaaaaaa');
                                break;
                        }
                    }
                }
            )
        }, 1000);
    }
);

// $('#shareInterface').hide();
// toolbar functionalities
    $('.inputBox').addClass('border border-gray-500 rounded-md focus:cursor-none focus:outline-blue-500');

    $('.inputField').addClass('flex flex-col w-full text-xl');

    $('#shareButton').on('click',
        function(event) {
            event.preventDefault();

            $('#shareInterface').show();
        }
    );

    $('.shareDocument').on('change',
    function(event) {
        event.preventDefault();

        var formData = {
            collaboratorId: $(this).closest('.collaborator').data('collaborator-id'),
            docId: $('#editor').data('doc-id'),
            shareReq: 1
        };

        if (formData.status != '') {
            $.ajax(
                {
                    type: 'POST',
                    url: '../core/handleForms.php',
                    data: formData,
                    success: function(data) {
                        switch (data) {
                            case 'Success':
                                console.log('Document shared');
                                break;
                        
                            default:
                                console.log('aaaaaaaaaaaaaa');
                                break;
                        }
                    }
                }
            )
        }
    }
);