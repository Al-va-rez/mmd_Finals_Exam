$('#editor').on('input',
    function(event) {
        event.preventDefault();

        var formData = {
            content: $(this).text(),
            docId: $(this).data('doc-id'),
            saveReq: 1
        };

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
    }
);