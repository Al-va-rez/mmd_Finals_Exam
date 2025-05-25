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


// ribbon functionalities
    $('#shareInterface').hide();
    $('.inputBox').addClass('border border-gray-500 rounded-md focus:cursor-none focus:outline-blue-500');

    $('.inputField').addClass('flex flex-col w-full text-xl');


    $('#shareButton').on('click',
        function(event) {
            event.preventDefault();

            $('#shareInterface').show();
        }
    );

    $('#closeShareInterface').on('click',
        function(event) {
            event.preventDefault();

            $('#shareInterface').hide();
        }
    );


    $('#searchInput').on('input',
        function(event) {
            event.preventDefault();

            var formData = {
                username: $(this).val(),
                docId: $('#docId').val(),
                searchReq: 1
            };

            $.ajax(
                {
                    type: 'POST',
                    url: '../core/handleForms.php',
                    data: formData,
                    success: function(data) {
                        if (formData.username == '') {
                            $('#searchedUsers').hide();
                            $('#retrievedUsers').show();
                        } else {
                            $('#retrievedUsers').hide();
                            $('#searchedUsers').html(data).show();
                        }
                        
                    }
                }
            )
        }
    );


    $('.usersList').on('change', '.shareDocument',
        function(event) {
            event.preventDefault();

            var verdict = $(this).is(':checked') ? 'Share' : 'Unshare';

            var formData = {
                collaboratorId: $(this).closest('.collaborator').data('collaborator-id'),
                docId: $('#editor').data('doc-id'),
                status: verdict,
                shareReq: 1
            };

            $.ajax(
                {
                    type: 'POST',
                    url: '../core/handleForms.php',
                    data: formData,
                    success: function(data) {
                        switch (data) {
                            case 'Share':
                                console.log('Document shared');
                                break;
                            
                            case 'Unshare':
                                console.log('Document unshared');
                                break;
                        
                            default:
                                console.log('aaaaaaaaaaaaaa');
                                break;
                        }
                    }
                }
            )
        }
    );


    $('#homeIcon').on('click',
        function(event) {
            window.location.href = '../index.php';
        }
    );
// ribbon functionalities