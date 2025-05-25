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


// toolbar functionalities