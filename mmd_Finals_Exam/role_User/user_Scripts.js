$('.documents').addClass('flex flex-col max-w-full p-5 hover:cursor-pointer hover:bg-blue-100');

$('.documentIcon').attr('src', 'https://ssl.gstatic.com/docs/doclist/images/mediatype/icon_1_document_x32.png').addClass('inline-block w-5 h-5');

$('.documentContainer').addClass('flex flex-row flex-nowrap w-full');

$('.columnIcon').addClass('w-1/12');
$('.columnTitle').addClass('w-5/12');
$('.columnOwner').addClass('w-2/12 truncate text-center');
$('.columnDate').addClass('w-5/12 text-center');
$('.columnMisc').addClass('w-1/12 text-center');



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
                        
                        case 'Error creating document':
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