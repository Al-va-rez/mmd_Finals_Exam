<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Google Docs</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </head>
    <body>
        <div class="flex flex-col items-center gap-8 bg-gray-100 w-full h-fit mx-auto py-20">
            <div class="text-2xl">Welcome</div>
            <button class="rounded-full bg-blue-500 px-12 py-5 text-white font-semibold hover:bg-blue-600">Create document</button>
        </div>


        <!-- php loop here; group by time period -->
        <div class="flex flex-col mx-auto max-w-[75%] max-h-fit mt-2">

            <!-- php if-else; show today on first loop; use data attr for "previous..." -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold text-gray-800">
                <div class="w-6/12">Today</div>
                <div class="w-1/12">Owned by</div>
                <div class="w-4/12 text-center">Last Opened</div>
                <div class="w-1/12">Sort</div>
            </div>

            <div class="documents">
                <!-- php loop for all documents in current time period -->
                <div class="documentContainer">
                    <div class="w-1/12">
                        <img class="documentIcon">
                    </div>
                    <div class="w-6/12">
                        <div class="max-w-[70%] truncate">
                            hwdakushdkauwhdkuawhdkuahsduawhdkuahwdkswdawdawdawdnfkauhsd
                        </div>
                    </div>
                    <div class="w-1/12 truncate">Owner</div>
                    <div class="w-6/12 text-center">Date</div>
                    <div class="w-1/12">Accessibility</div>
                </div>
            </div>
            
        </div>


        <script src="user_Scripts.js"></script>
    </body>
</html>