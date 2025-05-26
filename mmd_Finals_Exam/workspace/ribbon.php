<body class="bg-gray-100">
    <!-- Ribbon Container -->
    <div class="w-full bg-white shadow flex flex-col">
        <!-- Top Bar -->
        <div class="flex items-center px-4 py-2">
            <!-- Google Docs Icon -->
            <div class="flex items-center mr-4">
                <div class="w-8 h-8 bg-blue-500 rounded flex items-center justify-center hover:cursor-pointer">
                    <img id="homeIcon" src="https://ssl.gstatic.com/docs/doclist/images/mediatype/icon_1_document_x32.png" alt="">
                </div>
                <span id="docTitle" class="ml-2 text-lg font-semibold text-gray-800"><?= (isset($_GET['docId'])) ? $getAccessedDocument['title'] : 'Untitled Document' ?></span>
                <form id="formDocTitle" class="ml-4">
                    <input type="text" id="docTitleInput" class="ml-2 border-b border-gray-300 focus:outline-none focus:border-blue-500">
                </form>
                
                <span id="savingStatus" class="ml-2 text-sm text-gray-500">Saving...</span>
            </div>
            <!-- Menu -->
            <div class="flex space-x-4 text-sm text-gray-700 font-medium">
                <button class="hover:bg-gray-100 px-2 py-1 rounded">File</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Edit</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">View</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Insert</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Format</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Tools</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Extensions</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Help</button>
            </div>
            <!-- Spacer -->
            <div class="flex-1"></div>
            <!-- Action Icons -->
            <div class="flex items-center space-x-2">
                <button id="messageButton" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <button id="historyButton" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-8 h-8 rounded-full border-2 border-blue-500">
            </div>
        </div>
        <!-- Toolbar -->
        <div class="flex items-center px-4 py-2 border-t border-b bg-gray-50">
            <!-- undo -->
            <button class="p-2 hover:bg-gray-200 rounded" title="Undo">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 14H5v-4" />
                    <path d="M20 20a9 9 0 10-8 8" />
                </svg>
            </button>
            <!-- redo -->
            <button class="p-2 hover:bg-gray-200 rounded" title="Redo">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 10h4v4" />
                    <path d="M4 4a9 9 0 018 8" />
                </svg>
            </button>
            <!-- dividier -->
            <div class="w-px h-6 bg-gray-300 mx-2"></div>
            <!-- typeface -->
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2">
                <option value="p">Normal text</option>
                <option value="h1">Title</option>
                <option value="h2">Subtitle</option>
                <option value="h3">Heading 1</option>
                <option value="h4">Heading 2</option>
            </select>
            <!-- font family -->
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2">
                <option value="Arial">Arial</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Calibri">Calibri</option>
            </select>
            <!-- font size -->
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2" style="width: 60px;">
                <option>11</option>
                <option>12</option>
                <option>14</option>
                <option>18</option>
            </select>
            <!-- typography -->
            <div class="flex items-center space-x-1">
                <button class="p-2 hover:bg-gray-200 rounded font-bold" title="Bold">
                    <span class="font-bold text-gray-700">B</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded italic" title="Italic">
                    <span class="italic text-gray-700">I</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded underline" title="Underline">
                    <span class="underline text-gray-700">U</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Text color">
                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 01.894.553l5 10A1 1 0 0115 14H5a1 1 0 01-.894-1.447l5-10A1 1 0 0110 2zm0 3.618L6.382 12h7.236L10 5.618zM10 16a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Highlight color">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <rect x="4" y="4" width="12" height="12" rx="2"/>
                    </svg>
                </button>
            </div>
            <!-- divider -->
            <div class="w-px h-6 bg-gray-300 mx-2"></div>
            <!-- alignment and lists -->
            <div class="flex items-center space-x-1">
                <button class="p-2 hover:bg-gray-200 rounded" title="Align left">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 6h18M3 12h12M3 18h18"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Align center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 6h12M3 12h18M6 18h12"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Align right">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 12h12M3 18h18"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Numbered list">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 6h13M8 12h13M8 18h13"/>
                        <circle cx="4" cy="6" r="1"/>
                        <circle cx="4" cy="12" r="1"/>
                        <circle cx="4" cy="18" r="1"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Bulleted list">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 6h13M8 12h13M8 18h13"/>
                        <circle cx="4" cy="6" r="1"/>
                        <circle cx="4" cy="12" r="1"/>
                        <circle cx="4" cy="18" r="1"/>
                    </svg>
                </button>
            </div>
            <!-- divider -->
            <div class="flex-1"></div>
            <!-- Share Button -->
            <button id="shareButton" class="ml-2 px-4 py-1 bg-blue-600 text-white rounded font-medium hover:bg-blue-700">Share</button>
        </div>
    </div>
</body>