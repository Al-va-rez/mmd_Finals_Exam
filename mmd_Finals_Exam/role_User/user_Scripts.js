// styles
    $('.documents').addClass('flex flex-col max-w-full p-4 hover:cursor-pointer hover:bg-blue-100');

    $('.documentIcon').attr('src', 'https://ssl.gstatic.com/docs/doclist/images/mediatype/icon_1_document_x32.png').addClass('inline-block w-5 h-5');

    $('.documentContainer').addClass('flex flex-row flex-nowrap w-full items-center');

    $('.columnIcon').addClass('w-1/12');
    $('.columnTitle').addClass('w-5/12 font-semibold');
    $('.columnOwner').addClass('w-2/12 truncate text-center font-semibold text-gray-500');
    $('.columnDate').addClass('w-5/12 text-center font-semibold text-gray-500');
    $('.columnMisc').addClass('w-1/12 flex items-center justify-center');
// styles


// create document
$('#createDocument').on('click',
    function () {
        var formData = {createReq: 1};

        $.ajax(
            {
                type: 'POST',
                url: '../core/handleForms.php',
                data: formData,
                success: function(data) {
                    switch (data) {
                        case 'Document created':
                            alert(data);
                            setTimeout(function() {
                                window.location.href = "../workspace/main.php";
                            }, 500);
                            break;
                        
                        case 'Account is suspended':
                            alert(data);
                            break;
                    
                        default:
                            break;
                    }
                }
            }
        )
    }
);


// delete document
$('.deleteBtn').on('click',
    function(event) {
        event.preventDefault();

        var formData = {
            docId: $(this).closest('.documents').data('doc-id'),
            deleteReq: 1
        };

        $.ajax(
            {
                type: 'POST',
                url: '../core/handleForms.php',
                data: formData,
                success: function(data) {
                    switch (data) {
                        case 'Document deleted':
                            alert(data);
                            location.reload();
                            break;
                        
                        case 'Account is suspended':
                            alert(data);
                            break;
                    
                        default:
                            break;
                    }
                }
            }
        )
    }
);