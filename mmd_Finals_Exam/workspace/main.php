<?php
    require_once '../core/dbConfig.php';
    require_once '../core/myFunctions.php';
?>


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

        <?php if (isset($_GET['docId'])) { ?>
            <!-- existing document -->
            <?php $docId = $_GET['docId']; ?>
            <?php $getAccessedDocument = getAccessedDocument($pdo, $docId); ?>
        <?php } else { ?>
            <!-- new document -->
            <?php $getNewDocument = getNewDocument($pdo, $_SESSION['user_id']); ?>
            <?php $docId = $getNewDocument['document_id']; ?>

        <?php } ?>


        <?php include 'ribbon.php'; ?>

        

        <!-- WORKSPACE -->
        <div class="flex flex-col items-center justify-center mt-8">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg border border-gray-200">
                <div class="px-8 py-6 min-h-[600px] outline-none" contenteditable="true" spellcheck="true" id="editor" data-doc-id="<?= $docId ?>">
                    <?= isset($_GET['docId']) ? $getAccessedDocument['content'] : $getNewDocument['content'] ?>
                </div>
            </div>
        </div>
        <!-- /WORKSPACE -->


        <!-- SHARE -->
        <div id="shareInterface" class="fixed inset-0 bg-black bg-opacity-35 flex flex-col items-center justify-center z-50 p-8">

            <?php $allUsers = getAllUsers($pdo); ?>

            <!-- window -->
            <div class="bg-white border rounded-lg shadow-lg p-6 w-[50%] max-h-[70%]">

                <!-- close button -->
                <div class="flex flex-row w-full justify-end">
                    <button class="closeButton bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-3 rounded-full">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </button>
                </div>


                <!-- search field -->
                <div class="inputField mb-4">
                    <label for="searchQuery">Share with: </label>
                    <input id="searchInput" type="text" name="searchQuery" class="inputBox" placeholder="Search for users...">
                    <input type="hidden" id="docId" value="<?= $docId ?>">
                </div>
                

                <!-- list of users -->
                <div id="retrievedUsers" class="usersList flex flex-col mx-auto w-[90%] max-h-[70%] overflow-y-auto divide-y-2">

                    <?php foreach ($allUsers as $user) { ?>

                        <?php if ($user['user_id'] == $_SESSION['user_id']) { continue; } else { ?>

                            <!-- individual record -->
                            <div class="collaborator flex flex-row items-center justify-between px-4 py-2" data-collaborator-id="<?= $user['user_id'] ?>">

                                <!-- username -->
                                <div><?= $user['username'] ?></div>

                                <!-- check if document already shared -->
                                <?php $check_documentShared = check_documentShared($pdo, $docId, $user['user_id']); ?>

                                <!-- share -->
                                <input type="checkbox" class="shareDocument" <?= ($check_documentShared) ? 'checked' : '' ?>>

                            </div>

                        <?php } ?>

                    <?php } ?>

                </div>


                <!-- list of searched users -->
                <div id="searchedUsers" class="usersList flex flex-col mx-auto w-[90%] max-h-[70%] overflow-y-auto divide-y-2">
                    <!-- content added dynamically using jquery -->
                </div>
                
            </div>

        </div>
        <!-- /SHARE -->


        <!-- ACTIVITY LOGS -->
        <div id="historyInterface" class="fixed inset-0 bg-black bg-opacity-35 flex flex-col items-center justify-center z-50 p-8">

            <!-- window -->
            <div class="bg-white border rounded-lg shadow-lg p-6 w-[50%] max-h-[70%]">

                <!-- close button -->
                <div class="flex flex-row w-full justify-end">
                    <button class="closeButton bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-3 rounded-full">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </button>
                </div>


                <?php $allChanges = getChanges($pdo, $docId); ?>

                <!-- logs -->
                <div id="changeLogs" class="flex flex-col mx-auto w-[90%] max-h-[90%] overflow-y-auto divide-y-2">

                    <?php foreach ($allChanges as $change) { ?>

                        <!-- individual record -->
                        <div class="space-y-4 p-4">

                            <!-- who did it -->
                            <div><span class="font-semibold">Done By:</span> <?= $change['username'] ?></div>
                            <!-- what changed -->
                            <div><span class="font-semibold">Changes made:</span>
                                <div class="w-[90%] mx-auto">
                                    <?= $change['changes_made'] ?>
                                </div>
                            </div>
                            <!-- when did it happen -->
                            <div><span class="font-semibold">Time:</span> <?= $change['date_updated'] ?></div>
                        </div>
                        
                    <?php } ?>

                </div>

            </div>

        </div>
        <!-- /ACTIVITY LOGS -->


        <!-- MESSAGES -->
        <div id="messageInterface" class="fixed inset-0 bg-black bg-opacity-35 flex flex-col items-center justify-center z-50 p-8">

            <!-- window -->
            <div class="bg-white border rounded-lg shadow-lg p-6 w-[50%] max-h-[70%]">

                <!-- close button -->
                <div class="flex flex-row w-full justify-end mb-4">
                    <button class="closeButton bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-3 rounded-full">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </button>
                </div>


                <?php $allMessages = getMessages($pdo, $docId); ?>


                <!-- get messages -->
                <div id="messages" class="flex flex-col mx-auto w-[90%] max-h-[80%] overflow-y-auto divide-y-2 mb-4">

                    <?php foreach ($allMessages as $msg) { ?>

                        <!-- individual record -->
                        <div class="space-y-4 p-4">
                            <div><span class="font-semibold text-lg"><?= $msg['username'] ?></span> <span class="text-xs text-gray-500"><?= $msg['date_sent'] ?></span></div>
                            <div class="w-[90%] mx-auto"><?= $msg['msg_content'] ?></div>
                        </div>
                        
                    <?php } ?>

                </div>

                <!-- write message -->
                <div class="inputField mb-4">

                    <form id="formMessage" class="">
                        <input id="messageInput" type="text" class="inputBox" placeholder="send message...">
                    </form>
                    
                    <input type="hidden" id="docId" value="<?= $docId ?>">
                    
                </div>

            </div>

        </div>
        <!-- /MESSAGES -->
        
        <script src="workspace_Scripts.js"></script>
    </body>
</html>