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
        <?php include 'ribbon.php'; ?>

        <!-- *issue: there is no docId upon first creation of document -->
        <?php if (isset($_GET['docId'])) { ?>
            <?php $getAccessedDocument = getAccessedDocument($pdo, $_GET['docId']); ?>
        <?php } else { ?>
            <?php $getNewDocument = getNewDocument($pdo, $_SESSION['user_id']); ?>
        <?php } ?>
        

        <div class="flex flex-col items-center justify-center mt-8">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg border border-gray-200">
                <div class="px-8 py-6 min-h-[600px] outline-none" contenteditable="true" spellcheck="true" id="editor" data-doc-id="<?= isset($_GET['docId']) ? $_GET['docId'] : $getNewDocument['document_id'] ?>">
                    <?= isset($_GET['docId']) ? $getAccessedDocument['content'] : $getNewDocument['content'] ?>
                </div>
            </div>
        </div>

        <div id="shareInterface" class="fixed inset-0 bg-black bg-opacity-35 flex flex-col items-center justify-center z-50 p-8">

                <?php $allUsers = getAllUsers($pdo); ?>
                <?php $docId = isset($_GET['docId']) ? $_GET['docId'] : $getNewDocument['document_id']; ?>

                <div class="bg-white border rounded-lg shadow-lg p-6 w-[50%]">

                    <!-- search -->
                    <div class="inputField">
                        <label for="searchQuery">Share with: </label>
                        <input id="searchInput" type="text" name="searchQuery" class="inputBox" placeholder="Search for users...">
                    </div>
                    
                    <!-- list of users -->
                    <div class="flex flex-col mx-auto w-[90%] max-h-[70%] overflow-y-auto divide-y-2">

                        <?php foreach($allUsers as $user) { ?>

                            <!-- exclude current user -->
                            <?php if ($user['user_id'] == $_SESSION['user_id']) { continue; } else { ?>

                                <!-- show all other users -->
                                <div class="collaborator flex flex-row items-center justify-between py-2" data-collaborator-id="<?= $user['user_id'] ?>">

                                    <div><?= $user['username'] ?></div>

                                    <?php $check_documentShared = check_documentShared($pdo, $docId, $user['user_id']); ?>

                                    <input type="checkbox" class="shareDocument" <?= ($check_documentShared) ? 'checked' : '' ?>>

                                </div>

                            <?php } ?>

                        <?php } ?>

                    </div>
                    
                </div>

            </div>
        
        <script src="workspace_Scripts.js"></script>
    </body>
</html>