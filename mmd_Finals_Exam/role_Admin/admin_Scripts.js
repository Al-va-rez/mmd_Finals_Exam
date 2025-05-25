// docList styles
    $('.documents').addClass('flex flex-col max-w-full p-5 hover:cursor-pointer hover:bg-blue-100');
    $('.documentContainer').addClass('flex flex-row flex-nowrap w-full');
    $('.documentIcon').attr('src', 'https://ssl.gstatic.com/docs/doclist/images/mediatype/icon_1_document_x32.png').addClass('inline-block w-5 h-5');
    $('.columnIcon').addClass('w-1/12');
    $('.columnTitle').addClass('w-5/12 font-semibold');
    $('.columnOwner').addClass('w-2/12 truncate text-center font-semibold text-gray-500');
    $('.columnDate').addClass('w-5/12 text-center font-semibold text-gray-500');
    $('.columnMisc').addClass('w-1/12 text-center font-semibold text-gray-500');
// docList styles


// tabButton styles and logic
    $('.tabButton').addClass('border-x border-t rounded-t-lg border-black px-4 py-1 hover:bg-gray-200');
    $('.tabContent').addClass('flex flex-col mx-auto max-w-[75%] max-h-fit');

    $('#userList').hide();

    var $buttons = $('.tabButton');
    var $tabContents = $('.tabContent');

    $buttons.first().addClass('bg-blue-500 text-white hover:bg-blue-600').removeClass('hover:bg-gray-200');

    $buttons.on('click',
        function () {
            var index = $buttons.index(this);

            $tabContents.hide();
            $buttons.removeClass('bg-blue-500 text-white hover:bg-blue-600').addClass('hover:bg-gray-200');

            $tabContents.eq(index).show();
            $(this).addClass('bg-blue-500 text-white hover:bg-blue-600').removeClass('hover:bg-gray-200');
        }
    );
// tabButton styles and logic


// userList styles
    $('.gdocsUsers').addClass('flex flex-col max-w-full p-5 hover:cursor-pointer hover:bg-blue-100');
    $('.userContainer').addClass('flex flex-row flex-nowrap w-full items-center');
    $('.columnUsername').addClass('w-5/12');
    $('.columnFirstName').addClass('w-2/12 text-center');
    $('.columnLastName').addClass('w-5/12 text-center');
    $('.columnRegister').addClass('w-1/12 text-center');
    $('.columnSuspend').addClass('w-1/12 text-center');
// userList styles